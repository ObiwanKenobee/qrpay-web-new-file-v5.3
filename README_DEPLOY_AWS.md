# AWS Deployment Guide for QRPay (ECS Fargate)

This guide summarizes how to deploy with zero downtime using the files in this repo.

Prerequisites
- AWS: ECR, ECS (Fargate), ALB, RDS (MySQL), ElastiCache (Redis), S3, SES
- IAM roles:
  - ECS task execution role (pull from ECR, write logs)
  - ECS task role (read Secrets Manager/SSM parameters)
  - GitHub OIDC deploy role (assumed by workflow)
- GitHub repo: Actions enabled, OIDC role ARN in secrets

Key Files
- docker/Dockerfile: Multi-stage build; runs Nginx + PHP-FPM via Supervisor
- docker/entrypoint.sh: Warm caches; optional migration; one-off command support
- docker/nginx/default.conf: Health at /health.php; Laravel public root
- public/health.php: used by ALB and container HEALTHCHECK
- .github/workflows/deploy-ecs.yml: Build, register TD, optional migrate, update ECS service
- .github/workflows/deploy-ecs-worker.yml: Deploy queue worker service
- ecs-task-def.json: App service task definition (container name: app)
- ecs-task-def-worker.json: Queue worker task definition (container name: worker)
- ecs-task-def-scheduler.json: Scheduler task definition (container name: scheduler)
- .env.aws.example: Production env template for AWS

GitHub configuration
- Variables (Repository → Settings → Variables):
  - AWS_REGION
  - ECR_REPOSITORY (e.g., qrpay-app)
  - ECS_CLUSTER (e.g., qrpay-cluster)
  - ECS_SERVICE (web service name)
  - ECS_WORKER_SERVICE (worker service name)
  - ECS_SUBNETS (comma-separated subnet IDs for run-task migrations, e.g. subnet-aaa,subnet-bbb)
  - ECS_SECURITY_GROUPS (comma-separated SG IDs)
  - MIGRATE_BEFORE_DEPLOY = true (recommended)
- Secrets:
  - AWS_ROLE_TO_ASSUME = arn:aws:iam::<account-id>:role/<GithubOidcDeployRole>

Secrets Manager (recommended)
Store these secrets and use their ARNs in ecs-task-def*.json under "secrets":
- APP_KEY, DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD, REDIS_HOST, AWS_BUCKET

ALB health check
- Target group health check path: /health.php
- Ensure container HEALTHCHECK (curl /health.php) matches

Initial deployment steps
1) Create log groups and ECS cluster (optional helper)
   AWS_REGION=... AWS_ACCOUNT_ID=... ECS_CLUSTER=... ECS_SERVICE=... \
   ECS_WORKER_SERVICE=... ECS_SUBNETS=subnet-1,subnet-2 ECS_SECURITY_GROUPS=sg-1 \
   bash scripts/aws/bootstrap-ecs.sh

2) Provision ALB + target group and wire to ECS service (outside of this repo)
   - Health path: /health.php
   - Rolling update: minHealthy=100, maxPercent=200; enable circuit breaker + rollback

3) Push to main to deploy web service (and optionally worker)
   - deploy-ecs.yml builds image, optionally runs migrations as a one-off task, then updates ECS service
   - deploy-ecs-worker.yml deploys the worker service

Run migrations safely
- Preferred: One-off Fargate run-task executed by deploy-ecs.yml before service update
- Alternative: Temporarily set MIGRATE_ON_BOOT=true in ECS task env for a single rollout (not recommended ongoing)

Queues and scheduler
- Create a separate ECS service using ecs-task-def-worker.json for queue processing (scale horizontally)
- Create an EventBridge Scheduled Task (cron: * * * * ?) using ecs-task-def-scheduler.json

Troubleshooting
- If route:cache fails at runtime, ensure duplicate route names are resolved (already fixed in this repo)
- If view:cache fails due to missing installer views, ensure resources/installer/src/views exists (added .gitkeep)
- If ALB shows unhealthy targets, check container logs and confirm /health.php returns 200 and PHP-FPM is up

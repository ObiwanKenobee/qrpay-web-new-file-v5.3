#!/usr/bin/env bash
# Bootstrap commonly-required AWS resources for ECS deployments (idempotent where possible).
# Requires: AWS CLI v2, jq, and appropriate IAM permissions. Fill placeholders or pass env vars.
# WARNING: This script is an example scaffold. Review before executing in production.

set -euo pipefail

# Required inputs
: "${AWS_REGION:?Must set AWS_REGION}"
: "${AWS_ACCOUNT_ID:?Must set AWS_ACCOUNT_ID}"
: "${ECS_CLUSTER:?Must set ECS_CLUSTER}"
: "${ECS_SERVICE:?Must set ECS_SERVICE}"
: "${ECS_WORKER_SERVICE:?Must set ECS_WORKER_SERVICE}"
: "${ECS_SUBNETS:?Must set ECS_SUBNETS as comma-separated subnet IDs}"
: "${ECS_SECURITY_GROUPS:?Must set ECS_SECURITY_GROUPS as comma-separated SG IDs}"

# Optional log group names
APP_LOG_GROUP="/ecs/qrpay-app"
WORKER_LOG_GROUP="/ecs/qrpay-worker"
SCHEDULER_LOG_GROUP="/ecs/qrpay-scheduler"

create_log_group() {
  local name=$1
  if ! aws logs describe-log-groups --log-group-name-prefix "$name" --region "$AWS_REGION" | jq -e --arg n "$name" '.logGroups[] | select(.logGroupName==$n)' >/dev/null 2>&1; then
    aws logs create-log-group --log-group-name "$name" --region "$AWS_REGION"
    echo "Created log group: $name"
  else
    echo "Log group exists: $name"
  fi
}

echo "Ensuring CloudWatch Logs groups exist..."
create_log_group "$APP_LOG_GROUP"
create_log_group "$WORKER_LOG_GROUP"
create_log_group "$SCHEDULER_LOG_GROUP"

echo "Ensuring ECS cluster exists... ($ECS_CLUSTER)"
if ! aws ecs describe-clusters --clusters "$ECS_CLUSTER" --region "$AWS_REGION" | jq -e '.clusters[0].status=="ACTIVE"' >/dev/null; then
  aws ecs create-cluster --cluster-name "$ECS_CLUSTER" --region "$AWS_REGION" >/dev/null
  echo "Created ECS cluster: $ECS_CLUSTER"
else
  echo "ECS cluster active: $ECS_CLUSTER"
fi

echo "Network configuration to use for run-task or service updates:"
echo "  Subnets: $ECS_SUBNETS"
echo "  Security Groups: $ECS_SECURITY_GROUPS"

echo "NOTE: Creating or updating ALB, target groups, listeners, and ECS services is environment-specific."
echo "Please provision ALB + target group with health check path /health.php and connect to service $ECS_SERVICE."

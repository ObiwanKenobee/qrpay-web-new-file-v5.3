<<<<<<<< Update Guide >>>>>>>>>>>

Immediate Older Version: 5.2.0
Current Version: 5.3.0

Feature Update

1. Admins can create users, agents, and merchants from registration data.
2. Site sections are now dynamically manageable from the admin panel.
3. Extensions check if credentials are properly configured.
4. New All Notifications page added in the admin panel.
5. Admins can open support tickets for users, agents, and merchants.
6. Error logs are viewable and clearable from the admin panel.
7. Added support for dynamic admin URL access.
8. Enhanced roles and permissions management.
9. Integrated Authorize.net payment gateway.


Please Use This Commands On Your Terminal To Update Full System
1. To Run project Please Run This Command On Your Terminal
    composer update && php artisan migrate:fresh --seed && php artisan passport:install --force

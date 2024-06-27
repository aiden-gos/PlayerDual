## Description
This is a Laravel project integrated with MySQL database

Deploy: https://trongphan5301.click/

## Diagram
Link: https://mermaid.live/edit#pako:eNq9V0uTojAQ_itUzmr5QhzOe93T3rasolrSgylDQoWgwzr-9w2vUYegrFLLBdL9pftLdydNTiSUFIlPUP1gECmIN8Ixj5IcU-dUDYqHCY0RKofRi-wAKtyBcgTEeJFqFmOqIU6cUCFopAFomzZL6I32vBHVR5ai6u27AN_630rJHeNCZ-l3IX5cJFRmW47OFjiIENuGQ5kJrfK2Ag6gQbXlCaTpUSraw1TBBkG0WNacEsVsjDTT3CKmmIaKJZpJ0Q5ZkcfgOm4vZ-ddci6P1vxUKiaioMjKjdtbiLHbQrxMLALOUeU960bniSWWnIm90zYwPNlUS8X677CO1B8YRRkUpG1FZ-wJ3VZ8L7rG74HhsS3lbI__IyCFn-BOVDorqpiTD8sllHFsQvcwO09w68zOy6SVEfeup5b7C-Pro-3hAiHTOzn4Po6fbT2NlMXRwITK86pvPZQTehXKy9xMv_mHZmnMpRDh4zPB3oga0zQzxXbTbmq8lhp40DGrpHq3OZSI-72hqE_dESQUXeF7MrhUCqPom_USfXd9lT3L-gbKz0B_Xp-f47E8fTV6_9LXe6CQWkCXHeQ7CYc8tWDqSvabKngIsfOpc-Y3wX4IsZupfyYMaAc2tk2n6tLftLMu0FefuQI0c-x2iqEdeGWr-bR4rJqEX77pHX11rl-fx5ZMlorr60KNqSzWayIjEqOKgVFzySh30oboHZpTm_jmk4Lab8hGnA3OOJW_chESX6sMR0TJLNoR_x14akZV0daXlAaSgCD-iXwQf7GeeJ7rrabebOWtp6v1iOTEH8-Wk-V8OZ-vvbeVu1ou5m_nEfkjpbEwm8xcb-26i7eZO50v1tPliCBlJqw_qytReTMqffwuJxQuz38BQlUxOw

## How to Run the Project
### Requirements
- [Docker](https://www.docker.com/) (installed)
- [Composer]() (installed)

### Running the Project
1. Create and start Docker containers:
    ```bash
    composer install
    sail up -d (./vendor/bin/sail up -d)
    sail exec laravel chmod -R 777 .
    sail exec laravel php artisan key:generate
    sail exec laravel php artisan migrate
    sail exec laravel php artisan db:seed
    sail exec laravel npm run build
    ```
2. Schedule task
   ```
   sail exec laravel php artisan schedule:work
   ```

## Directory Structure
```
├── app
│   ├── Console
│   │   ├── Commands
│   │   │   ├── UpdateStatusOrder.php
│   │   │   └── UpdateStatusStories.php
│   │   └── Kernel.php
│   ├── Events
│   │   └── EventActionNotify.php
│   ├── Exceptions
│   │   └── Handler.php
│   ├── Http
│   │   ├── Controllers
│   │   │   ├── Admin
│   │   │   │   ├── GameCrudController.php
│   │   │   │   ├── OrderCrudController.php
│   │   │   │   ├── RoleCrudController.php
│   │   │   │   └── UserCrudController.php
│   │   │   └── Auth
│   │   │       ├── AuthenticatedSessionController.php
│   │   │       ├── ConfirmablePasswordController.php
│   │   │       ├── EmailVerificationNotificationController.php
│   │   │       ├── EmailVerificationPromptController.php
│   │   │       ├── NewPasswordController.php
│   │   │       ├── PasswordController.php
│   │   │       ├── PasswordResetLinkController.php
│   │   │       ├── RegisteredUserController.php
│   │   │       └── VerifyEmailController.php
│   │   ├── CommentController.php
│   │   ├── Controller.php
│   │   ├── DonateController.php
│   │   ├── FollowController.php
│   │   ├── HomeController.php
│   │   ├── NotificationController.php
│   │   ├── OrderController.php
│   │   ├── PreOrderController.php
│   │   ├── ProfileController.php
│   │   ├── RankController.php
│   │   ├── RateController.php
│   │   ├── StoriesController.php
│   │   ├── StripeController.php
│   │   └── UserController.php
│   ├── Middleware
│   │   ├── Authenticate.php
│   │   ├── CheckIfAdmin.php
│   │   ├── CheckRoleIsAdmin.php
│   │   ├── ContentSecurityPolicy.php
│   │   ├── EncryptCookies.php
│   │   ├── PreventRequestsDuringMaintenance.php
│   │   ├── RedirectIfAuthenticated.php
│   │   ├── TrimStrings.php
│   │   ├── TrustHosts.php
│   │   ├── TrustProxies.php
│   │   ├── ValidateSignature.php
│   │   └── VerifyCsrfToken.php
│   ├── Requests
│   │   ├── Auth
│   │   │   └── LoginRequest.php
│   │   ├── GameRequest.php
│   │   ├── OrderRequest.php
│   │   ├── ProfileUpdateRequest.php
│   │   ├── RoleRequest.php
│   │   └── UserRequest.php
│   └── Kernel.php
│   ├── Models
│   │   ├── Comment.php
│   │   ├── Donate.php
│   │   ├── Follow.php
│   │   ├── Gallery.php
│   │   ├── Game.php
│   │   ├── Like.php
│   │   ├── Order.php
│   │   ├── Rate.php
│   │   ├── Role.php
│   │   ├── Story.php
│   │   └── User.php
│   ├── Notifications
│   │   ├── ActionNotify.php
│   │   └── RentNotify.php
│   ├── Providers
│   │   ├── AppServiceProvider.php
│   │   ├── AuthServiceProvider.php
│   │   ├── BroadcastServiceProvider.php
│   │   ├── EventServiceProvider.php
│   │   └── RouteServiceProvider.php
│   ├── Services
│   │   ├── HomeService.php
│   │   ├── OrderService.php
│   │   ├── PreOrderService.php
│   │   ├── RateService.php
│   │   └── UserService.php
│   └── View
│       └── Components
│           ├── AppLayout.php
│           └── GuestLayout.php
├── bootstrap
│   ├── cache
│   │   ├── .gitignore
│   │   ├── packages.php
│   │   └── services.php
│   └── app.php
├── config
│   ├── backpack
│   │   ├── operations
│   │   │   ├── create.php
│   │   │   ├── list.php
│   │   │   ├── reorder.php
│   │   │   ├── show.php
│   │   │   └── update.php
│   │   ├── base.php
│   │   └── crud.php
│   ├── app.php
│   ├── auth.php
│   ├── broadcasting.php
│   ├── cache.php
│   ├── cloudinary.php
│   ├── cors.php
│   ├── database.php
│   ├── dropbox.php
│   ├── filesystems.php
│   ├── gravatar.php
│   ├── hashing.php
│   ├── logging.php
│   ├── mail.php
│   ├── queue.php
│   ├── sanctum.php
│   ├── sentry.php
│   ├── services.php
│   ├── session.php
│   └── view.php
├── database
│   ├── factories
│   │   ├── DonateFactory.php
│   │   ├── GalleryFactory.php
│   │   ├── OrderFactory.php
│   │   ├── StoryFactory.php
│   │   └── UserFactory.php
│   ├── migrations
│   │   ├── 2013_05_27_084140_create_roles_table.php
│   │   ├── 2014_10_12_000000_create_users_table.php
│   │   ├── 2014_10_12_100000_create_password_resets_table.php
│   │   ├── 2019_05_03_000001_create_customer_columns.php
│   │   ├── 2019_05_03_000002_create_subscriptions_table.php
│   │   ├── 2019_05_03_000003_create_subscription_items_table.php
│   │   ├── 2019_08_19_000000_create_failed_jobs_table.php
│   │   ├── 2019_12_14_000001_create_personal_access_tokens_table.php
│   │   ├── 2024_05_28_085541_create_galleries_table.php
│   │   ├── 2024_06_03_103757_donate.php
│   │   ├── 2024_06_04_022935_create_notifications_table.php
│   │   ├── 2024_06_05_025614_follow.php
│   │   ├── 2024_06_05_075121_game.php
│   │   ├── 2024_06_05_075423_create_game_user_table.php
│   │   ├── 2024_06_06_034405_order.php
│   │   ├── 2024_06_11_031749_create_rates_table.php
│   │   ├── 2024_06_12_024157_create_stories_table.php
│   │   ├── 2024_06_13_051947_create_dropbox_tokens_table.php
│   │   ├── 2024_06_13_083434_create_comments_table.php
│   │   └── 2024_06_13_103608_create_likes_table.php
│   ├── seeders
│   │   ├── DatabaseSeeder.php
│   │   ├── GameSeeder.php
│   │   ├── RoleSeeder.php
│   │   ├── StoriesSeeder.php
│   │   └── UserSeeder.php
│   └── .gitignore
├── docker
│   ├── php
│   │   ├── Dockerfile
│   │   ├── php.ini
│   │   └── xdebug.ini
│   └── web
│       ├── vhost.conf
│       └── web.dockerfile
├── lang
│   └── en
│       ├── auth.php
│       ├── pagination.php
│       ├── passwords.php
│       └── validation.php
├── public
│   ├── .htaccess
│   ├── css
│   │   ├── app.css
│   │   └── style.css
│   ├── img
│   │   ├── gallery
│   │   │   ├── image1.jpg
│   │   │   ├── image2.jpg
│   │   │   └── image3.jpg
│   │   ├── logo.png
│   │   └── profile
│   │       ├── avatar1.jpg
│   │       └── avatar2.jpg
│   ├── index.php
│   ├── js
│   │   ├── app.js
│   │   └── script.js
│   ├── robots.txt
│   └── web.config
├── resources
│   ├── css
│   │   └── app.css
│   ├── js
│   │   └── app.js
│   ├── lang
│   │   └── en
│   │       ├── auth.php
│   │       ├── pagination.php
│   │       ├── passwords.php
│   │       └── validation.php
│   └── views
│       ├── admin
│       │   ├── dashboard.blade.php
│       │   └── user.blade.php
│       ├── auth
│       │   ├── login.blade.php
│       │   ├── password.blade.php
│       │   ├── register.blade.php
│       │   └── verify.blade.php
│       ├── components
│       │   └── alert.blade.php
│       ├── dashboard.blade.php
│       ├── home.blade.php
│       ├── layouts
│       │   ├── app.blade.php
│       │   ├── footer.blade.php
│       │   └── header.blade.php
│       ├── order.blade.php
│       ├── profile.blade.php
│       ├── rank.blade.php
│       ├── stories.blade.php
│       ├── user.blade.php
│       └── welcome.blade.php
├── routes
│   ├── api.php
│   ├── channels.php
│   ├── console.php
│   └── web.php
├── storage
│   ├── app
│   ├── framework
│   │   ├── cache
│   │   ├── sessions
│   │   ├── testing
│   │   └── views
│   └── logs
│       └── laravel.log
├── tests
│   ├── Feature
│   │   ├── ExampleTest.php
│   │   └── UserTest.php
│   └── Unit
│       ├── ExampleTest.php
│       └── UserTest.php
├── .env
├── .env.example
├── .gitattributes
├── .gitignore
├── artisan
├── composer.json
├── composer.lock
├── package.json
├── phpunit.xml
├── docker-compose.yml
├── tailwind.config.js
├── README.md
├── vite.config.js
```


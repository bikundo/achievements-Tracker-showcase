## Video Course Portal User Achievement tracking

**Installation**

1. clone this repo to your local environment
2. From the root directory run `composer install`
3. You must have a MySQL database running locally
4. Update the database details in `.env` to match your local setup
5. Run `php artisan migrate --seed` to setup the database tables ad seed data
6. run `php artisan test` to run the tests.

**Adding new badges and achievements**

- New achievements/ badges can be generated by running `php artisan make:badge` or `php artisan make:achievement` commands and following the prompts
- Please edit the class as required and register it either the `AchievementServiceProvider` or the `BadgeServiceProvider`. 


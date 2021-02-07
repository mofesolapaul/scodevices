### ScoDevices

#### Setup instructions:
1. Clone repository
2. Install composer dependencies `composer install`
3. Run migrations and seed sample users `php artisan migrate:fresh --seed`
4. Launch app with `php artisan serve`
5. Find app at `http://localhost:8000`

#### Docker:
You can spin up Docker environment for this app. Make sure to run migrations within the `scodevices-app` container

#### Login credentials:
user1@email.com : password \
user2@email.com : password

#### Queue:
The application uses queues to run background jobs, run `php artisan queue:work` to ensure that queued jobs are processed.

#### Mailing:
Email config default to `log`, check in `storage/logs/laravel.log` to examine sent emails when a Work device is added.

#### Google Maps
Remember to enable 'Google Maps Javascript Api' and 'Geocoding Api' on your GOOGLE_API_KEY

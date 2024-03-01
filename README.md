# Simple API

## Installation

Create a .env file by copying and renaming .env.example. Configure your environment settings. Uncomment DB_HOST for Docker or leave it commented out for basic installation.

### Using docker and sail

-   Install Laravel Dependencies

        docker run --rm -v $(pwd):/opt -w /opt laravelsail/php83-composer composer install --no-progress --no-interaction

### Without docker

-   Install Laravel Dependencies

        composer install --ignore-platform-reqs --no-progress --no-interaction

## After installation

### Start the application

-   `./vendor/bin/sail up -d` - docker / sail

-   `php artisan serve` - without docker

### Generate Laravel application key

-   `./vendor/bin/sail artisan key:generate` - docker / sail

-   `php artisan key:generate` - without docker

### Run migrations and seeders

-   `./vendor/bin/sail artisan migrate --seed` - docker / sail

-   `php artisan migrate --seed` - without docker

You can access the application using API at:

<http://localhost:8000/api> (without docker)

or

<http://localhost/api> (docker / sail)

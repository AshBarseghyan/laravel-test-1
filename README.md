<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## BPSO

This is the back-end API and web application for the BPSO project. It is built using the Laravel framework.

## Tools

- [Laravel](https://laravel.com/)
- [Spatie Laravel Permission](https://spatie.be/docs/laravel-permission/v4/introduction)
- [Laravel Breeze](https://laravel.com/docs/8.x/starter-kits#laravel-breeze)


## Installation

1. Clone the repository
2. Create a `.env` file from the `.env.example` file
3. Install the dependencies
```bash
composer install
```
4. Update the `.env` file with your database credentials
5. Generate the application key
```bash
php artisan key:generate
```
6. Run the migrations
```bash
php artisan migrate
```
7. Run the seeder
```bash
php artisan db:seed
```
8. Install the front-end dependencies
```bash
npm install
```
9. Build the front-end assets
```bash
npm run build
```


## Usage
```
php artisan serve
```

## Testing
```
php artisan test
```

## Import Commands
```
Users import command - php artisan import:users
Notify users import command - php artisan import:notify-users
```

## REST API
```
POST /api/upload-image - use postman collection in repository
```



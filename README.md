<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## TSI Couponing App for LMS

## Command to run

```
    cp .env.example .env
    yarn install
    yarn dev
    composer install
    php artisan key:generate
    touch db.sqlite
    php artisan migrate:fresh --seed
```

## Change the value of DB_DATABASE in the .env file
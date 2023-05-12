<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Simple Task Manger App

- create new task and assign it to a user
- view statistics about tasks assigned for each user
- view all tasks
- only admins can create and assign tasks

## Running the project
- simply two commands to run the project
- 'php artisan migrate'
- 'php artisan db:seed --class=UsersTableSeeder --no-interaction' [to seed the database with users] take care this would take a while
- 'php artisan serve' [to run the project]


## background jobs
- to run the background jobs you need to run the following command
-  php artisan schedule:work
- this will run the background jobs every minute, and you can change the time in the schedule function in the app/Console/Kernel.php file


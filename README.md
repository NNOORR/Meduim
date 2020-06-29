<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About The Project

Meduim is a platform for publishing and managing articles, created using Laravel7 as a BackEnd admin panel and VueJS as a frontEnd single page application, so it has smoothly surfing and navigation

## Dependencies
You need to have on your local machine the following things:

- **composer** to build the project and download the needed packages
you can download it easily from this site: https://getcomposer.org/

- **npm** Node package Manager to install all needed packages
You can download it easily from this site: https://nodejs.org/en/download/



## Installation instructions
Clone the project to your local machine and put it into your server directory like (WAMP or XAMP) for example in "www" folder

## Establishing the Database for the project
You need to create an empty database called "meduim"

## Build he project
After you cloned the project you should access to the project directory and run the following command using command prompt, and be patient because this step would take awhile

- **composer install** to install all necessary packages for laravel
- **npm install** to install all necessary packages to vueJS
- **php artisan migrate --seed** to migrate all tables to your database and fill them by generated and random info for the test purposes

## Run the project
Now, to run the project you need to run the following command in project directory using command prompt

- **php artisan serv** to run the project

## Project details
The project contains two-sides BackEnd admin panel and FrontEnd.
 
To browse your lovely backend(Laravel) you should go to the following route
- **http://localhost:8000/admin** to visit admin panel

Here in backEnd you can manage your articles (add, edit, delete and view), also you can manage the authors information of the articles and their nationalities, and you can add images and tags to the articles easily and preview then in lovely way.

To browse your lovely frontend(VueJs) you should go to the following route
- **http://localhost:8000** to visit admin panel

Here in frontEnd you can preview all articles by descending added order in depending on the (preview_count) of each article i.e the count of visiting the article by visitors. 

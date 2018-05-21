<p align="center">
<a href="https://travis-ci.org/vaidas-lungis/rss-aggregator"><img src="https://travis-ci.org/vaidas-lungis/rss-aggregator.svg?branch=master" alt="Build Status"></a>
</p>

## About

Simple News RSS application:
- Follow favorite RRS feeds
- Add categories to feeds
- Filter feeds by categories


## Setup
- `composer install`
- `npm install`
- `cp .env.example .env`
- `php artisan key:generate`
- `Setup connection to database`
- `php artisan migrate`
- `php artisan user:create`
- `Login`

## Dev env
For convince `docker-compose.yml` file available. 
Run it with 
- `docker-compose up`

## Heroku instance 
https://vaidas-rss-aggregator.herokuapp.com/
- u: `admin@example.com` / p: `admin`

## Laravel URL Shortener

A simple URL shotener with a very scalable architecture to use in any project

## About project

Designed as example on how to build a scalable architecture and make a good documentation with flowcharts, features included:

- Guide for docs
- Flowcharts for all features
- Builded entirely with TDD
- Dev environment in docker

## Running locally

First of all you need to duplicate .env.example and configure your .env file
```
cp .env.example .env
```

If you have composer locally run this to install dependencies and sail bin:
```
composer install
```

If you don't have composer locally, you can run with docker
```
docker compose up -d
docker exec laravel-url-shortener-laravel.test-1 composer install
docker compose down
```

Run the following commands to finally configure your application
```
./vendor/bin/sail up -d
./vendor/bin/sail php artisan key:generate
./vendor/bin/sail php artisan migrate

```

At this moment yout application will be online on port that you have configured inside .env

To run tests you can use
```
./vendor/bin/sail test
```

## About architecture

The architeture consists in provide fast response with the scalability, the php code must be in a load balancer so can receive a infra upgrade without any trouble. I recommend to use a Redis database to save route cache responses.

The SQL replicas are good to use in case of need of intense sql reads but in most cases(of this shortener), only a central database can maintein the requests because the most routes are saved inside a cache system.

<p align="center">
    <img src="/docs/flowcharts/scalable_architecture.jpg" width="450" title="Scalable Architecture">
</p>

### A lowly architecture for MVP

You can follow this example to use as MVP and validate the project, in this case you can use a cache system like memcached or with files so you don't need to have a redis server running and use a local sqlite.

Basically you can remove load balancer, external cache and dedicated database to run all application inside one simple server without any difficulty.

<p align="center">
    <img src="/docs/flowcharts/mvp_architecture.jpg" width="400" title="MVP Architecture">
</p>

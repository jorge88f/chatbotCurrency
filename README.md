# CHATBOT
## About Chatbot

This apllication provide a view to interact with the bot, also allows currency exchange.

## Technologies

-Docker
-Laravel 8
-MariaDb

## Requirements
    It´s required to have docker installed.
    [docker](https://docs.docker.com/get-docker/)

## Installation
1) In the project folder run

```bash
docker-compose up --build
```

The installation ends when terminal show this message:
Starting Laravel development server: http://0.0.0.0:3000

2) execut seeders

open a new terminal and run in order the next commands to seed the DB
```bash
docker exec -it chatbot_container php artisan db:seed --class=CurrencySeeder 
docker exec -it chatbot_container php artisan db:seed --class=UserSeeder 
docker exec -it chatbot_container php artisan db:seed --class=AccountSeeder 
docker exec -it chatbot_container php artisan db:seed --class=MessageSeeder 
```
## Use
When the installation is finished you can see the chatbot in localhost:3000.
[chatbot](localhost:3000)

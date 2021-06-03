# CHATBOT
## About Chatbot

This apllication provide a view to interact with the bot, also allows currency exchange.

## Technologies

-Docker
-Laravel 8
-MariaDb

## Requirements
    It´s required to have docker installed.
    https://docs.docker.com/get-docker/

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
When the installation is finished you can see the chatbot in http://localhost:3000.

By using the followin commands you can perform actions with an account

The following command its an example that allows you to create an account for the user jorge@flores.com with password 123456  with a balance of 30 USD
- #signup jorge@flores.com 123456 30 USD

The following command is an example of login with the previous register
- #login jorge@flores.com 123456

To logout you simply write in the chat
- #logout

To see your balance write in the chat 
- #balance

To deposit or withdraw you have to specify the amount and the currency, like the examples below
- #deposit 30 USD
- #withdraw 30 USD

To exchange values of money you have to specify the amount and the 'currency from' and the 'currency to'
- #exchange 30 USD EUR
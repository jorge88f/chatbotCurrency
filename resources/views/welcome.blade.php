<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Chatbot</title>
        <link href="/css/app.css" rel="stylesheet"></link>
        <!-- <script src="https://kit.fontawesome.com/a076d05399.js"></script> -->
    </head>
    <body>
        <div class="wrapper">
            <div class="title"><b>Currency Exchange</b></div>
            <div class="form">
                <div class="bot-inbox inbox">
                    <div class="msg-header">
                        <p>Hi, how can I help you?</p>
                    </div>
                </div>
                <div class="user-inbox">
                    <div class="msg-header">
                        <p>whats uuuuuup!</p>
                    </div>
                </div>
            </div>
            <div class="input-data">
                <input type="text" class="text" placeholder="Text to send"></input>
                <button>send</button>
             </div>
        </div>

    </body>
</html>

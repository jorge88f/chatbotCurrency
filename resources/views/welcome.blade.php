<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Chatbot</title>
        <link href="/css/app.css" rel="stylesheet"></link>
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        
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
                
            </div>
            <div class="input-data">
                <input id="message" type="text" class="text" placeholder="Text to send"></input>
                <button id="send-msg" class="btn">SEND</button>
             </div>
        </div>

        <script>
            $(document).ready(function(){
                $("#send-msg").on("click",function(){
                    $value = $("#message").val();
                    if($value != ''){
                        $userMessage = '<div class="user-inbox"><div class="msg-header"><p>'+ $value +'</p></div></div>';
                    $(".form").append($userMessage);
                    $("#message").val('');
                    $.ajax({
                        url: 'bot',
                        type: 'POST',
                        data: {
                                        _token: $("meta[name='csrf-token']").attr("content"),
                                        // _token: '{{ csrf_token() }}',
                                        text: $value
									},

                        success: function(result){
                            $botMessage = '<div class="bot-inbox inbox"><div class="msg-header"><p>'+ result +'</p></div></div>';
                            $(".form").append($botMessage);
                        }
                    });
                    }
                });
            });
    </script>


    </body>
   
</html>

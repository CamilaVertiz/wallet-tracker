<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{csrf_token()}}">

        <title>Wallet Tracker</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="icon" href="/brand-icon.ico" />
        
        <!-- Styles -->        
        <link rel="stylesheet" href="css/app.css" >
    </head>
    <body>
         <div class="content">
            <div id="app"></div>
        </div>
    </body>
    <script type="text/javascript" src="js/app.js"></script>
</html>

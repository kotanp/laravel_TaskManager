<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="\js\ajax.js"></script>
    <script src="\js\scriptLogin.js"></script>
    <meta name="csrf-token" content=<?php $token=csrf_token(); echo $token;?>>
    <title>Login</title>
</head>
<body>
<form id="form" method="POST" action=<?php $route=route('signin.custom'); echo $route?>>
                    <fieldset>
                    <legend>Bejelentkezés:</legend>
                    <input type="hidden" name="_token" value=<?php $token=csrf_token(); echo $token;?>>
                    <label for="azon">Azonosító:</label><br>
                    <input type="text" id="azon" name="azon"><br>
                    <label for="password">Jelszó:</label><br>
                    <input type="password" id="password" name="password">
                    <input type="submit" id="submit" value="Belépés">
                </fieldset> 
                </form>
</body>
</html>
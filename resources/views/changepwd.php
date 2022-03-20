<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="\js\ajax.js"></script>
    <script src="\..\js\scriptChangepwd.js"></script>
    <meta name="csrf-token" content=<?php $token=csrf_token(); echo $token;?>>
    <title>Change Password</title>
</head>
<body>

<form id="form" method="POST">
                    <fieldset>
                    <legend>Jelszó Módosítás:</legend>
                    <input type="hidden" name="_token" value=<?php $token=csrf_token(); echo $token;?>>
                    <label for="oldpwd">Régi jelszó:</label><br>                   
                    <input type="password" id="oldpwd" name="oldpwd"><br>
                    <p id="oldpwderror"></p>
                    <?php //if(session('errors')!==null) { $error=session('errors')/*->first('oldpwd')*/; if (isset($error['oldpwd'])){echo $error['oldpwd']; echo "<br>";}} ?>
                    <?php #if(session('error')!==null) {  echo session('error'); echo "<br>";} ?>
                    <label for="newpwd">Új jelszó:</label><br>
                    <input type="password" id="newpwd" name="newpwd"><br>
                    <p id="newpwderror"></p>
                    <?php /*if(session('errors')!==null) { $error=session('errors')->first('newpwd'); if ($error!==''){echo $error; echo "<br>";}}*/ ?>
                    <label for="confirmpwd">Jelszó megerősítése:</label><br>
                    <input type="password" id="confirmpwd" name="confirmpwd"><br>
                    <p id="confirmpwderror"></p>
                    <?php /*if(session('errors')!==null) { $error=session('errors')->first('currentpwd'); if ($error!==''){echo $error; echo "<br>";}}*/ ?>
                    <button type="submit" id="submit">OK</button>
                </fieldset> 
                </form>
</body>
</html>
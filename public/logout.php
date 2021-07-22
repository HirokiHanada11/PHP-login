<?php
session_start();
require_once '../classes/UserLogic.php';

if(!$logout = filter_input(INPUT_POST, 'logout')){
    exit("Anauthorized Request");
}

//check if the user is logged in, if the session timed out, asked to login again
$result = UserLogic::checkLogin();

if(!$result){
    exit('session timed out, please log in again');
}

//log out
UserLogic::logout();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log out</title>
</head>
<body>
<h2>Log out complete</h2>
<p>Logged out</p>
<a href="login_form.php">Log in</a>
</body>
</html>
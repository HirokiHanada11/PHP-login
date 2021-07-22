<?php
session_start();
require_once '../classes/UserLogic.php';



//error messages
$err = [];

//validation

if(!$email = filter_input(INPUT_POST, 'email')){
    $err['email'] = 'please enter email';
}

if(!$password = filter_input(INPUT_POST, 'password')){
    $err['password'] = 'please enter password';
}

if(count($err) > 0){
    //if error
    $_SESSION = $err;
    header('Location: login_form.php');
    return;
}
//login success
$result = UserLogic::login($email, $password);
//login failed
if(!$result){
    header('Location: login_form.php');
    return;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in Completed</title>
</head>
<body>
<h2>Log in completed</h2>
<p>Log in complete!</p>
<a href="mypage.php">My Page</a>
</body>
</html>
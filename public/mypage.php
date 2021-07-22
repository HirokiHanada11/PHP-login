<?php
session_start();
require_once '../classes/UserLogic.php';
require_once '../function.php';

//check if the user is logged in
$result = UserLogic::checkLogin();

if(!$result){
    $_SESSION['login_err'] = 'Please register and log in';
    header('Location: signup_form.php');
    return;
}

$login_user = $_SESSION['login_user'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Page</title>
</head>
<body>
<h2>My Page</h2>
<p>Log in User:<?php echo h($login_user['name']) ?></p>
<p>email:<?php echo h($login_user['email']) ?></p>
<form action="logout.php" method="POST">
<input type="submit" name="logout" value="Log out">
</form>
</body>
</html>
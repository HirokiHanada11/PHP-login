<?php
session_start();
require_once '../classes/UserLogic.php';

//error messages
$err = [];

$token = filter_input(INPUT_POST, 'csrf_token');
//token error
if(!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']){
    echo $_SESSION['csrf_token'];
    echo $token;
    exit('Unauthorized Request');
}

unset($_SESSION['csrf_token']);

//validation
if(!$username = filter_input(INPUT_POST, 'username')){
    $err[] = 'please enter username';
}

if(!$email = filter_input(INPUT_POST, 'email')){
    $err[] = 'please enter email';
}

$password = filter_input(INPUT_POST, 'password');
if (!preg_match("/\A[a-z\d]{8,100}+\z/i",$password)){
    $err[] = "enter valid password";
}
$password_conf = filter_input(INPUT_POST, 'password_conf');
if($password !== $password_conf){
    $err[] = 'Password does not match';
}

if(count($err) === 0){
    $hasCreated = UserLogic::createUser($_POST);

    if(!$hasCreated){
        $err[] = 'Registration failed';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Completed</title>
</head>
<body>
<?php if(count($err) > 0 ) : ?>
    <?php foreach($err as $e) : ?>
        <p><?php echo $e ?></p>
        <?php endforeach ?>
<?php else: ?>
    <p>Registration complete!</p>
<?php endif ?>
    <a href="./login_form.php">Log in</a>
</body>
</html>
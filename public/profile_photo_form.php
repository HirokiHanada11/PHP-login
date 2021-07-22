<?php
    session_start();

    require_once '../function.php';
    require_once '../classes/UserLogic.php';

    $result = UserLogic::checkLogin();
    if(!$result) {
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
    <title>Add profile photo</title>
</head>
<body>
    <h2>Edit Profile Photo</h2>
    <?php if (isset($login_err)) : ?>
        <p><?php echo $login_err; ?></p>
    <?php endif; ?>
    <form action="profile_photo.php" method="POST" enctype="multipart/form-data">
        <p>
            <label for="photoUrl">Profile Photo<br></label>
            <input type="file" name="photoUrl" accept=".jpd, .jpeg, .png" >
        </p>
        <input type="hidden" name="csrf_token" value="<?php echo h(setToken()); ?>">
        <p>
            <input type="submit" value="Set">
        </p>
    </form>
    <a href="./mypage.php"> Back </a>
</body>
</html>
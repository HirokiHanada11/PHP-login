<?php
session_start();
require_once '../classes/UserLogic.php';

//error messages
$err = [];

// $token = filter_input(INPUT_POST, 'csrf_token');
// //token error
// if(isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']){
//     exit('Unauthorized Request');
// }

// unset($_SESSION['csrf_token']);

$target_dir = "./image/";

// //validation
// if(!$photo = filter_input(INPUT_POST, 'photoUrl')){
//     $err[] = 'please enter file';
// }

$target_file = $target_dir . basename($_FILES["photoUrl"]["name"]);

$imgFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["photoUrl"]["tmp_name"]);
    if($check === false) {
      $err[] =  "File is not an image.";
    }
}
  

// Check file size
if ($_FILES["photoUrl"]["size"] > 500000) {
    $err[] = "Sorry, your file is too large.";
}

// Allow certain file formats
if($imgFileType != "jpg" && $imgFileType != "png" && $imgFileType != "jpeg") {
    $err[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
}

if(count($err) === 0){
    $hasCreated = UserLogic::addProfilePhoto($target_file, $_SESSION['login_user']['id']);
    if(!$hasCreated){
        $err[] = 'Upload failed';
    }
    $_SESSION['login_user']['profilePhotoUrl'] = $target_file;
    if (move_uploaded_file($_FILES["photoUrl"]["tmp_name"], $target_file)) {
      echo "The file ". htmlspecialchars( basename( $_FILES["photoUrl"]["name"])). " has been uploaded.";
    } else {
      echo "Sorry, there was an error uploading your file.";
    }

    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo upload</title>
</head>
<body>
<?php if(count($err) > 0 ) : ?>
    <?php foreach($err as $e) : ?>
        <p><?php echo $e ?></p>
        <?php endforeach ?>
<?php else: ?>
    <p>Photo Uploaded!</p>
<?php endif ?>
    <a href="./mypage.php">Back</a>
</body>
</html>
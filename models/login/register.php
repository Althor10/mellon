<?php
session_start();
if(isset($_SESSION['errors'])){
    unset($_SESSION['errors']);
}
if(isset($_POST['submit'])){

    $username = $_POST['username'];
    $password = $_POST['pass'];
    $first = $_POST['first_name'];
    $last = $_POST['last_name'];

    $errors = [];
    $reLozinka = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$^+=!*()@%&_-]).{8,}$/";
    $reName = "/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/";

    if (!preg_match($reLozinka, $password)) {
        $errors[] = "Password or e-mail is wrong.";
    }
    if(!preg_match($reName,$first)){
        array_push($errors,"Wrong Name Format");
    }
    if(!preg_match($reName,$last)){
        array_push($errors,"Wrong Name Format");
    }

//profilePic
$profilePic_name = $_FILES['profilePic']['name'];
$profilePic_tmpLocation = $_FILES['profilePic']['tmp_name'];
$profilePic_type = $_FILES['profilePic']['type'];
$profilePic_size = $_FILES['profilePic']['size'];
$th = $_FILES['profilePic'];


// 3 000 000 ~ 3MB

$approoved_types = ['image/jpg', 'image/jpeg', 'image/png'];

if(!in_array($profilePic_type,$approoved_types)){
    array_push($errors,"Wrong file type!");
}
if($profilePic_size > 3000000){
    array_push($errors, "Maximum file limit exceeded. File must be maximum 3MB.");
}
list($widthPic, $heightPic) = getimagesize($profilePic_tmpLocation);

$presentImgPic = null;
switch($profilePic_type){
    case 'image/jpeg':
        $presentImgPic = imagecreatefromjpeg($profilePic_tmpLocation);
        break;
    case 'image/png':
        $presentImgPic = imagecreatefrompng($profilePic_tmpLocation);
        break;
}

//profilePic=============================================================================================
$newWidthPic = 200;
$newHeightPic = ($newWidthPic/$widthPic) * $heightPic; // novaVisina : visina = novaSirina : sirina

$newImgPic = imagecreatetruecolor($newWidthPic, $newHeightPic);

imagecopyresampled($newImgPic, $presentImgPic, 0, 0, 0, 0, $newWidthPic, $newHeightPic, $widthPic, $heightPic);

$thmbName = time().$profilePic_name;
$pathNewImgPic = 'assets/images/uploaded/uploaded_'.$thmbName;

switch($profilePic_type){
    case 'image/jpeg':
        imagejpeg($newImgPic, '../../'.$pathNewImgPic, 75);
        break;
    case 'image/png':
        imagepng($newImgPic, '../../'.$pathNewImgPic);
        break;
}

$pathOrgImgPic = 'assets/uploaded/'.$thmbName;

if(move_uploaded_file($profilePic_tmpLocation, '../../'.$pathNewImgPic)){
    $password = md5($password);
    try{
        $isInserted = insertUser($first,$last,$username,$password,$pathNewImgPic);
        if($isInserted){
            echo "Your post has been inserted into the database";
            $_SESSION['success'] = "New user created!";
            header('Location: ../../index.php?page=login');
        } else {
            $_SESSION['errors'] = "Failed to insert a user!";
            header("Location: ../../index.php?page=login&content=register");
        }
    } catch (PDOException $e){
        $_SESSION['errors'] = $e->getMessage();
        header("Location: ../../index.php?page=login&content=register");
    }
} else {

    $_SESSION['errors'] = "Failed to insert the picture!";
    header("Location: ../../index.php?page=login&content=register");
}
}
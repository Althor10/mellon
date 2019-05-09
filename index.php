<?php
include "config/connection.php";
session_start();

$page="";

if(isset($_GET['page'])){
    $page = $_GET['page'];
}

if($page == 'login'){
    include "assets/views/login/loginHead.php";
    include "assets/views/login/loginForm.php";
    include "assets/views/login/loginFooter.php";
} else if ($page == 'admin'){
    include "admin.txt";
}else{

    include "assets/views/head.php";
    include "assets/views/header.php";
    switch ($page){
        case 'home':
            include "assets/views/pages/homeSlider.php";
            include "assets/views/pages/homeContent.php";
            break;
        case 'about':
            include "assets/views/pages/";
            break;
        case "category":
            include "assets/views/pages/";
            break;
        case "contact":
            include "assets/views/pages/";
            break;
        case "single":
            include "assets/views/pages";
            break;
        default:
            include "assets/views/pages/homeSlider.php";
            include "assets/views/pages/homeContent.php";
            break;
    }
    include "assets/views/footer.php";
    include "assets/views/scripts.php";
}
<?php
header('Content-Type: application/json');
require_once "../../config/connection.php";
include "functionsPosts.php";
if(isset($_POST['postId'])){

    $id = $_POST['postId'];
   // echo $id;
    $rezultat = getSinglePost($id);
    echo json_encode($rezultat);
}

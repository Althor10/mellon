<?php

$statusCode = 404;
if ($_SERVER['REQUEST_METHOD'] != "POST") {
    echo "Error! You aren't authorised to be here!";
}
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    include "../../config/connection.php";
    $deleteCat = $conn->prepare("DELETE FROM post_category WHERE id_post = :idc");
    $deleteCat->bindParam(":idc",$id);
    $deletePic = $conn->prepare("DELETE FROM post_img WHERE id_post = :idi");
    $deletePic->bindParam(":idi",$id);
    $deletePost = $conn->prepare("DELETE FROM post WHER post_id = :idp");
    $deletePost->bindParam(":idp",$id);

    try {
        $rezDC = $deleteCat->execute();
        $rezDI = $deletePic->execute();
        $rezDP = $deletePost->execute();
        if($rezDC && $rezDI && $rezDP){
            $statusCode = 204;
        }else{
            $statusCode = 500;
        }
    } catch (PDOException $e) {
        $statusCode = 500;
    }
}
// Vracanje statusnog koda ka klijentu (JS)
http_response_code($statusCode);
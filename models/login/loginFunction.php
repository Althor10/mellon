<?php
require "../../config/connection.php";
function insertUser($first,$last,$username,$password,$pathNewImgPic){
    global $conn;
    $insert = $conn->prepare("INSERT INTO bloguser VALUES('',?,?,?,?,null,?,DEFAULT ,CURRENT_TIMESTAMP )");
    $rezultat = $insert->execute([$username,$password,$first,$last,$pathNewImgPic]);
    return $rezultat;
}
<?php
header('Content-Type: application/json');
require_once "../../config/connection.php";

    $rezultat = executeQuery(getQuery());
    echo json_encode($rezultat);


function getQuery(){
    return "SELECT * FROM post p INNER JOIN bloguser bu ON p.id_user=bu.user_id INNER JOIN post_category pc ON p.post_id=pc.id_post INNER JOIN categories c ON pc.id_cat=c.category_id";
}
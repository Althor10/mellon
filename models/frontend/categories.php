<?php
header('Content-Type: application/json');
require_once "../../config/connection.php";

$rezultat = executeQuery(getQuery());
echo json_encode($rezultat);


function getQuery(){
    return "SELECT cat_name,COUNT(id_post) as postCount FROM categories c LEFT JOIN post_category pc ON c.category_id=pc.id_cat LEFT JOIN post p ON pc.id_post=p.post_id GROUP BY cat_name ORDER BY cat_name";
}
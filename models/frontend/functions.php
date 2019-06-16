<?php

function getCategories(){
    return "SELECT category_id, cat_name,COUNT(id_post) as postCount FROM categories c LEFT JOIN post_category pc ON c.category_id=pc.id_cat LEFT JOIN post p ON pc.id_post=p.post_id GROUP BY cat_name,category_id,cat_name ORDER BY cat_name";
}


function getSliders(){
    return "SELECT * FROM post p INNER JOIN bloguser bu ON p.id_user=bu.user_id INNER JOIN post_category pc ON p.post_id=pc.id_post INNER JOIN categories c ON pc.id_cat=c.category_id LIMIT 3";
}


function getTags(){
    return "SELECT tag_name FROM tags";
}

function getBio(){
   return "SELECT * FROM bloguser WHERE id_role = 1";
}

function getNav(){
    return "SELECT * FROM nav_menu";
}

function getCategoryOne($id){
    global $conn;
    $query =  "SELECT cat_name FROM categories WHERE category_id = ?";
   $rez = $conn->prepare($query);
   $rez->execute([$id]);
    $rezultat = $rez->fetchAll();
   return $rezultat;
}
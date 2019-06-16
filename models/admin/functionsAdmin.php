<?php

function getPostsTable(){
    return "SELECT *,COUNT(comment_id) as numCom FROM post p LEFT JOIN comments c ON p.post_id=c.post_com_id LEFT JOIN post_category pc ON p.post_id=pc.id_post LEFT JOIN categories ca ON pc.id_cat=ca.category_id GROUP BY title,post_id,comment_id,post_cat_id ORDER BY title ASC ";
}

function getUsersTable(){
    return "SELECT *,COUNT(comment_id) as numCom FROM bloguser bu LEFT JOIN comments c ON bu.user_id=c.id_user GROUP BY first_name ORDER BY comment_id";
}

function insertPost($title,$subtitle,$text, $pathNewImg){
    global $conn;
    $insert = $conn->prepare("INSERT INTO post VALUES('', ?, ?,?,?,DEFAULT,CURRENT_TIMESTAMP )");
    $isInserted = $insert->execute([$title,$subtitle,$text, $pathNewImg]);
    return $isInserted;
}

function getInsertedPost($pathNewImg){
    global $conn;
    $get = $conn->prepare("SELECT post_id FROM post WHERE thumbnail = ?");
    $rez = $get->execute([$pathNewImg]);
    $rez = $get->fetchAll();
    return $rez;
}

function insertImgs($isPostAdded,$pathNewImgFirst,$pathNewImgSecond,$pathNewImgThird){
    global $conn;
    $insert = $conn->prepare("INSERT INTO post_img VALUES('',?,?,?,?)");
    $rez = $insert->execute([ $isPostAdded,$pathNewImgFirst,$pathNewImgSecond,$pathNewImgThird ]);
    return $rez;
}

function insertCat($isPostAdded,$category){
    global $conn;
    $insert = $conn->prepare("INSERT INTO post_category(post_cat_id,id_post,id_cat) VALUES('',?,?)");
    $rez = $insert->execute([$isPostAdded,$category]);
    return $rez;
}

function updatePost($id,$title,$subtitle,$text, $pathNewImg){
    global $conn;
    $update = $conn->prepare("UPDATE post SET title= ?, subtitle = ?, text = ? , thumbnail = ? WHERE post_id = ?");
    $isUpdated = $update->execute([$title,$subtitle,$text, $pathNewImg,$id]);
    return $isUpdated;
}

function updateImgs($id,$pathNewImgFirst,$pathNewImgSecond,$pathNewImgThird){
    global $conn;
    $update = $conn->prepare("UPDATE post_img SET first_img_path = ?, second_img_path  = ?, third_img_path  = ? WHERE id_post = ?");
    $isUpdated = $update->execute([$pathNewImgFirst,$pathNewImgSecond,$pathNewImgThird,$id]);
    return $isUpdated;
}

function updateCat($id,$category){
    global $conn;
    $update = $conn->prepare("UPDATE post_img SET id_cat = ? WHERE id_post = ?");
    $isUpdated = $update->execute([$category,$id]);
    return $isUpdated;
}
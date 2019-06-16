<?php

function getLatestPosts(){
    return "SELECT * FROM post p INNER JOIN bloguser bu ON p.id_user=bu.user_id GROUP BY post_id,title,post_date ORDER BY post_date DESC";
}
function getLatestPostsFooter(){
    return "SELECT * FROM post p INNER JOIN bloguser bu ON p.id_user=bu.user_id GROUP BY post_id,title,post_date ORDER BY post_date DESC";
}
function getCategoryPosts($id)
{
    global $conn;
    $rezultat = $conn->prepare("SELECT * FROM post p INNER JOIN post_category pc ON p.post_id=pc.id_post INNER JOIN categories c ON pc.id_cat=c.category_id INNER JOIN bloguser b ON p.id_user=b.user_id WHERE category_id = ?");
    $rezultat->execute([$id]);
    return $rezultat->fetchAll();
        }
function getCategoryPostsAll(){
    return "SELECT * FROM post p INNER JOIN post_category pc ON p.post_id=pc.id_post INNER JOIN categories c ON pc.id_cat=c.category_id INNER JOIN bloguser b ON p.id_user=b.user_id";
}
function getPopPosts(){
    return "SELECT post_id, title,thumbnail,post_date,comment_id FROM post p LEFT JOIN comments c ON p.post_id = c.post_com_id GROUP BY post_id, title,thumbnail,post_date,comment_id ORDER BY comment_id DESC LIMIT 3";
}

function getSinglePost($id){
    global $conn;
    $rezultat = $conn->prepare("SELECT * FROM post p INNER JOIN post_category pc ON p.post_id=pc.id_post INNER JOIN categories c ON pc.id_cat=c.category_id INNER JOIN bloguser b ON p.id_user=b.user_id INNER JOIN post_img pi ON p.post_id = pi.id_post WHERE post_id = ?");
    $rezultat->execute([$id]);
    return $rezultat->fetchAll();
}

function getComments($id){
    global $conn;
    $rezultat = $conn->prepare("SELECT * FROM comments c LEFT JOIN post p ON p.post_id=c.post_com_id LEFT JOIN bloguser bu ON c.id_user=bu.user_id WHERE post_com_id = ?");
    $rezultat->execute([$id]);
    return $rezultat->fetchAll();
}
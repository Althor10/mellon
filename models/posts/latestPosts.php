<?php
header('Content-Type: application/json');
require_once "../../config/connection.php";
include "functionsPosts.php";

$rezultat = executeQuery(getLatestPosts());
echo json_encode($rezultat);

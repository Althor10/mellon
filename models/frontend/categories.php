<?php
header('Content-Type: application/json');
require_once "../../config/connection.php";
include "functions.php";

$rezultat = executeQuery(getCategories());
echo json_encode($rezultat);

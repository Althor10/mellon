<?php
header('Content-Type: application/json');
require_once "../../config/connection.php";
include "functionsAdmin.php";

$rezultat = executeQuery(getUsersTable());
echo json_encode($rezultat);

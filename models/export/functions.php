<?php
function getUsers(){
    return executeQuery("SELECT * FROM bloguser b INNER JOIN role r ON b.id_role=r.role_id");
}
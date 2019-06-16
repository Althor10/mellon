<?php
session_start();
if (isset($_POST['submit'])) {
    unset($_SESSION['error']);
    $username = $_POST['username'];
    $password = $_POST['pass'];
    $errors = [];
    $reLozinka = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$^+=!*()@%&_-]).{8,}$/";
    if (!preg_match($reLozinka, $password)) {
        $errors[] = "Password or e-mail is wrong.";
    }
    if (count($errors) > 0) {
        $_SESSION['error'] = $errors;
        require "../../config/connection.php";
        saveLogError();
        header("Location: ../../index.php?page=login");
    } else {
        require_once "../../config/connection.php";
        $pass = md5($password);
        $query = "SELECT * FROM bloguser bu INNER JOIN role r ON bu.id_role=r.role_id WHERE username = :username AND password = :password";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $pass);
        $stmt->execute();
        $user = $stmt->fetch(); // Dohvatanje samo jednog korisnika
        if ($user) {

            $_SESSION['user'] =  $user; //Pravljenje sesije koja kao sadrzaj ima rezultat rada baze podataka
                if($user->role_name == 'blogger(admin)'){
                    header("Location: ../../index.php?page=admin");
                }else {

                    header("Location: ../../?page=home");
                }
        } else {
            $errors[] = "Wrong e-mail or password";
            saveLogError();

            $_SESSION['error'] = $errors;
          //  header("Location: ../../?page=login");
        }
    }
}
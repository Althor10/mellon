<?php
session_start();
if(isset($_SESSION['errors'])){
    unset($_SESSION['errors']);
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['btnSubmit'])){
            $cName = $_POST['cName'];
            $cEmail = $_POST['cEmail'];
            $cPhone = $_POST['cPhone'];
            $cMess = $_POST['cMess'];

         $errror = [];
         $regName = "/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/";
         $regPhone = "/^\+3816[0-9]{8,11}$/";
         $regEmail = "/[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/";

         if(!preg_match($regName,$cName)){
             array_push($errror,"Wrong name Format!");
         }
        if(!preg_match($regPhone,$cPhone)){
            array_push($errror,"Wrong Phone Format!");
        }
        if(!filter_var($cEmail, FILTER_VALIDATE_EMAIL)){
            array_push($errror,"Wrong e-mail Format!");
        }

        if(strlen($cMess) > 3000){
            array_push($errror,"Message exeeds maximum character length!");
        }

        if(count($errror)>0){
            $_SESSION['errors'] = $errror;
            header("Location: ../../index.php?page=home");
        }else{
            include "../../config/connection.php";

            $insert = $conn->prepare("INSERT INTO contact VALUES ('',?,?,?,?)");
            try{
                $rezultat = $insert->execute([$cName,$cPhone,$cEmail,$cMess]);

                if($rezultat){
                    $_SESSION['success'] = "Message has been added!";
                    header("Location: ../../index.php?page=contact");
                    http_response_code(200);
                }

            }catch (PDOException $e){
                array_push($errror,$e->getMessage());
                $_SESSION['errors'] = $errror;
                http_response_code(500);
            }
        }


        } else http_response_code(500);
} http_response_code(403);

<?php
session_start();
if(isset($_SESSION['errors'])){
    unset($_SESSION['errors']);
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['btnSubmit'])){

        require_once "../../config/connection.php";
        require_once "functionsAdmin.php";

        //TextData
        $id = $_POST['id'];
        $category = $_POST['category'];
        $title = $_POST['title'];
        $subtitle = $_POST['subtitle'];
        $text = $_POST['text'];

        $errors = [];

        $regTitle = "/[\"']?[A-Z][^.?!]+((?![.?!]['\"]?\s[\"']?[A-Z][^.?!]).)+[.?!'\"]?/";

        if(!preg_match($regTitle,$title)){
            array_push($errors,"Title is in wrong format!");
        }
        if(!preg_match($regTitle,$subtitle)){
            array_push($errors, "Subtitle format is wrong");
        }

        if(strlen($text)>3000){
            array_push($errors, "Too many characters in the textarea!");
        }

        if($category == 0){
            array_push($errors,"You Must Choose a category!");
        }


        //Thumbnail
        $thumbnail_name = $_FILES['thumbnail']['name'];
        $thumbnail_tmpLocation = $_FILES['thumbnail']['tmp_name'];
        $thumbnail_type = $_FILES['thumbnail']['type'];
        $thumbnail_size = $_FILES['thumbnail']['size'];
        $th = $_FILES['thumbnail'];


        // 3 000 000 ~ 3MB

        $approoved_types = ['image/jpg', 'image/jpeg', 'image/png'];

        if(!in_array($thumbnail_type,$approoved_types)){
            array_push($errors,"Wrong file type!");
        }
        if($thumbnail_size > 3000000){
            array_push($errors, "Maximum file limit exceeded. File must be maximum 3MB.");
        }

        //1. Image
        $firstImage_name = $_FILES['firstPic']['name'];
        $firstImage_tmpLocation = $_FILES['firstPic']['tmp_name'];
        $firstImage_type = $_FILES['firstPic']['type'];
        $firstImage_size = $_FILES['firstPic']['size'];
        $fi = $_FILES['firstPic'];



        if(!in_array($firstImage_type,$approoved_types)){
            array_push($errors,"Wrong file type!");
        }
        if($firstImage_size > 3000000){
            array_push($errors, "Maximum file limit exceeded. File must be maximum 3MB.");
        }

        //2. image
        $secondImage_name = $_FILES['secondPic']['name'];
        $secondImage_tmpLocation = $_FILES['secondPic']['tmp_name'];
        $secondImage_type = $_FILES['secondPic']['type'];
        $secondImage_size = $_FILES['secondPic']['size'];
        $si = $_FILES['secondPic'];

        if(!in_array($secondImage_type,$approoved_types)){
            array_push($errors,"Wrong file type!");
        }
        if($secondImage_size > 3000000){
            array_push($errors, "Maximum file limit exceeded. File must be maximum 3MB.");
        }

        //3. Img
        $thirdImage_name = $_FILES['thirdPic']['name'];
        $thirdImage_tmpLocation = $_FILES['thirdPic']['tmp_name'];
        $thirdImage_type = $_FILES['thirdPic']['type'];
        $thirdImage_size = $_FILES['thirdPic']['size'];
        $ti = $_FILES['thirdPic'];

        // 3 000 000 ~ 3MB
        if(!in_array($thirdImage_type,$approoved_types)){
            array_push($errors,"Wrong file type!");
        }
        if($thirdImage_size > 3000000){
            array_push($errors, "Maximum file limit exceeded. File must be maximum 3MB.");
        }

//            echo $thumbnail_type.'<br>';
//            echo $firstImage_type.'<br>';
//            echo $secondImage_type.'<br>';
//            echo $thirdImage_type.'<br>';
//
//            var_dump($errors);


        if(count($errors) == 0 ){

            list($widthThumb, $heightThumb) = getimagesize($thumbnail_tmpLocation);
            list($widthFirstImg, $heightFirstImg) = getimagesize($firstImage_tmpLocation);
            list($widthSecondImg, $heightSecondImg) = getimagesize($secondImage_tmpLocation);
            list($widthThirdImg, $heightThirdImg) = getimagesize($thirdImage_tmpLocation);

            //Postojeca slika Thumb
            $presentImgThumb = null;
            switch($thumbnail_type){
                case 'image/jpeg':
                    $presentImgThumb = imagecreatefromjpeg($thumbnail_tmpLocation);
                    break;
                case 'image/png':
                    $presentImgThumb = imagecreatefrompng($thumbnail_tmpLocation);
                    break;
            }
            //Postojeca slika First
            $presentImgFirst = null;
            switch($firstImage_type){
                case 'image/jpeg':
                    $presentImgFirst = imagecreatefromjpeg($firstImage_tmpLocation);
                    break;
                case 'image/png':
                    $presentImgFirst = imagecreatefrompng($firstImage_tmpLocation);
                    break;
            }
            //Postojeca slika Second
            $presentImgSecond = null;
            switch($secondImage_type){
                case 'image/jpeg':
                    $presentImgSecond = imagecreatefromjpeg($secondImage_tmpLocation);
                    break;
                case 'image/png':
                    $presentImgSecond = imagecreatefrompng($secondImage_tmpLocation);
                    break;
            }
            //Postojeca slika Third
            $presentImgThird = null;
            switch($thirdImage_type){
                case 'image/jpeg':
                    $presentImgThird = imagecreatefromjpeg($thirdImage_tmpLocation);
                    break;
                case 'image/png':
                    $presentImgThird = imagecreatefrompng($thirdImage_tmpLocation);
                    break;
            }

            //THUMBNAIL=============================================================================================
            $newWidthThumb = 200;
            $newHeightThumb = ($newWidthThumb/$widthThumb) * $heightThumb; // novaVisina : visina = novaSirina : sirina

            $newImgThumb = imagecreatetruecolor($newWidthThumb, $newHeightThumb);

            imagecopyresampled($newImgThumb, $presentImgThumb, 0, 0, 0, 0, $newWidthThumb, $newHeightThumb, $widthThumb, $heightThumb);

            $thmbName = time().$thumbnail_name;
            $pathNewImgThumb = 'assets/images/uploaded/uploaded_'.$thmbName;

            switch($thumbnail_type){
                case 'image/jpeg':
                    imagejpeg($newImgThumb, '../../'.$pathNewImgThumb, 75);
                    break;
                case 'image/png':
                    imagepng($newImgThumb, '../../'.$pathNewImgThumb);
                    break;
            }

            $pathOrgImgThumb = 'assets/uploaded/'.$thmbName;
            //======================================================================================================

            //FIRST IMG=============================================================================================
            $newWidthFirst = 200;
            $newHeightFirst = ($newWidthFirst/$widthFirstImg) * $heightFirstImg; // novaVisina : visina = novaSirina : sirina

            $newImgFirst = imagecreatetruecolor($newWidthFirst, $newHeightFirst);

            imagecopyresampled($newImgFirst, $presentImgFirst, 0, 0, 0, 0, $newWidthFirst, $newHeightFirst, $widthFirstImg, $heightFirstImg);

            $firstName = time().$firstImage_name;
            $pathNewImgFirst = 'assets/images/uploaded/uploaded_'.$firstName;

            switch($firstImage_type){
                case 'image/jpeg':
                    imagejpeg($newImgFirst, '../../'.$pathNewImgFirst, 75);
                    break;
                case 'image/png':
                    imagepng($newImgFirst, '../../'.$pathNewImgFirst);
                    break;
            }

            $pathOrgImgFirst = 'assets/uploaded/'.$firstName;
            //======================================================================================================

            //SECOND IMG=============================================================================================
            $newWidthSecond = 200;
            $newHeightSecond = ($newWidthSecond/$widthSecondImg) * $heightSecondImg; // novaVisina : visina = novaSirina : sirina

            $newImgSecond = imagecreatetruecolor($newWidthSecond, $newHeightSecond);

            imagecopyresampled($newImgSecond, $presentImgSecond, 0, 0, 0, 0, $newWidthSecond, $newHeightSecond, $widthSecondImg, $heightSecondImg);

            $secondName = time().$secondImage_name;
            $pathNewImgSecond = 'assets/images/uploaded/uploaded_'.$secondName;

            switch($secondImage_type){
                case 'image/jpeg':
                    imagejpeg($newImgSecond, '../../'.$pathNewImgSecond, 75);
                    break;
                case 'image/png':
                    imagepng($newImgSecond, '../../'.$pathNewImgSecond);
                    break;
            }

            $pathOrgImgSecond = 'assets/uploaded/'.$secondName;
            //======================================================================================================


            //THIRD IMG=============================================================================================
            $newWidthThird = 200;
            $newHeightThird = ($newWidthThird/$widthThirdImg) * $heightThirdImg; // novaVisina : visina = novaSirina : sirina

            $newImgThird = imagecreatetruecolor($newWidthThird, $newHeightThird);

            imagecopyresampled($newImgThird, $presentImgThird, 0, 0, 0, 0, $newWidthThird, $newHeightThird, $widthThirdImg, $heightThirdImg);

            $thirdName = time().$thirdImage_name;
            $pathNewImgThird = 'assets/images/uploaded/uploaded_'.$thirdName;

            switch($thirdImage_type){
                case 'image/jpeg':
                    imagejpeg($newImgThird, '../../'.$pathNewImgThird, 75);
                    break;
                case 'image/png':
                    imagepng($newImgThird, '../../'.$pathNewImgThird);
                    break;
            }

            $pathOrgImgThird = 'assets/uploaded/'.$thirdName;
            //======================================================================================================


            if(move_uploaded_file($thumbnail_tmpLocation, '../../'.$pathNewImgThumb) && move_uploaded_file($firstImage_tmpLocation,'../../'.$pathNewImgFirst) && move_uploaded_file($secondImage_tmpLocation,'../../'.$pathNewImgSecond) && move_uploaded_file($thirdImage_tmpLocation,'../../'.$pathNewImgThird)){
                echo "Thumbnail is uploaded to server!";

                try {
                    $isInsertedPost = updatePost($id,$title,$subtitle,$text,$pathNewImgThumb);

                    if($isInsertedPost){

                            $isInsertedImgs = updateImgs($id,$pathNewImgFirst,$pathNewImgSecond,$pathNewImgThird);
                            $isInsertedCat = updateCat($id,$category);
                            if($isInsertedImgs && $isInsertedCat){
                                http_response_code(200);
                                echo "Your post has been inserted into the database";
                                header('Location: ../../index.php?page=admin');
                            } else{
                                $_SESSION['errors'] = "Coulnd't insert new post";
                                header("Location: ../../index.php?page=admin");
                                http_response_code(500);

                        }


                    } else {
                        $_SESSION['errors'] = "Coulnd't insert new post";
                        header("Location: ../../index.php?page=admin");
                        http_response_code(500);
                    }

                } catch(PDOException $ex){
                    echo $ex->getMessage();
                    $_SESSION['errors'] = "Coulnd't insert new post ".$ex->getMessage();
                    header("Location: ../../index.php?page=admin");
                    http_response_code(500);
                }
            }

            // brisanje iz memorije
            imagedestroy($presentImgThumb);
            imagedestroy($newImgThumb);
            imagedestroy($presentImgFirst);
            imagedestroy($newImgFirst);
            imagedestroy($presentImgSecond);
            imagedestroy($newImgSecond);
            imagedestroy($presentImgThird);
            imagedestroy($newImgThird);

        }else {
            var_dump($errors);
            $_SESSION['errors'] = $errors;
            header('Loation: ../../index.php?page=admin');
            http_response_code(500);

        }
    }
}else {
    $_SESSION['errors'] = "You are forbidden!";
    header("Location: ../../index.php?page=index");
    http_response_code(419);
}
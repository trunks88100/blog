<?php

if($_SERVER['REQUEST_METHOD'] === "POST"){
    $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
    $content = filter_var($_POST['content'], FILTER_SANITIZE_STRING);

    if($_FILES['file']['error'] === 0){
        $file = $_FILES['file'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = (int) $file['size'];
        $fileError = $file['error'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($fileTmpName);
        $allowedTypes = array('image/png', 'image/jpg', 'image/jpeg');

        //Error Handling
         if(!is_valid_img($mimeType, $allowedTypes, $fileError, $fileSize, $errors)){
            $errors['invalid_img'] = "Your image is not valid, it may be too big or have an unexpected extension";
            }

         $fileNameNew = uniqid('',true). '.'.$fileActualExt;
        $fileDestination = __DIR__."/../../public/assets/post_img/".$fileNameNew;
        $filePath = '/blog/assets/post_img/'.$fileNameNew;
        move_uploaded_file($fileTmpName, $fileDestination);
        
    } else {
        $filePath = "";
    }
    
  


    try {
        require_once __DIR__ .'/../dbh.inc.php';
        require_once 'post_model.inc.php';
        require_once 'post_contr.inc.php';

        //ERROR HANDLERS

        $errors = [];

        if(is_input_empty($title, $content)){
            $errors['empty_input'] = 'PLEASE FILL IN ALL FIELDS';
        }

        if(invalid_length($title, 3, 50) || invalid_length($content, 10, 200)){
            $errors['invalid_length'] = "INVALID LENGTH DETECTED";
        }

        
        // require_once __DIR__ . '/../config_session.inc.php';

        if($errors){
            $_SESSION['post_errors'] = $errors;
            header("Location: /blog/dashboard.php");
            exit();
        }

        // //create a new post
       
        $id = $_SESSION['user_id'];
        create_post($pdo,$id,$title,$content, $filePath);
        $_SESSION['newPost'] = "You just created a new post!";

         
        


        header("Location: /blog/dashboard.php");
        exit();

    } catch (PDOException $e) {
        exit('Query failed: '. $e->getMessage());
    }

} else {
    header("Location: /blog/index.html");
    exit();
}

?>
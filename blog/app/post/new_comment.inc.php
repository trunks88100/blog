<?php

if($_SERVER['REQUEST_METHOD'] === "POST"){
    $content = htmlspecialchars($_POST['content']);
    $user_id = (int) $_SESSION['user_id'];
    $post_id = (int) $_POST['post_id'];

    try {
        require_once __DIR__ .'/../dbh.inc.php';
        require_once 'comments_model.inc.php';
        require_once 'post_contr.inc.php';

        //ERROR HANDLERS

        $errors = [];

        if(is_input_empty('y', $content)){
            $errors['empty_input'] = 'PLEASE FILL IN ALL FIELDS';
        }

        if(invalid_length($content, 0, 100)){
            $errors['invalid_length'] = "INVALID LENGTH DETECTED";
        }

        require_once __DIR__ . '/../config_session.inc.php';

        if($errors){
            $_SESSION['post_errors'] = $errors;
            header("Location: /blog/dashboard.php");
            exit();
        }

        //create a new post
        $id = $_SESSION['user_id'];
        create_comment($pdo, $user_id, $post_id, $content);
        $_SESSION['newPost'] = "You just wrote a new comment!";


        header("Location: /blog/dashboard.php");
        exit();

    } catch (PDOException $e) {
        exit('Query failed: '. $e->getMessage());
    }

} else {
    header("Location: /blog/index.html");
    $_SESSION["post_errors"] = "Something unexpected happened";
    exit();
}

?>
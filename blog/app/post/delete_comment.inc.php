<?php

    if($_SERVER['REQUEST_METHOD']=== "POST"){

        try {
        require_once __DIR__ .'/../dbh.inc.php';
        require_once 'comments_model.inc.php';

        $user_id = (int) $_SESSION['user_id'];
        $comment_id = (int) $_POST['comment_id'];
        $result = fetch_target_comment($pdo,$user_id, $comment_id) ?? "";


       
        if($result){
            delete_target_comment($pdo,$user_id, $comment_id);
            $_SESSION['newPost'] = "Your comment was successfully deleted !";
            header("Location: /blog/dashboard.php");
            exit();
        }  else if($_SESSION['user_rank']==='admin'){
             super_delete_target_comment($pdo, $comment_id);
            $_SESSION['delete_status'] = "<h3 style='color: green;text-align: center;background-color: #00800047;padding: 2px 0;margin-bottom:5px'>This comment was successfully deleted !</h3>";
            header("Location: /blog/manage_posts.php");
            exit();
        }
            else {
            $_SESSION['post_errors'] = "Something unexpected happened !";
            header("Location: /blog/dashboard.php");
            exit();

        }
 



        


    } catch (PDOException $e){
        exit("Query failed: ".$e->getMessage());
    }
} else {
    header("Location: /blog/index.html");
    exit();
}

?>
<?php

    if($_SERVER['REQUEST_METHOD']=== "POST"){

        try {
        require_once __DIR__ .'/../dbh.inc.php';
        require_once 'post_model.inc.php';
        require_once 'post_contr.inc.php';

        $user_id = (int) $_SESSION['user_id'];
        $post_id = (int) $_POST['post_id'];
        $result = fetch_target_post($pdo,$user_id, $post_id) ?? "";


        
        if($result){
            delete_target_post($pdo,$user_id, $post_id);
            $_SESSION['delete_status'] = "<h3 style='color: green;text-align: center;background-color: #00800047;padding: 2px 0;margin-bottom:5px'>Your post was successfully deleted !</h3>";
            header("Location: /blog/my-posts.php");
            exit();
        } else if ($_SESSION['user_rank']==='admin'){
             super_delete_target_post($pdo, $post_id);
            $_SESSION['delete_status'] = "<h3 style='color: green;text-align: center;background-color: #00800047;padding: 2px 0;margin-bottom:5px'>This post was successfully deleted !</h3>";
            header("Location: /blog/manage_posts.php");
            exit();
            
        } else {
            $_SESSION['delete_status'] = "<h3 style='color:red;text-align: center;background-color: #802b0047;padding: 2px 0;margin-bottom:5px'>Something unexpected happened !</h3>";
            header("Location: /blog/my-posts.php");
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
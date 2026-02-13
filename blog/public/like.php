<?php 
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        require_once  __DIR__. '/../app/config_session.inc.php';
        require_once  __DIR__. '/../app/dbh.inc.php';
        require_once  __DIR__. '/../app/post/like_model.inc.php';


        $post_id = (int) $_POST['post_id'];
        $user_id = $_SESSION['user_id'];

     
        //check if already liked 

        $result = check_likes($pdo, $user_id, $post_id);
        if($result){
            //delete like
            delete_like($pdo, $user_id, $post_id);
            header("Location: /blog/dashboard.php");
            exit();
        } else {
            // add a like 
            add_like($pdo, $user_id, $post_id);

            header("Location: /blog/dashboard.php");
            exit();
        }

    } else{
        header("Location: /blog/dashboard.php");
        exit();
    }
        



        
?>
<?php

        require_once  __DIR__. '/../config_session.inc.php';
        require_once  __DIR__. '/../dbh.inc.php';
        require_once  'like_model.inc.php';

        if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];

        // Show liked posts
        $result = get_liked_posts($pdo, $user_id);

        if($result){
            $_SESSION['liked_posts'] = $result;
        }

        }

?>
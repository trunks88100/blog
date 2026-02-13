<?php 
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        require_once __DIR__ . '/../app/config_session.inc.php';

        require_once __DIR__ . '/../app/post/new_comment.inc.php';
    }
    
?>
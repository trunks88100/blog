<?php
    if($_SERVER['REQUEST_METHOD']=== "POST"){
        require_once __DIR__ . '/../app/users/update_profile.inc.php';

    } else {
        header("Location: /blog/profile_page.php");
        exit();
    }
?>
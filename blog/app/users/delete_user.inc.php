<?php

    if($_SERVER['REQUEST_METHOD']=== "POST"){

        try {
        require_once __DIR__ .'/../dbh.inc.php';
        require_once 'user_model.inc.php';

        $user_id = (int) $_POST['user_id'];
        $result = fetch_profil($pdo,$user_id) ?? "hello";


        if($result){
            delete_target_user($pdo,$user_id);
            $_SESSION['delete_status'] = "<h3 style='color: green;text-align: center;background-color: #00800047;padding: 2px 0;margin-bottom:5px'>This user was successfully deleted !</h3>";
            header("Location: /blog/manage_acc.php");
            exit();
        } else {
            $_SESSION['delete_status'] = "<h3 style='color:red;text-align: center;background-color: #802b0047;padding: 2px 0;margin-bottom:5px'>Something unexpected happened !</h3>";
            header("Location: /blog/manage_acc.php");
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
<?php
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $username = $_POST['username'];
        $pass = $_POST['pass'];

        try {
        require_once __DIR__ .'/../dbh.inc.php';  
        require_once 'login_model.inc.php';
        require_once 'login_contr.inc.php';


        //ERRORS HANDLERS

        $errors = [];

        if (is_input_empty($username,$pass)){
            $errors['empty_input'] = "Please fill the required fields";
        }
        
        $result = get_user($pdo, $username);

      
        if(is_username_wrong($pdo, $result) || is_password_wrong($pass, $result['password'])){
            $errors['login_incorrect'] = "Incorrect login info";
        }
        

        require_once __DIR__ . '/../config_session.inc.php';

        if ($errors){
            $_SESSION['errors'] = $errors;
            header("Location: /blog/login_view.php");
            exit();
        } 

      

        $newSessionId = session_create_id(); //jsp pourquoi
        $sessionId = $newSessionId. "_". $result['id'];
        session_id($sessionId);

        $_SESSION['user_id'] = $result['id'];
        $_SESSION['username'] = $result['username'];
        $_SESSION['user_rank'] = $result['rank'];
        $_SESSION['user_avatar'] = $result['avatar'];



        header("Location: /blog/dashboard.php");
        $pdo = null;
        $stmt = null;
        exit();


        } catch (PDOException $e) {
            exit('Query failed' . $e->getMessage());
        }

        

    } else {
        $_SESSION['error'] = true;
        header("Location: /blog/login_view.php");
        exit();
    }
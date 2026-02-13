<?php 
    declare(strict_types = 1);

    function is_input_empty(string $username,string $pass){
        if(empty($username) || empty($pass)){
            return true;
        } else {
            return false;
        }
    } 

    function is_username_wrong(object $pdo, array|bool $result){
        if(!$result){
            return true;
        } else {
            return false;
        }
    }
    function is_password_wrong(string $pass, string $hashedPass){
        if(!password_verify($pass,$hashedPass)){
            return true;
        } else {
            return false;
        }
    }
    
?>
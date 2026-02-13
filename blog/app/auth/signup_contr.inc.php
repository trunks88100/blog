<?php

    declare(strict_types=1);

    function is_input_empty(string $username,string $pass, string $pass_confirm){
        if(empty($username) || empty($pass)||empty($pass_confirm)){
            return true;
        } else {
            return false;
        }
    } 

    function is_username_taken(object $pdo, string $username){
        if(get_username($pdo,$username)){
            return true;
        } else {
            return false;
        }
    }

    function invalid_length(string $input, int $length){
        if(strlen($input) > $length){
            return true;
        } else {
            return false;
        }
    }
    function invalid_hobby(array $allowed_hobbies, array $selected_hobbies){
        foreach($selected_hobbies as $hobby){
            if(!in_array($hobby, $allowed_hobbies,true)){
                return true;
            } else {
                return false;
            }
        }
    }
    function invalid_avatar(array $allowed_avatars, string $selected_avatar){
        $avatar = str_replace("/images/", "", $selected_avatar);
        if(!in_array($avatar, $allowed_avatars, true)){
            return true;
        } else {
            return false;
        }
    }
    function unmatch_pass(string $pass, string $pass_confirm){
        if($pass !== $pass_confirm){
            return true;
        } else {
            return false;
        }
    }

?>
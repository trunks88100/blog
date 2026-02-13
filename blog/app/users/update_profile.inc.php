<?php
    if($_SERVER['REQUEST_METHOD']==="POST"){
        $username = ucfirst(trim($_POST['username']));
        $bio = trim($_POST['bio']);
        $allowed_hobbies = ["sport", "cinema","drawing", "reading", "games","music"];
        $hobbies_array = $_POST['hobbies'] ?? [];
        $hobbies = implode(',',$_POST['hobbies'] ?? []);
        $avatar = trim($_POST['avatar']);
        $allowed_avatars = ["cat.png","bear.png","chicken.png","panda.png","koala.png","gorilla.png"];


    try {
        require_once __DIR__ . '/../dbh.inc.php';
        require_once __DIR__ .'/../auth/signup_model.inc.php';
        require_once __DIR__ . '/../auth/signup_contr.inc.php';

        //ERROR HANDLING
        $errors = [];

        if(is_input_empty($username, $avatar, true)){
            $errors['empty_input'] = "Please fill all required fields !";
        }

        require_once __DIR__ . '/../config_session.inc.php';

        if (is_username_taken($pdo, $username) && $username !== $_SESSION['username']){
            $errors['username_taken'] = "This username is already taken !";
        }

        if (invalid_length($bio, 300) || invalid_length($username, 20)){
            $errors['invalid_length'] = "Invalid length detected !";
        }

        if (invalid_hobby($allowed_hobbies, $hobbies_array)){
            $errors['invalid_hobbies'] = "Please select valid hobbies !";
        }

        if (invalid_avatar($allowed_avatars, $avatar)){
            $errors['invalid_avatar'] = "Please select a valid avatar !";
        }

        //check errors
        if ($errors){
            $_SESSION['errors_edit'] = $errors;
            header("Location: /blog/profile_page.php");
            exit();
        } 
        
        


        //Update the profile on the db
        $query = "UPDATE users SET username = :username, bio = :bio, hobbies = :hobbies, avatar = :avatar WHERE id = :user_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":username",$username);
        $stmt->bindParam(":bio",$bio);
        $stmt->bindParam(":hobbies",$hobbies);
        $stmt->bindParam(":avatar",$avatar);
        $stmt->bindParam(":user_id",$_SESSION['user_id']);

        $stmt->execute();

        $_SESSION['username'] =  $username;
        $_SESSION['user_avatar'] = $avatar;
        header('Location: /blog/profile_page.php?edit=success');
        exit();



    } catch(PDOException $e){
        exit('Query failed: '. $e->getMessage());
    }





    } else {
        header("Location: /blog/profile_page.php");
        exit();
    }
?>
<?php
    
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = ucfirst(trim($_POST['username']));
    $pass = $_POST['pass'];
    $pass_confirm = $_POST['pass-confirm'];
    $allowed_hobbies = ["sport", "cinema","drawing", "reading", "games","music"];
    $hobbies_array = $_POST['hobbies'] ?? [];
    $hobbies = implode(",",$_POST['hobbies'] ?? []);
    $bio = trim($_POST['bio']);

    try {
        require_once __DIR__ . '/../dbh.inc.php';
        require_once __DIR__ .'/../auth/signup_model.inc.php';
        require_once __DIR__ . '/../auth/signup_contr.inc.php';

        // ERROR HANDLERS
        $errors = [];

        if (is_input_empty($username,$pass,$pass_confirm)){
            $errors['empty_input'] = "Please fill the required fields";
        }
        if (is_username_taken($pdo,$username)){
            $errors['username_taken'] = "Username already taken";
        }
        if (invalid_length($username, 20) || invalid_length($bio, 300)){
            $errors['length'] = "Respect the limited number of caracters";
        }
        if (invalid_hobby($allowed_hobbies, $hobbies_array)){
            $errors['invalid_hobby'] = "Please choose a valid hobby";
        }
        if (unmatch_pass($pass,$pass_confirm)){
            $errors['unmatch_pass'] = "Please match the passwords";
        }
        require_once __DIR__ . '/../config_session.inc.php';

        if ($errors){
            $_SESSION['errors_signup'] = $errors;

            $signupData = [
                "username" => $username,
                "hobbies" => $hobbies_array,
                "bio" => $bio,
            ];
            $_SESSION['signup_data'] = $signupData;


            header("Location: /blog/signup_view.php");
            exit();
        } 



        //Create user
        $avatars = ["chicken.png","cat.png","bear.png","panda.png","gorilla.png","koala.png"];
        $avatar = "images/". $avatars[array_rand($avatars)];
        create_user($pdo, $username,$pass,$hobbies,$bio, $avatar);

        header("Location: /blog/login_view.php?signup=success");
        $pdo = null;
        $stmt = null;
        exit();


    } catch (PDOException $e) {
       exit('Query failed :' . $e->getMessage());
    }

} else {
    header("Location: /blog/index.html");
    exit();
}
   
?>

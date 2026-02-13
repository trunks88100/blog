<?php 
    declare(strict_types = 1);
    
    function check_login_errors(array $t){
        if(isset($_SESSION['errors'])){
            $errors = $_SESSION['errors'];
            foreach($errors as $error){
                echo "<p style='color:rgb(181, 9, 9); text-align:center'>".$t[$error]."</p>";
            }
            unset($_SESSION['errors']);
            } else if (isset($_GET['login']) && $_GET['login'] === 'success'){
            echo "<p style='color:rgb(12, 255, 77); text-align:center'> You are now successfully logged in!</p>";
        } else if (isset($_GET['signup']) && $_GET['signup'] === "success") {
                echo "<p style='color:green; text-align:center'> Account successfully created !</p>";
        }
    }

?>
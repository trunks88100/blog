<?php

    declare(strict_types=1);


        //Keep user's data after error
        function signup_inputs($el){
            if(isset($_SESSION['signup_data'][$el])){
                echo $_SESSION['signup_data'][$el];
            }
        }


        $first_row = ["sport", "cinema","drawing"];
        $second_row = ["reading", "games","music"];
        function signup_checkboxes(array $row, array $t)
        {
            $selected_hobbies = $_SESSION['signup_data']['hobbies'] ?? [];
            foreach ($row as $hobby){
                $checked = in_array($hobby, $selected_hobbies, true) ? 'checked':'';
            
                echo "<td>
                <input type='checkbox' name='hobbies[]' value='{$hobby}' id='{$hobby}' {$checked}>
                <label for='{$hobby}'>".ucfirst($t[$hobby]) . "</label>                
                    </td>";
                    
                }
        
    }
    


    function check_signup_errors(){
        if(isset($_SESSION['errors_signup'])){
            $errors = $_SESSION['errors_signup'];
            foreach($errors as $error){
                echo "<p style='color:rgb(181, 9, 9); text-align:center'>".$error."</p>";
                }
            unset($_SESSION['errors_signup']);
        } else if (isset($_GET['signup']) && $_GET['signup'] === "success") {
                echo "<p style='color:green; text-align:center'> Account successfully created !</p>";
        }
    }

    


?>
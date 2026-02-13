<?php
    session_start();
    if ($_SERVER["REQUEST_METHOD"] === "POST"){

            // Check method type
            if (preg_match("/once|monthly/", $_POST['donation_type'])){
                $donation_type = $_POST['donation_type'];
            } else {
                $_SESSION['amountError'] = "Something went wrong with the choosen type";
                $_SESSION['errorShadow'] = true;
                header("Location: UPH-don.php");
                exit();
            }

            // Check l'amount
            if ($_POST['amount'] ??"" XOR $_POST['libre'] ??""){
                if (!empty($_POST['amount'])){
                    $amount = round((float) $_POST['amount'], 2);
                } else {
                    $amount = round((float) $_POST['libre'],2);
                }
            }
            $options = ["options" => ["min_range" => 0.0000000001]];
            if (!filter_var($amount, FILTER_VALIDATE_FLOAT, $options)){
                $_SESSION['amountError'] = "Something went wrong with the entered value";
                $_SESSION['errorShadow']= true;
                header("Location: UPH-don.php");
                exit();
            }

            // Check l'email
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                     $email = $_POST['email'];
            } else {
                 $_SESSION['emailError'] = "Email invalide";
                $_SESSION['errorShadow'] = true;
                header("Location: UPH-don.php");
                exit();
            }
           
            //Connect to the database
            try {
                $host = 'localhost';
            $dbname = 'uph';
            $username = 'root';
            $charset = 'utf8mb4';
            $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
            $db = new PDO($dsn, $username, "");

            $sql = "INSERT INTO donation_form (Donation_type, Amount, Email) VALUES (?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$donation_type,$amount,$email]);
            } catch (Exception $e) {
                echo $e->getMessage();
            }

            $_SESSION['confirmation'] = "Votre don a bien été pris en compte";
            header("Location: UPH-don.php");
            $db = null;
            exit();
            

    } else {
        $_SESSION['errorShadow'] = true;
        header("Location: UPH-don.php");
        exit();
    }

?>
<?php 
    session_start();
    if ($_SERVER['REQUEST_METHOD'] === "POST"){
        $name = ucfirst(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
        $surname = ucfirst(filter_var($_POST['surname'], FILTER_SANITIZE_STRING));

        //Check date
        if (preg_match("/^\d{4}-\d{2}-\d{2}$/", $_POST['age'])){
            $age = $_POST['age'];
        } else {
            $_SESSION['error'] = "pb date de naissance";
            header("Location: UPH-join.php");
            exit(); 
        }

        //Check ranges 
        $augmentation = (int) $_POST['augmentation'];
        $control = (int) $_POST['control'];
        $vitesse = (int) $_POST['vitesse'];
        $ranges = [$augmentation, $control, $vitesse];
        $options = ["options" => ['min_range'=>0, 'max_range'=> 10]];
        foreach($ranges as $range){
            if(filter_var($range, FILTER_VALIDATE_INT, $options) === false){
                $_SESSION['error'] = "pb range";
                header("Location: UPH-join.php");
                exit();
            }
        }
    
        //Check checkboxes
        $implants = filter_var($_POST['implants'], FILTER_SANITIZE_STRING);
        if (preg_match("/^no\-no$|^maybe\slater$|^yes$/", $implants) !== 1){
           $_SESSION['error'] = "pb implants";
                header("Location: UPH-join.php");
                exit(); 
        }
        
        $events = filter_var($_POST['events'], FILTER_SANITIZE_STRING);
        if (preg_match("/^no$|^yes$|^maybe$/", $events) !== 1){
            $_SESSION['error'] = true;
            header("Location: UPH-join.php");
            exit();
        }


        //Check TextArea
        $implants_details = filter_var($_POST['implants-details'], FILTER_SANITIZE_STRING) ?? "";
        $events_ideas = filter_var($_POST['events-ideas'], FILTER_SANITIZE_STRING) ?? "";

        //Check tel and email
        $regexTel = "/^([0-9]{2}([\-\.\_\s])*){5}$/";
        $tel = $_POST['tel'] ?? "";
        if ($tel && preg_match($regexTel, $tel) !== 1){
            $_SESSION['error'] = "tel problem";
            header("Location: UPH-join.php");
            exit();
        } else {
            $tel = preg_replace("/[^0-9]/", "", $tel);
        }
        
        $email = $_POST['email'] ?? "";
        if ($email && !filter_var($email, FILTER_VALIDATE_EMAIL)){
            $_SESSION['error'] = "email problem";
            header("Location: UPH-join.php");
            exit();
        } 
        $contacts = implode(', ', $_POST['contacts'] ?? []);
	if (!preg_match("/^(tel)$|^(email)$|^(tel, email)$/", $contacts) && !empty($contacts)){
            $_SESSION['error'] = "contact problem";
            header("Location: UPH-join.php");
            exit();
            }

        $newsletter = $_POST['contact-no'] ?? "yes";
        if (preg_match("/^(yes|no)$/", $newsletter) !== 1){
            $_SESSION['error'] = "pb news";
            header("Location: UPH-join.php");
            exit();
        }

        $color = $_POST['color'];
        if (preg_match("/^#[0-9a-f]{6}$/",$color) !== 1){
            $_SESSION['error'] = "pb color";
            header("Location: UPH-join.php");
            exit();
        }
        
        $_SESSION['confirmation'] = true;
        header("Location: UPH-join.php");
        exit();


    //connect to the database 
    try {
        $host = "localhost";
        $dbname = "UPH";
        $username = "root";
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

        $db = new PDO($dsn, $username, "");

        $sql = "INSERT INTO join_form (name, username, birthdate, augmentation, control, speed, implants, implants_details, events, events_ideas, contacts, tel, email, newsletter, color) 
        VALUE (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$name,$surname,$age,$augmentation,$control,$vitesse,$implants,$implants_details,$events,$events_ideas,$contacts,$tel,$email,$newsletter,$color]);
    } catch (Exception $e){
        echo $e->getMessage();
    }




    } else {
        $_SESSION['error'] = true ;
        header("Location: UPH-join.php");
        exit();
    }
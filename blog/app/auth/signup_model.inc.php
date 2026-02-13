<?php

    declare(strict_types=1);
    

    function get_username(object $pdo, string $username)
    {
        $query = "SELECT username FROM users WHERE username = :username";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":username",$username);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result; //return false si rien
    }

    function create_user(object $pdo, string $username, string $pass, string $hobbies, string $bio, string $avatar)
    {
        $query = "INSERT INTO users (username, password, hobbies, bio, avatar) VALUES (?,?,?,?,?)";
        $stmt = $pdo->prepare($query);

        $options = [
            'cost' => 12,
        ];
        $hashedPass = password_hash($pass, PASSWORD_BCRYPT, $options);

        $stmt->execute([$username,$hashedPass,$hobbies,$bio, $avatar]);
    }

?>
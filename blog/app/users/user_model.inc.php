<?php 

    declare(strict_types = 1);

    function fetch_profil(object $pdo, int $user_id){
        $query = "SELECT users.username, users.hobbies, users.bio, users.avatar FROM users WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":id", $user_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function fetch_accounts(object $pdo){
        $query = "SELECT users.username, users.id,  users.avatar, users.rank, users.date_of_creation FROM users";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function fetch_usernames(object $pdo){
        $query = "SELECT users.username FROM users";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function delete_target_user(object $pdo, int $user_id){
        $query = "DELETE FROM users WHERE id = :user_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':user_id',$user_id);
        $stmt->execute();
    }
?>
<?php 
    declare(strict_types = 1);

    function create_post(object $pdo, int $user_id, string $title, string $content, string $img){
        $query = "INSERT INTO posts (user_id, title, content, img) VALUES (?,?,?,?)";
        $stmt = $pdo->prepare($query);

        $stmt->execute([$user_id,$title,$content,$img]);
    }

    function fetch_post(object $pdo){
        $query = "SELECT posts.*, users.username, users.avatar FROM posts JOIN users ON posts.user_id = id ORDER BY posts.post_id DESC" ;
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function fetch_user_post(object $pdo, int $user_id){
        $query = "SELECT posts.*, users.username, users.avatar FROM posts JOIN users ON posts.user_id = id WHERE user_id = :user_id ORDER BY posts.post_id DESC" ;
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':user_id',$user_id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function fetch_target_post(object $pdo, int $user_id, int $post_id){
        $query = "SELECT * FROM posts WHERE user_id = :user_id AND post_id = :post_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':user_id',$user_id);
        $stmt->bindParam(':post_id', $post_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    function delete_target_post(object $pdo, int $user_id, int $post_id){
        $query = "DELETE FROM posts WHERE user_id = :user_id AND post_id = :post_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':user_id',$user_id);
        $stmt->bindParam(':post_id', $post_id);
        $stmt->execute();
    }
    function super_delete_target_post(object $pdo, int $post_id){
        $query = "DELETE FROM posts WHERE post_id = :post_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':post_id', $post_id);
        $stmt->execute();
    }

    function count_posts(object $pdo, int $user_id){
        $query = "SELECT COUNT(*) FROM posts WHERE user_id = :user_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
?>
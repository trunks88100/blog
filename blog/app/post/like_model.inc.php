<?php


    function check_likes(object $pdo, int $user_id, int $post_id){
            $query = "SELECT * FROM likes WHERE user_id = :user_id AND post_id = :post_id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':post_id', $post_id);
            $stmt->execute();
            $result =  $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
            }

    function add_like(object $pdo, int $user_id, int $post_id){
        $query = "INSERT INTO likes (user_id, post_id) VALUES (?,?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$user_id, $post_id]);
        }
    
    function delete_like(object $pdo, int $user_id, int $post_id){
        $query = "DELETE FROM likes WHERE user_id = :user_id AND post_id = :post_id";
        $stmt= $pdo->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':post_id', $post_id);
        $stmt->execute();
    }
    
    function get_liked_posts(object $pdo, int $user_id){
        $query = "SELECT post_id FROM likes WHERE user_id = :user_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function count_likes (object $pdo, int $post_id){
        $query = "SELECT COUNT(*) FROM likes WHERE post_id = :post_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':post_id', $post_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['COUNT(*)'];
    }
?>
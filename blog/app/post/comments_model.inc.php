<?php 
    declare(strict_types = 1);

    function create_comment(object $pdo, int $user_id, int $post_id, string $content){
        $query = "INSERT INTO comments (user_id, post_id, content) VALUE (?,?,?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$user_id, $post_id, $content]);
    }

    function fetch_all_comments(object $pdo){
        $query = "SELECT comments.*, users.avatar, users.username FROM comments JOIN users ON comments.user_id = id ORDER BY comments.comment_id DESC";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function count_comments_by_post(object $pdo, $post_id){
        $query = "SELECT COUNT(*) FROM comments WHERE post_id = :post_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':post_id', $post_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['COUNT(*)'];
    }

    function fetch_target_comment(object $pdo, int $user_id, int $comment_id){
        $query = "SELECT * FROM comments WHERE user_id = :user_id AND comment_id = :comment_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':user_id',$user_id);
        $stmt->bindParam(':comment_id', $comment_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

       function delete_target_comment(object $pdo, int $user_id, int $comment_id){
        $query = "DELETE FROM comments WHERE user_id = :user_id AND comment_id = :comment_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':user_id',$user_id);
        $stmt->bindParam(':comment_id', $comment_id);
        $stmt->execute();
    }
    function super_delete_target_comment(object $pdo, int $comment_id){
        $query = "DELETE FROM comments WHERE comment_id = :comment_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':comment_id', $comment_id);
        $stmt->execute();
    }
?>
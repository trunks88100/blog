<?php
    declare(strict_types = 1);

    function show_all_comments(object $pdo, array $result){
        foreach($result as $comment){
            ?>
            <?php if(isset($_SESSION['user_id']) && $comment['user_id'] === $_SESSION['user_id']){?>
                             <form class="comment_delete" id="comment_delete_<?=$comment['comment_id']?>"method="POST" action="delete_comment.php">
                            <input type="hidden" id="comment_id" name="comment_id" value="<?= $comment['comment_id'] ?>">
                            <button type="button" id="cancel_delete" onclick="toggle_show('comment_delete_<?= $comment['comment_id'] ?>')">Cancel</button>
                            <input type="submit" value="Delete this comment">
                        </form> 
                        <?php } ?>
            <div class="comments_content">
                        <img src="/blog/assets/<?= $comment['avatar']?>" class="avatar_comment">
                <?php if(isset($_SESSION['user_id']) && $comment['user_id'] === $_SESSION['user_id']){?>
                        <img src="/blog/assets/images/delete.png" class="delete_comment" onclick="toggle_show('comment_delete_<?= $comment['comment_id'] ?>')">
                <?php } ?>
                        <span><?= $comment['username']?></span>
                        <p><?= $comment['content']?></p>
                        <date><?= $comment['date_of_creation']?></date>
                        <span style='display:none'><?= $comment['post_id']?></span>
                        
            </div>
            <?php }
        }
    
    function super_show_all_comments(object $pdo, array $result){
        foreach($result as $comment){
            ?><form class="comment_delete" id="comment_delete_<?=$comment['comment_id']?>"method="POST" action="delete_comment.php">
                            <input type="hidden" id="comment_id" name="comment_id" value="<?= $comment['comment_id'] ?>">
                            <button type="button" id="cancel_delete" onclick="toggle_show('comment_delete_<?= $comment['comment_id'] ?>')">Cancel</button>
                            <input type="submit" value="Delete this comment">
                        </form> 
            <div class="comments_content">
                        <img src="/blog/assets/<?= $comment['avatar']?>" class="avatar_comment">
                        <img src="/blog/assets/images/delete.png" class="delete_comment" onclick="toggle_show('comment_delete_<?= $comment['comment_id'] ?>')">
                        <span><?= $comment['username']?></span>
                        <p><?= $comment['content']?></p>
                        <date><?= $comment['date_of_creation']?></date>
                        <span style='display:none'><?= $comment['post_id']?></span>
            </div>
            <?php
        }
    }
?>
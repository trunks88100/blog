<?php
    require_once  __DIR__. '/../app/config_session.inc.php';
    if(isset($_SESSION['user_id'])){
        require_once __DIR__.'/../app/post/post_model.inc.php';
        require_once __DIR__.'/../app/dashboard_view.inc.php';
         require_once __DIR__. '/../app/post/comments_model.inc.php';

        require_once __DIR__. '/../app/post/comments_view.inc.php';



        $posts_result = fetch_user_post($pdo, $_SESSION['user_id']);

        $t = $_COOKIE['lang'] ?? 'fr';
        require "assets/lang/$t.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./assets/blog.css">
    <title>My Posts</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="./assets/images/coffee.png" type="image/png">
    <script src="./assets/themeColor.js"></script>
</head>
<body>
     <main style="background-color:var(--primary-bg-color)">
        <a href="./dashboard.php" class="back_button"><img id="arrows" src="./assets/images/back.png">BACK</a>
        <h1 id="my_post_h1"><?= $t['my_posts']?></h1>

        <div class="all_posts" style="display:flex">
            <div id="my_posts">
                <?php echo $_SESSION['delete_status'] ?? ""; unset($_SESSION['delete_status'])?>
                <?php show_posts($posts_result, $pdo)?>
            </div>
            <form id="delete_window"method="POST" action="delete_post.php">
                    <input type="hidden" id="post_id" name="post_id" value="">
                    <button type="button" id="cancel_delete" onclick="toggle_show('delete_window')"><?= $t['cancel']?></button>
                    <input type="submit" value="<?= $t['post_delete']?>">
            </form> 

            
                <div class="comments_section" id="comments">
                            <img id="close_comment" src="/blog/assets/images/back.png" onclick="closeComments()">

                            

                            <?php $comments = fetch_all_comments($pdo); echo super_show_all_comments($pdo, $comments); ?>
                            
                        </div>
                </div>
        </div>

    </main>


<script>

     function toggle_show(el){
        const window = document.getElementById(el);
        window.classList.toggle('show');
    }
    function deletePost(post_id){
        document.getElementById('delete_window').classList.toggle('show');
        let form = document.getElementById('post_id');
        form.value = post_id;
    }

     const comments = document.getElementById('comments');

    function showComments(id){
        comments.classList.add('comments_show');

        const postComments = document.querySelectorAll('.comments_content')
        postComments.forEach((comment, index)=>{
                post_id = comment.innerHTML.split('none">')
                post_id = post_id[1].split('</span>')
                post_id = post_id[0];

                if(post_id.match(`^${id}$`)){
                    comment.style.display="block";
                } else {
                    comment.style.display="none";
                }
            })
        } 
        
        
    function closeComments(){
        comments.classList.remove('comments_show');

        document.querySelectorAll('input[type="radio"]').forEach((radio)=>{
            radio.checked= false;
        })
    }




    const textarea = document.getElementById('comment_text');

    textarea.addEventListener('input', () => {
    textarea.style.height = textarea.scrollHeight + 'px';
    });

    function toggle_show(el){
        const window = document.getElementById(el);
        window.classList.toggle('show');
    }

    function add_hide(el){
        const window = document.getElementById(el);
        window.classList.add('hide');
    }
    function remove_hide(el){
        const window = document.getElementById(el);
        window.classList.remove('hide');
    }


    function passPostId(id){
        document.getElementById('post_id').value = id;
    }
</script>



</body>
</html>

<?php }else{
    header("Location: ./index.html");
    exit();
}
?>
<?php 
    require_once  __DIR__. '/../app/config_session.inc.php';
    if(isset($_SESSION['user_id']) || $_GET['user'] === 'guest'){
    require_once __DIR__. '/../app/dashboard_view.inc.php';
    require_once __DIR__. '/../app/post/post_model.inc.php';
     require_once __DIR__. '/../app/users/user_view.inc.php';
    require_once __DIR__. '/../app/users/user_model.inc.php';
    require_once __DIR__. '/../app/post/comments_view.inc.php';
    require_once __DIR__. '/../app/post/comments_model.inc.php';
    require_once __DIR__. '/../app/post/like.inc.php';
    require_once __DIR__. '/../app/post/like_model.inc.php';



    $t = $_COOKIE['lang'] ?? 'en';
    require "assets/lang/$t.php";


?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="./assets/blog.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="./assets/images/coffee.png" type="image/png">
    <script src="./assets/themeColor.js"></script>

</head>
<body>
<main>
    <nav id="main_nav">
        <div class="user_profile">
            <?php show_user($t) ?>
        </div>
        <div class="search_bar">
            <input type="text" name="search" id="search" placeholder="<?= $t['search'];?>">
        </div>
        
        <div class="nav_options">
            <?php show_login_buttons($t) ?>
                <div id="translations">
                    <img src="./assets/images/translate.png" alt="languages" id="translate">
                    <span class="lang_opt" onclick="setLang('fr')">🇫🇷</span>
                    <span class="lang_opt" onclick="setLang('jp')">🇯🇵</span>
                    <span class="lang_opt" onclick="setLang('en')">🇬🇧</span>

                </div>
            <div class="dropdown">
                <img src="./assets/images/more.png" alt="more" id="more" onclick="toggle_show('dropdown_content')">
                <ul class="dropdown_content" id="dropdown_content">
                    <div class="colors">
                        <div class="color" id="yellow" onclick="themeColor('yellow')"></div>
                        <div class="color" id="green" onclick="themeColor('green')"></div>
                        <div class="color" id="blue" onclick="themeColor('blue')"></div>
                     </div>
                     <a style="gap: 3px;" id="translate_drop"><img src="./assets/images/translate.png" alt="languages"> Languages</a>
                        <div class="lang_opts">
                            <span  onclick="setLang('fr')">🇫🇷</span>
                            <span onclick="setLang('jp')">🇯🇵</span>
                            <span onclick="setLang('en')">🇬🇧</span>
                        </div>
                    <?php if(isset($_GET['user']) && $_GET['user']==='guest'){?>
                        <a href="/blog/signup_view.php"><?= $t['signup']?></a>
                        <a href="/blog/login_view.php"><?= $t['login']?></a>
                    <?php }?> 
                    <?php if(access('user')){?>
                        <a href="/blog/logout.php"><?= $t['logout']?></a>
                    <?php }?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="main_dashboard">
        <?php show_subnav($t);?>
            
       
        <?php show_errors() ?>

        <div id="dashboard">
            <?php show_validation() ?>

                <!-- Posts -->
            <?php $result = fetch_post($pdo); show_posts($result, $pdo); ?>
        </div>

        <!-- comments -->
                <div class="comments_section" id="comments">
                    <?php if(isset($_SESSION['user_id'])){?>
                        <img id="add_comment" src="/blog/assets/images/add_comment.png" onclick="remove_hide('new_comment_form')">
                    <?php } ?>
                    <img id="close_comment" src="/blog/assets/images/back.png" onclick="closeComments()">
                    <!-- New comment -->
                    <form method="post" action="./new_comment.php" id="new_comment_form" class="hide" >

                            <div class="new_comment">
                                <div class="new_comment_user">
                                    <img src="/blog/assets/<?= $_SESSION['user_avatar']?>">
                                </div>

                                <div class="new_comment_section">
                                    <textarea id="comment_text" name="content" maxlength="100" required placeholder="<?= $t['com_placeholder']?>"></textarea>
                                    <div class="new_comment_buttons">
                                        <button type="button" onclick="add_hide('new_comment_form')" style="background-color:#f107073d"><?= ucfirst($t['cancel'])?></button>
                                        <input type="submit" value="<?= $t['publish']?>" id="publish" style="background-color:#00ff003d">
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="post_id" id="post_id">
                    </form> 

                    <?php $result = fetch_all_comments($pdo); echo show_all_comments($pdo, $result); ?>
                    
                </div>
    </div>

    
    <!-- New Post -->

    <div id="new_post_window">
        <form method="post" action="./new_post.php" enctype="multipart/form-data">
            <div class="upper_post_window">
                <img src="./assets/images/close.png" onclick="toggle_show('new_post_window')">
            </div>
            <div class="main_post_window">
                <h3><?= $t['title']?> : </h3>
                <input type="text" name="title" placeholder="<?= $t['title']?>" minlength="3" maxlength="50" required>
                <h3><?= $t['content']?> : </h3>
                <textarea name="content" minlength="10" maxlength="200" required placeholder="<?= $t['post_placeholder']?>"></textarea>
                <input type="file" name="file">
            </div>
            <div class="lower_post_window">
                <button type="button" onclick="toggle_show('new_post_window')" style="background-color:#f107073d"><?= $t['cancel']?></button>
                <input type="submit" value="<?= $t['publish']?>" id="publish"  style="background-color:#00ff003d">
            </div>
        </form>
    </div>

        

           <?php if(isset($_GET['profile'])){
                $user_id = $_GET['profile'];
                $profile_result = fetch_profil($pdo,$user_id);
                $posts_result = fetch_user_post($pdo, $user_id);
                echo '<div id="others_profile">';
                show_others_profil($user_id,$profile_result,$posts_result, $t);
                '</div>';
    }?>



</main>

<script>

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


    function getUserProfile(id){
        window.location.href=`http://localhost/blog/dashboard.php?profile=${id}`
}
    if(document.getElementById('others_profile')){
            document.addEventListener('click', (event)=> {
        if(!document.getElementById('others_profile').contains(event.target)){
            document.getElementById('others_profile').classList.add('go-away');
        }
    })
    }
    
    input = "";
    document.getElementById('search').addEventListener('keyup', ()=>{
        input = document.getElementById('search').value;
        let postsUser = document.querySelectorAll('.post');
        hr = document.querySelectorAll(`#dashboard hr`)

        postsUser.forEach((post, index)=>{

            
            let username = post.firstElementChild.innerHTML.split("<figcaption>")
            username = username[1].split("</figcaption>");
            username = username[0]

            let postContent = post.firstElementChild.innerHTML.split('<div class="text_area">\n');
            postContent = postContent[1].split("</div>");
            postContent = postContent[0];
            dashboard = document.getElementById('dashboard');

            
            low_input = input.toLowerCase();

            if(username.match(`${input}`) || username.toLowerCase().match(`^${input}`) 
                || postContent.toLowerCase().match(`${low_input}`) ){
                    post.style.display='flex';
                    hr[index].style.display='block'

                    


                } else {                   
                    post.style.display='none';
                    hr[index].style.display='none'
                }
                


        })

    })

    // Likes

    function like(el, post_id, index){
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        if(!urlParams.get('user') === 'guest'){
            
        
            count = document.querySelectorAll('.like_count')[index];
            
            if(el.classList.contains('liked')){
                count.textContent = Number(count.textContent) - 1
            } else {
                count.textContent = Number(count.textContent) + 1
            }

            el.classList.toggle('liked');

             const xhr = new XMLHttpRequest();
            xhr.open("POST", "/blog/like.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send(`post_id=${post_id}`)
        }
    };
        
    //Translations 

    document.getElementById('translate').addEventListener('click', () =>{
        const translationMenu = document.getElementById('translations');
        translationMenu.classList.toggle('extended');
        
        const langOpt = document.querySelectorAll('.lang_opt');
        langOpt.forEach((lang) =>{
            lang.classList.toggle('show_lang')
        })
    })

    function setLang(lang){
        document.cookie=`lang=${lang}`;
        location.reload()
    }

     document.getElementById('translate_drop').addEventListener('click', () =>{
        const langOpt = document.querySelector('.lang_opts');

            langOpt.classList.toggle('show_lang_opts')

    })
</script>
</body>
</html>
<?php } else {
    header("Location: index.php");
    exit();
}
?>
    
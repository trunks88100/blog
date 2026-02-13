<?php

    function show_user(array $t){
        if(isset($_SESSION['user_id'])){
            $username = $_SESSION['username'];
            $avatar = $_SESSION['user_avatar'];
            echo "<a href='/blog/profile_page.php'><img src='/blog/assets/{$avatar}' id='user_pp' alt='Users profile picture'></a>";
            echo "<span>{$username}</span>";
        } else {
           echo "<img src='/blog/assets/images/guest.png' id='user_pp' alt='Users profile picture'>";
            echo "<span>".$t['guest']."</span>";
        }
    }

    function access($needed_rank){
        $user_rank = $_SESSION['user_rank'] ?? "";
        switch($needed_rank){
            case 'admin':
                return ($user_rank === 'admin');
                break;
            case 'user':
                return ($user_rank === 'admin' || $user_rank === 'user');
                break;
        }
    }

    function show_errors(){
        if(isset($_SESSION['post_errors'])){
            $errors = $_SESSION['post_errors'];
            echo "<div class='errors_message'>";
            foreach($errors as $error){
                echo "<p style='color:rgb(186,19,19);padding:10px'>" . $error . "</p>";
            }
            echo "</div>";
        unset($_SESSION['post_errors']);
        }
    }

    try {
        include_once  'dbh.inc.php';
        include_once   'post/post_model.inc.php';
        include_once   'post/like_model.inc.php';


        $result = fetch_post($pdo);

        function show_liked_post(array $liked_posts, int $post_id){
            if(in_array($post_id, $liked_posts, true)){
                return " liked";
            }
        }


        function show_validation(){
            if(isset($_SESSION['newPost'])){
                echo "<p id='newPost'>" . $_SESSION['newPost'] . "</p>";
            unset($_SESSION['newPost']);
            } 
        }
                
        function show_posts(array $result, object $pdo){
            if(!empty($result)){
                $index = 0;
                $list = [];
                $liked_posts = get_liked_posts($pdo, $_SESSION['user_id']??0) ?? [];
                foreach($liked_posts as $liked_post){
                        array_push($list, $liked_post['post_id']);
                    }
                foreach($result as $post){
                    $count = count_comments_by_post($pdo, $post['post_id']) ?? 0;
                    $likes = count_likes($pdo, $post['post_id']) ?? 0;
                    $liked= show_liked_post($list, $post['post_id']);

                    echo '<div class="post">
                    <div class="post_wrapper">
                        <figure class="post_user" onclick="getUserProfile('.$post['user_id'].')">
                            <img src="/blog/assets/'. $post['avatar']. '">
                            <figcaption>'. $post['username'] . '</figcaption>
                        </figure>
                        <div class="text_area">
                            <h3>'. $post['title'] . '</h3>
                            <p>'. $post['content'] . '</p>
                            <date>' . $post['date'] . '</date>
                            '; if($post['img']){ echo '<img src="'.$post['img'].'">';} echo'
                        </div>
                        <div class="post_other">
                            <div class="like_form">
                                <img class="like_button'.$liked.'" src="../blog/assets/images/like.png" onclick="like(this, '.$post['post_id'].','.$index.')">
                                <span class="like_count">'. $likes .'</span>
                            </div>

                            <div>
                                    <input type="radio" name="post_comments" id="post_num'.$post['post_id'].'">
                                <label for="post_num'.$post['post_id'].'" class="comment_icon" onclick="showComments('.$post['post_id'].'); passPostId('.$post['post_id'].')">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor">
                                        <path d="M240-400h480v-80H240v80Zm0-120h480v-80H240v80Zm0-120h480v-80H240v80Zm-80 400q-33 0-56.5-23.5T80-320v-480q0-33 23.5-56.5T160-880h640q33 0 56.5 23.5T880-800v720L720-240H160Z"/></svg>
                                </label><span>'. $count .'</span>
                            </div>
                        </div>
                    </div>
                    <div class="delete_zone" onclick="deletePost('.$post['post_id'].')">
                        <img src="../blog/assets/images/close.png">
                    </div>
                </div>
                <hr>';
                $index += 1;
                }
        
            } else {
                echo "<h1 style='text-align:center;background-color: var(--nav-hover);
             padding: 10px 0;'>There is nothing to show here</h1>";
            }
        }
        function show_profile_posts(array $result){
            if(!empty($result)){
                foreach($result as $post){
                    echo '<div class="post">
                    <div class="post_wrapper">
                    <div class="text_area" style="border-left:2px solid white;padding-left:10px">
                        <h3>'. $post['title'] . '</h3>
                        <p>'. $post['content'] . '</p>
                        <date>' . $post['date'] . '</date>
                    </div>
                    <div class="post_other">
                        <img src="../blog/assets/images/like.png">
                        <img src="../blog/assets/images/comment.png" class="comment">
                    </div>
                    </div>
                </div>';
                }
            } else {
                echo "<h1 style='text-align:center;background-color: #007cff57;
             padding: 10px 0;'>No posts yet</h1>";
            }
        }

    


        function show_subnav(array $t){
             if (access('user')){ 
            echo
             '<div id="subnav">
                <a href="/blog/profile_page.php"><img src="../blog/assets/images/home.png">'.$t["My profile"].'</a>
                <hr>
                <a href="/blog/my-posts.php"> <img src="../blog/assets/images/my_posts.png">'.$t["My posts"].'</a>
                <hr>               
                <a  onclick="toggle_show(\'new_post_window\')"> <img src="../blog/assets/images/add-post.png">'.$t['New post'].'</a>';
                if (access('admin')){ 
                echo '<hr><a class="admin_use" href="./manage_acc.php"> <img src="../blog/assets/images/settings.png">Manage accounts</a>
                    <hr>
                    <a class="admin_use" href="./manage_posts.php"><img src="../blog/assets/images/settings.png"> Manage posts</a>';
                }
            echo '</div>';
            } 
        }

        function show_login_buttons($t){
            if(!access('user')){
                echo 
                '<div class="guest_buttons">
                <a href="./login_view.php">'. strtoupper($t['login']).'</a>
                <a href="signup_view.php">'. strtoupper($t['signup']).'</a>
            </div>';
            }
        }


        


    } catch (PDOException $e){
        exit("Query failed: $e->getMessage");
    }
    
    
?>
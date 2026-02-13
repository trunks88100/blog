<?php 
    declare(strict_types = 1);

    require_once __DIR__.'/../config_session.inc.php';
    require_once __DIR__.'/../dbh.inc.php';
    require_once __DIR__. '/../users/user_model.inc.php';
    require_once __DIR__. '/../post/post_model.inc.php';
    require_once __DIR__. '/../dashboard_view.inc.php';
    require_once __DIR__. '/../auth/signup_view.inc.php';

    

    if(isset($_SESSION['user_id'])){
        $result = fetch_profil($pdo, (int) $_SESSION['user_id']);
        $posts_result = fetch_user_post($pdo, (int) $_SESSION['user_id']);
    }
    


    function show_hobbies(string $result_hobbies, array $t){
        if(!empty($result_hobbies)){
            $hobbies = explode(',',$result_hobbies);
            foreach($hobbies as $hobby){
                echo "<span>".ucfirst($t[$hobby]). "</span>";
            }
        }
    }

    function edit_hobbies(string $result_hobbies, array $t){
        $all_hobbies = ["sport","cinema", "drawing", "reading", "games","music"];
        $user_hobbies = explode(',', $result_hobbies);
        foreach($all_hobbies as $hobby){
            if(in_array($hobby, $user_hobbies, true)){
                echo "<input type='checkbox' name='hobbies[]' id=".$hobby." value=".$hobby." checked><label for=".$hobby.">". ucfirst($t[$hobby]). "</label>";
            } else {
                echo "<input type='checkbox' name='hobbies[]' id=".$hobby." value=".$hobby." ><label for=".$hobby.">".ucfirst($hobby). "</label>";
            }
        }
    }

    function edit_avatar(string $user_avatar){
        $all_avatars = ["cat.png","bear.png","chicken.png","panda.png","koala.png","gorilla.png"];
        foreach($all_avatars as $avatar){
            if('/images/'.$avatar === $user_avatar){
                echo "<input type='radio'  name='avatar' id='".$avatar."' value='/images/".$avatar."' checked><label for=".$avatar."><img class='avatar_el' src='./assets/images/".$avatar."' alt='avatar'></label>";
            } else {
                echo "<input type='radio'  name='avatar' id='".$avatar."' value='/images/".$avatar."'><label for=".$avatar."><img class='avatar_el' src='./assets/images/".$avatar."' alt='avatar'></label>";
            }
        }
    }

    function check_edit_errors(){
        if(isset($_SESSION['errors_edit'])){
            $errors = $_SESSION['errors_edit'];
            echo '<div class="edit_status" style="background-color:#80240047">';
            foreach($errors as $error){
                echo "<p style='color:rgb(181, 9, 9); text-align:center'>".$error."</p>";
                }
            echo '</div>';
            unset($_SESSION['errors_edit']);
        } else if (isset($_GET['edit']) && $_GET['edit'] === "success") {
                echo '<div class="edit_status">';
                echo "<p style='color:green; text-align:center'> Account successfully edited !</p>";
                    echo '</div>';

        }
    }


    function show_profil(int $user_id, $result, $posts_result, array $t){
            ?>                       
         <?php check_edit_errors()?>
        <div class="profile_left">
                <div class="profile_upper_left">
                    <img src="./assets/<?php echo $result['avatar']?>">
                    <span><?php echo $result['username']?> </span>
                    <button id="edit_profile" onclick='window.location="/blog/profile_page.php?profile=edit"'><?= $t['edit'] ?></button>
                </div>
                <div class="profile_bottom_left">
                    <h3><?= $t['bio']?> :</h3>
                    <p><?php echo $result['bio'] ?></p>
                </div>
            </div>
            <div class="profile_right">
                <div class="hobbies_box">
                    <h3><?= $t['hobbies']?> :</h3>
                    <div class="hobbies">
                        <?php show_hobbies($result['hobbies'], $t);?>
                    </div>
                </div>
                <div class="posts_section">
                    <h3><?= $t['posts']?> :</h3>
                    <div class="posts_box">
                        <?php show_profile_posts($posts_result) ?>
                    </div>  
                </div>
            </div>
        <?php }


         function edit_profil(int $user_id, $result, array $t){
            ?>
        <form id="edit_form" method="POST" action="./update_profile.php">
            <div class="profile_left">
                    <div class="profile_upper_left">
                        <img src="./assets/<?php echo $result['avatar']?>" id="user_pp">
                        <span><input type="text" name="username" maxlength="20" value="<?php echo $result['username']?>"> </span>
                        <div class="profile_buttons">
                            <button type="button" id="cancel_edit" onclick="window.location='/blog/profile_page.php'"><?= strtoupper($t['cancel'])?></button>
                            <button type="submit" id="confirm_edit"><?= strtoupper($t['confirm'])?></button>
                        </div>

                    </div>
                    <div class="profile_bottom_left">
                        <h3><?= $t['bio']?> :</h3>
                        <textarea name="bio" maxLength=300 placeholder="300 caracters max"><?php echo $result['bio'] ?></textarea>
                    </div>
                </div>
                <div class="profile_right">
                    <div class="hobbies_box">
                        <h3><?= $t['hobbies']?> :</h3>
                        <div class="hobbies">
                            <?php edit_hobbies($result['hobbies'], $t);?>
                            
                        </div>
                    </div>
                    <div class="avatar_section">
                        <h3><?= $t['avatar']?> :</h3>
                        <div class="avatar_box">
                            <?php edit_avatar($result['avatar']) ?>
                        </div>  
                    </div>
                </div>
            </div>
        <?php } ?>


        <?php function show_others_profil(int $user_id, array $result, array $posts_result, $t){
?>
        <div class="others_profile_left">
                <div class="profile_upper_left">
                    <img src="./assets/<?php echo $result['avatar']?>">
                    <span><?php echo $result['username']?> </span>
                </div>
                <div class="profile_bottom_left">
                    <h3><?= $t['bio']?> :</h3>
                    <p><?php echo $result['bio'] ?></p>
                </div>
            </div>
            <div class="profile_right">
                <div class="hobbies_box">
                    <h3><?= $t['hobbies']?> :</h3>
                    <div class="hobbies">
                        <?php show_hobbies($result['hobbies'], $t);?>
                    </div>
                </div>
            </div>

        
    <?php } 

        function show_accounts(array $result, object $pdo){ 
            foreach($result as $account){ ?>
                    <div class="user_box">
                    <div class="user_avatar" onclick="location.href='./manage_posts.php?user=<?= $account['username']?>'">
                        <img src="/blog/assets/<?= $account['avatar']?>">
                    </div>
                    <div class="user_info">
                        <h4>Username: <span><?= $account['username']?></span></h4>
                        <p>Rank: <span><?= $account['rank']?></span></p>
                        <p>Posts: <span><?php  $result = count_posts($pdo, $account['id']); echo $result['COUNT(*)'];?></span></p>
                        <date>Created on <?= $account['date_of_creation']?></date>
                    </div>
                    <div class="delete_user" onclick="deleteUser(<?= $account['id']?>)">
                        <img  id="delete_img" src="/blog/assets/images/close.png">
                    </div>
                </div>
                           <?php }
        }

        function show_users_list(array $result){
            foreach($result as $username){
                echo "<option value=".$username['username'].">";
            }
        }
?>
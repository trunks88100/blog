<?php 
    require_once  __DIR__. '/../app/config_session.inc.php';
    if(isset($_SESSION['user_id'])){
    require_once __DIR__. '/../app/users/user_view.inc.php';
    require_once __DIR__. '/../app/users/user_model.inc.php';


    $profile_result = fetch_profil($pdo,$_SESSION['user_id']);
    $posts_result = fetch_user_post($pdo, $_SESSION['user_id']);

    $t = $_COOKIE['lang'] ?? 'fr';
    require "assets/lang/$t.php";

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./assets/blog.css">
    <title>Profile Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="./assets/images/coffee.png" type="image/png">
    <script src="./assets/themeColor.js"></script>

</head>
<body>
    <main style="background:linear-gradient(var(--dashboard), #3a1943)">
        <a href="./dashboard.php" class="back_button"><img id="arrows" src="./assets/images/back.png"><?= $t['back']?></a>
        <div class="profile_box">
            <?php if(isset($_GET['profile'])){
                    edit_profil($_SESSION['user_id'], $profile_result, $t);
                } else {
                    show_profil($_SESSION['user_id'], $profile_result, $posts_result, $t);
                } ?>
        </div>
    </main>

    <script>
        const small = document.querySelectorAll('.avatar_el');
        const big = document.getElementById('user_pp');
        small.forEach(el =>{
            el.addEventListener('click', ()=>{
                big.src = el.src;
            })
        })

    </script>
</body>
</html>
<?php } else {
    header("Location: index.html");
    exit();
}
?>
    
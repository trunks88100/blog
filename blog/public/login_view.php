
<?php 
     require_once  '../app/config_session.inc.php';
    require_once   '../app/auth/login_view.inc.php';
    
       $t = $_COOKIE['lang'] ?? 'en';
    require "assets/lang/$t.php";

 ?>
<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="./assets/blog.css">
<title>Log-in</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="./assets/images/coffee.png" type="image/png">
    <script src="./assets/themeColor.js"></script>


</head>
<body>
    <div class="main">
        <div id="translations" class="index-trans" style="right:2rem; left:auto">
                    <img src="./assets/images/translate.png" alt="languages" id="translate">
                    <span class="lang_opt" onclick="setLang('fr')">🇫🇷</span>
                    <span class="lang_opt" onclick="setLang('jp')">🇯🇵</span>
                    <span class="lang_opt" onclick="setLang('en')">🇬🇧</span>

        </div>

        <form class="log-in-box" method="POST" action="./log-in.php">
            <h1><?= $t['login']?></h1>
            <?= check_login_errors($t) ?>
            <div class="input-group">
                <img id="user-img" src="./assets/images/user(1).png">
                <input type="text" id="username" name="username" placeholder="<?= $t['username']?>">
                <label for="username"><?= $t['username']?></label>

            </div>
            <div class="input-group">
                <img id="user-img" src="./assets/images/password.png">
                    <input type="password" id="pass" name="pass" placeholder="<?= $t['password']?>">
                    <label for="pass"><?= $t['password']?></label>
            </div>
            <a id="recover" href="#"><?= $t['recover']?></a>
            <div class="log_buttons">
                <input id="submit" type="submit" value="<?= $t['signin']?>">
                <a id='new-account' href='signup_view.php'><?= $t['create_acc']?></a>
            </div>
            <hr class="or">            
                <a id='guest-account' href='dashboard.php?user=guest'><?= $t['log_guest']?></a>
        </form>
    </div>
    

<script>
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

    document.getElementById('recover').addEventListener('click', () =>{
        document.getElementById('recover').textContent = "<?= $t['sorry']?>"
        })
</script>
</body>
<?php 
    require_once '../app/config_session.inc.php';
    require_once  '../app/auth/signup_view.inc.php';

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

    <form class="log-in-box" method="POST" action="./sign-up.php">
        <?php check_signup_errors()?>
        <h1><?= $t['signup']?></h1>
        <div class="input-group">
             <img id="user-img" src="./assets/images/user(1).png">
            <input type="text" id="username" name="username" placeholder="* <?= $t['username']?>" maxlength="20" value="<?php signup_inputs("username")?>" required >
            <label for="username"><?= $t['username']?></label>
        </div>
        <div class="input-group" style="margin-bottom:1rem">
              <img id="user-img" src="./assets/images/password.png">
                <input type="password" id="pass" name="pass" placeholder="* <?= $t['password']?>" required >
                <label for="pass"><?= $t['password']?></label>

                <input type="password" id="pass-confirm" name="pass-confirm" placeholder="* <?= $t['confirm password']?>" required>
                <label for="pass-confirm" id="confirm-label"> <?= $t['confirm password']?></label>

                <p id="match_error"><?= $t['no_match']?></p>
        </div>
        <u><?= $t['hobbies']?></u> : 
        <table class="hobbies">
            <tr>
               <?php signup_checkboxes($first_row, $t) ?>
            </tr>
            <tr>
                <?php signup_checkboxes($second_row, $t) ?>
            </tr>
            
        </table>
        <u><?= $t['bio']?></u> :
        <textarea name="bio" id="bio" maxLength=300><?php signup_inputs("bio")?></textarea>

        <div class="sign-up-buttons">
            <a id="login" href="login_view.php"><?= $t['login_now']?></a>
            <input type="submit" id="submit" value="<?= $t['create_my_acc']?>">
        </div>
    </form>
</div>

    <script>
        function invalid_match(passConfirm, pass){
            return pass.value !== "" && passConfirm.value !== "" && passConfirm.value !== pass.value;
        }

        const pass = document.getElementById('pass');
        const passConfirm = document.getElementById('pass-confirm');
        const message = document.getElementById('match_error');

        function checkPasswords() {
        if (invalid_match(passConfirm, pass)) {
            message.style.display = "block";
            document.getElementById('submit').disabled = true;
        } else {
            message.style.display = "none";
            document.getElementById('submit').disabled = false;
        }
    }

pass.addEventListener('input', checkPasswords);
passConfirm.addEventListener('input', checkPasswords);


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
    </script>   

</body>
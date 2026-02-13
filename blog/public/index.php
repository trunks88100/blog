<?php $t = $_COOKIE['lang'] ?? 'en';
    require "assets/lang/$t.php"; 
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./assets/blog.css">
    <title>Index</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="./assets/images/coffee.png" type="image/png">

    

</head>
<body style="background-color: var(--main-color);">
    <div id="translations" class="index-trans">
                    <img src="./assets/images/translate.png" alt="languages" id="translate">
                    <span class="lang_opt" onclick="setLang('fr')">🇫🇷</span>
                    <span class="lang_opt" onclick="setLang('jp')">🇯🇵</span>
                    <span class="lang_opt" onclick="setLang('en')">🇬🇧</span>

        </div>
    <div class="covering">
        <button id="access"><?= $t['access']?></button>
    </div>
    <div class="index-box">
        
        <ul>
            <li><a href="/blog/signup_view.php"><?= $t['signup']?></a></li>
            <li> <a href="/blog/login_view.php"><?= $t['login']?></a> </li>
            <li><a href="dashboard.php?user=guest"><?= $t['guest']?></a></li>
        </ul>
    </div>


<script>
    function slide(el, distance){
        el.style.transform=`translateX(${distance})`;
    }
    document.getElementById('access').addEventListener('click', () =>{
        let covering = document.querySelector('.covering');
        let indexBox = document.querySelector('.index-box');
        slide(covering, "50vw");
        slide(indexBox, "-25vw");
        indexBox.style.opacity="1";
    })

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
</html>
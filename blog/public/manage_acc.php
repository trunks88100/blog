<?php
    require_once __DIR__ . '/../app/config_session.inc.php';
    if($_SESSION['user_rank'] === 'admin'){
        require_once __DIR__. '/../app/users/user_view.inc.php';
        require_once __DIR__. '/../app/users/user_model.inc.php';
    
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./assets/blog.css">
    <title>Manage accounts</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="./assets/images/coffee.png" type="image/png">
    <script src="./assets/themeColor.js"></script>

</head>
<body>
    <main style="background-color:var(--main-color); overflow:auto; scrollbar-width:none">
        <a href="./dashboard.php" id="manage_back_button" class="back_button"><img id="arrows" src="./assets/images/back.png">BACK</a>
            <div class="manage_box">
                <?php if(isset($_SESSION['delete_status'])){echo "<div class='delete_status'>".$_SESSION['delete_status']."</div>"; /*unset($_SESSION['delete_status'])*/;}?>
                <?php $result = fetch_accounts($pdo); show_accounts($result, $pdo); ?>
            </div>
    </main>
    <form id="delete_window"method="POST" action="delete_user.php">
                <input type="hidden" id="user_id" name="user_id" value="">
                <button type="button" id="cancel_delete" onclick="toggle_show('delete_window')">Cancel</button>
                <input type="submit" value="Delete this account">
    </form> 

<script>
    function toggle_show(el){
        const window = document.getElementById(el);
        window.classList.toggle('show');
    }
    function deleteUser(user_id){
        document.getElementById('delete_window').classList.toggle('show');
        let form = document.getElementById('user_id');
        form.value = user_id;
    }
</script>
</body>
</html>

<?php } else {
    header("Location: index.html");
    exit();
}
?>
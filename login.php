<?php
include_once("DB/mysqli.php");
$connect = new Connect();
$db = $connect->sql();
$url = $connect->url();
session_start();
?>
<!DOCTYPE html>
<html>
<?php

if (isset($_POST['action']) && $_POST['action'] == 'login') {
    $email = $_POST['email'];
    $password = md5($_POST['pswd']);
    $check_login = $db->query("SELECT * FROM user WHERE `email` = '$email' AND `password` = '$password' AND type = 1 LIMIT 1");
    if ($check_login->num_rows > 0) {
        $_SESSION['email_session'] = $email;
?>
        <meta http-equiv="refresh" content="0;url=<?= $url ?>/login.php?t=1">
    <?php

        exit;
    } else {
        $message = 'Email or Password is incorrect';
    }
}
if (isset($_GET['t'])) {
    ?>
    <meta http-equiv="refresh" content="0;url=<?= $url ?>">
<?php
}
if (isset($_GET['type'])) {
    $message = '';
}
?>

<head>
    <title>Sign Up and Login Form</title>
    <link rel="stylesheet" type="text/css" href="assets/css/SignUp&Login.css?v=<?= time() ?>">
</head>
<style>
    .login.active {
        transform: translateY(-500px);
    }
</style>

<body>
    <div class="main">
        <input type="checkbox" id="chk" aria-hidden="true">

        <div class="signup">
            <form>
                <label for="chk" aria-hidden="true">Đăng ký</label>
                <input type="text" name="txt" placeholder="Họ và tên" required="">
                <input type="email" name="email" placeholder="Email" required="">
                <input type="number" name="broj" placeholder="Số điện thoại" required="">
                <input type="password" name="pswd" placeholder="Mật khẩu" required="">
                <button class="sign-up">Gửi</button>
            </form>
        </div>

        <div class="login <?= isset($message) ? 'active' : '' ?>">
            <form method="POST">
                <label for="chk" aria-hidden="true">Đăng nhập</label>
                <input type="email" name="email" placeholder="Email" required="">
                <input type="password" name="pswd" placeholder="Mật khẩu" required="">
                <p style="text-align:center"><?= isset($message) ? $message : '' ?></p>
                <input type="hidden" name="action" value="login">
                <button name="login" type="submit">Gửi</button>
            </form>
        </div>
    </div>
</body>
<script src="<?= $url ?>/assets/js/jquery.js?v=<?= time() ?>"></script>
<script>
    $(document).ready(function() {
        $('.sign-up').click(function(e) {
            e.preventDefault();
            var txt = $('input[name="txt"]').val();
            var email = $('input[name="email"]').val();
            var broj = $('input[name="broj"]').val();
            var pswd = $('input[name="pswd"]').val();
            var action = 'register';
            $.ajax({
                type: "POST",
                dataType: "JSON",
                url: "ajax.php",
                data: {
                    action,
                    txt,
                    email,
                    broj,
                    pswd
                },
                success: function() {
                    $('.login').addClass('active');
                }
            });
        });
    });
</script>

</html>
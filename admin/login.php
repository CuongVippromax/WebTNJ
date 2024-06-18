<?php
    include_once("../DB/mysqli.php");
    $connect = new Connect();
    $db = $connect->sql();
    $url = $connect->url();
    session_start();
    if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'login'){
        $email = $_POST['email'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $check_login = $db->query("SELECT * FROM user WHERE `email` = '$email' AND `password` = '$password' AND type = 0 LIMIT 1");
        if($check_login->num_rows > 0){
            $_SESSION['email_backend'] = $email;
            ?>
             <meta http-equiv="refresh" content="0;url=<?= $url ?>/admin/login.php?t=1">
            <?php
            
            exit;
        }else{
            $message = 'Email or Password is incorrect';
        }
    }
    if(isset($_GET['t'])){
        ?>
        <meta http-equiv="refresh" content="0;url=<?= $url ?>/admin">
        <?php
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="<?= $url ?>/admin/asset/style.css?v=<?= time() ?>">
</head>
<body>
    
 <!-- Login Form -->
 <div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card shadow">
                <div class="card-title text-center border-bottom">
                    <h2 class="p-3">Login</h2>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-4">
                            <label for="username" class="form-label">Username/Email</label>
                            <input type="text" name="email" class="form-control" required id="username" />
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required id="password" />
                        </div>
                        <div class="mb-4">
                            <input type="checkbox" class="form-check-input" id="remember" />
                            <label for="remember" class="form-label">Remember Me</label>
                        </div>
                        <div class="">
                            <p style="text-align:center"><?= isset($message) ? $message : '' ?></p>
                        </div>
                        <input type="hidden" name="action" value="login">
                        <div class="d-grid">
                            <button type="submit" class="btn text-light btn-primary">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    include_once('include/footer.php')
?>
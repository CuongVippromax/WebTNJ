<?php
include_once("DB/mysqli.php");
$connect = new Connect();
$db = $connect->sql();
$url = $connect->url();
session_start();
$cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
if (isset($_GET['logout'])) {
    unset($_SESSION['email_session']);
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang sức TNJ</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link rel="stylesheet" href="<?= $url ?>/assets/css/TNJ2home.css?v=<?= time() ?>">
    

</head>

<body>
    <!-- header section starts -->
    <header>

        <input type="checkbox" name="" id="toggler">
        <label for="toggler" class="fas fa-bars"></label>

        <a href="<?= $url ?>/" class="logo">TNJ <span>.</span></a>

        <nav class="navbar">
            <a href="<?= $url ?>/">Trang chủ</a>
            <a href="<?= $url ?>/#about">Tổng quát</a>
            <a href="<?= $url ?>/#products">Sản phẩm</a>
            <a href="<?= $url ?>/#review">Đánh giá</a>
            <a href="<?= $url ?>/#contact">Liên hệ</a>
        </nav>

        <div class="icons">

            <a href="<?= $url ?>/cart.php" class="reline">
                <i class="fas fa-shopping-cart"></i>
                <span class="bage"><?= $cart ?></span>
            </a>

            <?php
            if (isset($_SESSION['email_session'])) {
            ?>
                <a href="<?= $url ?>/?logout" class="fas fa-sign-out"></a>
            <?php
            } else {
            ?>
                <a href="<?= $url ?>/login.php" class="fas fa-user"></a>
            <?php
            }
            ?>

        </div>
    </header>
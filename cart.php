<?php include_once("include/headercart.php") ?>
<?php
error_reporting(E_ALL);
if (isset($_POST['action']) && $_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'update') {
    $quantity = $_POST['quantity'];
    if (isset($_SESSION['cart'])) {
        $i = 0;
        foreach ($_SESSION['cart'] as $product_id => $cart) {
            $_SESSION['cart'][$product_id] = array(
                "quantity" => $quantity[$i],
            );
            $i++;
        }
        header('location:cart.php');
    }
}
if (isset($_GET['action']) && $_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['action'] == 'delete') {
    $id_product = $_GET['id_first'];
    if (isset($_SESSION['cart'])) {
        unset($_SESSION['cart'][$id_product]);
        header('location:cart.php');
    }
}

if (isset($_POST['action']) && $_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'thanhtoan') {
    $fullname = isset($_POST['fullname']) ? $_POST['fullname'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $notes = isset($_POST['notes']) ? $_POST['notes'] : '';
    $payment = isset($_POST['payment']) ? $_POST['payment'] : '';
    $json = json_encode($_SESSION['cart']);
    $db->query("INSERT INTO `orders`(`fullname`, `email`, `phone`, `address`, `notes`,`payment`, `json`) VALUES ('$fullname','$email','$phone','$address','$notes','$payment','$json')");
    $id = mysqli_insert_id($db);
    $oll = 0;
    if ($id) {
        if (isset($_SESSION['cart'])) {
            $cart = $_SESSION['cart'];
            foreach ($cart as $product_id => $carts) {
                $oll++;
                $qusntity = $carts['quantity'];
                $get_product = mysqli_fetch_assoc($db->query("SELECT * FROM product WHERE id = " . $product_id));
                $update_qty = (int) $get_product['quantity'] - (int)$qusntity;
                $db->query("UPDATE `product` SET `quantity_old` = '$update_qty' WHERE id = '$product_id' ");
            }
        }
    }
    unset($_SESSION['cart']);
    if ($oll > 0) {
?>
        <meta http-equiv="refresh" content="0;url=<?= $url . '/orderpay.php?id=' . $id . '&token=' . md5($id) ?>">
<?php
    }

    exit;
}
$cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>
<!-- header section starts -->


<!-- header section end -->

<!-- shopping cart section starts -->


<div class="shoppingcart-container">
    <div class="payment">

        <div class="payment-container">

            <h3>Thông Tin Thanh Toán</h3>
            <form method="POST">
                <div class="form-group">
                    <label for="">Họ Và Tên</label>
                    <input type="text" name="fullname" placeholder="Họ Và Tên" required>
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label for="">Số Điện Thoại</label>
                    <input type="text" name="phone" placeholder="Số Điện Thoại" required>
                </div>
                <div class="form-group">
                    <label for="">Địa Chỉ</label>
                    <input type="text" name="address" placeholder="Địa Chỉ" required>
                </div>
                <div class="form-group">
                    <label for="">Ghi Chú</label>
                    <textarea name="notes" class="form-control" placeholder="Ghi Chú"></textarea>
                </div>

                <div class="form-group2">
                    <h3 for="">Phương Thức Thanh Toán</h3>
                    <?php
                    $result = $db->query("SELECT * FROM pttt");
                    while ($rows = mysqli_fetch_assoc($result)) {
                    ?>
                        <div>
                            <input required id="payment_<?= $rows['id'] ?>" type="radio" name="payment" value="<?= $rows['id'] ?>">
                            <label for="payment_<?= $rows['id'] ?>"><?= $rows['title'] ?></label>
                        </div>
                    <?php
                    }
                    ?>
                </div>

                <div class="form-group3">
                    <input type="hidden" name="action" value="thanhtoan">
                    <button class="btn">Kiểm Tra</button>
                </div>
            </form>

        </div>


    </div>
    <div class="cart">
        <div class="main">
            <?php
            if (isset($_SESSION['cart'])) {
                $cart = $_SESSION['cart'];
            ?>
                <form method="POST">
                    <div class="scroll">
                        <?php
                        $tongtien = 0;
                        foreach ($cart as $product_id => $carts) {
                            $get_product = mysqli_fetch_assoc($db->query("SELECT * FROM product WHERE id = " . $product_id));
                        ?>

                            <div class="product">
                                <div class="img">
                                    <img src="<?= $url ?>/assets/image/product/<?= $get_product['image'] ?>" alt="">
                                </div>
                                <div class="content">
                                    <div class="text">
                                        <h2><?= $get_product['name'] ?></h2>
                                    </div>
                                    <div class="price"><?= number_format($get_product['price']) ?></div>
                                </div>
                                <div class="number-control">
                                    <input type="number" min="1" max="20" class="number-quantity" name="quantity[]" value="<?= $carts['quantity'] ?>">
                                </div>
                                <div class="trash">
                                    <a href="<?= $url ?>/cart.php?action=delete&id_first=<?= $product_id ?>"><i class="fa fa-trash"></i></a>
                                </div>
                            </div>


                            <input type="hidden" name="id_product[]" value="<?= $product_id ?>">
                        <?php
                            $tongtien += (float)$get_product['price'] * (float)$carts['quantity'];
                        }
                        ?>
                        <div class="total">Total: <?= number_format($tongtien) ?></div>
                        <input type="hidden" name="action" value="update">
                        <input type="submit" class="btn" value="Update"></input>
                    </div>
                </form>
            <?php
            } else {
            ?>
                <div class="scroll">
                    <h4>No cart</h4>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>

<div style="clear:both">&ensp;</div>
<?php include_once("include/footer.php") ?>
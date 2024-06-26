<?php include_once("include/headercart.php") ?>

<section class="home justify-center" id="home">
    <div class="content text-center">
        <h3>Thank your order</h3>
    </div>
</section>

<section>

    <div class="shoppingcart-container">
        <?php
        if (isset($_GET['id']) && isset($_GET['token']) && md5($_GET['id']) == $_GET['token']) {
            $id = isset($_GET['id']) ? $_GET['id'] : '';
            $result = $db->query("SELECT * FROM orders WHERE id = " . $id);
            $detail = mysqli_fetch_assoc($result);
        ?>
            <div class="payment">
                <div class="payment-container">
                    <h3>Thông Tin Thanh Toán</h3>
                    <form>

                        <div class="form-group">
                            <label for="">Họ Và Tên</label>
                            <p><?= $detail['fullname'] ?></p>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="">Email</label>
                            <p><?= $detail['email'] ?></p>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="">Số Điện Thoại</label>
                            <p><?= $detail['phone'] ?></p>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="">Địa Chị</label>
                            <p><?= $detail['address'] ?></p>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="">Ghi Chú</label>
                            <p><?= $detail['notes'] ?></p>
                        </div>
                        <?php
                        $tongtien = 0;
                        $product = json_decode($detail['json'], true);
                        foreach ($product as $id_pro => $products) {
                            $get_product = mysqli_fetch_assoc($db->query("SELECT * FROM product WHERE id = " . $id_pro));
                            $tongtien += (float)$get_product['price'] * (float)$products['quantity'];
                        }
                        ?>
                        <hr>
                        <div class="form-group">
                            <label for="">Phương thức thanh toán</label>
                            <p>
                                <?php
                                $result = $db->query("SELECT * FROM pttt WHERE id = " . $detail['id']);
                                $pttt = mysqli_fetch_assoc($result);
                                print isset($pttt['title']) ? $pttt['title'] : '';
                                ?>
                            </p>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="">Trạng thái</label>
                            <p>
                                <?php
                                if ($detail['status'] == 0) {
                                    print 'Đang xác thực';
                                } else if ($detail['status'] == 1) {
                                    print 'Đang chờ vận chuyển';
                                } else if ($detail['status'] == 2) {
                                    print 'Đang vận chuyển';
                                } else if ($detail['status'] == 3) {
                                    print 'Đã hoàn thành';
                                }
                                ?>
                            </p>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="">Tổng tiền</label>
                            <p><?= number_format($tongtien) ?>đ</p>
                        </div>

                    </form>

                </div>
            </div>
            <div class="cart">
                <div class="main">

                    <div class="scroll">
                        <h3 style="font-size: 2rem;">Chi tiết đơn hàng</h3>
                        <?php
                        $product = json_decode($detail['json'], true);
                        foreach ($product as $id_pro => $products) {
                            $get_product = mysqli_fetch_assoc($db->query("SELECT * FROM product WHERE id = " . $id_pro));
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
                                    <input type="number" min="1" max="20" class="number-quantity" value="<?= $products['quantity'] ?>" disabled>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>

                </div>

            </div>
        <?php
        } else {
        ?>
            <p style="font-size:2rem">No order exists</p>
        <?php
        }
        ?>
    </div>

</section>

<?php include_once("include/footer.php") ?>
<?php include_once("include/header.php") ?>
<?php
if (isset($_POST['action']) && $_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'addtocart') {

    $id_product = $_POST['id_product'];
    $slug = $_POST['slug'];
    $quantity = $_POST['quantity'];
    if (isset($_SESSION['cart'][$id_product])) {
        $_SESSION['cart'][$id_product]['quantity']++;
    } else {
        $_SESSION['cart'][$id_product] = array(
            "quantity" => $quantity,
        );
    }
?>
    <meta http-equiv="refresh" content="0;url=<?= $url ?>?t=1">
    <?php
    if (isset($_GET['t'])) {
    ?>
        <meta http-equiv="refresh" content="0;url=<?= $url ?>">
<?php
    }
}
$cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>



<!-- home section starts -->
<section class="home" id="home">

    <div class="content">
        <h3>Trang sức TNJ</h3>
        <span>Hơn Cả Trang Sức - Biểu Tượng Của Niềm Tin</span>
        <p>TNJ là minh chứng cho sự cam kết về chất lượng và dịch vụ xuất sắc. Mỗi món đồ là lời hứa về sự bền bỉ,
            vẻ
            đẹp trường tồn và trải nghiệm mua sắm hoàn hảo, mang đến niềm tin và sự hài lòng cho khách hàng.</p>
        <p>
            Hãy để TNJ đồng hành cùng bạn trên hành trình chinh phục ước mơ và khẳng định
            giá trị bản thân.</p>
        <a href="shop.php" class="btn">Cửa hàng</a>
    </div>

</section>
<!-- home section end -->


<!-- about section starts -->
<section class="about" id="about">

    <h1 class="heading"><span> Tổng </span> Quan</h1>

    <div class="row">

        <div class="video-container">
            <video src="<?= $url ?>/assets/video/vd2.mp4" loop autoplay muted></video>
            <h3>Số một thị trường</h3>
        </div>

        <div class="content">

            <h3>Tại sao bạn nên chọn chúng tôi?</h3>
            <p> Kể từ khi ra đời vào năm 2014, TNJ đã không ngừng thăng hoa nghệ thuật chế tác trang sức, mang đến
                những tuyệt tác tinh xảo tôn vinh vẻ đẹp thanh lịch và thuần khiết vượt thời gian dành cho phái nữ
                mọi lứa tuổi. Mỗi món đồ của TNJ đều được các nghệ nhân tỉ mỉ chăm chút, là sự kết hợp hoàn hảo giữa
                nét cổ điển sang trọng và hơi thở đương đại, tinh tế tô điểm cho phong cách riêng biệt của mỗi người
                phụ nữ.</p>

            <p>
                Với bộ sưu tập đa dạng, phong phú, phù hợp cho mọi dịp, TNJ cam kết mang đến cho khách hàng những
                món trang sức chất lượng đỉnh cao cùng dịch vụ hoàn hảo. Hãy bước chân vào thế giới của TNJ, khám
                phá những kiệt tác trang sức tinh xảo, nơi kể chuyện phong cách của bạn và nâng tầm vẻ đẹp rạng
                ngời.</p>

            <a href="#" class="btn">Chi tiết</a>
        </div>
    </div>
</section>
<!-- about section ends -->
<!-- icons section starts -->
<section class="icons-container">

    <div class="icons">
        <img src="<?= $url ?>/assets/image/ic1.png" alt="">
        <div class="info">
            <h3>Miễn phí giao hàng</h3>
            <span>Trên mọi đơn hàng</span>
        </div>
    </div>

    <div class="icons">
        <img src="<?= $url ?>/assets/image/ic2 (1).png" alt="">
        <div class="info">
            <h3>Đổi trả trong 10 ngày</h3>
            <span>Đảm bảo hoàn tiền</span>
        </div>
    </div>

    <div class="icons">
        <img src="<?= $url ?>/assets/image/ic3.png" alt="">
        <div class="info">
            <h3>Đổi trả trong 10 ngày</h3>
            <span>Đảm bảo hoàn tiền</span>
        </div>
    </div>

    <div class="icons">
        <img src="<?= $url ?>/assets/image/ic4.png" alt="">
        <div class="info">
            <h3>Bảo mật thanh toán</h3>
            <span>An toàn cho mọi giao dịch</span>
        </div>
    </div>

</section>
<!-- icons section ends -->

<!-- products section starts -->
<section class="products" id="products">
    <h1 class="heading">Sản Phẩm <span>Mới Nhất</span></h1>
    <div class="box-container">
        <?php
        $all_product = $db->query("SELECT * FROM product ORDER BY rand() LIMIT 8");
        if (isset($all_product)) {
            while ($item = mysqli_fetch_assoc($all_product)) {
        ?>
                <div class="box">
                    <?php
                    if (isset($item['pricesale'])) {
                        $sale = ((float)$item['pricesale'] - (float)$item['price']) / (float)$item['pricesale'] * 100;
                    ?>
                        <span class="discount">-<?= ceil($sale) ?>%</span>
                    <?php
                    }
                    ?>

                    <div class="image">

                        <img src="<?= $url ?>/assets/image/product/<?= $item['image'] ?>" alt="">

                        <div class="icons">

                            <form method="POST">
                                <input type="hidden" value="<?= $item['id'] ?>" name="id_product">
                                <input type="hidden" value="<?= $item['slug'] ?>" name="slug">
                                <input type="hidden" value="1" name="quantity">
                                <input type="hidden" value="addtocart" name="action">
                                <button type="submit" class="cart-btn">Thêm vào giỏ hàng</button>
                            </form>
                            <a href="detail.php?id=<?= $item['id'] ?>&tensp=<?= $item['slug'] ?>" class="fas fa-share"></a>

                        </div>

                    </div>

                    <div class="content">

                        <h3><a href="detail.php?id=<?= $item['id'] ?>&tensp=<?= $item['slug'] ?>"><?= $item['name'] ?></a></h3>

                        <div class="price"><?= number_format($item['price'], 0) ?> <span><?= number_format($item['pricesale'], 0) ?></span></div>

                    </div>

                </div>

            <?php
            }
        } else {
            ?>
            <h5>Không có dữ liệu sản phẩm</h5>
        <?php
        }
        ?>
    </div>
</section>

<!-- products section ends -->

<!-- review section starts -->

<section class="review" id="review">

    <h1 class="heading">Đánh Giá <span>Của Khách Hàng</span></h1>

    <div class="box-container">

        <div class="box">
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <p>Tôi có thể cho bạn biết liệu hầu hết khách hàng hài lòng hay không hài lòng với sản phẩm, và họ thích
                hoặc không thích những gì về sản phẩm?
            <p>

            <div class="user">
                <img src="https://png.pngtree.com/thumb_back/fh260/background/20221128/pngtree-outdoorsy-young-woman-sporting-shades-confidently-posing-with-a-juice-bottle-meets-the-camera-gaze-photo-image_42709010.jpg" alt="">
                <div class="user-info">
                    <h3>Hiền Trang</h3>
                    <span>Khách hàng hạnh phúc</span>
                </div>
            </div>

            <span class="fas fa-quote-right"></span>
        </div>

        <div class="box">
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <p>Tôi có thể cho bạn biết liệu hầu hết khách hàng hài lòng hay không hài lòng với sản phẩm, và họ thích
                hoặc không thích những gì về sản phẩm?</p>

            <div class="user">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR2goftFJBbe8xqqJlplYIxPXa2QFsVsLcSPmPM4IJz4AuHVzRdnrFJTSMKGk-b_PR9OS0&usqp=CAU" alt="">
                <div class="user-info">
                    <h3>Văn Sơn</h3>
                    <span>Khách hàng hạnh phúc</span>
                </div>
            </div>

            <span class="fas fa-quote-right"></span>
        </div>

        <div class="box">
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <p>Tôi có thể cho bạn biết liệu hầu hết khách hàng hài lòng hay không hài lòng với sản phẩm, và họ thích
                hoặc không thích những gì về sản phẩm?</p>

            <div class="user">
                <img src="https://letranlaw.com/wp-content/uploads/2020/02/hannahavatar2.jpg" alt="">
                <div class="user-info">
                    <h3>Kim Tuệ</h3>
                    <span>Khách hàng hạnh phúc</span>
                </div>
            </div>

            <span class="fas fa-quote-right"></span>
        </div>

    </div>

</section>

<!-- review section ends -->


<!-- contact section starts -->

<section class="contact" id="contact">
    <h1 class="heading"> <span>contact</span> us</h1>
    <div class="row">
        <form action="">
            <input type="text" name="name" placeholder="Name" class="box" required>
            <input type="email" name="email" placeholder="Email" class="box" required>
            <input type="number" name="phone" placeholder="Phone" class="box" required>
            <textarea name="" name="content" class="box" placeholder="Message" id="" cols="30" rows="10"></textarea>
            <input type="button" class="contact-form btn" value="send message">
            <p class="success-contact" style="display:none;color: #333; font-size: 15px;">Send contact us successfully</p>
        </form>
        <div class="image">
            <img src="https://kimcuongdanang.com/wp-content/uploads/2022/07/Gems-Casa-bai-viet-phoi-trang-suc-quan-ao-5.jpg" alt="">
        </div>
    </div>
</section>

<!-- contact section ends -->

<?php include_once("include/footer.php") ?>

<script>
    $(document).ready(function() {
        $('.contact-form').click(function(e) {
            e.preventDefault();
            var name = $('input[name="name"]').val();
            var email = $('input[name="email"]').val();
            var phone = $('input[name="phone"]').val();
            var content = $('textarea[name="contentss"]').val();
            var action = 'contact';
            $.ajax({
                type: "POST",
                dataType: "JSON",
                url: "ajax.php",
                data: {
                    action,
                    name,
                    email,
                    phone,
                    content
                },
                success: function(data) {
                    $('input[name="name"]').val('');
                    $('input[name="email"]').val('');
                    $('input[name="phone"]').val('');
                    $('textarea[name="content"]').val('');
                    $('.success-contact').show();
                }
            });
        });
    });
</script>
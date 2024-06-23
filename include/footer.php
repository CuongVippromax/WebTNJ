<!-- footer section starts -->

<section class="footer">
    <div class="box-container">
        <div class="box">
            <h3>Đường dẫn nhanh</h3>
            <a href="<?= $url ?>/index.php#home">Trang chủ</a>
            <a href="<?= $url ?>/index.php#about">Tổng quan</a>
            <a href="<?= $url ?>/index.php#products">Sản phẩm</a>
            <a href="<?= $url ?>/index.php#review">Đánh giá</a>
            <a href="<?= $url ?>/index.php#contact">Liên hệ</a>
        </div>
        <div class="box">
            <h3>Đường dẫn nhanh</h3>
            <?php
            if (isset($_SESSION['email_session'])) {
            ?>
                <a href="<?= $url ?>/myaccount.php">Tài khoản</a>
            <?php
            } else {
            ?>
                <a href="<?= $url ?>/login.php?type">Tài khoản</a>
            <?php
            }
            ?>
            <a href="<?= $url ?>/order.php">giỏ hàng</a>

        </div>
        <div class="box">
            <h3>Cơ sở</h3>
            <a href="">Hạ Long-Quảng Ninh</a>
            <a href="">Hải Phòng</a>
            <a href="">Hà Nội</a>
            <a href="">Hò Chí Minh</a>
        </div>
        <div class="box">
            <h3>Địa chỉ liên hệ</h3>
            <a href="">+84-9887654</a>
            <a href="">TNJ@gmail.com</a>
            <a href="">Triều Khúc - Thanh Xuân - Hà Nội</a>
            <img src="<?= $url ?>/assets/image/cardpayjpg.jpg" alt="">
        </div>
    </div>
    <div class="credit"> Sáng tạo bởi <span> chúng tôi </span>|Bùi Hiền Trang, Phan Văn Tùng, Ngô Thị Thảo Thơm, Vũ Quang Minh, Nguyễn Văn Cường</div>
</section>
<!-- footer section ends -->
<script src="<?= $url ?>/assets/js/jquery.js?v=<?= time() ?>"></script>
<script src="<?= $url ?>/assets/js/custom.js?v=<?= time() ?>"></script>
</body>

</html>
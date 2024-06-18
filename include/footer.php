<!-- footer section starts -->

<section class="footer">
    <div class="box-container">
        <div class="box">
            <h3>quick links</h3>
            <a href="<?= $url ?>/index.php#home">home</a>
            <a href="<?= $url ?>/index.php#about">about</a>
            <a href="<?= $url ?>/index.php#products">products</a>
            <a href="<?= $url ?>/index.php#review">review</a>
            <a href="<?= $url ?>/index.php#contact">contact</a>
        </div>
        <div class="box">
            <h3>extra links</h3>
            <?php
                if(isset($_SESSION['email_session'])){
                    ?>
                        <a href="<?= $url ?>/myaccount.php">my acccount</a>
                    <?php
                }else{
                    ?>
                        <a href="<?= $url ?>/login.php?type">my acccount</a>
                    <?php
                }
            ?>
            <a href="<?= $url ?>/order.php">my order</a>
            <a href="">my favorite</a>
        </div>
        <div class="box">
            <h3>locations</h3>
            <a href="">india</a>
            <a href="">USA</a>
            <a href="">japan</a>
            <a href="">france</a>
        </div>
        <div class="box">
            <h3>contact info</h3>
            <a href="">+84-9887654</a>
            <a href="">TNJ@gmail.com</a>
            <a href="">Triều Khúc - Thanh Xuân - Hà Nội</a>
            <img src="<?= $url ?>/assets/image/cardpayjpg.jpg" alt="">
        </div>
    </div>
    <div class="credit"> created by <span> WE </span>|Bùi Hiền Trang, Phan Văn Tùng, Ngô Thị Thảo Thơm, Vũ Quang Minh, Nguyễn Văn Cường</div>
</section>
    <!-- footer section ends -->
<script src="<?= $url ?>/assets/js/jquery.js?v=<?= time() ?>"></script>
<script src="<?= $url ?>/assets/js/custom.js?v=<?= time() ?>"></script>
</body>

</html>
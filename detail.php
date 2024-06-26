<?php include_once("include/headerdetail.php") ?>
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

    $loadpage = $url . "/detail.php?id=" . $id_product . "&tensp=" . $slug . "/true";
?>
    <meta http-equiv="refresh" content="0;url=<?= $loadpage ?>?t=1">
    <?php
    if (isset($_GET['t'])) {
    ?>
        <meta http-equiv="refresh" content="0;url=<?= $loadpage ?>">
<?php
    }
}
$cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>
<section class="home" id="home">
    <div class="content">
        <h3>Mùa Hè</h3>
        <span>Tiết Kiệm Nhiều Hơn Với Giảm Giá 70%</span>
    </div>
</section>
<?php
if (isset($_GET['status']) && $_GET['status'] == 'true') {
?>
    <section class="detail container mt-1">
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Success!</strong> Added product successfully!
        </div>
    </section>
<?php
}
?>

<?php
$id = isset($_GET['id']) ? $_GET['id'] : '';
$result = $db->query("SELECT * FROM product WHERE id = " . $id);
$detail = mysqli_fetch_assoc($result);
if (isset($detail)) {
?>
    <section class="detail">

        <div class="img">
            <img src="<?= $url ?>/assets/image/product/<?= $detail['image'] ?>" width="100%">
        </div>

        <div class="content">
            <h1>
                <?= $detail['name'] ?>
            </h1>

            <div class="product-price">

                <span class="current-price-value" content="299000">
                    <?= number_format($detail['price']) ?> &nbsp;₫
                </span>

                <span class="product-discount">
                    <span class="regular-price"> <?= number_format($detail['pricesale']) ?> &nbsp;₫</span>
                </span>


            </div>

            <div class="product-short-description">

                <?= $detail['content'] ?>

            </div>


            <form method="POST">

                <input type="hidden" value="<?= $id ?>" name="id_product">
                <input type="hidden" value="<?= $detail['slug'] ?>" name="slug">
                <input type="hidden" value="addtocart" name="action">

                <div class="quantity">

                    <button class="minus" type="button" aria-label="Decrease">&minus;</button>

                    <input type="number" class="input-box" value="1" min="1" max="20" name="quantity">

                    <button class="plus" type="button" aria-label="Increase">&plus;</button>

                </div>

                <button class="btn">Thêm Vào Giỏ Hàng</button>

            </form>

            <div class="discrai">
                <p> SKU: <span>D2300-3-2-2</span></p>
                <p> CATEGORY: <span>BRACELETS</span></p>
                <p> TAGS: <span>HOT, TREND</span></p>
            </div>

        </div>


    </section>

    <div class="document">

        <h2>THÔNG TIN SẢN PHẨM</h2>
        <p> <span> Tiêu đề:</span> Vòng kim cương lấp lánh - Tỏa sáng nét đẹp sang trọng</p>
        <span>Mô tả:</span>
        <p>Tìm kiếm một món trang sức tinh tế và sang trọng để tôn vinh vẻ đẹp của bạn? Hãy khám phá Vòng kim cương lấp
            lánh - Tuyệt tác từ LiLi. Chiếc vòng được chế tác tỉ mỉ từ những viên kim cương lấp lánh, mang
            đến vẻ đẹp rực rỡ và đẳng cấp cho người sở hữu.</p>
        <span>Điểm nổi bật:</span>
        <ul>
            <li><span>Kim cương lấp lánh:</span> Chiếc vòng được tô điểm bởi những viên kim cương được tuyển chọn kỹ
                lưỡng, đảm bảo độ sáng, lửa và độ tinh khiết cao cấp. Ánh sáng lấp lánh từ kim cương sẽ thu hút mọi ánh
                nhìn và tôn lên vẻ đẹp sang trọng của bạn.</li>
            <li><span>Thiết kế tinh tế:</span> Vòng kim cương được thiết kế với kiểu dáng thanh lịch và hiện đại, phù
                hợp với mọi phong cách và cá tính. Chiếc vòng có thể được đeo riêng hoặc kết hợp với các món trang sức
                khác để tạo điểm nhấn ấn tượng.</li>
            <li><span>Chất liệu cao cấp:</span> Vòng kim cương được chế tác từ vàng trắng/vàng vàng/vàng hồng (tùy chọn)
                cao cấp, đảm bảo độ bền và sáng bóng lâu dài. Chất liệu cao cấp không chỉ tôn lên vẻ đẹp của kim cương
                mà còn mang đến sự sang trọng và đẳng cấp cho người sở hữu.</li>
            <li><span>Món quà hoàn hảo:</span> Vòng kim cương là món quà hoàn hảo cho những người phụ nữ đặc biệt trong
                cuộc đời bạn. Chiếc vòng thể hiện sự trân trọng, yêu thương và là lời chúc may mắn cho người nhận.</li>
        </ul>
        <span>Thông tin chi tiết</span>
        <ul>
            <li>Chất liệu: Vàng trắng/vàng vàng/vàng hồng (tùy chọn)</li>
            <li>Kiểu dáng: Tròn</li>
            <li>Loại kim cương: 50kara</li>
            <li>Số lượng viên kim cương: 20</li>
            <li>Trọng lượng: 50g</li>
            <li>Kích thước: 20mm</li>
        </ul>
    </div>

<?php
}
?>
<?php include_once("include/footer.php") ?>
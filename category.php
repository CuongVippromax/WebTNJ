<?php include_once("include/headershopnow.php") ?>
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
    $loadpage = $url . "/category.php?id=" . $_GET['id'] . "&tensp=" . $_GET['tensp'];
    header('location:' . $loadpage);
}
$cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>

<!-- home section starts -->
<section class="home" id="home">
    <div class="content">
        <h3>Mùa Hè</h3>
        <span>Tiết kiệm nhiều hơn với giảm giá 70%</span>
    </div>
</section>

<!-- home section end -->

<!-- shop section starts -->

<div class="shop">
    <div class="input">
        <div class="search">
            <input type="text" placeholder="Tìm kiếm">
            <i class="fa-solid fa-magnifying-glass"></i>
        </div>

        <h2>Phân loại <span>sản phẩm</span></h2>

        <div class="navbar">

            <?php
            $category = $db->query("SELECT * FROM category ORDER BY id DESC");
            if (isset($category)) {
                while ($item = mysqli_fetch_assoc($category)) {
            ?>
                    <a href="<?= $url ?>/category.php?id=<?= $item['id'] ?>&tensp=<?= $item['slug'] ?>" class="hightlight"><?= $item['name'] ?></a>

                <?php
                }
            } else {
                ?>
                <span>No data category</span>
            <?php

            }
            ?>
        </div>
    </div>


    <!-- products section starts -->
    <div class="products">
        <?php
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $category = $db->query("SELECT * FROM category WHERE id = " . $id);
        $result = mysqli_fetch_assoc($category);
        if (isset($result)) {
        ?>
            <h1 class="heading"><?= $result['name'] ?></h1>
        <?php
        }
        ?>

        <div class="box-container">
            <?php
            $all_product = $db->query("SELECT * FROM product WHERE id_category = '$id' ORDER BY id DESC");
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
                                <a href="<?= $url ?>/detail.php?id=<?= $item['id'] ?>&tensp=<?= $item['slug'] ?>" class="fas fa-share"></a>
                            </div>
                        </div>
                        <div class="content">
                            <h3><a href="<?= $url ?>/detail.php?id=<?= $item['id'] ?>&tensp=<?= $item['slug'] ?>"><?= $item['slug'] ?></a></h3>
                            <div class="price"><?= number_format($item['price'], 0) ?> <span><?= number_format($item['pricesale'], 0) ?></span></div>
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                <h5>No data product</h5>
            <?php
            }
            ?>


        </div>
    </div>
</div>

<?php include_once("include/footer.php") ?>
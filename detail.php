<?php include_once("include/headerdetail.php") ?>
<?php
    if(isset($_POST['action']) && $_SERVER['REQUEST_METHOD'] =='POST' && $_POST['action'] == 'addtocart'){
        $id_product = $_POST['id_product'];
        $slug = $_POST['slug'];
        $quantity = $_POST['quantity'];
        if(isset($_SESSION['cart'][$id_product])){ 
            $_SESSION['cart'][$id_product]['quantity']++; 
        }else{
            $_SESSION['cart'][$id_product] = array( 
                "quantity" => $quantity, 
            ); 
        }
        
        $loadpage = $url."/detail.php?id=".$id_product."&tensp=".$slug."/true";
        ?>
            <meta http-equiv="refresh" content="0;url=<?= $loadpage ?>?t=1">
        <?php
        if(isset($_GET['t'])){
            ?>
                <meta http-equiv="refresh" content="0;url=<?= $loadpage ?>">
            <?php
        }
    }
    $cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>
    <section class="home" id="home">
        <div class="content">
            <h3>in summer</h3>
            <span>Save more with coupons & up to 70% off</span>
        </div>
    </section>
    <?php
        if(isset($_GET['status']) && $_GET['status'] == 'true'){
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
        $result = $db->query("SELECT * FROM product WHERE id = ".$id);
        $detail = mysqli_fetch_assoc($result);
        if(isset($detail)){
            ?>
                <section class="detail container mt-1">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="<?= $url ?>/assets/image/product/<?= $detail['image'] ?>" width="100%">
                        </div>
                        <div class="col-md-8">
                            <h1 class="product_title">
                                <?= $detail['name'] ?>
                            </h1>
                            <div class="product-price has-discount">
                                <div class="current-price">
                                    <span class="current-price-value" content="299000">
                                         <?= number_format($detail['price']) ?> &nbsp;₫
                                    </span>
                                    <span class="product-discount">
                                        <span class="regular-price"> <?= number_format($detail['pricesale']) ?> &nbsp;₫</span>
                                    </span>
                                </div>
                            </div>
                            <div class="product-short-description">
                                <?= $detail['content'] ?>
                            </div>
                            <form method="POST" class="qty-button">
                                <input type="hidden" value="<?= $id ?>" name="id_product">
                                <input type="hidden" value="<?= $detail['slug'] ?>" name="slug">
                                <input type="hidden" value="addtocart" name="action">
                                <div class="quantity">
                                    <button class="minus" type="button" aria-label="Decrease">&minus;</button>
                                        <input type="number" class="input-box" value="1" min="1" max="20" name="quantity">
                                    <button class="plus" type="button" aria-label="Increase">&plus;</button>
                                </div>
                                <button class="btn-primary">Thêm Vào Giỏ Hàng</button>
                            </form>
                        </div>
                    </div>
                </section>
            <?php
        }
    ?>
<?php include_once("include/footer.php") ?>
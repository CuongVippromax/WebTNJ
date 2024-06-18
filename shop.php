<?php include_once("include/header.php") ?>
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
        header('location:shop.php');
    }

?>
    <section class="home" id="home">
        <div class="content">
            <h3>in summer</h3>
            <span>Save more with coupons & up to 70% off</span>
        </div>
    </section>
    <div class="shop">
        <div class="input">
            <div class="search">
                <form method="GET">
                    <input type="text" name="search" placeholder="Search" value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>">
                </form>
            </div>
            <h2>jewelry <span>classification</span></h2>
            <div class="navbar">
                <?php
                    $category = $db->query("SELECT * FROM category ORDER BY id DESC");
                    if(isset($category)){
                        while ($item = mysqli_fetch_assoc($category)) {
                            ?>
                                <a href="category.php?id=<?= $item['id'] ?>&tensp=<?= $item['slug'] ?>" class="hightlight"><?= $item['name'] ?></a>
                            <?php
                        }
                    }else{
                        ?>
                            <span>No data category</span>
                        <?php
                    }
                ?>
            </div>
        </div>
        <!-- products section starts -->
        <div class="products">
            <h1 class="heading">All <span>products</span></h1>
            <div class="box-container">
                <?php
                    $keyword = isset($_GET['search']) ? $_GET['search'] : '';
                    $all_product = $db->query("SELECT * FROM product WHERE name LIKE '%$keyword%' ORDER BY id DESC");
                    if(isset($all_product)){
                        while ($item = mysqli_fetch_assoc($all_product)) {
                            ?>
                                <div class="box">
                                    <?php
                                        if(isset($item['pricesale'])){
                                            $sale = ((float)$item['pricesale'] - (float)$item['price']) / (float)$item['pricesale'] * 100;
                                            ?>
                                                <span class="discount">-<?= ceil($sale) ?>%</span>
                                            <?php
                                        }
                                    ?>
                                    <div class="image">
                                        <img src="<?= $url ?>/assets/image/product/<?= $item['image'] ?>" alt="">
                                        <div class="icons">
                                            <a href="#" class="fas fa-heart"></a>
                                            <form method="POST">
                                                <input type="hidden" value="<?= $item['id'] ?>" name="id_product">
                                                <input type="hidden" value="<?= $item['slug'] ?>" name="slug">
                                                <input type="hidden" value="1" name="quantity">
                                                <input type="hidden" value="addtocart" name="action">
                                                <button type="submit" class="cart-btn">add to cart</button>
                                            </form>
                                            <a href="#" class="fas fa-share"></a>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <h3><a href="detail/<?= $item['id'] ?>/<?= $item['slug'] ?>"><?= $item['name'] ?></a></h3>
                                        <div class="price"><?= number_format($item['price'],0) ?> <span><?= number_format($item['pricesale'],0) ?></span></div>
                                    </div>
                                </div>
                            <?php
                        }
                    }else{
                        ?>
                            <h5>No data product</h5>
                        <?php
                    }
                ?>
                
                
            </div>
        </div>
    </div>

<?php include_once("include/footer.php") ?>
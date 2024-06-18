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
        ?>
            <meta http-equiv="refresh" content="0;url=<?= $url ?>?t=1">
        <?php
        if(isset($_GET['t'])){
            ?>
                <meta http-equiv="refresh" content="0;url=<?= $url ?>">
            <?php
        }
    }
    $cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>
    <!-- header section end -->
    <!-- home section starts -->
    <section class="home" id="home">
        <div class="content">
            <h3>TNJ Jewelry</h3>
            <span>Durable & beautiful jewelry</span>
            <p> Adorned with exquisite gemstones and crafted with impeccable artistry, these jewels exude timeless
                elegance and refined luxury.</p>
            <p>
                Embrace the epitome of style and sophistication with these captivating pieces of jewelry, where timeless
                elegance meets modern trends.</p>
            <a href="shop.php" class="btn">shop now</a>
        </div>
    </section>
    <!-- home section end -->
    <!-- about section starts -->
    <section class="about" id="about">
        <h1 class="heading"><span> about </span>us</h1>
        <div class="row">
            <div class="video-container">
                <video src="<?= $url ?>/assets/video/vd2.mp4" loop autoplay muted></video>
                <h3>best jewelry sellers</h3>
            </div>
            <div class="content">
                <h3>why choose us?</h3>
                <p>Since its establishment in 2024, TNJ has been offering exquisite jewelry designs that embody timeless
                    elegance and purity for women of all ages. Each meticulously handcrafted piece from TNJ is a perfect
                    blend of classic and contemporary aesthetics, adding a touch of refinement to every woman's unique
                    style.</p>

                <p>
                    With a diverse range of designs to suit every occasion, TNJ is committed to providing customers with
                    high-quality jewelry and exceptional service.Step into the world of TNJ and discover exquisite
                    jewelry that speaks to your style and elevates your
                    presence.</p>

                <a href="#" class="btn">learn more</a>
            </div>
        </div>
    </section>
    <!-- about section ends -->
    <!-- icons section starts -->
    <section class="icons-container">
        <div class="icons">
            <img src="<?= $url ?>/assets/image/ic1.png" alt="">
            <div class="info">
                <h3>free delivery</h3>
                <span>on all order</span>
            </div>
        </div>
        <div class="icons">
            <img src="<?= $url ?>/assets/image/ic2 (1).png" alt="">
            <div class="info">
                <h3>10 days returns</h3>
                <span>moneyback ganatee</span>
            </div>
        </div>
        <div class="icons">
            <img src="<?= $url ?>/assets/image/ic3.png" alt="">
            <div class="info">
                <h3>offer & gifts</h3>
                <span>on all order</span>
            </div>
        </div>
        <div class="icons">
            <img src="<?= $url ?>/assets/image/ic4.png" alt="">
            <div class="info">
                <h3>secure paymens</h3>
                <span>protected by paypal</span>
            </div>
        </div>
    </section>
    <!-- icons section ends -->
    <!-- products section starts -->
    <section class="products" id="products">
        <h1 class="heading">latest <span>products</span></h1>
        <div class="box-container">
        <?php
            $all_product = $db->query("SELECT * FROM product ORDER BY rand() LIMIT 14");
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
                                    <a href="detail.php?id=<?= $item['id'] ?>&tensp=<?= $item['slug'] ?>" class="fas fa-share"></a>
                                </div>
                            </div>
                            <div class="content">
                                <h3><a href="detail.php?id=<?= $item['id'] ?>&tensp=<?= $item['slug'] ?>"><?= $item['slug'] ?></a></h3>
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
    </section>

    <section class="review" id="review">
        <h1 class="heading">customer's <span>review</span></h1>
        <div class="box-container">
            <div class="box">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ipsa natus iste aperiam delectus eum! Velit
                    laborum nostrum libero. Ab voluptatibus harum vero corrupti possimus reiciendis, vitae quia sapiente
                    qui ad?</p>
                <div class="user">
                    <img src="https://png.pngtree.com/thumb_back/fh260/background/20221128/pngtree-outdoorsy-young-woman-sporting-shades-confidently-posing-with-a-juice-bottle-meets-the-camera-gaze-photo-image_42709010.jpg" alt="">
                    <div class="user-info">
                        <h3>John deo</h3>
                        <span>happy customer</span>
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
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ipsa natus iste aperiam delectus eum! Velit
                    laborum nostrum libero. Ab voluptatibus harum vero corrupti possimus reiciendis, vitae quia sapiente
                    qui ad?</p>
                <div class="user">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR2goftFJBbe8xqqJlplYIxPXa2QFsVsLcSPmPM4IJz4AuHVzRdnrFJTSMKGk-b_PR9OS0&usqp=CAU" alt="">
                    <div class="user-info">
                        <h3>John deo</h3>
                        <span>happy customer</span>
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
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ipsa natus iste aperiam delectus eum! Velit
                    laborum nostrum libero. Ab voluptatibus harum vero corrupti possimus reiciendis, vitae quia sapiente
                    qui ad?</p>
                <div class="user">
                    <img src="https://letranlaw.com/wp-content/uploads/2020/02/hannahavatar2.jpg" alt="">
                    <div class="user-info">
                        <h3>John deo</h3>
                        <span>happy customer</span>
                    </div>
                </div>
                <span class="fas fa-quote-right"></span>
            </div>
        </div>
    </section>

    <section class="contact" id="contact">
        <h1 class="heading"> <span>contact</span> us</h1>
        <div class="row">
            <form action="">
                <input type="text" name="name" placeholder="Name" class="box" required>
                <input type="email" name="email" placeholder="Email" class="box" required>
                <input type="number" name="phone" placeholder="Phone" class="box" required>
                <textarea name="" name="content" class="box" placeholder="Message" id="" cols="30" rows="10"></textarea>
                <input type="button" class="contact-form" value="send message" class="btn">
                <p class="success-contact" style="display:none;color: #fff; font-size: 18px;">Send contact us successfully</p>
            </form>
            <div class="image">
                <img src="https://kimcuongdanang.com/wp-content/uploads/2022/07/Gems-Casa-bai-viet-phoi-trang-suc-quan-ao-5.jpg" alt="">
            </div>
        </div>
    </section>

    <!-- contact section ends -->

<?php include_once("include/footer.php") ?>
<script>
    $(document).ready(function(){
        $('.contact-form').click(function(e){
            e.preventDefault();
            var name = $('input[name="name"]').val();
            var email = $('input[name="email"]').val();
            var phone = $('input[name="phone"]').val();
            var content = $('textarea[name="content"]').val();
            var action = 'contact';
            $.ajax({
                type : "POST",
                dataType : "JSON",
                url : "ajax.php",
                data : { action, name, email, phone, content },
                success:function(data){
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
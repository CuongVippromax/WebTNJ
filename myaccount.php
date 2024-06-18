<?php include_once("include/header.php") ?>
<style>
    .scrolls{
        color:#fff
    }
    .shoppingcart-container .shoppingcart {
        padding-bottom: 5%;
        padding-top: 5% !important;
    }
</style>
<section class="home justify-center" id="home">
    <div class="content text-center">
        <h3>Infomation Account</h3>
    </div>
</section>

<section>
    <div class="mx-19">
        <div class="shoppingcart-container" style="justify-content:center">
            <?php
                if(isset($_SESSION['email_session'])){
                    $email = isset($_SESSION['email_session']) ? $_SESSION['email_session'] : '';
                    $result = $db->query("SELECT * FROM user WHERE email = '$email' LIMIT 1");
                    $detail = mysqli_fetch_assoc($result);
                    
                    ?>
                        <div class="shoppingcart mt-0">
                            <div class="scrolls">
                                <h3 style="font-size:2rem;margin-bottom:1rem;color:#fff">INFOMATION</h3>
                                <div class="form-group">
                                    <label for=""><strong>Full name:</strong></label>
                                    <p><?= $detail['name'] ?></p>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <p><?= $detail['email'] ?></p>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="">Phone</label>
                                    <p><?= $detail['phone'] ?></p>
                                </div>
                            </div>
                        </div>
                    <?php
                }else{
                    ?>
                    <div class="mt-0" style="text-align: center;width:100%">
                        <p style="font-size:2rem;color: #fff;">No login</p>
                        </div>
                    <?php
                }
            ?>
        </div>
    </div>
</section>

<?php include_once("include/footer.php") ?>
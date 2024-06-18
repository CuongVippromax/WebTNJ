<?php
    include_once('include/header.php');
    if(isset($_POST['status']) && $_POST['status'] != ''){
        $status = isset($_POST['status']) ? $_POST['status'] : '';
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $result = $db->query("UPDATE orders SET `status` = '$status' WHERE id = '$id'");
        $message = "Update status payment successfully";
    }
?>
<style>
    .page-title-headings{
        color:#fff
    }
    .text-center{
        text-align:center
    }
    table td,
    table th{
        color:#fff;
        border:1px solid #ccc;
        padding:10px;
    }
    table{
        width: 100%;
        margin-top: 1px;
        box-sizing: border-box;
        border-collapse: collapse;
    }
    .list-codeorder li{
        list-style: none;
        font-size:2rem;
        padding-top:5px;
        padding-bottom:5px;
    }
    .list-codeorder li hr{
        border-bottom:1px solid #ccc;
        padding-top:10px;
        padding-bottom:10px;
    }
</style>
<?php
    if(isset($_GET['action']) && $_GET['action'] == 'edit'){
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $sql = $db->query("SELECT * FROM orders WHERE id = '$id'");
        $result = mysqli_fetch_assoc($sql);
        if($result){
            ?>
                <div class="app-page-title mt-1 pl-5">
                    <?php
                        if(isset($message)){
                            ?>
                                <div class="alert alert-<?= $status ?> alert-dismissible">
                                    <?= $message ?>
                                </div>
                            <?php
                        }
                    ?>
                </div>
                <section class="home justify-center" id="home">
                    <div class="content text-center">
                        <h3>Defailt order</h3>
                    </div>
                </section>
                <section>
                    <div class="mx-19">
                        <div class="shoppingcart-containers">
                            <div class="app-page-title mt-1 pl-5">
                                <div class="page-title-wrappers">
                                    <div class="page-title-headings">
                                        <div class="d-flex mb-2 text-center">
                                            <h3 class="text-center" style="font-size:3rem;margin-bottom:1.5rem">Order</h3>
                                        </div>
                                        <div class="">
                                            <ul class="list-codeorder">
                                                <li>
                                                    <b># Code Orders </b>
                                                </li>
                                                <li>
                                                    PO-000<?= $result['id'] ?>
                                                </li>
                                                <li><hr></li>
                                                <li>
                                                    <b>Address </b>
                                                </li>
                                                <li>
                                                    <?= $result['address'] ?>
                                                </li>
                                                <li><hr></li>
                                                <li>
                                                    <b>Payment </b>
                                                </li>
                                                <li>
                                                    <?php
                                                        $sql = $db->query("SELECT * FROM pttt WHERE id = '".$result['payment']."'");
                                                        $payment = mysqli_fetch_assoc($sql);
                                                        print $payment['title'];
                                                    ?>
                                                </li>
                                                <li><hr></li>
                                                <li>
                                                    <b>Status </b>
                                                </li>
                                                <li>
                                                    <?php
                                                        if($result['status'] == 0){
                                                            print 'Đang xác thực';
                                                        }else if($result['status'] == 1){
                                                            print 'Đang chờ vận chuyển';
                                                        }else if($result['status'] == 2){
                                                            print 'Đang vận chuyển';
                                                        }else if($result['status'] == 3){
                                                            print 'Đã hoàn thành';
                                                        }
                                                    ?>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="products">
                                            <h3 class="text-left" style="font-size:3rem;margin-bottom:1.5rem;margin-top:1.5rem">Product</h3>
                                            <table class="table table-striped table-bordered dataTable">
                                                <thead>
                                                    <tr role="row">
                                                        <th>#</th>
                                                        <th>Image</th>
                                                        <th>Name</th>
                                                        <th>Price</th>
                                                        <th>Quantity</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $product = json_decode($result['json'],true);
                                                        $i = 0;
                                                        $total_all = 0;
                                                        foreach ($product as $id_pro => $products) {
                                                            $get_product = mysqli_fetch_assoc($db->query("SELECT * FROM product WHERE id = ".$id_pro));
                                                            $i++;
                                                            ?>
                                                                <tr>
                                                                    <td><?= $i ?></td>
                                                                    <td>
                                                                        <img src="<?= $url ?>/assets/image/product/<?= $get_product['image'] ?>" width="100">
                                                                    </td>
                                                                    <td><?= $get_product['name'] ?></td>
                                                                    <td><?= number_format($get_product['price']) ?></td>
                                                                    <td><?= $products['quantity'] ?></td>
                                                                    <td><?= number_format($get_product['price'] * $products['quantity']) ?></td>
                                                                </tr>
                                                            <?php
                                                            $total_all += $get_product['price'] * $products['quantity'];
                                                        }
                                                    ?>
                                                    <tr>
                                                        <td colspan="6"><h3>ORDER VALUE</h3></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">Tổng số lượng</td>
                                                        <td colspan="4"><?= $i ?> sản phẩm</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2"><span class="text-danger">Tổng đơn hàng</span></td>
                                                        <td colspan="4"><span class="text-danger"><?= number_format($total_all) ?></td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            <?php
        }
        
    }else{
        ?>
        <section class="home justify-center" id="home">
            <div class="content text-center">
                <h3>View Order</h3>
            </div>
        </section>
        <section>
            <div class="mx-19">
                <div class="shoppingcart-containers">
                    <div class="app-page-title mt-1 pl-5">
                        <?php
                            if(isset($message)){
                                ?>
                                    <div class="alert alert-<?= $status ?> alert-dismissible">
                                        <?= $message ?>
                                    </div>
                                <?php
                            }
                        ?>
                        <div class="page-title-wrappers">
                            <div class="page-title-headings">
                                <div class="d-flex mb-2 text-center">
                                    <h3 class="text-center" style="font-size:3rem;margin-bottom:1.5rem">Order</h3>
                                </div>
                                <table class="table table-striped table-bordered dataTable">
                                    <thead>
                                        <tr role="row">
                                            <th>#</th>
                                            <th>Full name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Payment</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sql = $db->query("SELECT * FROM orders");
                                            while ($result = mysqli_fetch_assoc($sql)) {
                                                ?>
                                                    <tr role="row" class="odd">
                                                        <td class=""><?= $result['id'] ?></td>
                                                        <td><?= $result['fullname'] ?></td>
                                                        <td><?= $result['email'] ?></td>
                                                        <td><?= $result['phone'] ?></td>
                                                        <td><?= $result['address'] ?></td>
                                                        <td>
                                                            <?php
                                                                $sql = $db->query("SELECT * FROM pttt WHERE id = '".$result['payment']."'");
                                                                $payment = mysqli_fetch_assoc($sql);
                                                                print $payment['title'];
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                if($result['status'] == 0){
                                                                    print 'Đang xác thực';
                                                                }else if($result['status'] == 1){
                                                                    print 'Đang chờ vận chuyển';
                                                                }else if($result['status'] == 2){
                                                                    print 'Đang vận chuyển';
                                                                }else if($result['status'] == 3){
                                                                    print 'Đã hoàn thành';
                                                                }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-sm btn-primary" href="<?= $url ?>/order.php?action=edit&id=<?= $result['id'] ?>">Chi tiết</a>
                                                        </td>
                                                    </tr>  
                                                <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
?>

<?php
    include_once('include/footer.php')
?>
<?php
    include_once('include/header.php');
    if(isset($_POST['action']) && $_POST['action'] == 'add'){
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $slug = isset($_POST['name']) ? $connect->str_slug(($_POST['name'])) : '';
        $price = isset($_POST['price']) ? $_POST['price'] : '';
        $pricesale = isset($_POST['pricesale']) ? $_POST['pricesale'] : '';
        $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : '';
        $id_category = isset($_POST['id_category']) ? $_POST['id_category'] : '';
        $content = isset($_POST['content']) ? $_POST['content'] : '';
        $imagename = '';
        if(isset($_FILES['image'])){
            $image = $_FILES['image']['name']; 
            $expimage = explode('.',$image);
            $imageexptype = $expimage[1];
            $date = date('m/d/Yh:i:sa', time());
            $rand = rand(10000,99999);
            $encname = $date.$rand;
            $imagename = md5($encname).'.'.$imageexptype;
            $imagepath = "../assets/image/product/".$imagename;
            move_uploaded_file($_FILES["image"]["tmp_name"],$imagepath);
        }
        $result = $db->query("INSERT INTO `product`(`id_category`, `name`, `slug`, `price`, `pricesale`, `content`, `image`, `quantity`) 
        VALUES ('$id_category','$name','$slug','$price','$pricesale','$content','$imagename','$quantity')");
        $message = "Add category successfully";
        $status = 'success';
    }

    if(isset($_POST['action']) && $_POST['action'] == 'update'){
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $slug = isset($_POST['name']) ? $connect->str_slug(($_POST['name'])) : '';
        $price = isset($_POST['price']) ? $_POST['price'] : '';
        $pricesale = isset($_POST['pricesale']) ? $_POST['pricesale'] : '';
        $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : '';
        $id_category = isset($_POST['id_category']) ? $_POST['id_category'] : '';
        $content = isset($_POST['content']) ? $_POST['content'] : '';
        $imagename = '';
        if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != ''){
            $image = $_FILES['image']['name']; 
            $expimage = explode('.',$image);
            $imageexptype = $expimage[1];
            $date = date('m/d/Yh:i:sa', time());
            $rand = rand(10000,99999);
            $encname = $date.$rand;
            $imagename = md5($encname).'.'.$imageexptype;
            $imagepath = "../assets/image/product/".$imagename;
            move_uploaded_file($_FILES["image"]["tmp_name"],$imagepath);
        }
        if($imagename == ''){
            $result = $db->query("UPDATE `product` SET `id_category`='$id_category',
            `name`='$name',`slug`='$slug',`price`='$price',`pricesale`='$pricesale',`content`='$content',`quantity`='$quantity' WHERE id = '$id'");
        }else{
            $result = $db->query("UPDATE `product` SET `id_category`='$id_category',
            `name`='$name',`slug`='$slug',`price`='$price',`pricesale`='$pricesale',`content`='$content',`quantity`='$quantity',
            ,`image`='$imagename' WHERE id = '$id'");
        }
        
        $message = "Updated product successfully";
        $status = 'success';
    }

    if(isset($_GET['action']) && $_GET['action'] == 'edit'){
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $result = $db->query("SELECT * FROM product WHERE `id` = '$id'LIMIT 1");
        $product = mysqli_fetch_assoc($result);
    }

    
    if(isset($_GET['action']) && $_GET['action'] == 'delete'){
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $result = $db->query("DELETE FROM product WHERE id = '$id'");
        $message = "Delete product successfully";
        $status = 'success';
    }
?>

<?php
    if(isset($_GET['action']) && $_GET['action'] == 'add' || isset($_GET['action']) && $_GET['action'] == 'edit'){
        if($_GET['action'] == 'add'){
            $title = 'Add';
        }else{
            $title = 'Update';
        }
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
                <div class="page-title-wrappers">
                    <div class="page-title-headings">
                        <div class="d-flex mb-2">
                            <h3>
                                <?= $title ?> Product</h3>
                        </div>
                        <form method="POST" enctype="multipart/form-data">
                            <div class="mb-4">
                                <label for="Fullname" class="form-label">Name</label>
                                <input type="text" name="name" value="<?= isset($_POST['name']) ? $_POST['name'] : (isset($product) ? $product['name'] : '') ?>" class="form-control" required/>
                            </div>
                            <div class="mb-4">
                                <label for="Fullname" class="form-label">Price</label>
                                <input type="number" name="price" value="<?= isset($_POST['price']) ? $_POST['price'] : (isset($product) ? $product['price'] : '') ?>" class="form-control" required/>
                            </div>
                            <div class="mb-4">
                                <label for="Fullname" class="form-label">Price Sale</label>
                                <input type="number" name="pricesale" value="<?= isset($_POST['pricesale']) ? $_POST['pricesale'] : (isset($product) ? $product['pricesale'] : '') ?>" class="form-control"/>
                            </div>
                            <div class="mb-4">
                                <label for="Fullname" class="form-label">Quantity</label>
                                <input type="number" name="quantity" value="<?= isset($_POST['quantity']) ? $_POST['quantity'] : (isset($product) ? $product['quantity'] : '') ?>" class="form-control"/>
                            </div>
                            <div class="mb-4">
                                <label for="Fullname" class="form-label">Category</label>
                                <select name="id_category" class="form-control">
                                    <?php
                                        $category = $db->query("SELECT * FROM category ORDER BY id DESC");
                                        if(isset($category)){
                                            while ($item = mysqli_fetch_assoc($category)) {
                                                ?>
                                                    <option value="<?= $item['id'] ?>"
                                                    <?php
                                                        if(isset($product)){
                                                            if($product['id_category'] == $item['id']){
                                                                print ' selected ';
                                                            }
                                                        }
                                                    ?>
                                                    ><?= $item['name'] ?></option>
                                                <?php       
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="Fullname" class="form-label">Content</label>
                                <textarea name="content" class="form-control ckeditor"><?= isset($product) ? $product['content'] : '' ?></textarea>
                            </div>
                            <?php
                                if($_GET['action'] == 'add'){
                                    ?>
                                        <input type="hidden" name="action" value="add">
                                    <?php
                                }else{
                                    ?>
                                        <input type="hidden" name="action" value="update">
                                        <input type="hidden" name="id" value="<?= isset($product) ? $product['id'] : '' ?>">
                                    <?php
                                }
                            ?>
                            <div class="mb-4">
                                <label for="Fullname" class="form-label">Image</label>
                                <?php
                                    if($_GET['action'] == 'add'){
                                        ?>
                                             <input type="file" name="image" class="form-control" required/>
                                        <?php
                                    }else{
                                        ?>
                                            <input type="file" name="image" class="form-control"/>
                                        <?php
                                    }
                                ?>
                               
                                <?php
                                    if(isset($product)){
                                        ?>
                                            <img width="150" class="mt-2" src="<?= $url."/assets/image/product/".$product['image'] ?>">
                                        <?php
                                    }
                                ?>
                            </div>
                            <button class="btn btn-primary" type="submit">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php
    }else{
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
                <div class="page-title-wrappers">
                    <div class="page-title-headings">
                        <div class="d-flex mb-2">
                            <h3>Product</h3>
                            <a href="<?= $url ?>/admin/product.php?action=add" class="ml-3 d-flex align-items-center btn btn-primary">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                            </a>
                        </div>
                        <table class="table table-striped table-bordered dataTable">
                            <thead>
                                <tr role="row">
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Price Sale</th>
                                    <th>Quantity</th>
                                    <th>Stock</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sql = $db->query("SELECT * FROM product");
                                    while ($result = mysqli_fetch_assoc($sql)) {
                                        ?>
                                            <tr role="row" class="odd">
                                                <td class=""><?= $result['id'] ?></td>
                                                <td><img width="50" src="<?= $url."/assets/image/product/".$result['image'] ?>"></td>
                                                <td><?= $result['name'] ?></td>
                                                <td><?= $result['price'] ?></td>
                                                <td><?= $result['pricesale'] ?></td>
                                                <td><?= $result['quantity'] ?></td>
                                                <td><?= $result['quantity_old'] ?></td>
                                                <td>
                                                    <a class="btn btn-sm btn-primary" href="<?= $url ?>/admin/product.php?action=edit&id=<?= $result['id'] ?>">Chỉnh sửa</a>
                                                    <a class="btn btn-sm btn-danger" href="?action=delete&id=<?= $result['id'] ?>">Xóa</a>
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
        <?php
    }
?>


<?php
    include_once('include/footer.php')
?>
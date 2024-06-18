<?php
    include_once('include/header.php');
    if(isset($_POST['action']) && $_POST['action'] == 'add'){
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $slug = isset($_POST['name']) ? $connect->str_slug(($_POST['name'])) : '';
        $check_category = $db->query("SELECT * FROM category WHERE `name` = '$name' LIMIT 1");
        if($check_category->num_rows <= 0){
            $result = $db->query("INSERT INTO `category`(`name`, `slug`) 
            VALUES ('$name','$slug')");
        }
        
        $message = "Add category successfully";
        $status = 'success';
    }

    if(isset($_POST['action']) && $_POST['action'] == 'update'){
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        $slug = isset($_POST['name']) ? $connect->str_slug(($_POST['name'])) : '';
        $result = $db->query("UPDATE `category` SET `name` = '$name',`slug`= '$slug' WHERE id = '$id'");
        $message = "Updated category successfully";
        $status = 'success';
    }

    if(isset($_GET['action']) && $_GET['action'] == 'edit'){
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $result = $db->query("SELECT * FROM category WHERE `id` = '$id'LIMIT 1");
        $category = mysqli_fetch_assoc($result);
    }

    if(isset($_GET['action']) && $_GET['action'] == 'delete'){
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $result = $db->query("DELETE FROM category WHERE id = '$id'");
        $message = "Delete category successfully";
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
                                <?= $title ?> Category</h3>
                        </div>
                        <form method="POST">
                            <div class="mb-4">
                                <label for="Fullname" class="form-label">Title</label>
                                <input type="text" name="name" value="<?= isset($_POST['name']) ? $_POST['name'] : (isset($category) ? $category['name'] : '') ?>" class="form-control" required id="Fullname" />
                            </div>
                            <?php
                                if($_GET['action'] == 'add'){
                                    ?>
                                        <input type="hidden" name="action" value="add">
                                    <?php
                                }else{
                                    ?>
                                        <input type="hidden" name="action" value="update">
                                        <input type="hidden" name="id" value="<?= isset($category) ? $category['id'] : '' ?>">
                                    <?php
                                }
                            ?>
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
                            <h3>Category</h3>
                            <a href="<?= $url ?>/admin/category.php?action=add" class="ml-3 d-flex align-items-center btn btn-primary">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                            </a>
                        </div>
                        <table class="table table-striped table-bordered dataTable">
                            <thead>
                                <tr role="row">
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Created Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sql = $db->query("SELECT * FROM category");
                                    while ($result = mysqli_fetch_assoc($sql)) {
                                        ?>
                                            <tr role="row" class="odd">
                                                <td class=""><?= $result['id'] ?></td>
                                                <td><?= $result['name'] ?></td>
                                                <td><?= date('d/m/Y',strtotime($result['created_at'])) ?></td>
                                                <td>
                                                    <a class="btn btn-sm btn-primary" href="<?= $url ?>/admin/category.php?action=edit&id=<?= $result['id'] ?>">Chỉnh sửa</a>
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
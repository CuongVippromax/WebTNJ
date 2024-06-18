








<?php
    include_once('include/header.php');
    if(isset($_POST['action']) && $_POST['action'] == 'add'){
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $passhash = md5($password);
        $type = isset($_POST['type']) ? $_POST['type'] : '';
        $status = isset($_POST['status']) ? $_POST['status'] : '';
        $check_login = $db->query("SELECT * FROM user WHERE `email` = '$email' AND type = 1 LIMIT 1");
        if($check_login->num_rows > 0){
            $message = "Email already exists!";
            $status = 'danger';
        }else{
            $result = $db->query("INSERT INTO `user`(`name`, `email`, `password`, `type`, `status`) 
            VALUES ('$name','$email','$passhash', '$type', '$status')");
            $message = "Register account successfully";
            $status = 'success';
        }
    }

    if(isset($_POST['action']) && $_POST['action'] == 'update'){
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        $type = isset($_POST['type']) ? $_POST['type'] : '';
        $status = isset($_POST['status']) ? $_POST['status'] : '';
        $result = $db->query("UPDATE `user` SET `name`='$name',`email`='$email',`status`='$status',`type`='$type' WHERE id = ".$id);
        $message = "Updated account successfully";
        $status = 'success';
    }
    
    if(isset($_GET['action']) && $_GET['action'] == 'edit'){
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $result = $db->query("SELECT * FROM user WHERE `id` = '$id'LIMIT 1");
        $user = mysqli_fetch_assoc($result);
    }

    
    if(isset($_GET['action']) && $_GET['action'] == 'delete'){
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $result = $db->query("DELETE FROM user WHERE id = '$id'");
        $message = "Delete account successfully";
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
                                <?= $title ?> User</h3>
                        </div>
                        <form method="POST">
                            <div class="mb-4">
                                <label for="Fullname" class="form-label">Fullname</label>
                                <input type="text" name="name" value="<?= isset($_POST['name']) ? $_POST['name'] : (isset($user) ? $user['name'] : '') ?>" class="form-control" required id="Fullname" />
                            </div>
                            <div class="mb-4">
                                <label for="Email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" required id="Email" value="<?= isset($_POST['email']) ? $_POST['email'] : (isset($user) ? $user['email'] : '') ?>"/>
                            </div>
                            <?php
                                if($_GET['action'] == 'add'){
                                    ?>
                                        <input type="hidden" name="action" value="add">
                                        <div class="mb-4">
                                            <label for="Password" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" required id="Password" value="<?= isset($_POST['password']) ? $_POST['password'] : '' ?>"/>
                                        </div>
                                    <?php
                                }else{
                                    ?>
                                        <input type="hidden" name="action" value="update">
                                        <input type="hidden" name="id" value="<?= isset($user) ? $user['id'] : '' ?>">
                                    <?php
                                }
                            ?>
                            <div class="mb-4">
                                <label for="Password" class="form-label">Role</label>
                                <select name="type" class="form-control">
                                    <option value="1" <?= (isset($user) ? (($user['type'] == 1) ? 'selected' : '') : '') ?>>Client</option>
                                    <option value="0" <?= (isset($user) ? (($user['type'] == 0) ? 'selected' : '') : '') ?>>Admin</option> 
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="Password" class="form-label">Status</label>
                                <select name="status" class="form-control">
                                    <option value="0" <?= (isset($user) ? (($user['status'] == 0) ? 'selected' : '') : '') ?>>Active</option>
                                    <option value="1" <?= (isset($user) ? (($user['status'] == 1) ? 'selected' : '') : '') ?>>No Active</option> 
                                </select>
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
                            <h3>User</h3>
                            <a href="<?= $url ?>/admin/user.php?action=add" class="ml-3 d-flex align-items-center btn btn-primary">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                            </a>
                        </div>
                        <table class="table table-striped table-bordered dataTable">
                            <thead>
                                <tr role="row">
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sql = $db->query("SELECT * FROM user");
                                    while ($result = mysqli_fetch_assoc($sql)) {
                                        ?>
                                            <tr role="row" class="odd">
                                                <td class=""><?= $result['id'] ?></td>
                                                <td><?= $result['name'] ?></td>
                                                <td><?= $result['email'] ?></td>
                                                <td>
                                                    <?php
                                                        if($result['type'] == 0){
                                                            print 'Admin';
                                                        }else{
                                                            print 'Client';
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                <?php
                                                    if($result['status'] == 0){
                                                        print 'Đang hoạt động';
                                                    }else{
                                                        print 'Ngừng hoạt động';
                                                    }
                                                ?>
                                                </td>
                                                <td>
                                                    <a class="btn btn-sm btn-primary" href="<?= $url ?>/admin/user.php?action=edit&id=<?= $result['id'] ?>">Chỉnh sửa</a>
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
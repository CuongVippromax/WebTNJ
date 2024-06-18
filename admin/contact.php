<?php
    include_once('include/header.php');
?>


<div class="app-page-title mt-1 pl-5">
    <div class="page-title-wrappers">
        <div class="page-title-headings">
            <div class="d-flex mb-2">
                <h3>Contact</h3>
            </div>
            <table class="table table-striped table-bordered dataTable">
                <thead>
                    <tr role="row">
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Content</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = $db->query("SELECT * FROM contact");
                        while ($result = mysqli_fetch_assoc($sql)) {
                            ?>
                                <tr role="row" class="odd">
                                    <td class=""><?= $result['id'] ?></td>
                                    <td><?= $result['name'] ?></td>
                                    <td><?= $result['email'] ?></td>
                                    <td><?= $result['phone'] ?></td>
                                    <td><?= $result['content'] ?></td>
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
    include_once('include/footer.php')
?>
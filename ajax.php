<?php
    include_once("DB/mysqli.php");
    $connect = new Connect();
    $db = $connect->sql();

    if(isset($_POST['action']) && $_POST['action'] == 'register'){
        $name = isset($_POST['txt']) ? $_POST['txt'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $phone = isset($_POST['broj']) ? $_POST['broj'] : '';
        $password = isset($_POST['pswd']) ? md5($_POST['pswd']) : '';
        $check = $db->query("SELECT * FROM user WHERE email = '$email' LIMIT 1");
        if($check->num_rows <= 0){
            $result = $db->query("INSERT INTO `user`(`name`, `email`, `phone`, `password`) VALUES ('$name','$email','$phone','$password')");
            echo json_encode(true);
            exit;
        } 
    }

    if(isset($_POST['action']) && $_POST['action'] == 'contact'){
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        $content = isset($_POST['content']) ? md5($_POST['content']) : '';
        $result = $db->query("INSERT INTO `contact`(`name`, `email`, `phone`, `content`) VALUES ('$name','$email','$phone','$content')");
        echo json_encode(true);
        exit;
    }
?>
<?php
session_start();
session_unset();
// không kiểm tra dữ liệu khi đăng nhập rất nguy hiểm

if(!empty($_POST)){
    $user_name = $_POST['user_name'];
          $pwd = $_POST['pwd'];
    $error = false;
    if($user_name == 'admin' && $pwd =='1'){
        $_SESSION['user_name'] = $user_name;
        header('Location: index.php');
    }else
    {
        $error = true;
    }
}
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="js/kickstart.js"></script> <!-- KICKSTART -->
<link rel="stylesheet" href="css/kickstart.css" media="all" /> <!-- KICKSTART --> 
</head>
<body>
<form style="width: 20%;margin: auto;" class="vertical" action="" method="post">
<fieldset>
    <legend>Đăng Nhập</legend>
    <div class="notice error <?php if($error){echo 'show';}else{echo 'hide';} ?>">
        <i class="fa fa-remove fa-large"></i>
        Sai tài khoản, mật khẩu
    </div>
        <label for="user_name">Tài khoản:</label>
            <input type="text" name="user_name" id="user_name" />
        <label for="pwd">Mật khẩu:</label>
            <input type="password" name="pwd" id="pwd" />
            <button class="blue" tyle="submit">Đăng Nhập</button>
</fieldset>

   </form>
</body>
</html>
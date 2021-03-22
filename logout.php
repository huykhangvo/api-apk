<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Xuất</title>
</head>
<body>
    <?php
        session_start();
        session_unset();
        session_destroy();
        echo '<center>Đăng Xuất Thành Công - Đang chuyển đến trang đăng nhập...</center>';
        header("Refresh:2; url=login.php");
    ?>
</body>
</html>
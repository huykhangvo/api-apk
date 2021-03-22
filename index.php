<?php 
    session_start();
    include 'func.php';

    if(empty($_SESSION['user_name'])){
        echo '<center>Bạn chưa đăng nhập - Đá về trang đăng nhập!!!</center>';
        header("Refresh:1; url=login.php");
        return;
    }

    $current_page = 0;

    if(!empty($_GET['page'])){
        $current_page = $_GET['page'];
    }

    $posts = get_posts($current_page);
    $total_pages = get_total_page();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web tin tức</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="js/kickstart.js"></script> <!-- KICKSTART -->
<link rel="stylesheet" href="css/kickstart.css" media="all" /> <!-- KICKSTART -->  

</head>
<body>
<div>
    <div>
        <a style="float: left" class="button blue small" href="detail.php"><i class="fa fa-plus"></i>New post</a>
        <a style="float: right" class="button red small" href="logout.php">Logout</a>
    </div>
    <br/>
        <br/>
    <table class="sortable">
       <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Action</th>
            </tr>
       </thead>
       <body>
       <?php
    if(!empty($posts)):
        for($i = 0; $i < count($posts);++$i):
       ?>
            <tr>
                <td><?php echo $posts[$i]['post_id']; ?></td>
                <td><?php echo $posts[$i]['post_title']; ?></td>
                <td>
                    <a href="delete.php?id=<?php echo $posts[$i]['post_id']; ?>&page=<?php echo $current_page;?>" onclick="return confirm('Bạn có chắc chắn hay không!!!')" class="button red small">Delete</a>
                    <a href="edit.php?id=<?php echo $posts[$i]['post_id']; ?>" class="button blue small">Edit</a>
                </td>
            </tr>
        <?php 
        endfor;
    else: ?>
                <tr>
                    <td class="center" colspan="3">Không có dữ liệu</td>
                </tr>
<?php endif; ?>

       </body>
    </table>
<form method="get" action="">
Trang:<input style="width:45px" type="number" id="page" name="page" value="<?php echo $current_page; ?>" /> / <?php echo $total_pages; ?><button class="blue small" type="submit">Go</button>
</form>
</div>


</body>
</html>
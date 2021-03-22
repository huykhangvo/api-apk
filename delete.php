<?php
include 'func.php';
$post_id = 0;
$page = 0;

if(!empty($_GET['id'])){
    $post_id = $_GET['id'];
}

if(!empty($_GET['page'])){
    $page = $_GET['page'];
}

$r = delete_post($post_id);
if($r==true){
    echo '<center> Xóa bài viết thành công </center>';
}else{
    echo '<center> Xóa bài viết không thành công </center>';
}
header('Refresh: 1; url=index.php?page=' .$page);



















?>

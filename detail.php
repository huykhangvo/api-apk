<?php
    session_start();
    include 'func.php';

    if(empty($_SESSION['user_name'])){
        echo '<center>Bạn chưa đăng nhập - Đá về trang đăng nhập!!!</center>';
        header("Refresh:1; url=login.php");
        return;
    }

    if(!empty($_POST)){
        $post_title = $_POST['post_title'];
        $post_desc = $_POST['post_desc'];
        $post_thumb = $_POST['post_thumb'];
        $category_id = $_POST['category_id']; //Khỏi check
        $post_content = $_POST['post_content'];

        //check lại lưu trạng thái
        $is_ok = true;
        //check dữ liệu
        $errors = array();

        if(empty($post_title)){
            $errors['post_title'] = 'Tiêu đề không được bỏ trống';
            $is_ok = false;
        }   

        if(empty($post_desc)){
            $errors['post_desc'] = 'Mô tả không được bỏ trống';
            $is_ok = false;
        } 

        if(empty($post_thumb)){
            $errors['post_thumb'] = 'Hình ảnh không được bỏ trống';
            $is_ok = false;
        }  

        if(empty($post_content)){
            $errors['post_content'] = 'Nội dung không được bỏ trống';
            $is_ok = false;
        } 

        if(!empty($post_content) && strlen($post_content) < 200){
            $errors['post_content'] = 'Nội dung của bạn quá ngắn';
            $is_ok = false;
        } 

        if($is_ok){
            $r = save_post($post_title,$post_desc,$post_thumb,$post_content,$category_id);  //kt đk thêm thành công
          
            //xóa dữ liệu
            unset($post_title);
            unset($post_desc);
            unset($post_thumb);
            unset($category_id);
            unset($post_content);
        }

    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Bài</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="js/kickstart.js"></script> <!-- KICKSTART -->
<link rel="stylesheet" href="css/kickstart.css" media="all" /> <!-- KICKSTART -->  
<script src="//cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>
</head>
<body>
    <form style="width: 50%;margin: auto;" action="" method="post" class="vertical">
        <fieldset>
        <a href="index.php" class="button blue small">Trang chủ</a>
            <legend>Bài Viết</legend>
<div class="<?php if($r){echo 'notice success show';}else{echo 'notice success hide';} ?>">
    Thêm mới bài viết thành công !!!
</div>


            <label for="post_title">Tiêu đề:<span style="color:red;" class="right"><?php if(!empty($errors['post_title'])){ echo $errors['post_title'];} ?></span></label>
            <input class="<?php if(!empty($errors['post_title'])){ echo 'error';}  ?>" type="text" name="post_title" id="post_title" value="<?php if($post_title){echo $post_title; } ?>"/>

            <label class="<?php if(!empty($errors['post_desc'])){ echo 'error';}  ?>" for="post_desc">Mô tả:<span style="color:red;" class="right"><?php if(!empty($errors['post_desc'])){ echo $errors['post_desc'];} ?></span></label>
            <textarea name="post_desc" id="post_desc"/><?php if($post_desc){echo $post_desc; } ?></textarea>

            <label for="post_thumb">Ảnh:<span style="color:red;" class="right"><?php if(!empty($errors['post_thumb'])){ echo $errors['post_thumb'];} ?></span></label>
            <input value="<?php if($post_thumb){echo $post_thumb; } ?>" class="<?php if(!empty($errors['post_thumb'])){ echo 'error';}  ?>" type="text" name="post_thumb" id="post_thumb" />

            <label for="category_id">Chuyên mục:</label>
            <select name="category_id" id="category_id"/>
                <option <?php if(empty($category_id) || $category_id == 1){echo "selected";} ?> value="1">Thời sự</option>
                <option <?php if(!empty($category_id) && $category_id == 2){echo "selected";} ?> value="2">Thể thao</option>
                <option <?php if(!empty($category_id) && $category_id == 3){echo "selected";} ?> value="3">Kinh tế</option>
                <option <?php if(!empty($category_id) && $category_id == 4){echo "selected";} ?> value="4">Chính trị</option>
            </select>

            <label class="<?php if(!empty($errors['post_content'])){ echo 'error';}  ?>" for="post_content">Nội dung:<span style="color:red;" class="right"><?php if(!empty($errors['post_content'])){ echo $errors['post_content'];} ?></span></label>
            <textarea name="post_content" id="post_content"/><?php if($post_content){echo $post_content; } ?></textarea>
            <script>
                CKEDITOR.replace('post_content');
            </script>

            <button class="button blue small" type="submit">Lưu</button>

        </fieldset>
    </form>


</body>
</html>
<?php require './lib/Medoo.php'; 
use Medoo\Medoo; 

  $database = new Medoo([
    'database_type' => 'mysql',
    'database_name' => 'tintuc2',
    'server' => 'localhost',
    'username' => 'root',
    'password' => 'mysql',
    'charset' => 'utf8'
]);
//Hiển Thị
function get_posts($page = 0){
  global $database;

  $total_post_in_page = 10;

  $posts = $database->select('post','*',[
    	"ORDER" => ["post.post_id" => "DESC"],	"LIMIT" => [$page * $total_post_in_page , $total_post_in_page]
    
  ]);

  //var_dump($posts);
  return $posts;
}
//Phân trang
function get_total_page() {
  global $database;

  $total_post_in_page = 10;

  $count = $database->count('post');

  $total_page = $count / $total_post_in_page;

  return floor($total_page);
}
//Xóa
function delete_post($post_id) {
  global $database;

  $r = $database->delete('post',[
    'post_id' => $post_id

  ]);

  return $r; //true

}
//Lưu
function save_post($post_title,$post_desc,$post_thumb,$post_content,$category_id){
  global $database;

  $r = $database->insert('post',[
    'post_title' => $post_title,
    'post_desc' => $post_desc,
    'post_thumb' => $post_thumb,
    'post_content' => $post_content,
    'category_id' => $category_id
  ]);

  return $r;
   //true tô đỏ lỗi theme visual code nó đã đúng không phải sai
}
//Lấy dữ liệu ra
function get_post_by_id($post_id){
  global $database;
  //Biến hứng dữ liệu $post

  $post = $database->get('post','*',[// '*' lấy hết dữ liệu
    'post_id' => $post_id
  ]);
  
  return $post;
}

function update_post($post_id,$post_title,$post_desc,$post_thumb,$post_content,$category_id){
  global $database;

  $r = $database->update('post',[ //Dữ liệu cần update
    'post_title' => $post_title,
    'post_desc' => $post_desc,
    'post_thumb' => $post_thumb,
    'post_content' => $post_content,
    'category_id' => $category_id
  ],[
    'post_id' => $post_id
  ]);

  return $r;

}

// phân trang trên apk
function get_post_by_category_id($category_id,$offset,$limit){
      global $database;

      $posts = $database->select('post', [
        'post_id','post_title','post_desc','post_thumb','post_content','category_id'
      ],[
        'category_id' => $category_id, "ORDER" => ["post.post_id" => "DESC"],	"LIMIT" => [$offset,$limit]
      ]);

      return $posts;
}
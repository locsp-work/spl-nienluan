<?php $open="category"; ?>
<?php
  require_once __DIR__. "/../../autoload/autoload.php";
  $id = intval(getInput('id'));
  $del_data=$db->fetchID("category",$id);
  if (empty($del_data)) {
    $_SESSION['error']="Dữ liệu không tồn tại";
    redirectAdmin("category");
  }
//Kiểm tra danh mục có sản phẩm không??
  $contain=$db->fetchOne("product"," category_id= $id ");
  if($contain == NULL){
    $num=$db->delete("category",$id);
    if ($num > 0) {
      $_SESSION["success"]="Dữ liệu đã được xóa!";
      redirectAdmin("category");
    }
    else{
      $_SESSION["error"]="Dữ liệu xóa không thành công";
      redirectAdmin("category");
    }
  }
  else{
    $_SESSION["error"]="Tồn tại sản phẩm trong danh mục! Không thể xóa";
    redirectAdmin("category");
  }
?>

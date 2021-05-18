<?php $open="product"; ?>
<?php
  require_once __DIR__. "/../../autoload/autoload.php";
  $id = intval(getInput('id'));
  $del_data=$db->fetchID("product",$id);
  if (empty($del_data)) {
    $_SESSION['error']="Sản phẩm không tồn tại";
    redirectAdmin("product");
  }
  $num=$db->delete("product",$id);
  if ($num > 0) {
    $_SESSION["success"]="Sản phẩm đã được xóa!";
    redirectAdmin("product");
  }
  else{
    $_SESSION["error"]="Sản phẩm xóa không thành công";
    redirectAdmin("product");
  }
?>

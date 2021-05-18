<?php $open="admin"; ?>
<?php
  require_once __DIR__. "/../../autoload/autoload.php";
  $id = intval(getInput('id'));
  $del_data=$db->fetchID("admin",$id);
  if (empty($del_data)) {
    $_SESSION['error']="Tài khoản không tồn tại";
    redirectAdmin("admin");
  }
  $num=$db->delete("admin",$id);
  if ($num > 0) {
    $_SESSION["success"]="Tài khoản đã được xóa!";
    redirectAdmin("admin");
  }
  else{
    $_SESSION["error"]="Tài khoản  xóa không thành công";
    redirectAdmin("admin");
  }
?>

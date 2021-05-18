<?php $open="user"; ?>
<?php
  require_once __DIR__. "/../../autoload/autoload.php";
  $id = intval(getInput('id'));
  $del_data=$db->fetchID("user",$id);
  if (empty($del_data)) {
    $_SESSION['error']="Tài khoản không tồn tại";
    redirectAdmin("user");
  }
  $num=$db->delete("user",$id);
  if ($num > 0) {
    $_SESSION["success"]="Tài khoản đã được xóa!";
    redirectAdmin("user");
  }
  else{
    $_SESSION["error"]="Tài khoản  xóa không thành công";
    redirectAdmin("user");
  }
?>

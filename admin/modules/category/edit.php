<?php $open="category"; ?>
<?php
  require_once __DIR__. "/../../autoload/autoload.php";
  $id = intval(getInput('id'));
  $edit_category=$db->fetchID("category",$id);
  if (empty($edit_category)) {
    $_SESSION="Dữ liệu không tồn tại";
    redirectAdmin("category");
  }
  if($_SERVER['REQUEST_METHOD'] == "POST"){
    $data=[
      "name"=>postInput("name"),
      "slug"=>to_slug(postInput("name"))];
    $error=[];
    //Chua nhap vao danh muc
    if(postInput("name")==""){
      $error['name']= "Mời bạn nhập đầy đủ danh mục";
    }
    //Khong co loi nhap vao danh muc
    if(empty($error)){
      if ($edit_category["name"] != $data["name"]) {
        $isset=$db->fetchOne("category","name='".$data["name"]."'");
        if (count($isset)>0){
          $_SESSION["error"]="Danh mục đã tồn tại! Mời nhập lại";
        }
        else{
          $id_update=$db->update("category",$data,array("id"=>$id));
          if($id_update>0){
            $_SESSION['success']="Cập nhật thành công!";
            redirectAdmin("category");
          }
        }
      }
      else{
        $_SESSION['error']="Dữ liệu không thay đổi";
        redirectAdmin("category");
      }
    }
  }

?>
<?php require_once __DIR__. "/../../layouts/header.php"; ?>
<div class="row">
   <div class="col-lg-12">
      <h1 class="page-header">
         Sửa danh mục
      </h1>
      <ol class="breadcrumb">
         <li class="breadcrumb-item">
            <i class="fa fa-list-ul"></i><a href="index.php"> Danh mục</a>
         </li>
         <li class="active breadcrumb-item">
            <i class="fa fa-edit"></i> Sửa danh mục
         </li>
      </ol>
   </div>
</div>
<form class="form-horizontal" role="form" action="" method="POST">
  <?php require_once __DIR__. "/../../../notification/notification.php"; ?>
  <div class="form-group">
    <label for="InputDanhmuc" class="col-sm-2 control-label">Tên danh mục mới</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="InputDanhmuc" name="name" placeholder="<?php echo $edit_category["name"] ?>">
      <?php if(isset($error['name'])): ?>
        <p class="text-danger"><?php echo $error['name'] ?></p>
      <?php endif ?>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-success">Sửa</button>
    </div>
  </div>
</form>
<?php require_once __DIR__. "/../../layouts/footer.php"?>

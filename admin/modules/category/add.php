<?php $open="category"; ?>
<?php
  require_once __DIR__. "/../../autoload/autoload.php";
  if($_SERVER['REQUEST_METHOD'] == "POST"){
    $data=[
      "name"=>postInput("name"),
      "slug"=>to_slug(postInput("name"))
    ];
    $error=[];
    //Chua nhap vao danh muc
    if(postInput("name")==""){
      $error['name']= "Mời bạn nhập đầy đủ danh mục";
    }
    if(empty($error)){
        $isset=$db->fetchOne("category","name='".$data["name"]."'");
        if (count($isset)>0){
          $_SESSION["error"]="Danh mục đã tồn tại! Mời nhập lại";
        }
        else{
          $id_insert=$db->insert("category",$data);
          if($id_insert>0){
            $_SESSION['success']="Thêm mới thành công";
            redirectAdmin("category");
          }
          else{
            $_SESSION['error']="Thêm mới thất bại";
            redirectAdmin("category");
          }
        }
    }
  }
?>
<?php require_once __DIR__. "/../../layouts/header.php"; ?>
<div class="row">
   <div class="col-lg-12">
      <h1 class="page-header">
         Thêm mới danh mục
      </h1>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
           <li class="breadcrumb-item" aria-current="page">
              <i class="fa fa-list-ul"></i><a href="index.php"> Danh sách danh mục</a>
           </li>
           <li class="breadcrumb-item active" aria-current="page">
              <i class="fa fa-indent"></i> Thêm mới danh mục
           </li>
        </ol>
      </nav>
   </div>
</div>
<form class="form-horizontal" role="form" action="" method="POST">
  <?php require_once __DIR__. "/../../../notification/notification.php"; ?>
  <div class="form-group">
    <label for="InputDanhmuc" class="col-sm-2 control-label">Thêm danh mục</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="InputDanhmuc" name="name" placeholder="Nhập danh mục cần thêm">
      <?php if(isset($error['name'])): ?>
        <p class="text-danger"><?php echo $error['name'] ?></p>
      <?php endif ?>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-success">Thêm vào</button>
    </div>
  </div>
</form>
<?php require_once __DIR__. "/../../layouts/footer.php"?>

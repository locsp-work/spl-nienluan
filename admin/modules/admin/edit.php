<?php $open="admin"; ?>
<?php
  require_once __DIR__. "/../../autoload/autoload.php";
  $id = intval(getInput('id'));
  $edit_admin=$db->fetchID("admin",$id);
  if (empty($edit_admin)) {
    $_SESSION["error"]="Dữ liệu không tồn tại";
    redirectAdmin("admin");
  }
  if($_SERVER['REQUEST_METHOD'] == "POST"){
    $data=[
      "name"=>postInput("name"),
      "address"=>postInput("address"),
      "level"=>postInput("level"),
      "phone"=>postInput("phone"),
      "email"=>postInput("email"),
    ];
    $error=[];
    //Chua nhap vao danh muc
    if(postInput("name")==''){
      $error['name']="Mời bạn nhập tên admin";
    }
    if(postInput("address")==''){
      $error['address']= "Mời bạn nhập địa chỉ";
    }
    if(postInput("level")=='') {
      $error['level']="Mời bạn chọn cấp độ tài khoản" ;
    }
    if(postInput("phone")==""){
      $error['phone']= "Mời bạn nhập số điện thoại";
    }
    if(postInput("password")!=NULL && postInput("re_password")!=NULL){
      if(postInput("password")!=postInput("re_password")){
        $error["re_password"]="Mật khẩu thay đổi không khớp";
      }
      else{
        $data["password"]=MD5(postInput("password"));
      }
    }
    if(postInput("email")==""){
      $error['email']= "Mời bạn nhập đầy đủ email";
    }else{
      if(postInput('email')!=$edit_admin['email']){
        $isset=$db->fetchOne("admin"," email='".$data["email"]."'");
        if (count($isset)>0){
          $error['email']= "Email đã tồn tại, mời nhập lại";
        }
      }
    }
    if(empty($error)){
      $id_update=$db->update("admin",$data,array("id"=>$id));
      if($id_update>0){
        $_SESSION['success']="Cập nhật thành công!";
        redirectAdmin("admin");
      }
      else {
        $_SESSION['error']="Dữ liệu không thay đổi";
        redirectAdmin("admin");
      }
    }
}
?>
<?php require_once __DIR__. "/../../layouts/header.php"; ?>
<div class="row">
   <div class="col-lg-12">
      <h1 class="page-header">
         Thêm mới Admin
      </h1>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
           <li class="breadcrumb-item" aria-current="page">
              <i class="fa fa-cog fa-spin"></i><a href="index.php?page=1"> Danh sách Admin </a>
           </li>
           <li class="breadcrumb-item active" aria-current="page">
              <i class="fa fa-user-plus"></i> Thêm mới Admin
           </li>
        </ol>
      </nav>
   </div>
</div>
<div class="row">
  <div class="col-lg-12">
    <form class="form-horizontal" action="" id="form1" method="POST" enctype="multipart/form-data">
      <?php require_once __DIR__. "/../../../notification/notification.php"; ?>
      <!-- Tên admin -->
      <div class="form-row">
        <div class="form-group col-md-12">
          <label>Học và tên</label>
          <input type="text" class="form-control" name="name" value="<?php echo $edit_admin["name"] ?>">
          <?php if(isset($error['name'])): ?>
            <p class="text-danger"><?php echo $error['name'] ?></p>
          <?php endif ?>
        </div>
      </div>
      <!-- Địa chỉ-->
      <div class="form-row">
        <div class="form-group col-md-12">
          <label for="address">Địa chỉ</label>
          <input type="text" id="address" class="form-control"  name="address" value="<?php echo $edit_admin["address"] ?>">
          <?php if(isset($error['address'])): ?>
            <p class="text-danger"><?php echo $error['address'] ?></p>
          <?php endif ?>
        </div>
      </div>
      <!-- Số điện thoại và email -->
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="sdt">Số điện thoại</label>
          <input type="text" id="sdt" class="form-control"  name="phone" value="<?php echo $edit_admin["phone"] ?>">
          <?php if(isset($error['phone'])): ?>
            <p class="text-danger"><?php echo $error['phone'] ?></p>
          <?php endif ?>
        </div>
        <!--========================== -->
        <div class="form-group col-md-6">
          <label for="email">Email</label>
          <input type="email" class="form-control"  name="email" value="<?php echo $edit_admin["email"] ?>">
          <?php if(isset($error['email'])): ?>
            <p class="text-danger"><?php echo $error['email'] ?></p>
          <?php endif ?>
        </div>
      </div>
      <!-- Mật khẩu -->
      <div class="form-row">
        <div class="form-group col-md-6">
          <label>Mật khẩu</label>
          <input type="password" class="form-control"  name="password"></input>
          <?php if(isset($error['password'])): ?>
            <p class="text-danger"><?php echo $error['password'] ?></p>
          <?php endif ?>
        </div>
        <div class="form-group col-md-6">
          <label>Xác nhận mật khẩu</label>
          <input type="password" class="form-control"  name="re_password" placeholder="********"></input>
          <?php if(isset($error['re_password'])): ?>
            <p class="text-danger"><?php echo $error['re_password'] ?></p>
          <?php endif ?>
        </div>
      </div>
      <!-- Cấp bậc admin -->
      <div class="form-row">
        <div class="form-group col-md-12">
          <label >Level</label>
          <select class="form-control" name="level">
            <option value=""> --Chọn cấp bậc admin-- </option>
            <option value="1" <?php echo $edit_admin["level"]=="1" ? "selected" : '' ?>> Cộng tác viên </option>
            <option value="2" <?php echo $edit_admin["level"]=="2" ? "selected" : '' ?>> Admin </option>
          </select>
          <?php if(!empty($error['level'])): ?>
            <p class="text-danger"><?php echo $error['level'] ?></p>
          <?php endif ?>
        </div>
      </div>
      <!-- submit -->
      <div class="form-row">
        <div class="col-sm-offset-2 col-sm-10 ">
          <button type="submit" class="btn btn-success ">Thêm vào</button>
        </div>
      </div>
    </form>
  </div>
</div>
<?php require_once __DIR__. "/../../layouts/footer.php"?>

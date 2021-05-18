<?php $open="admin"; ?>
<?php
  require_once __DIR__. "/../../autoload/autoload.php";
  $data=[
    "name"=>postInput("name"),
    "address"=>postInput("address"),
    "level"=>postInput("level"),
    "phone"=>postInput("phone"),
    "email"=>postInput("email"),
    "password"=> MD5(postInput("password")),
    "avatar"=>postInput("avatar")
  ];
  if($_SERVER['REQUEST_METHOD'] == "POST"){
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
    if(postInput("email")==""){
      $error['email']= "Mời bạn nhập đầy đủ email";
    }else{
      $isset=$db->fetchOne("admin"," email='".$data["email"]."'");
      if (count($isset)>0){
        $error['email']= "Email đã tồn tại, mời nhập lại";
      }
    }
    if(postInput("password")==""){
      $error['password']= "Mời bạn nhập mật khẩu";
    }
    if($data["password"] != MD5($_POST["re_password"])){
      $error['re_password']= "Mật khẩu không khớp";
    }
    if(isset($_FILES["avatar"])){
      $file_name=$_FILES["avatar"]["name"];
      $file_type=$_FILES["avatar"]["type"];
      $file_size=$_FILES["avatar"]["size"];
      $file_error=$_FILES["avatar"]["error"];
      $file_tmp = $_FILES['avatar']['tmp_name'];
      $file_ext=explode('.',$_FILES['avatar']['name']);
      $file_ext1=strtolower(end($file_ext));
      $type_sp= array("jpeg","jpg","png");
      if($file_size > 2097152){
         $error["avatar"]='Kích thước file không được lớn hơn 2MB';
      }else
      if(in_array($file_ext1,$type_sp)===false){
         $error["avatar"]="Chọn hình ảnh hỗ trợ upload file JPEG hoặc PNG";
      }else
      if($file_error==0){
         $data["avatar"]=$file_name;
         $path= ROOT."admin/";
      }
    }
    if(empty($error)){
      $isset=$db->fetchOne("admin","name='".$data["name"]."'");
      if(count($isset)>0){
        $_SESSION["error"]="Admin đã tồn tại! Mời nhập lại";
      }
      else{
        $thumb_insert=$db->insert("admin",$data);
        if($thumb_insert){
          move_uploaded_file($file_tmp, $path.$file_name);
          $_SESSION['success']="Thêm mới admin thành công";
          redirectAdmin("admin");
        }
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
          <input type="text" class="form-control" name="name" placeholder="Nhập họ tên tại đây">
          <?php if(isset($error['name'])): ?>
            <p class="text-danger"><?php echo $error['name'] ?></p>
          <?php endif ?>
        </div>
      </div>
      <!-- Địa chỉ-->
      <div class="form-row">
        <div class="form-group col-md-12">
          <label for="address">Địa chỉ</label>
          <input type="text" id="address" class="form-control"  name="address" placeholder="Nhập địa chỉ tại đây">
          <?php if(isset($error['address'])): ?>
            <p class="text-danger"><?php echo $error['address'] ?></p>
          <?php endif ?>
        </div>
      </div>
      <!-- Số điện thoại và emai -->
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="sdt">Số điện thoại</label>
          <input type="text" id="sdt" class="form-control"  name="phone" placeholder="Nhập số điện thoại tại đây">
          <?php if(isset($error['phone'])): ?>
            <p class="text-danger"><?php echo $error['phone'] ?></p>
          <?php endif ?>
        </div>
        <!--========================== -->
        <div class="form-group col-md-6">
          <label for="email">Email</label>
          <input type="email" class="form-control"  name="email" placeholder="Nhập Email@example.com">
          <?php if(isset($error['email'])): ?>
            <p class="text-danger"><?php echo $error['email'] ?></p>
          <?php endif ?>
        </div>
      </div>
      <!-- Mật khẩu -->
      <div class="form-row">
        <div class="form-group col-md-6">
          <label>Mật khẩu</label>
          <input type="password" class="form-control"  name="password" placeholder="********"></input>
          <?php if(isset($error['password'])): ?>
            <p class="text-danger"><?php echo $error['password'] ?></p>
          <?php endif ?>
        </div>
      <!-- Nhập lại mật khẩu -->
        <div class="form-group col-md-6">
          <label>Xác nhận mật khẩu</label>
          <input type="password" class="form-control"  name="re_password" placeholder="********" required></input>
          <?php if(isset($error['re_password'])): ?>
            <p class="text-danger"><?php echo $error['re_password'] ?></p>
          <?php endif ?>
        </div>
      </div>
      <!-- Hình ảnh và cấp bậc admin -->
      <div class="form-row">
        <div class="form-group col-md-6">
          <label>Hình ảnh</label>
          <input type="file" class="form-control"  name="avatar">
          <?php if(isset($error['avatar'])): ?>
            <p class="text-danger"><?php echo $error['avatar'] ?></p>
          <?php endif ?>
        </div>
        <!-- ======================================================= -->
        <div class="form-group col-md-6">
          <label >Level</label>
          <select class="form-control" name="level">
            <option value=""> --Chọn cấp bậc admin-- </option>
            <option value="1"> Cộng tác viên </option>
            <option value="2"> Admin </option>
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

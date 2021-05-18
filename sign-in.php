<?php require_once __DIR__."/autoload/autoload.php" ?>
<?php 
  if (isset($_SESSION['name_id'])) {
    echo '<script>alert("Bạn đã đăng nhập !!! Mời đăng xuất để thực hiện thao tác này"); location.href="index.php"</script>';
  }
  $data=[
    "name"=>postInput("name"),
    "address"=>postInput("address"),
    "phone"=>postInput("phone"),
    "email"=>postInput("email"),
    "password"=> MD5(postInput("password")),
  ];
  $error=[];
  if($_SERVER['REQUEST_METHOD'] == "POST"){
    //Chua nhap vao danh muc
    if(postInput("name")==''){
      $error['name']="Mời bạn nhập tên";
    }
    else{
      $is_check= $db->fetchOne("user"," email = '".$data['email']."'");
      if($is_check !=NULL){
        $error['email']='Email đã tồn tại mời bạn nhập địa chỉ email khác';
      }
    }
    if(postInput("address")==''){
      $error['address']= "Mời bạn nhập địa chỉ";
    }
    if(postInput("phone")==""){
      $error['phone']= "Mời bạn nhập số điện thoại";
    }
    if(postInput("email")==""){
      $error['email']= "Mời bạn nhập đầy đủ email";
    }
    if(postInput("password")==""){
      $error['password']= "Mời bạn nhập mật khẩu";
    }
    if (empty($error)){
      $user_insert=$db->insert("user",$data);
      if($user_insert > 0){
        $_SESSION['success']='Bạn đã đăng kí thành công';
        echo '<script>location.href="log-in.php"</script>';
      }
      else{
        $_SESSION['error']='Đăng kí thất bại';
      }
    }
}
?>
<?php if(isset($_SESSION['error'])): ?>
  <div class="alert alert-danger" data-dismiss="alert">
    <strong>Thất bại: </strong><?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
  </div>
<?php endif ?>
<?php require_once __DIR__."/layout/header.php" ?>
 <section id="myaccount">
    <div class="row">
      <div class="container">
        <div class="myaccount-area">
         <div class="myaccount-login col-md-12">
           <h4>Đăng kí</h4>
           <form class="form-horizontal" method="post" action="">
            <div class="form-group">
              <label class="control-label col-sm-4" for="email">Email:</label>
              <div class="col-sm-12">
                <input type="email" class="form-control" name="email" placeholder="Nhập email">
              </div>
              <?php if (isset($error['email'])): ?>
                <p class="text-danger"><?php echo $error['email'] ?></p>               
              <?php endif ?>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4" for="name">Họ và tên:</label>
              <div class="col-sm-12">
                <input type="text" class="form-control" name="name" placeholder="Nhập tên">
              </div>
              <?php if (isset($error['name'])): ?>
                <p class="text-danger"><?php echo $error['name'] ?></p>               
              <?php endif ?>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4" for="address">Địa chỉ:</label>
              <div class="col-sm-12">
                <input type="text" class="form-control" name="address" placeholder="Nhập địa chỉ">
              </div>
              <?php if (isset($error['address'])): ?>
                <p class="text-danger"><?php echo $error['address'] ?></p>               
              <?php endif ?>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4" for="phone">Số điện thoại:</label>
              <div class="col-sm-12">
                <input type="text" class="form-control" name="phone" placeholder="Nhập số điện thoại">
              </div>
              <?php if (isset($error['phone'])): ?>
                <p class="text-danger"><?php echo $error['phone'] ?></p>               
              <?php endif ?>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4" for="password">Password:</label>
              <div class="col-sm-12">
                <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu">
              </div>
              <?php if (isset($error['password'])): ?>
                <p class="text-danger"><?php echo $error['password'] ?></p>               
              <?php endif ?>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">Đăng kí</button>
              </div>
            </div>
           </form>
         </div>
       </div>
     </div>
   </div>
 </section>
<?php require_once __DIR__."/layout/footer.php" ?>

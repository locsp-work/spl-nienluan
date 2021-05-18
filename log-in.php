<!-- Đăng nhâp -->
<?php require_once __DIR__."/autoload/autoload.php" ?>
<?php require_once __DIR__."/layout/header.php" ?>
<?php 
  $data=[
    "email"=>postInput("email"),
    "password"=> MD5(postInput("password")),
  ];
  $error=[];
  if($_SERVER['REQUEST_METHOD'] == "POST"){
    //Chua nhap vao danh muc
    if(postInput("email")==""){
      $error['email']= "Mời bạn nhập đầy đủ email";
    }
    if(postInput("password")==""){
      $error['password']= "Mời bạn nhập mật khẩu";
    }
  if(empty($error)){
  $is_check= $db->fetchOne("user"," email = '".$data['email']."' AND password = '".$data['password']."'");
  if($is_check != NULL){
    $_SESSION['name_user']=$is_check['name'];
    $_SESSION['name_id']=$is_check['id'];
    echo "<script>alert('Đăng nhập thành công');location.href='index.php'</script>";
  }
  else{
    $_SESSION['error']='Đăng nhập thất bại';
  }
 }
}
?>
<?php require_once __DIR__."/notification/notification.php";?>
<section id="myaccount">
    <div class="container">
      <div class="row justify-content-md-center">
      <div class="myaccount-area col-md-6">
        <div class="myaccount-register ">
         <h4>Đăng nhập</h4>
         <form class="form-horizontal" method="post" action="">
           <div class="form-group">
             <label class="control-label col-sm-2" for="email">Email:</label>
             <div class="col-sm-12">
               <input type="email" class="form-control" name="email" placeholder="Enter email">
             </div>
              <?php if (isset($error['email'])): ?>
                <p class="text-danger"><?php echo $error['email'] ?></p>               
              <?php endif ?>
           </div>
           <div class="form-group">
             <label class="control-label col-sm-2" for="password">Password:</label>
             <div class="col-sm-12">
               <input type="password" class="form-control" name="password" placeholder="Enter password">
             </div>
              <?php if (isset($error['password'])): ?>
                <p class="text-danger"><?php echo $error['password'] ?></p>               
              <?php endif ?>
           </div>
           <div class="form-group">
             <div class="col-sm-offset-2 col-sm-10">
               <button type="submit" class="btn btn-success">Đăng nhập</button>
             </div>
           </div>
        </form>    
       </div>
     </div>
    </div>
  </div>
</section>
<?php require_once __DIR__."/layout/footer.php" ?>
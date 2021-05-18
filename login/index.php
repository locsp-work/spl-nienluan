<?php 
  session_start();
  require_once $_SERVER['SERVER_NAME']. "/autoload/autoload.php";
  require_once $_SERVER['SERVER_NAME']. "/libraries/Database.php";
  require_once $_SERVER['SERVER_NAME']. "/libraries/Function.php";
  $db=new Database;
  if (isset($_SERVER['HTTPS'])) {
    $data=[
      "email"=>postInput("email"),
      "password"=> postInput("password"),
    ];
}
  
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
  $is_check= $db->fetchOne("admin"," email = '".$data['email']."' AND password = '".md5($data['password'])."'");
  if($is_check != NULL){
    $_SESSION['admin_name']=$is_check['name'];
    $_SESSION['admin_id']=$is_check['id'];
    echo "<script>alert('Đăng nhập thành công');location.href='http://sploc-php.herokuapp.com/admin/'</script>";
  }
  else{
    $_SESSION['error']='Đăng nhập thất bại';
    echo "That Bai";
  }
 }
}
?>
<head>
    <link rel="stylesheet" type="text/css" href="front-end/bootstrapmin.css">
</head>
<style type="text/css">
.login,.image {
  min-height: 100vh;
}
.bg-image {
  background-image: url('https://res.cloudinary.com/mhmd/image/upload/v1555917661/art-colorful-contemporary-2047905_dxtao7.jpg');
  background-size: cover;
  background-position: center center;
}
</style>
<div class="container-fluid">
    <div class="row no-gutter">
        <!-- The image half -->
        <div class="col-md-6 d-none d-md-flex bg-image"></div>
        <!-- The content half -->
        <div class="col-md-6 bg-light">
            <div class="login d-flex align-items-center py-5">
                <div class="container">
                    <?php require_once __DIR__.'/../notification/notification.php'; ?>
                    <div class="row">
                        <div class="col-lg-10 col-xl-7 mx-auto">
                            <h3 class="display-4">Log-in admin</h3>
                            <form method="post" action="#">
                                <div class="form-group mb-3">
                                    <input name='email' type="email" placeholder="Nhập email" required="" autofocus="" class="form-control rounded-pill border-0 shadow-sm px-4">
                                </div>
                                <div class="form-group mb-3">
                                    <input name="password" type="password" placeholder="Password" required="" class="form-control rounded-pill border-0 shadow-sm px-4 text-primary">
                                </div>
                                <div class="custom-control custom-checkbox mb-3">
                                    <input id="customCheck1" type="checkbox" checked class="custom-control-input">
                                    <label for="customCheck1" class="custom-control-label">Remember password</label>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block text-uppercase mb-2 rounded-pill shadow-sm">Login</button>
                            </form>
                        </div>
                    </div>
                </div><!-- End -->
            </div>
        </div><!-- End -->
    </div>
</div>


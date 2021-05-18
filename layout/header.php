<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shop cây cảnh</title>
    <!-- Font awesome -->
    <link type="text/css" href="<?php echo base_url() ?>public/frontend/css/all.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>public/frontend/css/bootstrap.css"rel="stylesheet" >
    <link href="<?php echo base_url() ?>public/frontend/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>public/frontend/css/style.css" rel="stylesheet">
  </head>
  <body>
  <header id="header">
    <div class='header-top'>
      <div class='container'>
        <nav id="header-nav-top">
          <ul class="list-inline" id='headermenu'>
            <?php if (isset($_SESSION['name_user'])): ?>
              <li style="color: red">Xin Chào :<?php echo $_SESSION['name_user'] ?></li>
              <li>
                <a href="#"><i class='fa fa-user'></i>Tài khoản <i class='fa fa-chevron-circle-down'></i></a>
                <ul id='header-submenu'>
                  <li><a href="info.php">Thông tin</a></li>
                  <li><a href="cart.php">Giỏ hàng</a></li>
                  <li><a href="log-out.php"><i class='fa fa-share-square-o'></i>Đăng xuất</a></li>
                </ul>
              </li>
            <?php else: ?>
              <li>
                <a href="log-in.php"><i class='fa fa-unlock'></i> Đăng nhập</a>
                <a href="sign-in.php"><i class='fa fa-user'></i> Đăng kí</a>
              </li>
            <?php endif ?>
          </ul>
        </nav>        
      </div>
    </div>
    <!-- start header top  -->
    <!-- / header top  -->
    <!-- start header bottom  -->
    <div class="header-bottom">
      <div class="container">
        <div class="header-bottom-area">
          <!-- logo  -->
          <div class="logo">
            <!-- Text based logo -->
            <a href="index.php">
              <img src="<?php echo base_url() ?>public/img/logo2.png" alt="logo" width="100px" height="auto"/>
            </a>
            <p>Ươm mầm cây xanh</p>
          </div>
          <!-- / logo  -->
          <!-- search box -->
          <div class="search-box">
            <form action="search.php" method="get">
              <input type="text" name="name" placeholder="Tìm kiếm tại đây">
              <button type="submit"><span class="fa fa-search"></span></button>
            </form>
          </div>
          <!-- / search box -->
          <!-- cart box -->
         <div class="cartbox">
           <a class="cart-link" href="cart.php">
             <span class="fa fa-shopping-bag"></span>
             <span class="cart-notify">
                <?php echo (isset($_SESSION['cart']['name'])) ? '<i class="fa fa-exclamation"></i>' : '' ?>    
              </span>
             <span class="cart-title">GIỎ HÀNG</span>
           </a>
           <div class="cartbox-summary">
             <ul>
                <?php 
                  if(isset($_SESSION['cart'])){
                    foreach ($_SESSION['cart'] as $key => $value) {
                      echo'
                        <li>
                          <a class="cartbox-img" href="#"><img src="'.uploads().'/product/'.$value["thumbnail"].'"></a>
                         <div class="cartbox-info">
                           <h4><a href="#">'.$value["name"].'</a></h4>
                           <p>'.$value["quantity"].' x '.$value["price"].'</p>
                         </div>
                         <a class="remove-product" href="remove-in-cart.php?key='.$key.'"><span class="fa fa-times"></span></a>
                       </li>                               
                      ';
                    }
                  } 
                ?>
             </ul>
             <a class="cartbox-checkout primary-btn" href="cart.php">Xem giỏ hàng</a>
           </div>
         </div>
        </div>
      </div>
    </div>
  </header>
  <!-- / header section -->
  <!-- menu -->
  <nav id="nav-menu">
    <div id="mainnav">
      <ul class="menu">
          <li class="home" >
            <a class="drop-link" href="index.php">Trang chủ</a>
          </li>   
            <li class="drop-item">
              <a href="#" class="drop-link dropdown-toggle" data-toggle="dropdown">Cây cảnh hot</a>
              <?php foreach ($data_category as $value): ?>
              <ul class="submenu">
                  <?php foreach ($product_hot as $value['id'] => $item): ?>
                    <li class="d-flex justify-content-around">
                      <a href="chi-tiet-sp.php?id=<?php echo $item['id'] ?>" class="drop-menu-item"><?php echo $item['name'] ?></a>
                    </li>
                  <?php endforeach ?>                 
              </ul>
            </li>
        <?php endforeach; ?>
          <li class="drop-item" ><a class="drop-link" href="index.php">Liên hệ với chúng tôi</a>
          </li>
      </ul>
    </div>
</nav>
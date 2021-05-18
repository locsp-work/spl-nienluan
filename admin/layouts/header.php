<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Quản trị đơn hàng</title>
      <link href="<?php echo base_url() ?>public/admin/css/bootstrap.css" rel="stylesheet">
      <link href="<?php echo base_url() ?>public/admin/css/GiaodienAdmin.css" rel="stylesheet">
      <link href="<?php echo base_url() ?>public/admin/css/all.css" rel="stylesheet" type="text/css">
   </head>
   <body>
      <div class="wrapper">
        <div class="background-side">
          <nav id="sidebar">
            <div class="sidebar-header">
              <button type="button" id="sidebarCollapse" class="btn btn-sm">
                  <i class="fa fa-reply fa-lg"></i>
                  <i class="fa fa-share"></i>
              </button>
              <h3>Admin page</h3>
              <strong>AP</strong>
            </div>
           <ul class="list-unstyled tab">
              <li class="<?php echo isset($open) && $open=="category" ? "active" : "" ?>">
                 <a href="<?php echo modules("category")?>"><i class="fa fa-fw fa-list-ol"></i> Quản Lí Danh mục Cây</a>
              </li>
              <li class="<?php echo isset($open) && $open=="product" ? "active" : "" ?>">
                 <a href="<?php echo modules("product?page=1")?>"><i class="fa fa-fw fa-clipboard-list"></i> Sản phẩm Cây Cảnh</a>
              </li>
              <li class="<?php echo isset($open) && $open=="admin" ? "active" : "" ?>">
                 <a href="<?php echo modules("admin?page=1")?>"><i class="fas fa-cog fa-spin"></i>Admin</a>
              </li>
              <li class="<?php echo isset($open) && $open=="user" ? "active" : "" ?>">
                 <a href="<?php echo modules("user?page=1")?>"><i class="fas fa-users"></i>Quản lý thành viên</a>
              </li>
              <li class="<?php echo isset($open) && $open=="transaction" ? "active" : "" ?>">
                 <a href="<?php echo modules("transaction?page=1")?>"><i class="fas fa-cc-amazon-pay"></i>Quản lý giao dịch</a>
              </li>
              <li>
                 <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><?php echo $_SESSION['admin_name'] ?></a>
                 <ul class="collapse list-unstyled" id="pageSubmenu" >
                    <li>
                       <a href="/NienLuan/login/log-out.php">Đăng xuất</a>
                    </li>
                 </ul>
                </li>
             </ul>
          </nav>
        </div>
        <div id="content">
          <nav class="navbar navbar-expand-sm navbar-dark bg-white ">
              <div class="container-fluid">
                     <!-- Top Menu Items -->
                  <div class="collapse navbar-collapse" id="navbarContent">
                    <ul class="navbar-nav ml-auto">

                    </ul>
                  </div>
              </div>
          </nav>

<?php require_once("https://sploc-php.herokuapp.com/layout/header.php") ?>
<?php require_once("https://sploc-php.herokuapp.com/notification/notification.php)" ?>
<?php
  $port='5432';
  $host='ec2-3-91-127-228.compute-1.amazonaws.com';
  $user='rfjfberjafogwv';
  $password='a3aa0f58303cddf8336186b7acedc39cf53beb24cf620fbbca5daf45614ab259';
  $dbname='de5l84t9ch02r7';
  $connect = pg_connect('host='.$host.' port='.$port.' dbname='.$dbname.' user='.$user.' password='.$password);
  if (!$connect) {
      echo "An error occurred.\n";
      exit;
  }
  
  $tab_query="SELECT * FROM category WHERE home=1 ORDER BY update_at";
  $tab_result=pg_query($connect,$tab_query);
  $tab_menu='';
  $tab_content='';
  $count=0;
  while ($row = pg_fetch_array($tab_result)) {
    if($count==0){
      $tab_menu .= '
      <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#'.$row["id"].'">'.$row["name"].'</a>
      </li>';
      $tab_content .=
      '<div id="'.$row["id"].'" class="container tab-pane wow shake active">
        <ul class="product-catg">
      ';
    }
    else{
      $tab_menu .='
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#'.$row["id"].'">'.$row["name"].'</a>
      </li>';
      $tab_content .='<div id="'.$row["id"].'"class="container tab-pane wow shake">
      <ul class="product-catg">';
    }
    $product_query = "SELECT * FROM product WHERE category_id='".$row["id"]."'";
    $product_result= pg_query($connect,$product_query);
    while ($sub_row=pg_fetch_array($product_result)) {
      $tab_content.= '
        <li>
            <figure>
              <a class="product-img" href="chi-tiet-sp.php?id='.$sub_row["id"].'">
                <img src="public/uploads/product/'.$sub_row["thumbnail"].'" class="img-responsive img-thumbnail"/>
              </a>
              <a class="add-card-btn" href="add-cart.php?id='.$sub_row["id"].'">
                <span class="fa fa-shopping-cart"></span>Thêm vào giỏ hàng
              </a>
              <figcaption>
                <h4 class="product-title">
                  <a href="chi-tiet-sp.php?id='.$sub_row["id"].'">'.$sub_row["name"].'</a>
                </h4>
                '.(($sub_row["sale"]> 0)
                ?'
                <span class="product-price"><del>'.formatPrice($sub_row['price']).'</del></span>
                <span class="product-price">
                  '.formatPriceSale($sub_row['price'],$sub_row['sale']).'
                </span>'
                :'
                <span class="product-price">
                  '.formatPriceSale($sub_row['price'],$sub_row['sale']).'
                </span>'
                ).'
              </figcaption>
            </figure>
            <div class="product-hvr-content">
              <a href="add-favourite.php?id='.$sub_row["id"].'"><span class="fa fa-heart"></span></a>
              <a href="add-cart.php?id='.$sub_row["id"].'"><span class="fa fa-cart-arrow-down"></span></a>
            </div>
         </li>
      ';
    }
    $tab_content .='<div style="clear:both"></div></ul></div>';
    $count++;
  }
?>
  <div class="container mt-3 ">
    <ul class="nav nav-tabs justify-content-center">
      <?php
        echo $tab_menu;
      ?>
    </ul>
    <div class="tab-content" >
      <?php echo $tab_content; ?>
    </div>
  </div>
  <!-- / Products  section -->
  
  <!-- popular section -->
 <?php require_once __DIR__."/layout/footer.php" ?>











<?php require_once __DIR__."/autoload/autoload.php" ?>
<?php require_once __DIR__."/layout/header.php" ?>
<?php
	$id=intval(getInput("id"));
	$product_detail=$db->fetchID('product',$id);
	$category_detail=intval($product_detail['category_id']);
	$sql="SELECT * FROM category WHERE id = $category_detail";
	$cate_name=$db->fetchsql($sql);
?>
  <section id="product-details">
    <div class="container">
      <div class="product-details-area">
        <div class="product-details-content">
          <div class="row">
            <!-- Modal view slider -->
            <div class="col-md-5 col-sm-5 col-xs-12">
              <div class="product-view-slider">
	            	<a>
	            		<img src="<?php echo uploads() ?>product/<?php echo $product_detail["thumbnail"]?>" class="img-responsive img-thumbnail">
	            	</a>
              </div>
            </div>
            <!-- Modal view content -->
            <div class="col-md-7 col-sm-7 col-xs-12">
              <div class="product-view-content">
                <h3><?php echo $product_detail['name'] ?></h3>
                <div class="price-block">
        					<?php if ($product_detail['sale']>0): ?>
        						<span class="product-view-price">
        							<?php echo formatPriceSale($product_detail['price'],$product_detail['sale']) ?>
        							<strike><?php echo formatPrice($product_detail['price'])?></strike>
        						</span>
        					<?php else: ?>
        						<span class="product-view-price"><?php echo formatPrice($product_detail['price'])?></span>
        					<?php endif; ?>
                  	<p class="product-avilability">Trạng thái: <span><?php echo ($product_detail['warehouse']>0) ? "Còn hàng" : "Hết hàng" ?></span></p>
                </div>
                <div class="prod-quantity">
                  <p class="prod-category">
                    Category :<?php foreach ($cate_name as $value): ?><?php echo $value['name'] ?><?php endforeach; ?>
                  </p>
                </div>
                <div class="prod-view-bottom">
                  <a class="btn btn-info" href="add-cart.php?id=<?php echo $product_detail['id'] ?>">Thêm giỏ hàng</a>
                  <a class="btn btn-info" href="add-favourite.php?id=<?php echo $product_detail['id'] ?>">Yêu thích</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="product-details-bottom">
          <ul class="nav nav-tabs" id="myTab2">
            <li class="nav-item"><a class="nav-link active" href="#description" data-toggle="tab">Mô tả</a></li>
          </ul>
					<div class="tab-content">
						<div class="container tab-pane active" id="description">
	          	<pre><?php echo $product_detail['detail'] ?></pre>
	          </div>
					</div>
				</div>
      </div>
    </div>
  </section>

<?php require_once __DIR__."/layout/footer.php" ?>

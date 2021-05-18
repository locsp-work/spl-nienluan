<?php require_once __DIR__."/autoload/autoload.php" ?>
<?php 
  $sum=0;
  if(!isset($_SESSION['cart']) || count($_SESSION['cart'])==0){
  echo '<script>alert("Không có sản phẩm trong giỏ hàng");location.href="index.php"</script>';
  }
?>
<?php require_once __DIR__."/layout/header.php" ?>
<?php require_once __DIR__."/notification/notification.php" ?>
<section id="cart-view">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="cart-view-area">
           <div class="cart-view-table">
               <div class="table-responsive">
                  <table class="table table-hover" id="shoppingcart-info">
                    <thead>
                      <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Hình ảnh</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Tổng tiền</th>
                        <th>Thao tác</th>
                      </tr>
                    </thead>
                    <tbody>
                          <?php $stt=1; foreach ($_SESSION['cart'] as $key => $value): ?>
                            <tr>
                              <td><?php echo $stt ?></td>
                              <td><?php echo $value['name']?></td>
                              <td>
                                <img src="<?php echo uploads() ?>product/<?php echo $value['thumbnail']?>" width="80px" height="80px">
                              </td>
                              <td>
                                <input type="number" name="quantity" value="<?php echo $value['quantity'] ?>" class="quantity" style="width: 70px" min=0>
                              </td>
                              <td><?php echo formatPrice($value['price']) ?></td>
                              <td><?php echo formatPrice($value['price']*$value['quantity']) ?></td>
                              <td>
                                <a href="remove.php?key=<?php echo $key ?>" class="btn btn-sm btn-danger"><i class='fa fa-remove'></i>remove</a>
                                <a href="" class="btn btn-sm btn-info updatecart" data-key=<?php echo $key ?>><i class='fa fa-refresh'></i>update</a>
                              </td>
                            </tr>  
                            <?php $sum += $value['price'] * $value['quantity']; $_SESSION['sum']=$sum; ?>
                          <?php $stt++; endforeach ?>
                      </tbody>
                  </table>
                </div>
             <!-- Cart Total view -->
             <div class="cart-view-total">
               <h4>Thông tin đơn hàng</h4>
               <table class="totals-table">
                 <tbody>
                   <tr>
                     <th>Số tiền</th>
                     <td><span class="badge"><?php echo formatPrice($_SESSION['sum']) ?></span></td>
                   </tr>
                   <tr>
                      <th>Thuế 2%</th>
                     <td><span class="badge"><?php echo formatPrice($_SESSION['sum']*2/100)?></span></td>
                   </tr>
                   <tr>
                     <th>Tổng tiền</th>
                      <td>
                        <span class="badge"><?php echo formatPrice($_SESSION['total']=$_SESSION['sum']+$_SESSION['sum']*2/100)?></span>
                      </td>
                   </tr>
                 </tbody>
               </table>
               <li class="list-group-item">
                 <a href="thanh-toan.php" class="btn btn-sm btn-success">Thanh toán</a>
                 <a href="index.php" class="btn btn-sm btn-success">Tiếp tục mua hàng</a>                 
               </li>               
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
 </section>
<?php require_once __DIR__."/layout/footer.php" ?>

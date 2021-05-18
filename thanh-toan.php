<?php require_once __DIR__."/autoload/autoload.php" ?>
<?php 
	$user=$db->fetchID('user',intval($_SESSION['name_id']));
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		$data=[
			'amount' => $_SESSION['total'],
			'user_id' => $_SESSION['name_id'],
			'note' => postInput('note')
		];
	$tran_id=$db->insert('transaction',$data);
		if($tran_id>0){
			foreach ($_SESSION['cart'] as $key => $value) {
				$data2=[
					'transaction_id'=> $tran_id,
					'product_id' => $key,
					'quantity' => $value['quantity'],
					'price' => $value['price']
				];
				$id_insert=$db->insert('orders',$data2);
			}		
		$_SESSION['orders']['success']='Lưu thông tin đơn hàng thành công chúng tôi sẽ liên hệ với bạn sớm nhất';
    header("location:thong-bao.php");
	 }
}
?>
<?php require_once __DIR__."/layout/header.php"?>
<div class="container mt-3">
     <h4>Xác nhận thanh toán</h4>
     <form class="form-horizontal" method="post" action="">
       <div class="form-horizontal-group mt-3">
         <label class="control-label col-sm-2" for="name">Tên khách hàng</label>
         <div class="col-sm-12">
           <input type="text" readonly="" class="form-control" name="name" value="<?php echo $user['name']?>">
         </div>
       </div>
       <div class="form-group">
         <label class="control-label col-sm-2" for="email">Email</label>
         <div class="col-sm-12">
           <input type="email" readonly="" class="form-control" name="email" value="<?php echo $user['email']?>">
         </div>
       </div>
        <div class="form-group">
         <label class="control-label col-sm-2" for="address">Địa chỉ</label>
         <div class="col-sm-12">
           <input type="text" readonly="" class="form-control" name="address" value="<?php echo $user['address']?>">
         </div>
       </div>
       <div class="form-group">
         <label class="control-label col-sm-2" for="phone">Số điện thoại</label>
         <div class="col-sm-12">
           <input type="text" readonly="" class="form-control" name="phone" value="<?php echo $user['phone']?>">
         </div>
       </div>
        <div class="form-group">
         <label class="control-label col-sm-2" for="note">Ghi chú mua hàng</label>
         <div class="col-sm-12">
           <input type="text" class="form-control" name="note" placeholder="Nhập ghi chú đơn hàng tại đây">
         </div>
       </div>
       <div class="form-group">
         <div class="col-sm-offset-2 col-sm-10">
           <button type="submit" class="btn btn-success">Xác nhận</button>
         </div>
       </div>
    </form>
 </div>
<?php require_once __DIR__."/layout/footer.php" ?>
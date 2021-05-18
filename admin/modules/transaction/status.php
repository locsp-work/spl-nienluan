<?php 
require_once __DIR__. "/../../autoload/autoload.php";
$id = intval(getInput('id'));
$edit_transaction=$db->fetchID("transaction",$id);
if (empty($edit_transaction)) {
	$_SESSION["error"]="Dữ liệu không tồn tại";
	redirectAdmin("transaction");
}
if($edit_transaction['status']==1){
	$_SESSION['error']='Đơn hàng đã được xử lý !!!';
	redirectAdmin("transaction");
}
$status=1;
    $update=$db->update("transaction",array('status' => $status ),array('id' => $id));
    if($update>0){
      $_SESSION['success']="Cập nhật thành công!";
      $sql="SELECT product_id,quantity FROM orders WHERE transaction_id=$id";
      $Order=$db->fetchsql($sql);
      foreach ($Order as $value) {
      	$id_product=$value['product_id'];
      	$product=$db->fetchID('product',$id_product);
      	$number=$product['warehouse']-$value['quantity'];
      	//Cập nhật số lượng, số lần được mua
      	$update_pro=$db->update('product',array('warehouse'=>$number,"pay"=>$product['pay']+1),array('id'=>$id_product));
      }
      redirectAdmin("transaction");
    }
    else{
      $_SESSION['error']="Dữ liệu không thay đổi";
      redirectAdmin("transaction");
    }
?>
<?php require_once __DIR__."/autoload/autoload.php" ?>
<?php 
if (!isset($_SESSION['name_id'])) {
	echo '<script>alert("Bạn phải đăng nhập mới thêm vào giỏ hàng được");location.href="index.php"</script>';
  } 
//Lấy id chi tiết của sản phẩm
$id = intval(getInput('id'));
$product=$db->fetchID("product",$id);
//Nếu tồn tại giỏ hàng thì cập nhật giỏ hàng
//Ngược lại thì tạo mới

if(!isset($_SESSION['cart'][$id])){
	//tạo mới giỏ hàng
	$_SESSION['cart'][$id]['warehouse']=$product['warehouse'];
	$_SESSION['cart'][$id]['name']=$product['name'];
	$_SESSION['cart'][$id]['thumbnail']=$product['thumbnail'];
	$_SESSION['cart'][$id]['quantity']=1;
	$_SESSION['cart'][$id]['price']=((100-$product['sale']) * $product['price'])/100;
}
else{
	//cập nhật giỏ hàng
	$_SESSION['cart'][$id]['quantity']=+1;
}
echo '<script>alert("Thêm sản phẩm thành công"); location.href="cart.php"</script>';  
?>

<?php require_once __DIR__."/autoload/autoload.php" ?>
<?php require_once __DIR__."/layout/header.php" ?>
<?php 
	if(!isset($_SESSION['orders']['success'])){
		echo '<script>alert("Bạn phải order hàng mới được vào trang này !!!"); location.href="index.php"</script>';
	}
	else echo 
		'<div class="alert alert-success" data-dismiss="alert">
	    	<strong>Thành công: </strong>'.$_SESSION["orders"]["success"].'
	  	</div>';
	unset($_SESSION['orders']);
	unset($_SESSION['cart']);
	unset($_SESSION['total']);
?>
<div class="col-md-12" align="center">
	<?php require_once __DIR__."/notification/notification.php" ?>
	<a href="index.php"  style='margin-top:30px' class="btn btn-xs btn-success">Trở về trang chủ</a>
</div>
<?php require_once __DIR__."/layout/footer.php" ?>
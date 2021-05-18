<?php require_once __DIR__."/autoload/autoload.php" ?>
<?php 
	$key = intval(getInput("key"));
	$quantity = intval(getInput("quantity"));
	$warehouse=$_SESSION['cart'][$key]['warehouse'];
	if($quantity>$warehouse){
		echo 0;
	}else{
		$_SESSION['cart'][$key]['quantity']=$quantity;
		echo 1;	
	}	
?>
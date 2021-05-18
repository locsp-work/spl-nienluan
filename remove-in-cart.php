<?php require_once __DIR__."/autoload/autoload.php" ?>
<?php 
	$key=intval(getInput("key"));
	unset($_SESSION['cart'][$key]);
	header('location:index.php');
?>
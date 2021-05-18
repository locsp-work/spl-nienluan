<?php 
	require __DIR__ .'/autoload/autoload.php';
	$id=intval(getInput('id'));
	$product=$db->fetchID('product',$id);
	$update=$db->update("product",array("favourite"=>$product['favourite']+1),array('id'=>$id));
	$_SESSION['product'][$id]['favourite']=$product['favourite']+1;
	header('location:hot.php');
?>
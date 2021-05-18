<?php
	require __DIR__ .'/autoload/autoload.php';
	foreach ($_SESSION['product'] as $key => $value) {
		if($value['favourite']>10){
			$update=$db->update("product",array("hot"=>1),array('id'=>$key));
			$_SESSION['product'][$key]['hot']=1;
		}
		header('location:index.php');

	}
?>
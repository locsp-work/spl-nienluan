<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php 
	require_once __DIR__.'/autoload/autoload.php';

  if($_SERVER['REQUEST_METHOD'] == "GET"){
  	$data=[
    "slug"=>to_slug(getInput("name"))
  	];
  	$search=$db->fetchOne('product',"slug='".$data["slug"]."'");
  	if(count($search)>0){
  		header("location:chi-tiet-sp.php?id=".$search["id"]."");
  	}
  	else{
  		$_SESSION['error']="Không tìm thấy sản phẩm";
  		header("location:index.php");
  	}
  }
?>
</body>
</html>

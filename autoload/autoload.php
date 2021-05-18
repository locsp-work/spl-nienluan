<?php
  session_start();
  require_once $_SERVER['SERVER_NAME']. "/libraries/Database.php";
  require_once $_SERVER['SERVER_NAME']. "/libraries/Function.php";
  $db=new Database;
  $data_category=$db->fetchAll('category');
  $data_product=$db->fetchAll('product');
  $data_admin=$db->fetchAll('admin');
  $sql='SELECT * FROM product WHERE favourite!=1 LIMIT 4';
  $product_hot=$db->fetchsql($sql);
  define("ROOT",$_SERVER['DOCUMENT_ROOT']."uploads/");
?>

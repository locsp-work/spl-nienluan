<?php
  session_start();

  require_once("https://sploc-php.herokuapp.com/libraries/Database.php");
  require_once("https://sploc-php.herokuapp.com/libraries/Function.php");
  require('vendor/autoload.php');

  if(!isset($_SESSION['admin_id'])){
  	header('location:https://sploc-php.herokuapp.com/login');
  }
  $db=new Database;
  $data_category=$db->fetchAll('category');
  $data_product=$db->fetchAll('product');
  $data_admin=$db->fetchAll('admin');

  // define("ROOT",$_SERVER['DOCUMENT_ROOT']."/NienLuan/public/uploads/");
?>

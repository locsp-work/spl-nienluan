<?php $open="product"?>
<?php require_once __DIR__. "/../../autoload/autoload.php";?>
<?php require_once __DIR__. "/../../layouts/header.php"; ?>
<?php
  if($_SERVER['REQUEST_METHOD']!='GET') $p=1;
  if(isset($_GET['page'])){
    $p=$_GET['page'];
  }
  else{
    $p=1;
  }
  $sql="SELECT product.*,category.name as cate_name FROM product LEFT JOIN category on category.id=product.category_id";
  $product=$db->fetchJone('product',$sql,$p,10,true);
  if(isset($product['page'])){
    $sotrang= $product["page"];
    unset($product["page"]);
  }

?>

<div class="row">
   <div class="col-lg-12">
      <h1 class="page-header">
         Danh sách sản phẩm
         <a href="add.php" class="btn btn-success"><i class="fa fa-indent"></i> Thêm mới sản phẩm</a>
      </h1>
      <ol class="breadcrumb">
         <li class="breadcrumb-item active">
            <i class="fa fa-database"> </i> Danh sách sản phẩm
         </li>
      </ol>
      <?php require_once __DIR__. "/../../../notification/notification.php"; ?>
   </div>
</div>
<div class="table-responsive">
	<table class="table table-bordered table-hover">
		<thead align="center">
			<tr>
				<th>STT</th>
				<th>Name</th>
				<th>Slug</th>
        <th>Category</th>
        <th>Thumbnail</th>
        <th>Info</th>
				<th>Created_at</th>
        <th>Action</th>
			</tr>
		</thead>
    <?php $stt=1; foreach ($product as $value): ?>
      <tbody>
  			<tr>
          <td><?php echo $stt ?></td>
          <td><?php echo $value["name"] ?></td>
          <td><?php echo $value["slug"] ?></td>
          <td><?php echo $value["cate_name"] ?></td>
          <td><img src="<?php echo uploads()?>product/<?php echo $value["thumbnail"]; ?>" width="80px" height=auto ></td>
          <td>
            <ul class="disk">
              <li>Giá sản phẩm: <?php echo $value["price"] ?> VND</li>
              <li>Số lượng: <?php echo $value["warehouse"]?></li>
              <li>Sale : <?php echo $value["sale"]?></li>
            </ul>
          </td>
          <td><?php echo $value["created_at"] ?></td>
          <td width="20%">
            <a class="btn btn-xs btn-info" href="edit.php?id=<?php echo $value['id'] ?>"><i class="fa fa-edit"></i>Sửa</a>
            <a class="btn btn-xs btn-danger" href="remove.php?id=<?php echo $value['id'] ?>"><i class="fa fa-remove"></i>Xóa</a>
          </td>
  			</tr>
  		</tbody>
    <?php $stt++; endforeach; ?>
	</table>
</div>
<!-- Phân trang -->
<nav aria-label="Page navigation">
  <ul class="pagination justify-content-end">
    <li class="page-item <?php if ($p<=1 || $_SERVER['REQUEST_METHOD']!='GET') echo 'disabled';?>">
      <a class="page-link"  href="?page=<?php echo ($p<=1) ? 1 : $p-1?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <?php for ($i=1;$i<=$sotrang;$i++) : ?>
      <?php
        if($_SERVER['REQUEST_METHOD']!='GET') $p=1;
        if(isset($_GET["page"])){
          $p=$_GET["page"];
        }
        else{
          $p=1;
        }
      ?>
      <li class="page-item <?php echo ($i==$p) ? 'active' : '' ?>">
        <a class="page-link" href="?page=<?php echo $i ?>"><?php echo $i; ?></a>
      </li>
    <?php endfor; ?>
    <li class="page-item <?php if ($p>=$sotrang) echo 'disabled';?>">
      <a class="page-link" href="?page=<?php echo ($p==$sotrang) ? $sotrang : $p+1?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>
<?php require_once __DIR__. "/../../layouts/footer.php"?>

<?php $open="admin"?>
<?php require_once __DIR__. "/../../autoload/autoload.php";?>
<?php require_once __DIR__. "/../../layouts/header.php"; ?>
<?php
  if(isset($_GET['page'])){
    $p=$_GET['page'];
  }
  else{
    $p=1;
  }
  $sql="SELECT admin.* FROM admin ORDER BY ID DESC";
  $admin=$db->fetchJone('admin',$sql,$p,10,true);
  if(isset($admin['page'])){
    $sotrang= $admin["page"];
    unset($admin["page"]);
  }

?>

<div class="row">
   <div class="col-lg-12">
      <h1 class="page-header">
         Danh sách người quản trị
         <a href="add.php" class="btn btn-success"><i class="fa fa-fw fa-user-plus"></i> Thêm mới người quản trị</a>
      </h1>
      <ol class="breadcrumb">
         <li class="breadcrumb-item active">
            <i class="fa fa-cog fa-spin"> </i> Danh sách người quản trị
         </li>
      </ol>
      <?php require_once __DIR__. "/../../../notification/notification.php"; ?>
   </div>
</div>
<div class="table-responsive center">
	<table class="table table-bordered table-hover">
		<thead align="center">
			<tr>
				<th>STT</th>
				<th>Name</th>
        <th>Info</th>
				<th>Created_at</th>
        <th>Action</th>
			</tr>
		</thead>
    <?php $stt=1; foreach ($admin as $value): ?>
      <tbody>
  			<tr>
          <td><?php echo $stt ?></td>
          <td><?php echo $value["name"] ?></td>
          <td>
            <ul class="disk">
              <li>Email: <?php echo $value["email"] ?></li>
              <li>Số điện thoại: <?php echo $value["phone"]?></li>
              <li>Địa chỉ : <?php echo $value["address"]?></li>
            </ul>
          </td>
          <td><?php echo $value["create_at"] ?></td>
          <td>
            <a class="btn btn-xs btn-info" href="edit.php?id=<?php echo $value['id'] ?>"><i class="fa fa-user-edit"></i> Sửa</a>
            <a class="btn btn-xs btn-danger" href="remove.php?id=<?php echo $value['id'] ?>"><i class="fa fa-user-times"></i> Xóa</a>
          </td>
  			</tr>
  		</tbody>
    <?php $stt++; endforeach; ?>
	</table>
</div>
<!-- Phân trang -->
<nav aria-label="Page navigation">
  <ul class="pagination justify-content-end">
    <li class="page-item <?php if ($_GET['page']<=1) echo 'disabled';?>">
      <a class="page-link"  href="?page=<?php echo ($_GET['page']<=1) ? 1 : $_GET['page']-1?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <?php for ($i=1;$i<=$sotrang;$i++) : ?>
      <?php
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
    <li class="page-item <?php if ($_GET['page']>=$sotrang) echo 'disabled';?>">
      <a class="page-link" href="?page=<?php echo ($_GET['page']>=$sotrang) ? $sotrang : $_GET['page']+1?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>
<?php require_once __DIR__. "/../../layouts/footer.php"?>

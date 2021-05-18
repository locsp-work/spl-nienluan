<?php require_once __DIR__. "/../../autoload/autoload.php";?>
<?php $open="category";?>
<?php require_once __DIR__. "/../../layouts/header.php"; ?>
<div class="row">
   <div class="col-lg-12">
      <h1 class="page-header">
         Danh sách danh mục
         <a href="add.php" class="btn btn-success"><i class="fa fa-indent"></i> Thêm mới danh mục</a>
      </h1>
      <ol class="breadcrumb">
         <li class="breadcrumb-item active">
            <i class="fa fa-list-ul"> </i> Danh sách danh mục
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
          <th>Home</th>
  				<th>Created_at</th>
          <th>Action</th>
  			</tr>
  		</thead>
      <?php $stt=1; foreach ($data_category as $value): ?>
        <tbody align="center">
    			<tr>
            <td><?php echo $stt ?></td>
            <td><?php echo $value["name"] ?></td>
            <td><?php echo $value["slug"] ?></td>
            <td>
              <a class="<?php echo ($value["home"]==1) ? "btn btn-sm btn-success" : "btn btn-sm"?>" href="home.php?id=<?php echo $value['id'] ?>">
                <i class="fa fa-edit"></i>
                <?php echo ($value["home"]==0) ? "Không" : "Hiển thị"?>
              </a>
            </td>
            <td width="20%"><?php echo $value["created_at"] ?></td>
            <td width="20%">
              <a class="btn btn-sm btn-info" href="edit.php?id=<?php echo $value['id'] ?>"><i class="fa fa-edit"></i>Sửa</a>
              <a class="btn btn-sm btn-danger" href="remove.php?id=<?php echo $value['id'] ?>"><i class="fa fa-remove"></i>Xóa</a>
            </td>
    			</tr>
    		</tbody>
      <?php $stt++; endforeach; ?>
  	</table>
  </div>
</div>
<?php require_once __DIR__. "/../../layouts/footer.php"?>

<?php $open="transaction"?>
<?php require_once __DIR__. "/../../autoload/autoload.php";?>
<?php require_once __DIR__. "/../../layouts/header.php"; ?>
<?php
  if(isset($_GET['page'])){
    $p=$_GET['page'];
  }
  else{
    $p=1;
  }
  $sql="SELECT transaction.* , user.name as nameuser, user.phone as phoneuser FROM transaction LEFT JOIN user ON user.id = transaction.user_id ORDER BY ID DESC";
  $transaction=$db->fetchJone('transaction',$sql,$p,10,true);
  if(isset($transaction['page'])){
    $sotrang= $transaction["page"];
    unset($transaction["page"]);
  }

?>

<div class="row">
   <div class="col-lg-12">
      <h1 class="page-header">
         Danh sách giao dịch
      </h1>
      <ol class="breadcrumb">
         <li class="breadcrumb-item active">
            <i class="fa fa-cog fa-spin"> </i> Danh sách giao dịch
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
        <th>Trạng thái</th>
				<th>Created_at</th>
			</tr>
		</thead>
    <?php $stt=1; foreach ($transaction as $value): ?>
      <tbody align="center">
  			<tr>
          <td><?php echo $stt ?></td>
          <td><?php echo $value["nameuser"] ?></td>
          <td>
            <ul class="disk">
              <li>Số điện thoại: <?php echo $value["phoneuser"]?></li>
            </ul>
          </td>
          <td>
            <a href="status.php?id=<?php echo $value['id'] ?>" class="btn btn-sm <?php echo $value['status']==0 ? "btn-danger" : "btn-info" ?>"><?php echo $value['status']==0 ? "Chưa xử lý" : "Đã xử lý"?></a>
          </td>
          <td><?php echo $value["created_at"] ?></td>
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

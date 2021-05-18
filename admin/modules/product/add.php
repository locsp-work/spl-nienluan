<?php $open="product"; ?>
<?php
  require_once __DIR__. "/../../autoload/autoload.php";
  if($_SERVER['REQUEST_METHOD'] == "POST"){
    $data=[
      "name"=>postInput("name"),
      "slug"=>to_slug(postInput("name")),
      "price"=>postInput("price"),
      "thumbnail"=>postInput("thumbnail"),
      "detail"=>postInput("detail"),
      "sale"=>postInput("sale"),
      "warehouse"=>postInput("warehouse"),
      "category_id"=>postInput("category_id")
    ];

    $error=[];
    //Chua nhap vao danh muc
    if(postInput("category_id")==''){
      $error['category_id']="Mời bạn chọn loại sản phẩm";
    }
    if(postInput("name")==''){
      $error['name']= "Mời bạn nhập đầy đủ tên sản phẩm";
    }
    if(postInput("price")=='') {
      $error['price']="Mời bạn nhập đầy đủ giá sản phẩm" ;
    }elseif(!is_numeric(postInput("price"))){
      $error['price']="Mời bạn nhập đúng định dạng giá sản phẩm" ;
    }
    if(postInput("detail")==""){
      $error['detail']= "Mời bạn nhập đầy đủ mô tả sản phẩm";
    }
    if(isset($_FILES["thumbnail"])){
      $file_name=$_FILES["thumbnail"]["name"];
      $file_type=$_FILES["thumbnail"]["type"];
      $file_size=$_FILES["thumbnail"]["size"];
      $file_error=$_FILES["thumbnail"]["error"];
      $file_tmp = $_FILES['thumbnail']['tmp_name'];
      $file_ext=explode('.',$_FILES['thumbnail']['name']);
      $file_ext1=strtolower(end($file_ext));
      $type_sp= array("jpeg","jpg","png");
      if($file_size > 2097152){
         $error["thumbnail"]='Kích thước file không được lớn hơn 2MB';
      }else
      if(in_array($file_ext1,$type_sp)===false){
         $error["thumbnail"]="Chọn hình ảnh hỗ trợ upload file JPEG hoặc PNG";
      }else
      if($file_error==0){
         $data["thumbnail"]=$file_name;
         $path= ROOT."product/";
      }
    }
    if(empty($error)){
      $isset=$db->fetchOne("product","name='".$data["name"]."'");
      if(count($isset)>0){
        $_SESSION["error"]="Sản phẩm đã tồn tại! Mời nhập lại";
      }
      else{
        $thumb_insert=$db->insert("product",$data);
        if($thumb_insert){
          move_uploaded_file($file_tmp, $path.$file_name);
          $_SESSION['success']="Thêm mới sản phẩm thành công";
          redirectAdmin("product");
        }
      }
     }
}
?>
<?php require_once __DIR__. "/../../layouts/header.php"; ?>
<div class="row">
   <div class="col-lg-12">
      <h1 class="page-header">
         Thêm mới sản phẩm
      </h1>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
           <li class="breadcrumb-item" aria-current="page">
              <i class="fa fa-database"></i><a href="index.php?page=1"> Danh sách sản phẩm </a>
           </li>
           <li class="breadcrumb-item active" aria-current="page">
              <i class="fa fa-indent"></i> Thêm mới sản phẩm
           </li>
        </ol>
      </nav>
   </div>
</div>
<div class="row">
  <div class="col-lg-12">
    <form class="form-horizontal" action="" id="form1" method="POST" enctype="multipart/form-data">
      <?php require_once __DIR__. "/../../../notification/notification.php"; ?>
      <!-- Danh mục sản phẩm -->
      <div class="form-row">
        <div class="form-group col-md-12">
          <label >Chọn danh mục sản phẩm</label>
          <select class="form-control" name="category_id">
            <option value=""> --Mời bạn chọn danh mục sản phẩm-- </option>
            <?php foreach ($data_category as $value): ?>
              <option value="<?php echo $value["id"] ?>"> <?php echo $value["name"]?> </option>
            <?php endforeach ?>
          </select>
          <?php if(!empty($error['category_id'])): ?>
            <p class="text-danger"><?php echo $error['category_id'] ?></p>
          <?php endif ?>
        </div>
      </div>
      <!-- Tên sản phẩm -->
      <div class="form-row">
        <div class="form-group col-md-12">
          <label>Thêm sản phẩm</label>
          <input type="text" class="form-control" name="name" placeholder="Nhập tên sản phẩm cần thêm">
          <?php if(isset($error['name'])): ?>
            <p class="text-danger"><?php echo $error['name'] ?></p>
          <?php endif ?>
        </div>
      </div>
      <!-- Giá sản phẩm và số lượng-->
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="giasp">Giá sản phẩm</label>
          <input type="text" id="giasp" class="form-control"  name="price" placeholder="Nhập giá sản phẩm">
          <?php if(isset($error['price'])): ?>
            <p class="text-danger"><?php echo $error['price'] ?></p>
          <?php endif ?>
        </div>
        <div class="form-group col-md-6">
          <label for="soluong">Số lượng</label>
          <input type="text" class="form-control" id="soluong" name="warehouse" placeholder="Nhập số lượng sản phẩm cần thêm">
        </div>
      </div>
      <!-- Giảm giá và hình ảnh sản phẩm -->
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="giamgia">Giảm giá</label>
          <input type="number" class="form-control"  name="sale" placeholder="Giảm 10%" value="0">
        </div>
        <div class="form-group col-md-6">
          <label for="hinhanh">Hình ảnh</label>
          <input type="file" class="form-control"  name="thumbnail">
          <?php if(isset($error['thumbnail'])): ?>
            <p class="text-danger"><?php echo $error['thumbnail'] ?></p>
          <?php endif ?>
        </div>
      </div>
      <!-- Mô tả sản phẩm -->
      <div class="form-row">
      <div class="col-md-12">
          <label>Mô tả</label>
          <textarea class="form-control"  name="detail" rows="4" placeholder="Nhập mô tả sản phẩm"></textarea>
          <?php if(isset($error['detail'])): ?>
            <p class="text-danger"><?php echo $error['detail'] ?></p>
          <?php endif ?>
        </div>
      </div>
      <!-- submit -->
      <div class="form-row">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-success">Thêm vào</button>
        </div>
      </div>
    </form>
  </div>
</div>
<?php require_once __DIR__. "/../../layouts/footer.php"?>

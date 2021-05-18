<script type="text/javascript">
  window.setTimeout(function () {
    $(".alert-success,.alert-danger").fadeTo(500, 0).slideUp(500, function () {
        $(this).remove();
    });
  }, 4000);
</script>
<?php if(isset($_SESSION['success'])): ?>
  <div class="alert alert-success" data-dismiss="alert">
    <strong>Thành công: </strong><?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
  </div>
<?php endif ?>
<?php if(isset($_SESSION['error'])): ?>
  <div class="alert alert-danger" data-dismiss="alert">
    <strong>Thất bại: </strong><?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
  </div>
<?php endif ?>
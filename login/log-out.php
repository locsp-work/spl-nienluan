<?php
	session_start();
	unset($_SESSION['name_user']);
	unset($_SESSION['name_id']);
	echo '<script>location.href="index.php"</script>'
?>
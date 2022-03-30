<?php
//lanjutkan session yang sudah dibuat sebelumnya

//hapus session yang sudah dibuat
include './config.php';
session_start();
session_destroy();

?>
<script>
	window.location = '<?php echo $urlbase;?>';
</script>

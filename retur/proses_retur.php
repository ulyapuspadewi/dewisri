<?php

include '../config.php';
session_start();

$id_barang = $_GET['id_barang'];
$id_transaksi = $_GET['id_transaksi'];
$qty        = $_GET['qty'];
$kode_unik  = $_GET['kode_unik'];

if ($qty > 0) {
  $sql = "INSERT INTO retur (id_retur, id_member, tgl_retur, status_retur, kode_unik, id_barang, id_transaksi, jumlah)
          VALUES ('', '".$_SESSION['id']."','".date('Y-m-d')."', 'menunggu', '".$kode_unik."', '".$id_barang."', '".$id_transaksi."', '".$qty."')
  ";
  $simpan = mysqli_query($link, $sql);
  if($simpan){
    echo '
    <script>
      alert("retur berhasil disimpan");
      window.location.href="'.$urlbase.'retur";
    </script>
    ';
  }
}else {
echo '<script>
  alert("jumlah retur kosong");
  window.location.href="'.$urlbase.'retur";
</script>
';
}

 ?>

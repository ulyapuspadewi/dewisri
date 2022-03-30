<?php
include './config.php';
include './function.php';
session_start();

@$alamat = $_POST['alamat'];
@$nama = $_POST['nama'];
@$notelp = $_POST['notelp'];
$total = $_POST['total'];
$jenis_kirim = $_POST['jenis_kirim'];
$kirim = $_POST['kirim'];
$berat      = $_POST['berat'];
$member_id  = $_POST['member_id'];
$kode_unik  = rand(000,999);

  $query = "INSERT into transaksipenjualan
            (id_transaksi, id_member, id_admin, kode_unik, tanggalTransaksi, totalBayar, nama_tujuan, notelp_tujuan, alamat_tujuan, jenis_kirim, kirim_ke, status, berat)
            VALUES
            ('','".$member_id."', '".null."', '".$kode_unik."','".date('Y-m-d H:i:s')."', '".$total."', '".$nama."', '".$alamat."', '".$notelp."', '".$jenis_kirim."', '".$kirim."', 'menunggu','".$berat."')
            ";
  mysqli_query($link, $query);

$transaksi_id = mysqli_insert_id($link);
$simpan = false;
if(!empty($_SESSION['cart_product'][@$_SESSION['id']])){
  foreach ($_SESSION['cart_product'][$_SESSION['id']] as $key => $value) {
    $sql = "SELECT * FROM barang WHERE id_barang = '".$value['id_produk']."'";
    $hasil = mysqli_query($link, $sql);
    $dt = mysqli_fetch_assoc($hasil);
    $qwr = "INSERT INTO detailtransaksipenjualan
            (id_detail, id_transaksi, id_barang, berat_satuan)
            VALUES
            ('', '".$transaksi_id."', '".$dt['id_barang']."', '".$value['berat']."')
    ";
    $simpan = mysqli_query($link, $qwr);
  }
}
$_SESSION['rand_id'] = $kode_unik;
unset($_SESSION['cart_product'][$_SESSION['id']]);
$result['success'] = $simpan;
print_r(json_encode($result));
 ?>

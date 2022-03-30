<?php

include '../config.php';
include '../function.php';
session_start();

if (empty($_SESSION['memberChar'])) {
  echo '<script>alert("anda harus login");window.location.href="'.$urlbase.'login.php"</script>';
}

// get the product id
$id = isset($_GET['id']) ? $_GET['id'] : 1;
// make quantity a minimum of 1
@$kategori= $_GET['kategori'];
$cart_id      = $_SESSION['id'];
@$hrg          = $_GET['hrg'];
@$berat        = $_GET['berat'];
@$id_kategori  = $_GET['id_kategori'];
@$subtotal     = $hrg * $berat;

$aksi = $_GET['act'];
switch ($aksi) {
  case 'add':
  // cart SessionHandler
  if(!empty($_SESSION['cart_product'][$cart_id][$id])){
    $_SESSION['cart_product'][$cart_id][$id]['id_produk']   = $id;
    $_SESSION['cart_product'][$cart_id][$id]['berat']         = $berat;
    $_SESSION['cart_product'][$cart_id][$id]['hrg_item']    = $hrg;
    $_SESSION['cart_product'][$cart_id][$id]['subtotal']    = $subtotal;
    $_SESSION['cart_product'][$cart_id][$id]['id_kategori'] = $id_kategori;
    $_SESSION['cart_product'][$cart_id][$id]['tujuan']      = null;
    $_SESSION['cart_product'][$cart_id][$id]['biaya_kirim'] = null;
    $_SESSION['cart_product'][$cart_id][$id]['total']       = null;
  }else {
    $_SESSION['cart_product'][$cart_id][$id]['id_produk']   = $id;
    $_SESSION['cart_product'][$cart_id][$id]['berat']         = $berat;
    $_SESSION['cart_product'][$cart_id][$id]['hrg_item']    = $hrg;
    $_SESSION['cart_product'][$cart_id][$id]['subtotal']    = $hrg;
    $_SESSION['cart_product'][$cart_id][$id]['id_kategori'] = $id_kategori;
    $_SESSION['cart_product'][$cart_id][$id]['tujuan']      = null;
    $_SESSION['cart_product'][$cart_id][$id]['biaya_kirim'] = null;
    $_SESSION['cart_product'][$cart_id][$id]['total']       = null;
  }
    echo '<script>window.location.href="'.$urlbase.'produk/detailproduk.php?urlBarang='.$kategori.'"</script>';
    break;

  case 'update':
  $tujuan      = (isset($_GET['tujuan'])) ? $_GET['tujuan'] : null;
  $biaya_kirim = (isset($_GET['biaya_kirim'])) ? $_GET['biaya_kirim'] : null;
  $total       = $_SESSION['cart_product'][$cart_id][$id]['subtotal'] + $biaya_kirim;
  $_berat         = $berat;
  $sbtot       = $_SESSION['cart_product'][$cart_id][$id]['subtotal'] * $_berat;
  // cart SessionHandler
  $_SESSION['cart_product'][$cart_id][$id]['berat']         = $_berat;
  $_SESSION['cart_product'][$cart_id][$id]['subtotal']    = $subtotal;
  $_SESSION['cart_product'][$cart_id][$id]['tujuan']      = $tujuan;
  $_SESSION['cart_product'][$cart_id][$id]['biaya_kirim'] = $biaya_kirim;
  $_SESSION['cart_product'][$cart_id][$id]['total']       = $total;
    echo '<script>window.location.href="'.$urlbase.'produk/detailproduk.php?urlBarang='.$kategori.'"</script>';
    break;

  case 'delete':
  // cart SessionHandler
  unset($_SESSION['cart_product'][$cart_id][$id]);
    echo '<script>window.location.href="'.$urlbase.'produk/detailproduk.php?urlBarang='.$kategori.'"</script>';
    break;

  default:
    # code...
    break;
}
 ?>

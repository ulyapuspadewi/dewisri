<?php
include '../config.php';
include '../function.php';
session_start();
if (empty($_SESSION['id'])) {
  echo '<script>alert("anda harus login");window.location.href="'.$urlbase.'login.php"</script>';
}
 ?>
 <?php include '../header.php'; ?>
 <?php include '../menu.php'; ?>
 <div class="single-product-area">
 <div class="zigzag-bottom"></div>
 <div class="container">
     <div class="row">

												<div class="col-sm-12">
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>Nama Item</th>
                                <th>Rasa</th>
                                <th>Qty</th>
                                <th>Tambah</th>
                                <th>Harga Per Item</th>
                                <th>#</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php if(!empty($_SESSION['cart_product'][@$_SESSION['id']])){
                                $no = 1;
                                foreach ($_SESSION['cart_product'][$_SESSION['id']] as $key => $value) {
                                  $sql = "SELECT * FROM barang b, kategoribarang k WHERE b.id_kategori=k.id_kategori and id_barang = '".$value['id_produk']."'";
                    							$hasil = mysqli_query($link, $sql);
                                  $dt = mysqli_fetch_assoc($hasil);
                                  $max = $dt['stok'] - $value['qty'];
                                  echo '<tr>';
                                    echo '<td>'.$no.'</td>';
                                    echo '<td>'.$dt['namaKb'].'</td>';
                                    echo '<td>'.$dt['namaBarang'].'</td>';
                                    echo '<td>'.$value['qty'].'</td>';
                                    echo '<td><input type="number" id="in'.$no.'" value="0" style="width:70px" min="0" max="'.$max.'" class="form-control"></td>';
                                    echo '<td>'.FormatRupiah($value['hrg_item']).'</td>';
                                    echo '<td>
                                          <a href="javascript:void(0);" onclick="update('.$value['id_produk'].', '.$no.');" class="btn btn-xs btn-info">Update</a> |
                                          <a href="javascript:void(0);" onclick="hapus('.$value['id_produk'].');" class="btn btn-xs btn-danger">Hapus</a></td>';
                                  echo '</tr>';
                                  $no++;
                                }
                              }else {
                                echo '<tr>';
                                  echo '<td colspan="6" align="center">Keranjang Kosong</td>';
                                echo '</tr>';
                              } ?>
                            </tbody>
                          </table>
												</div>

              <button type="button" class="btn btn-info pull-right" onclick="checkout();">Checkout <i class="fa fa-arrow-right"></i></button>
						</div>
					</div>

					</div>


	 <?php include '../footer.php'; ?>
   <script>
     function update(id, dtid) {
       var qty = $('#in'+dtid).val();
       window.location.href="<?php echo $urlbase;?>cart/cart_function.php?act=update&id="+id+"&quantity="+qty;
     }

     function hapus(id) {
       window.location.href="<?php echo $urlbase;?>cart/cart_function.php?act=delete&id="+id;
     }

     function checkout() {
       window.location.href="<?php echo $urlbase;?>checkout";
     }
   </script>

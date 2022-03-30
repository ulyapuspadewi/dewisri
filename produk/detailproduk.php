<?php
	include '../config.php';
	include '../function.php';
	session_start();
	if($_GET['urlBarang'])
    {
        // $url1       = mysqli_real_escape_string($_GET['urlkat']);
        $url    = $_GET['urlBarang']; //Friendly URL
        $sql    = "SELECT b.id_barang, b.id_kategori, b.id_admin, b.namaBarang, b.deskripsi, b.gambar, b.berat, b.stok, b.harga, b.status, b.urlBarang, k.id_kategori, k.namaKb, k.hargakg, k.url, k.statusKb
                    FROM barang b, kategoribarang k WHERE k.id_kategori=b.id_kategori and k.statusKb='Publish' and urlBarang = '$url'";
        $proses = mysqli_query($link,$sql);
        $data   = mysqli_fetch_array($proses);
    }
    else
    {
       ?>
            <script>
                window.location = '$urlbase';
            </script>
            <?php
    }
 ?>
	 <?php include '../header.php'; ?>
	 <?php include '../menu.php'; ?>


	 <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-content-right">

                        <div class="row">
                            <div class="col-md-12"><h2><?php echo $data['namaKb'] ?></h2>
														</div>
                            <div class="col-sm-3">
                                <div class="product-images">
                                    <div class="product-main-img">
                                        <img src="<?php echo $urlbase."admin/img/".$data['gambar']?>" alt="">
																				<!-- <div class="col-sm-6"> -->
																						<p>* Jika anda adalah member dengan pembelian pertama, anda hanya dapat melakukan pesanan dengan minimal 30 Bungkus, pesannan selanjutnya anda hanya perlu dengan jumlah minimal 12 Bungkus</p>
																				<!-- </div> -->
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-2">
                                 <table class="table">
                                <thead>
                                    <tr>
                                        <th>Pilih Rasa</th>
                                        <th>Stok</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 <?php
                                    $sqlrasa  = "SELECT * FROM barang b, kategoribarang k WHERE b.urlBarang='$url' and b.id_kategori=k.id_kategori AND k.statusKb='Publish'";
                                    //echo $sqlrasa;
                                    $prosesrasa = mysqli_query($link,$sqlrasa);
                                    while ($datarasa = mysqli_fetch_array($prosesrasa)) {
                            ?>
                                    <tr>

                                        <td>
																					<?php if($datarasa['stok'] == '1'){?>
																						<a href="<?php echo $urlbase.'cart/cart_function.php?act=add&id='.$datarasa['id_barang'].'&hrg='.$datarasa['harga'].'&id_kategori='.$datarasa['id_kategori'].'&berat=1'.'&kategori='.$_GET['urlBarang'];?>"><?php echo $datarasa['namaBarang']; ?></a>
																					<?php }else{
																						echo $datarasa['namaBarang'];
																					}?>
																				</td>
                                        <td><?php echo ($datarasa['stok'] == '1') ? 'Tersedia' : 'Kosong'; ?></td>
                                    </tr>
                                    <?php } ?>

                                </tbody>

                            </table>
                            </div>

                            <div class="col-sm-7">
                               <table class="table table-hover">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>Produk</th>
                                <th>Rasa</th>
                                <th>Masukkan Jumlah</th>
                                <th>#</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $berat = 0; if(!empty($_SESSION['cart_product'][@$_SESSION['id']])){
                                $no = 1;
                                foreach ($_SESSION['cart_product'][$_SESSION['id']] as $key => $value) {
                                  $sql = "SELECT * FROM barang b, kategoribarang k WHERE b.id_kategori=k.id_kategori and id_barang = '".$value['id_produk']."'";
                                                $hasil = mysqli_query($link, $sql);
                                  $dt = mysqli_fetch_assoc($hasil);
																	$berat = $berat + $value['berat'];
                                  echo '<tr>';
                                    echo '<td>'.$no.'</td>';
                                    echo '<td>'.$dt['namaKb'].'</td>';
                                    echo '<td>'.$dt['namaBarang'].'</td>';
                                    echo '<td><input type="number" value="'.$value['berat'].'" min="0" id="in'.$no.'" style="width:70px" class="form-control"></td>';
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

														<tfoot>
															<tr>
                                <th></th>
                                <th></th>
                                <th>Harga Per Bungkus</th><?php
																	$sql1  = "SELECT * FROM kategoribarang WHERE url='".$_GET['urlBarang']."'";
																	//echo $sqlrasa;
																	$dt2 = mysqli_query($link,$sql1);
																	$dt = mysqli_fetch_array($dt2);
																?>
                                <th><?php echo FormatRupiah($dt['hargakg']);?> /500gr</th>
                              </tr>
                              <tr>
                                <th></th>
                                <th></th>
                                <th>Total Jumlah</th>
                                <th><?php echo $berat;?> Bungkus</th>
                              </tr>
                              <tr>
                                <th></th>
                                <th></th>
                                <th>Total Harga</th>
                                <th><?php $total_harga = $dt['hargakg'] * $berat;
																echo FormatRupiah($total_harga);?></th>
                              </tr>
                            </tfoot>
                          </table>
                            </div>
                              <button type="button" class="btn btn-info pull-right" onclick="checkout();">Checkout <i class="fa fa-arrow-right"></i></button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


	 <?php include '../footer.php'; ?>
	 <?php
	 $sql3  = "SELECT * FROM transaksipenjualan WHERE id_member='".$_SESSION['id']."'";
	 //echo $sqlrasa;
	 $dt3 = mysqli_query($link,$sql3);
	 $dt1 = mysqli_num_rows($dt3);
	 ?>
<script>
     function update(id, dtid) {
       var berat = $('#in'+dtid).val();
       window.location.href="<?php echo $urlbase;?>cart/cart_function.php?act=update&id="+id+"&hrg="+<?php echo $dt['hargakg'];?>+"&berat="+berat+"&kategori=<?php echo $_GET['urlBarang'];?>";
     }

     function hapus(id) {
       window.location.href="<?php echo $urlbase;?>cart/cart_function.php?act=delete&id="+id+"&kategori=<?php echo $_GET['urlBarang'];?>";
     }

     function checkout() {
			 var jml_transaksi = '<?php echo $dt1;?>';
			 var berat = '<?php echo $berat;?>';
			 if (parseInt(jml_transaksi) < 1) {
				 if (parseInt(berat) < 30) {
				 		alert('sebagai member baru anda hanya dapat melakukan pesanan dengan jumlah minimal 30 Bungkus')
				 }else {
				 		window.location.href="<?php echo $urlbase;?>checkout";
				 }
			 }else {
				 if (parseInt(berat) < 12) {
					 alert('jumlah yang anda pesan kurang dari 12 Bungkus');
				 }else {
				 		window.location.href="<?php echo $urlbase;?>checkout";
				 }
			 }
     }

     function cart() {

     }
   </script>

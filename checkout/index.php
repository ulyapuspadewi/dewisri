<?php
include '../config.php';
include '../function.php';
session_start();
error_reporting(0);
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

              <legend>Detail Pesanan</legend>
							<div class="">
								<div class="row">
                  <div class="col-sm-6">
                    <?php
                      $sql_member = "SELECT * FROM member WHERE id_member = '".$_SESSION['id']."'";
                      $hasil_member = mysqli_query($link, $sql_member);
                      $dt_member = mysqli_fetch_assoc($hasil_member);
                     ?>
                    Atas Nama : <label><?php echo $dt_member['nama'];?></label><br>
                    No Telp : <label><?php echo $dt_member['noHp'];?></label><br>
                    Email : <label><?php echo $dt_member['email'];?></label><br>
                    <!-- Kota : <label><?php echo $dt_member['Kota'];?></label><br> -->
                    Alamat : <label><?php echo $dt_member['alamat'];?></label>
                  </div>
                  <div class="col-sm-6">
                    Bagaimana barang sampai ke anda ? <br><br>
                              <label class="radio-inline">
                                <input type="radio" name="jenis_kirim" id="radio3" value="1">
                                Ambil sendiri <br><small>* Wajib membawa nota pembelian</small>
                              </label><br>
                              <label class="radio-inline">
                                <input type="radio" name="jenis_kirim" id="radio4" value="2"> Kirim <br><small>* Hanya berlaku untuk Daerah Istimewa Yogyakarta dan Jawa Tengah dengan bebas biaya kirim</small>
                              </label><br><br>

                    <!--<div id="ambil" hidden>
                       Tanggal Pengambilan : <input type="date" class="form-control" id="tanggalAmbil"><br>
                    </div>-->

                    <div id="kirim" hidden>
                      Kirim Ke : <label class="radio-inline">
                                  <input type="radio" name="kirim_ke" id="radio1" value="1"> Alamat Profil
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="kirim_ke" id="radio2" value="2"> Alamat Lain
                                </label><br><br>
                                <p>Dapatkan produk anda dalam kurun waktu seminggu setelah pesan,<br> sesuai agenda Dewi Sri</p>
                      Alamat Tujuan : <textarea name="alamat_tujuan" class="form-control" id="alamat_tujuan"></textarea><br>
                      Nama : <input class="form-control" id="nama_tujuan"><br>
                      Notelp : <input type="number" class="form-control" id="notelp_tujuan"><br>
                    </div>

                    <input type="text" id="jenis_kirim" hidden>
                    <input type="text" id="kirim_ke" hidden>


                  </div>
												<div class="col-sm-12"><br>
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>Rasa</th>
                                <th>Berat</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              $berat = 0;
                              $kid = 0;
                              if(!empty($_SESSION['cart_product'][@$_SESSION['id']])){
                                $no = 1;
                                $total = 0;
                                foreach ($_SESSION['cart_product'][$_SESSION['id']] as $key => $value) {
                                  $sql = "SELECT * FROM barang WHERE id_barang = '".$value['id_produk']."'";
                    							$hasil = mysqli_query($link, $sql);
                                  $dt = mysqli_fetch_assoc($hasil);
                                  $total = $total + $value['subtotal'];
                                  $berat = $berat + $value['berat'];
                                  $kid = $dt['id_kategori'];
                                  echo '<tr>';
                                    echo '<td>'.$no.'</td>';
                                    echo '<td>'.$dt['namaBarang'].'</td>';
                                    echo '<td>'.$value['berat'].' Bungkus</td>';
                                  echo '</tr>';
                                  $no++;
                                }
                              }else {
                                echo '<tr>';
                                  echo '<td colspan="6" align="center">Keranjang Kosong</td>';
                                echo '</tr>';
                              } ?>
                            </tbody>
                            <thead>
                              <tr>
                                <th></th>
                                <th>Total Jumlah</th>
                                <th><label><?php echo $berat;?> Bungkus</label></th>
                              </tr>
                              <tr>
                                <th></th>
                                <th>Harga Per Bungkus</th><?php
																	$sql1  = "SELECT * FROM kategoribarang WHERE id_kategori='".$kid."'";
																	//echo $sqlrasa;
																	$dt2 = mysqli_query($link,$sql1);
																	$dt = mysqli_fetch_array($dt2);
																?>
                                <th><?php echo FormatRupiah($dt['hargakg']);?></th>
                              </tr>
                              <tr>
                                <th></th>
                                <th>Total</th>
                                <th><label><?php $total_byr = $dt['hargakg']*$berat; echo FormatRupiah($total_byr);?></label></th>
                              </tr>
                            </thead>
                          </table>
												</div>
								</div><!-- /.row -->
							</div><!-- /.category-product --><br>
              <input type="hidden" id="berat" class="form-control" name="berat" value="1"><br>
              <button type="button" class="btn btn-info pull-right" onclick="simpan();">Bayar</button>
						</div>
					</div>

					</div><!-- /.scroll-tabs -->
				</div>
<?php include '../footer.php'; ?>
  <script>

    $('#radio2').click(function () {
      $('#alamat_tujuan').attr('required', true);
      $('#kirim_ke').val('2');
    });

    $('#radio1').click(function () {
      $('#alamat_tujuan').attr('required', false);
      $('#kirim_ke').val('1');
    });


    $('#radio4').click(function () {
      $('#kirim').show();
      //$('#ambil').hide();
      $('#jenis_kirim').val('2');
    });

    $('#radio3').click(function () {
      //$('#ambil').show();
      $('#kirim').hide();
      $('#jenis_kirim').val('1');
        $('#kirim_ke').val('');
    });


  </script>

   <script>

     function simpan() {
       var jenis_kirim = $('#jenis_kirim').val();
       var kirim_ke = $('#kirim_ke').val();
       var berat    = '<?php echo $berat;?>';
       var total    = '<?php echo $total_byr;?>';
       if (jenis_kirim == '') {
         alert('anda belum memilih jenis kirim');
       }else {
         if (jenis_kirim == '1') {
           $.ajax({
                 url   : '<?php echo $urlbase.'proses_transaksi.php'?>',
                 data : {
                   berat     : berat,
                   jenis_kirim : jenis_kirim,
                   kirim : kirim_ke,
                   total : total,
                   member_id : '<?php echo $_SESSION['id'];?>'
                 },
                 type : 'POST',
                 dataType : 'jSON',
                 success : function (r) {
                   if (r.success == true) {
                     alert('data berhasil disimpan');
                     window.location.href = "<?php echo $urlbase.'/checkout/berhasil.php?member_id='.$_SESSION['id'];?>";
                   }else {
                     alert('data gagal disimpan');
                   }
                 }
               });
         }else {
           if (kirim_ke == '') {
              alert('anda belum memilih kirim ke');
           }else {
             if (kirim_ke == '1') {
               $.ajax({
                     url   : '<?php echo $urlbase.'proses_transaksi.php'?>',
                     data : {
                       berat     : berat,
                       jenis_kirim : jenis_kirim,
                       kirim : kirim_ke,
                       total : total,
                       member_id : '<?php echo $_SESSION['id'];?>'
                     },
                     type : 'POST',
                     dataType : 'jSON',
                     success : function (r) {
                       if (r.success == true) {
                         alert('data berhasil disimpan');
                         window.location.href = "<?php echo $urlbase.'/checkout/berhasil.php?member_id='.$_SESSION['id'];?>";
                       }else {
                         alert('data gagal disimpan');
                       }
                     }
                   });
             }else {
               if ($('#alamat_tujuan').val() == '') {
                 alert('anda belum mengisi alamat');
               }else if ($('#nama_tujuan').val()=='') {
                 alert('anda belum mengisi nama');
               }else if ($('#notelp_tujuan').val() == '') {
                 alert('anda belum mengisi no telp');
               }else {
                 $.ajax({
                       url   : '<?php echo $urlbase.'proses_transaksi.php'?>',
                       data : {
                         alamat    : $('#notelp_tujuan').val(),
                         nama      : $('#nama_tujuan').val(),
                         notelp    : $('#alamat_tujuan').val(),
                         berat     : berat,
                         jenis_kirim : jenis_kirim,
                         kirim : kirim_ke,
                         total : total,
                         member_id : '<?php echo $_SESSION['id'];?>'
                       },
                       type : 'POST',
                       dataType : 'jSON',
                       success : function (r) {
                         if (r.success == true) {
                           alert('data berhasil disimpan');
                           window.location.href = "<?php echo $urlbase.'/checkout/berhasil.php?member_id='.$_SESSION['id'];?>";
                         }else {
                           alert('data gagal disimpan');
                         }
                       }
                     });
               }
             }
           }
         }
       }
     }

</script>

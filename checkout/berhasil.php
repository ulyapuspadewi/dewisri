<?php
include '../config.php';
include '../function.php';
session_start();
if (empty($_SESSION['id'])) {
  echo '<script>alert("anda harus login");window.location.href="'.$urlbase.'login.php"</script>';
}
$member_id = $_GET['member_id'];
if(!empty($member_id)){
 ?>

 <?php include '../header.php'; ?>
  <?php include '../menu.php'; ?>
      <style>
      @media print {
          body * {
            visibility: hidden;
            position: absolute;
            width: 100%;
            top: 0;
          }
          #myTabContent * {
            visibility: visible;
            position: relative;
            /*left: 0;*/
            /*width: 100%;*/
            top: 0;
          }
          }
      </style>

      <div class="single-product-area">
      <div class="zigzag-bottom"></div>
      <div class="container">
								<div class="row" id="myTabContent" >
                  <div class="col-sm-6">
                    <?php
                      $sql_member = "SELECT * FROM member as A
                                    LEFT JOIN transaksipenjualan as B
                                    ON A.id_member = B.id_member
                                    WHERE A.id_member = '".$member_id."'
                                    AND B.kode_unik = '".$_SESSION['rand_id']."'
                                    AND B.status = 'menunggu'";
                      $hasil_member = mysqli_query($link, $sql_member);
                      $dt_member = mysqli_fetch_assoc($hasil_member);
                     ?>
                    <?php if($dt_member['jenis_kirim'] != '1'){
                      if ($dt_member['kirim_ke'] == '1') {?>
                        Atas Nama : <label><?php echo $dt_member['nama'];?></label><br>
                        No Telp : <label><?php echo $dt_member['noHp'];?></label><br>
                        Alamat : <label><?php echo $dt_member['alamat'];?></label>
                      <?php
                    }else {?>
                      Atas Nama : <label><?php echo $dt_member['nama_tujuan'];?></label><br>
                      No Telp : <label><?php echo $dt_member['notelp_tujuan'];?></label><br>
                      Alamat : <label><?php echo $dt_member['alamat_tujuan'];?></label>
                    <?php }
                  }else {?>
                    Atas Nama : <label><?php echo $dt_member['nama'];?></label><br>
                    No Telp : <label><?php echo $dt_member['noHp'];?></label><br>
                    Alamat : <label><?php echo $dt_member['alamat'];?></label>
                <?php  }?>
                  </div>
												<div class="col-sm-6" id="cetak"><br>
                          <p>Transaksi anda berhasil kami simpan, dan akan segera kami proses setelah anda
                              melakukan transfer sejumlah <br>
                              <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th>Total Belanja</th>
                                    <th>Kode Unik</th>
                                    <th>Jumlah Transfer</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td><?php echo FormatRupiah($dt_member['totalBayar']);?></td>
                                    <td><?php echo FormatRupiah($dt_member['kode_unik']);?></td>
                                    <td><?php echo FormatRupiah($dt_member['totalBayar']+$dt_member['kode_unik']);?></td>
                                  </tr>
                                </tbody>
                              </table>
                              Mohon lakukan pembayaran hanya pada beberapa rekening berikut : <br>
                              <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th>No</th>
                                    <th>Bank</th>
                                    <th>A.N</th>
                                    <th>Nomor Rekening</th>
                                  </tr>
                                </thead>
                                <tbody>
                              <?php
                                $sql = "SELECT * FROM rekeningbank";
                                $hasil = mysqli_query($link, $sql);
                                $no = 1;
                                while ($dt = mysqli_fetch_assoc($hasil)) {
                                  echo '<tr>';
                                    echo '<td>'.$no.'</td>';
                                    echo '<td>'.$dt['bankRekening'].'</td>';
                                    echo '<td>'.$dt['namaRekening'].'</td>';
                                    echo '<td>'.$dt['noRekening'].'</td>';
                                  echo '</tr>';
                                  $no++;
                                }
                               ?>
                             </tbody>
                             </table>
                             <p class="noprint">
                               Setelah melakukan transfer, mohon untuk segera melakukan konfirmasi pembayaran pada halaman berikut<br>
                               <a href="<?php echo $urlbase.'/konfirmasi';?>">Konfirmasi Pembayaran</a>
                             </p>
                          </p>
												</div>
								</div>
                <button type="button" class="btn btn-info pull-right" onclick="cetak();">Cetak</button>
                <a href="<?php echo $urlbase;?>"class="btn btn-primary">Tutup</a>
							</div>
						</div>
					</div>


	 <?php include '../footer.php'; ?>
   <script>
     function cetak() {
       var mywindow = window.open('', 'PRINT', 'height=600,width=800');
       mywindow.document.write('<html>');
    mywindow.document.write('</head><body >');
    mywindow.document.write('<center><h1>BUKTI TRANSAKSI</h1></center>');
    mywindow.document.write('<center><h3>DEWI SRI</h3></center>');
    mywindow.document.write('<p>Berikut ini adalah bukti transaksi anda di DEWI SRI, mohon simpan data ini sebagai bukti ketika anda akan melakukan pembayaran atau ketika anda akan melakukan pengambilan barang.</p><br><br><br>');
    mywindow.document.write(document.getElementById('myTabContent').innerHTML);
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/
          mywindow.print();
          mywindow.close();
     }
   </script>
<?php }?>

<?php
include '../config.php';
include '../function.php';
session_start();
if (empty($_SESSION['id'])) {
  echo '<script>alert("anda harus login");window.location.href="'.$urlbase.'login.php"</script>';
}

if (isset($_POST['simpan'])) {
  if (empty($_SESSION['id'])) {
    echo '<script>alert("anda harus login");window.location.href="'.$urlbase.'login.php"</script>';
  }else {
    $q = "UPDATE member SET nama = '".$_POST['nama']."',
                            namaToko = '".$_POST['namaToko']."',
                            NIK = '".$_POST['NIK']."',
                            email = '".$_POST['email']."',
                            jenisKelamin = '".$_POST['jk']."',
                            alamat = '".$_POST['alamat']."',
                            noHp = '".$_POST['notelp']."',
                            Provinsi = '".$_POST['provinsi']."',
                            Kota = '".$_POST['kota']."',
                            password = '".$_POST['password']."'
          WHERE id_member = '".$_SESSION['id']."'
                            ";
    $simpan = mysqli_query($link, $q);
    if ($simpan) {
      echo '<script>alert("data berhasil diubah");window.location.href="'.$urlbase.'akun/"</script>';
    }else {
      echo '<script>alert("gagal menyimpan data");</script>';
    }
  }
}
 ?>
 <?php include '../header.php'; ?>
 <?php include '../menu.php'; ?>
 <div class="single-product-area">
 <div class="zigzag-bottom"></div>
 <div class="container">
     <div class="row">
										<div class="col-sm-12">
                      <?php
                        $sql_mem = "SELECT * FROM member WHERE id_member='".$_SESSION['id']."'";
                        $hasil_mem = mysqli_query($link,$sql_mem);
                        $mem = mysqli_fetch_assoc($hasil_mem);
                      ?>
                        <div class="col-sm-4">
                            <div style="border : solid 1px #d0d0d0; padding: 10px;">
                              <h5>Data Diri</h5>
                              <hr>
                              <form class="" action="" method="post">
                                <div class="form-group">
                                  <label>Nama</label>
                                  <input class="form-control"  type="text" name="nama" value="<?php echo $mem['nama'];?>">
                                </div>  
                                <div class="form-group">
                                  <label>Nama Toko</label>
                                  <input class="form-control"  type="text" name="namaToko" value="<?php echo $mem['namaToko'];?>">
                                </div> 
                                <div class="form-group">
                                  <label>NIK</label>
                                  <input class="form-control"  type="number" name="NIK" value="<?php echo $mem['NIK'];?>">
                                </div>
                                <div class="form-group">
                                  <label>No Telp</label>
                                  <input class="form-control"  type="number" name="notelp" value="<?php echo $mem['noHp'];?>">
                                </div>
                                <div class="form-group">
                                  <label>Email</label>
                                  <input class="form-control" type="email" name="email" value="<?php echo $mem['email'];?>">
                                </div>
                                 <div class="form-group">
                                  <label>Password</label>
                                  <input class="form-control"  type="text" name="password" value="<?php echo $mem['password'];?>">
                                </div>
                                <div class="form-group">
                                  <label>Jenis Kelamin</label>
                                  <select class="form-control" name="jk">
                                    <option value="">-Jenis Kelamin-</option>
                                    <?php
                                      $jk = array(
                                        'Perempuan'=>'Perempuan',
                                        'Laki-laki'=>'Laki - Laki'
                                      );
                                      foreach ($jk as $key => $value) {
                                        if ($key == $mem['jenisKelamin']) {
                                          echo '<option value="'.$mem['jenisKelamin'].'" selected>'.$value.'</option>';
                                        }else {
                                          echo '<option value="'.$key.'">'.$value.'</option>';
                                        }
                                      }
                                      ?>
                                  </select>
                                </div>
                                <!-- <div class="form-group">
                                  <label>Provinsi</label>
                                  <input class="form-control"  type="text" name="prov" value="<?php echo $mem['Provinsi'];?>">
                                </div>
                                <div class="form-group">
                                  <label>Kota</label>
                                  <input class="form-control"  type="text" name="kota" value="<?php echo $mem['Kota'];?>">
                                </div> -->
                                <div class="form-group">
                                  <label>Alamat</label>
                                  <textarea name="alamat" class="form-control"><?php echo $mem['alamat'] ?></textarea>
                                </div>
                                 <div class="form-group">
                                  <label>Provinsi</label>
                                  <input class="form-control"  type="text" name="provinsi" value="<?php echo $mem['Provinsi'];?>">
                                </div> 
                                  <div class="form-group">
                                  <label>Kota</label>
                                  <input class="form-control"  type="text" name="kota" value="<?php echo $mem['Kota'];?>">
                                </div> 
                                <div class="form-group">
                                  <input type="submit" name="simpan" value="Simpan" class="btn btn-info">
                                </div>
                              </form>
                            </div><br>
                        </div>

                        <div class="col-sm-8">
                            <div style="border : solid 1px #d0d0d0; padding: 10px;">
                              <h5>Data Pesanan</h5>
                              <hr>
                              <table class="table table-bordered table-hover">
                                <thead>
                                  <tr>
                                    <th>No</th>
                                    <th>Kode Unik</th>
                                    <th>Produk</th>
                                    <th>Rasa</th>
                                    <th>Jumlah</th>
                                    <th>Total Bayar</th>
                                    <th>Status</th>
                                    <th>Pada</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $dataPerPage = 3;
                                    if(isset($_GET['page']))
                                    {
                                      $noPage = $_GET['page'];
                                    }
                                    else $noPage = 1;

                                    $offset = ($noPage - 1) * $dataPerPage;
                                    $sql_d = "SELECT t.kode_unik, t.totalBayar, t.berat, t.status, t.tanggalTransaksi,
                                    b.namaBarang, k.namaKb FROM transaksipenjualan t, detailtransaksipenjualan d, barang b, kategoribarang k
                                    where t.id_transaksi=d.id_transaksi and d.id_barang=b.id_barang and b.id_kategori=k.id_kategori and id_member = '".$_SESSION['id']."' 
                                    order by t.tanggalTransaksi desc LIMIT ".$offset.", ".$dataPerPage;
                                    //echo $sql_d;
                                    $hasil_d = mysqli_query($link,$sql_d);
                                    $no = ($noPage - 1) * $dataPerPage + 1;
                                    $class = '';
                                    while ($art = mysqli_fetch_assoc($hasil_d)) {
                                      if ($art['status'] == 'menunggu') {
                                        $class ='text-mute';
                                      }else if ($art['status'] == 'ditolak') {
                                        $class ='text-danger';
                                      }elseif ($art['status'] == 'konfirmasi') {
                                        $class ='text-info';
                                      }else {
                                        $class = 'text-success';
                                      }
                                      echo '<tr>';
                                        echo '<td>'.$no.'</td>';
                                        echo '<td><strong>'.$art['kode_unik'].'</strong></td>';
                                        echo '<td><strong>'.$art['namaKb'].'</strong></td>';
                                        echo '<td><strong>'.$art['namaBarang'].'</strong></td>';
                                        echo '<td><strong>'.$art['berat'].'</strong></td>';
                                        echo '<td><strong>'.$art['totalBayar'].'</strong></td>';
                                        echo '<td><label class="'.$class.'">'.$art['status'].'</label></td>';
                                        echo '<td>'.FormatTanggaltime($art['tanggalTransaksi']).'</td>';
                                      echo '</tr>';
                                      $no++;
                                    }
                                  ?>
                                </tbody>
                              </table>
                            </div>
                        </div>

                        <div style="text-align:center">
                  <?php
                    if(mysqli_num_rows($hasil_d) == 0){
                      echo "Data Jurnal Tidak Ditemukan!";
                    }

                    $sqlPageTransaksi = "SELECT COUNT(*) AS jumData FROM transaksipenjualan";
                    $hasilPageTransaksi = mysqli_query($link, $sqlPageTransaksi);
                    $dataPageTransaksi = mysqli_fetch_array($hasilPageTransaksi);

                    $jumData = $dataPageTransaksi['jumData'];

                    $jumPage = ceil($jumData/$dataPerPage);

                    $out = "<ul class='pagination'>";
                    $active = "<li class='active'><a href='#'>";
                    echo $out;

                    if ($noPage > 1) {
                      echo  "<li><a href='".$_SERVER['PHP_SELF']."?action=akun&page=".($noPage-1)."'>&lt;&lt; Prev</a></li>";
                    }

                    $showPage=0;
                    for($page = 1; $page <= $jumPage; $page++)
                    {
                      if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $jumPage))
                      {
                        if (($showPage == 1) && ($page != 2))
                        echo "<li><a href=\"#\">...</a></li>";

                        if (($showPage != ($jumPage - 1)) && ($page == $jumPage))
                        echo "<li><a href=\"#\">...</a></li>";

                        if ($page == $noPage)
                        echo $active." <b>".$page."</b> </a></li>";
                        else
                        echo " <li><a class='page' href='?action=akun&page=".$page."'>".$page."</a> </li>";
                        $showPage = $page;
                      }
                    }

                    if ($noPage < $jumPage){
                      echo "<li><a href='".$_SERVER['PHP_SELF']."?action=akun&page=".($noPage+1)."'>Next &gt;&gt;</a></li></ul>";
                    }
                  ?>
                </div>

                          <div class="col-sm-8">
                            <div style="border : solid 1px #d0d0d0; padding: 10px;">
                              <h5>Data Konfirmasi Pembayaran</h5>
                              <hr>
                              <table class="table table-bordered table-hover">
                                <thead>
                                  <tr>
                                    <th>No</th>
                                    <th>Kode Unik</th>
                                    <th>Nama Pengirim</th>
                                    <th>Jumlah Transfer</th>
                                    <th>Nama Rekening</th>
                                    <th>Bank</th>
                                    <th>Status</th>
                                    <th>Pada</th>
                                  </tr>
                                </thead>
                                <tbody>
                                 <?php
                                    $dataPerPage = 3;
                                    if(isset($_GET['page']))
                                    {
                                      $noPage = $_GET['page'];
                                    }
                                    else $noPage = 1;

                                    $offset = ($noPage - 1) * $dataPerPage;
                                    $sql_k = "SELECT k.kode_unik, k.namaPengirim, k.jumlahTransfer, k.statusKonf, k.tanggalKonfirmasi,
                                    r.namaRekening, r.bankRekening FROM konfirmasipembayaran k, rekeningbank r
                                    WHERE k.id_rekening=r.id_rekening and id_member = '".$_SESSION['id']."' 
                                    order by k.tanggalKonfirmasi desc LIMIT ".$offset.", ".$dataPerPage;
                                    $hasil_k = mysqli_query($link,$sql_k);
                                    //echo $sql_k;
                                    $no = ($noPage - 1) * $dataPerPage + 1;
                                    $class = '';
                                    while ($knf = mysqli_fetch_assoc($hasil_k)) {
                                      if ($knf['statusKonf'] == 'menunggu') {
                                        $class ='text-mute';
                                      }else if ($knf['statusKonf'] == 'ditolak') {
                                        $class ='text-danger';
                                      }elseif ($knf['statusKonf'] == 'konfirmasi') {
                                        $class ='text-info';
                                      }else {
                                        $class = 'text-success';
                                      }
                                      echo '<tr>';
                                        echo '<td>'.$no.'</td>';
                                        echo '<td><strong>'.$knf['kode_unik'].'</strong></td>';
                                        echo '<td><strong>'.$knf['namaPengirim'].'</strong></td>';
                                        echo '<td><strong>'.$knf['jumlahTransfer'].'</strong></td>';
                                        echo '<td><strong>'.$knf['namaRekening'].'</strong></td>';
                                        echo '<td><strong>'.$knf['bankRekening'].'</strong></td>';
                                        echo '<td><label class="'.$class.'">'.$knf['statusKonf'].'</label></td>';
                                        echo '<td>'.FormatTanggal($knf['tanggalKonfirmasi']).'</td>';
                                      echo '</tr>';
                                      $no++;
                                    }
                                  ?>
                                </tbody>
                              </table>
                            </div>
                        </div>

                        <div style="text-align:center">
                  <?php
                    if(mysqli_num_rows($hasil_k) == 0){
                      echo "Data Jurnal Tidak Ditemukan!";
                    }

                    $sqlPageK = "SELECT COUNT(*) AS jumData FROM konfirmasipembayaran";
                    $hasilPageK = mysqli_query($link, $sqlPageK);
                    $dataPageK = mysqli_fetch_array($hasilPageK);

                    $jumData = $dataPageK['jumData'];

                    $jumPage = ceil($jumData/$dataPerPage);

                    $out = "<ul class='pagination'>";
                    $active = "<li class='active'><a href='#'>";
                    echo $out;

                    if ($noPage > 1) {
                      echo  "<li><a href='".$_SERVER['PHP_SELF']."?action=akun&page=".($noPage-1)."'>&lt;&lt; Prev</a></li>";
                    }

                    $showPage=0;
                    for($page = 1; $page <= $jumPage; $page++)
                    {
                      if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $jumPage))
                      {
                        if (($showPage == 1) && ($page != 2))
                        echo "<li><a href=\"#\">...</a></li>";

                        if (($showPage != ($jumPage - 1)) && ($page == $jumPage))
                        echo "<li><a href=\"#\">...</a></li>";

                        if ($page == $noPage)
                        echo $active." <b>".$page."</b> </a></li>";
                        else
                        echo " <li><a class='page' href='?action=akun&page=".$page."'>".$page."</a> </li>";
                        $showPage = $page;
                      }
                    }

                    if ($noPage < $jumPage){
                      echo "<li><a href='".$_SERVER['PHP_SELF']."?action=akun&page=".($noPage+1)."'>Next &gt;&gt;</a></li></ul>";
                    }
                  ?>
                </div>

										</div>
								</div><!-- /.row -->
							</div>
						</div>

	 <?php include '../footer.php'; ?>

</body>
</html>

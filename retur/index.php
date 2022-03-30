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
        <legend>Data Barang</legend>
        <p>Berikut adalah data barag yang telah anda pesan, jika anda akan melakukan retur, pilih kode unik yang tersedia kemudian <br>
          pilih salah satu barang, masukkan jumlah yang akan anda retur dan klik retur, sistem akan memproses data retur anda,<br>
          dan admin akan segera memprosesnya.
        </p>
        <div class="col-sm-12">
          <div class="col-sm-6">
            <form class="" action="" method="post">
                <div class="form-group">
                  <label>Pilih Kode Unik Anda</label>
                  <select class="form-control" name="kode_unik">
                    <option value="" selected>-Pilih Kode unik-</option>
                     <?php
                      $sqlr = "SELECT * FROM transaksipenjualan Where id_member = '".$_SESSION['id']."' and status='selesai'";
                      $prosesr = mysqli_query($link,$sqlr);
                      while ($dt1 = mysqli_fetch_assoc($prosesr)) {
                        if ($dt1['id_transaksi'].'|'.$dt1['kode_unik'] == $_POST['kode_unik']) {
                          echo '<option value="'.$_POST['kode_unik'].'" selected>'.$dt1['kode_unik'].'</option>';
                        }else {
                            echo '<option value="'.$dt1['id_transaksi'].'|'.$dt1['kode_unik'].'">'.$dt1['kode_unik'].'</option>';
                        }
                      }
                    ?>
                  </select>
                </div>

                <div class="form-group">
                  <input type="submit" name="kod" value="Cari Barang" class="btn btn-info">
                </div>
            </form>
          </div>

          <div class="col-sm-6">
          <h4>Data Barang</h4>
          <hr>
          <?php

          if (isset($_POST['kod'])) {
            $data_kode = explode('|', $_POST['kode_unik']);
            $id_transaksi = $data_kode[0];
            $kode_unik = $data_kode[1];
           ?>
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Item</th>
                <th>Rasa</th>
                <th>Jumlah Bungkus</th>
                <th>Harga</th>
                <th>#</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $sql_retur = "SELECT * FROM detailtransaksipenjualan LEFT JOIN
                  barang ON detailtransaksipenjualan.id_barang = barang.id_barang  where detailtransaksipenjualan.id_transaksi = '".$id_transaksi."'
                  order by detailtransaksipenjualan.id_detail DESC";
                $proses_retur = mysqli_query($link,$sql_retur);

                $no = 1;
                while ($dt = mysqli_fetch_assoc($proses_retur)) {
                  $sql1  = "SELECT * FROM kategoribarang WHERE id_kategori='".$dt['id_kategori']."'";
                  $dt2 = mysqli_query($link,$sql1);
                  $dt3 = mysqli_fetch_array($dt2);
                  $max = $dt['berat_satuan'];
                  echo '<tr>';
                  echo '<td>'.$no.'</td>';
                  echo '<td>'.$dt3['namaKb'].'</td>';
                  echo '<td>'.$dt['namaBarang'].'</td>';
                  echo '<td><input type="number" id="in'.$no.'" value="'.$max.'" style="width:70px" min="0" max="'.$max.'" class="form-control"></td>';
                  echo '<td>'.FormatRupiah($max * $dt3['hargakg']).'</td>';
                  echo '<td><a href="javascript:void(0);" onclick="retur('.$dt['id_barang'].','.$no.');" class="btn btn-xs btn-info">Retur</a></td>';
                  echo '</tr>';
                  $no++;
                }
              ?>
            </tbody>
          </table>
          <?php }?>
        </div>

        </div>
        <div class="col-sm-12">
            <h4>Data Retur</h4>
            <hr>

            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Unik</th>
                  <th>Produk</th>
                  <th>Rasa</th>
                  <th>Tanggal</th>
                  <th>Jumlah Bungkus</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
              <?php
                  $dataPerPage = 5;
                  if(isset($_GET['page']))
                  {
                    $noPage = $_GET['page'];
                  }
                  else $noPage = 1;

                  $offset = ($noPage - 1) * $dataPerPage;
                  $sql_retur = "SELECT * FROM retur r, barang b, kategoribarang k
                  WHERE r.id_barang=b.id_barang and b.id_kategori=k.id_kategori and id_member = '".$_SESSION['id']."' order by id_retur desc LIMIT ".$offset.", ".$dataPerPage;
                  //echo $sql_retur;
                  $proses_retur = mysqli_query($link,$sql_retur);
                  $no = ($noPage - 1) * $dataPerPage + 1;
                  $class = '';
                  while ($dt = mysqli_fetch_assoc($proses_retur)) {
                    $max = $dt['jumlah'];
                    echo '<tr>';
                    echo '<td>'.$no.'</td>';
                    echo '<td>'.$dt['kode_unik'].'</td>';
                    echo '<td>'.$dt['namaKb'].'</td>';
                    echo '<td>'.$dt['namaBarang'].'</td>';
                    echo '<td>'.formatTanggal($dt['tgl_retur']).'</td>';
                    echo '<td>'.$dt['jumlah'].'</td>';
                    echo '<td>'.$dt['status_retur'].'</td>';
                    echo '</tr>';
                    $no++;
                  }
                ?>
              </tbody>
            </table>
            <div style="text-align:center">
                  <?php
                    if(mysqli_num_rows($proses_retur) == 0){
                      echo "Data Jurnal Tidak Ditemukan!";
                    }

                    $sqlPageK = "SELECT COUNT(*) AS jumData FROM retur";
                    $hasilPageK = mysqli_query($link, $sqlPageK);
                    $dataPageK = mysqli_fetch_array($hasilPageK);

                    $jumData = $dataPageK['jumData'];

                    $jumPage = ceil($jumData/$dataPerPage);

                    $out = "<ul class='pagination'>";
                    $active = "<li class='active'><a href='#'>";
                    echo $out;

                    if ($noPage > 1) {
                      echo  "<li><a href='".$_SERVER['PHP_SELF']."?action=retur&page=".($noPage-1)."'>&lt;&lt; Prev</a></li>";
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
                        echo " <li><a class='page' href='?action=retur&page=".$page."'>".$page."</a> </li>";
                        $showPage = $page;
                      }
                    }

                    if ($noPage < $jumPage){
                      echo "<li><a href='".$_SERVER['PHP_SELF']."?action=retur&page=".($noPage+1)."'>Next &gt;&gt;</a></li></ul>";
                    }
                  ?>
                </div>
          </div>
      </div>
    </div>
  </div>
</div>

<?php include '../footer.php'; ?>
<script>
  function retur(id_barang, no) {
    var qty = $('#in'+no).val();
    var id_transaksi = '<?php echo $id_transaksi?>';
    var kode_unik = '<?php echo $kode_unik;?>';
    window.location.href="<?php echo $urlbase;?>retur/proses_retur.php?id_barang="+id_barang+"&id_transaksi="+id_transaksi+"&qty="+qty+"&kode_unik="+kode_unik;
  }
</script>

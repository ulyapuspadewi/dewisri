<?php
include '../config.php';
include '../function.php';
session_start();

if (isset($_POST['testi'])) {
  if(empty($_SESSION['id'])){
    echo "<script>alert('anda harus login');window.location.href='".$urlbase."login.php'</script>";
  }else {
    $query = "INSERT INTO testimoni (id_testimoni, id_admin, id_member,tanggalTestimoni,isi,status)
                                      VALUES
                                      ('','','".$_SESSION['id']."','".date('Y-m-d')."','".nl2br($_POST['isi'])."','Menunggu')";
    $simpan = mysqli_query($link, $query);
    // print_r($simpan);
    echo "<script>alert('testimoni ditambahkan');window.location.href='".$urlbase."testimoni'</script>";
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
                      $sql_artikel = "SELECT * FROM testimoni LEFT JOIN member on testimoni.id_member
                      = member.id_member WHERE testimoni.status='Ditampilkan' order by tanggalTestimoni DESC";
                      $hasil_artikel = mysqli_query($link,$sql_artikel);
                      while ($art = mysqli_fetch_assoc($hasil_artikel)) {
                    ?>
                      <div class="col-sm-4">
                          <div class="create-account" style="border : solid 1px #d0d0d0; padding: 10px;">
                            <h5><?php echo ucfirst($art['nama']);?> (<?php echo $art['email'];?>)</h5>
                            <hr>
                            <p>
                              <?php echo $art['isi'];?>..<br>
                              <small class="pull-right"><?php echo FormatTanggal($art['tanggalTestimoni']) ?></small>
                            </p>
                          </div><br>
                      </div>
                    <?php } ?>
                  </div>

              <div class="col-sm-4 pull-right"><br>
                <form action="" method="post">
                  <div class="form-group">
                    <label>Isi Testimoni</label>
                    <textarea name="isi" class="form-control" required></textarea>
                  </div>
                  <input type="submit" class="btn btn-info" name="testi" value="simpan">
                </form>
              </div>
						</div>


					</div><!-- /.scroll-tabs -->
				</div>

	 <?php include '../footer.php'; ?>

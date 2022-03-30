<?php
include '../config.php';
include '../function.php';
session_start();
 ?>

 <?php include '../header.php'; ?>
 <?php include '../menu.php'; ?>



 <div class="single-product-area">
 <div class="zigzag-bottom"></div>
 <div class="container">
     <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-3 sidebar">
            <?php include 'sidebarartikel.php'; ?>
          </div>
        <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">

                      <?php
                        $sql_artikel = "SELECT * FROM artikel
                        LEFT JOIN admin on artikel.id_admin = admin.id_admin LEFT JOIN kategoriartikel on artikel.id_kategoriArtikel = kategoriartikel.id_kategoriArtikel
                        WHERE artikel.status='publish' order by tanggalArtikel DESC";
                        $hasil_artikel = mysqli_query($link,$sql_artikel);
                        while ($art = mysqli_fetch_assoc($hasil_artikel)) {
                      ?>
                        <div class="col-sm-4">
                            <div style="border : solid 1px #d0d0d0; padding: 10px;">
                              <h4><?php echo $art['judulArtikel'];?></h4>
                              <h5><?php echo $art['namaKa'];?></h5>
                              <hr>
                              <p>
                                <?php echo substr($art['isi'], 0,200);?>..<br>
                                <a href="<?php echo $urlbase.'artikel/detail.php?url='.$art['urlArtikel'];?>" >Selengkapnya</a><br>
                                <small class="pull-right"><?php echo FormatTanggal($art['tanggalArtikel']) .'('.$art['namaA'].')';?></small>
                    
                              </p>
                            </div><br>
                        </div>
                      <?php } ?>
							</div>
						</div>
          </div>
					</div>


	 <?php include '../footer.php'; ?>

</body>
</html>

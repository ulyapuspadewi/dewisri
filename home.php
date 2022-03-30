<div class="single-product-area">
    <div class="zigzag-bottom">
    </div>
    <div class="container">
        <div class="row">
        <div class="col-md-12">
         <div class="brand-wrapper">
     <h2 class="heading text-center">Testimonials</h2>
                    <?php
                      $sql_artikel = "SELECT * FROM testimoni LEFT JOIN member on testimoni.id_member
                      = member.id_member WHERE testimoni.status='Ditampilkan' ORDER BY id_testimoni DESC LIMIT 0,3";
                      $hasil_artikel = mysqli_query($link,$sql_artikel);
                      while ($art = mysqli_fetch_assoc($hasil_artikel)) {
                    ?>
                       <div class="col-sm-4">
                          <div class="create-account">
                            <h5><?php echo ucfirst($art['nama']);?> (<?php echo $art['email'];?>)</h5>
                            <hr>
                            <p>
                              <h3><?php echo $art['isi'];?></h3><br>
                              <small class="pull-right"><?php echo FormatTanggal($art['tanggalTestimoni']) ?></small>
                            </p>
                          </div><br>
                      </div>
                    <?php } ?>
                  </div>
                          </div>
</div>
</div>
</div>

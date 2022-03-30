<div class="slider-area">
  <div class="block-slider block-slider4">
    <ul class="" id="bxslider-home4">
      <?php
        $sql = "select * from slider ";
        $hasil = mysqli_query($link, $sql);
        while($data = mysqli_fetch_array($hasil)){ ?>

          <li><img src="<?php echo "admin/img/".$data['gambar']; ?>" alt="Slide">
            <div class="caption-group">
              <h2 class="caption title">
                <?php echo $data['judul'];?>
              </h2>
              <!-- <a class="caption button-radius" href="#"><span class="icon"></span>Shop now</a> -->
            </div>
          </li>

      <?php } ?>
    </ul>
  </div>
</div>

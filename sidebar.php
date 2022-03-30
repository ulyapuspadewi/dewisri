<div class="col-md-4">
    <div class="single-sidebar">
        <h2 class="sidebar-title">Kategori</h2>
        <ul>
          <?php
            $sql1 = "SELECT * FROM kategoribarang ORDER BY namaKb";
            $hasil1 = mysqli_query($link,$sql1);
            while($data1 = mysqli_fetch_array($hasil1)){
              ?>
                <li>
                  <a href="<?php echo $urlbase."produk/kategori.php?urlkat=".$data1['url']; ?>"><?php echo $data1['namaKb']; ?></a>
                </li>
              <?php
            }
          ?>
        </ul>
    </div>
</div>

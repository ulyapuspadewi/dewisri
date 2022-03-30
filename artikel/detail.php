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
                      <?php
                        $sql_artikel = "SELECT * FROM artikel WHERE urlArtikel = '".$_GET['url']."' Limit 1";
                        $hasil_artikel = mysqli_query($link,$sql_artikel);
                        $art = mysqli_fetch_assoc($hasil_artikel);
                      ?>
                          <div class="col-sm-12">
                            <h4><?php echo $art['judulArtikel'];?></h4>
                            <hr>
                            <p><?php echo $art['isi'];?></p>
                          </div>
                          </div>
                        </div>
										</div>

	 <?php include '../footer.php'; ?>

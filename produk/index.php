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
								<div class="col-md-10 col-md-offset-1">
                    <?php
  										$sql = "SELECT b.id_barang, b.id_kategori, b.id_admin, b.namaBarang, b.deskripsi, b.gambar, b.berat, b.stok, b.harga, b.status, b.urlBarang, k.id_kategori, k.namaKb, k.hargakg, k.url
                        FROM barang b, kategoribarang k WHERE k.id_kategori=b.id_kategori and statusKb='Publish' and namaBarang='Nangka'";
  										//echo $sql;
  										$hasil = mysqli_query($link, $sql);
  										while($record = mysqli_fetch_array($hasil)){
  											?>
                        <div class="col-sm-6">
                          <div class="single-shop-product">
                              <div class="product-upper">
                                  <img src="<?php echo $urlbase."admin/img/".$record['gambar']?>" alt="">
                              </div>
                              <h2><a><?php echo $record['namaKb'] ?></a></h2>
                              <div class="product-carousel-price">
                                  <ins><?php echo FormatRupiah($record['hargakg']); ?></ins>
                              </div>
                
                                    <div class="product-inner-category">
                                                          <p>
                                        <?php
                                          if($record['stok'] > 0){
                                            ?>
                                              Tersedia
                                            <?php
                                          }else{
                                            ?>
                                              Kosong
                                            <?php
                                          }
                                        ?>
                                      </p>    
                                    </div>

                                    <div role="tabpanel">
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane fade in active" id="home">
                                                <h4>Deskripsi Produk</h4>
                                                <p>
                                                    <?php echo $record['deskripsi']; ?>
                                                </p>
                                            </div>

                                        </div>
                                    </div>


                              <div class="product-option-shop">
                                  <a class="add_to_cart_button" rel="nofollow" href="<?php echo $urlbase."produk/detailproduk.php?urlBarang=".$record['urlBarang']; ?>">Pilih</a>
                              </div>
                          </div>
                      </div>
  											<?php
  										}
  									?>
								</div>
							</div>
						</div>
					</div>


					</div><!-- /.scroll-tabs -->
				</div>
			</div>
		</div>
	</div>


	 <?php include '../footer.php'; ?>

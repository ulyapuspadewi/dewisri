<?php
	include '../config.php';
	include '../function.php';
	session_start();
	if($_GET['urlkat'])
    {
        // $url1       = mysqli_real_escape_string($_GET['urlkat']);
        $url        = $_GET['urlkat']; //Friendly URL
        $sqlnkat    = "SELECT * FROM kategoribarang WHERE url = '$url'";
        $prosesnkat = mysqli_query($link,$sqlnkat);
        $datankat   = mysqli_fetch_array($prosesnkat);
            $idkat  = $datankat['id_kategori'];
            $namakat= $datankat['namaKb'];
            $urlkate= $datankat['url'];
    }
    else
    {
        echo '404 Page.';
    }

 ?>
 <?php include '../header.php'; ?>
 <?php include '../menu.php'; ?>
 <div class="single-product-area">
			<div class="zigzag-bottom"></div>
			<div class="container">
					<div class="row">
						<!-- <?php include '../sidebar.php'; ?> -->
									<?php
										$dataPerPage = 6;
										if(isset($_GET['page']))
										{
											$noPage = $_GET['page'];
										}
										else $noPage = 1;

										$offset = ($noPage - 1) * $dataPerPage;
										$sql = "SELECT * FROM barang b, kategoribarang k where k.url = '$url' and b.id_kategori  = k.id_kategori and b.stok > 0 LIMIT ".$offset.", ".
										//echo $sql;
										$dataPerPage;
										$hasil = mysqli_query($link,$sql);
										while($record = mysqli_fetch_array($hasil)){
											?>
											<div class="col-md-3 col-sm-6">
													<div class="single-shop-product">
															<div class="product-upper">
																	<img src="<?php echo $urlbase."admin/img/".$record['gambar']?>" alt="">
															</div>
															<h2><a href="<?php echo $urlbase."produk/detailproduk.php?urlBarang=".$record['urlBarang']; ?>"><?php echo $record['namaBarang'] ?></a></h2>
															<div class="product-carousel-price">
																	<ins><?php echo FormatRupiah($record['harga']); ?></ins>
															</div>

															<div class="product-option-shop">
																	<a class="add_to_cart_button" rel="nofollow" href="<?php echo $urlbase.'cart/cart_function.php?act=add&id='.$record['id_barang'].'&hrg='.$record['harga'].'&id_kategori='.$record['id_kategori'].'&quantity=1';?>">Add to cart</a>
															</div>
													</div>
											</div>
											<?php
										}
									?>


								</div><!-- /.row -->
							</div><!-- /.category-product -->

						</div>

	 <?php include '../footer.php'; ?>

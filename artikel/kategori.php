<?php
	include '../config.php';
	include '../function.php';
	session_start();
	if($_GET['urlArtikel'])
    {
        // $url1       = mysqli_real_escape_string($_GET['urlArtikel']);
        $url        = $_GET['urlArtikel']; //Friendly URL
        $sqlnkat    = "SELECT * FROM kategoriartikel WHERE url = '$url'";
        $prosesnkat = mysqli_query($link,$sqlnkat);
        $datankat   = mysqli_fetch_array($prosesnkat);
            $idkat  = $datankat['id_kategoriArtikel'];
            $namakat= $datankat['namaKa'];
            $urlkate= $datankat['url'];
    }
    else
    {
        echo '404 Page.';
    }

 ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

		<meta name="description" content="Kategori Produk - <?php echo $dataWebsite['namaWebsite']; ?>">
		<meta name="author" content="jasawebmasters">
	    <meta name="keywords" content="Kategori Produk - <?php echo $dataWebsite['namaWebsite']; ?>">
	    <meta name="robots" content="all">

	    <title>Kategori <?php echo $namakat; ?> - <?php echo $dataWebsite['namaWebsite']; ?></title>

	    <?php include '../menu.php'; ?>

	</head>
    <body class="cnt-home">
	<?php include '../header.php'; ?>
		<div class="single-product-area">
		<div class="zigzag-bottom"></div>
 		<div class="container">
			<div class="row">

				<div class="col-xs-12 col-sm-12 col-md-3 sidebar">
					<?php include 'sidebarartikel.php'; ?>
				</div>
				<!-- ============================================== SIDEBAR : END ============================================== -->

				<!-- ============================================== CONTENT ============================================== -->
				<div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">


					<div class="search-result-container">
					<div id="myTabContent" class="tab-content">
						<div class="tab-pane active " id="grid-container">
							<div class="category-product  inner-top-vs" >
								<div class="row">
									<?php
										$dataPerPage = 6;
										if(isset($_GET['page']))
										{
											$noPage = $_GET['page'];
										}
										else $noPage = 1;

										$offset = ($noPage - 1) * $dataPerPage;
										$sql = "SELECT b.id_admin, b.namaA, a.id_artikel, a.judulArtikel, a.isi, a.tanggalArtikel, a.urlArtikel, a.status, k.namaKa, k.id_kategoriArtikel FROM admin b, artikel a, kategoriartikel k WHERE k.url = '$url' and b.id_admin=a.id_admin AND a.id_kategoriArtikel=k.id_kategoriArtikel and a.status='Publish' LIMIT ".$offset.", ". $dataPerPage;
										//echo $sql;
										$hasil = mysqli_query($link,$sql);
										while($record = mysqli_fetch_array($hasil)){
											?>
												 <div class="col-sm-4">
						                            <div style="border : solid 1px #d0d0d0; padding: 10px;">
						                              <h4><?php echo $record['judulArtikel'];?></h4>
						                              <h5><?php echo $record['namaKa'];?></h5>
						                              <hr>
						                              <p>
						                                <?php echo substr($record['isi'], 0,200);?>..<br>
						                                <a href="<?php echo $urlbase.'artikel/detail.php?url='.$record['urlArtikel'];?>" >Selengkapnya</a><br>
						                                <small class="pull-right"><?php echo FormatTanggal($record['tanggalArtikel']) .'('.$record['namaA'].')';?></small>
						                    
						                              </p>
						                            </div><br>
						                        </div>
											<?php
										}
									?>


								</div><!-- /.row -->
							</div><!-- /.category-product -->

						</div>
					</div>
					<div class="clearfix filters-container">
						<div class="text-right">
							 <div class="pagination-container">
								<ul class="list-inline list-unstyled">
									<?php
										// mencari jumlah semua data dalam tabel berita

										$query   = "SELECT COUNT(id_artikel) AS jumData FROM artikel a
																LEFT JOIN kategoriartikel k
																ON a.id_kategoriArtikel = k.id_kategoriArtikel
																where k.url = '$url' and a.id_kategoriArtikel = k.id_kategoriArtikel AND a.status='Publish'";
										//echo $query;
										$hasil  = mysqli_query($link,$query);
										$dataa    = mysqli_fetch_array($hasil);

										$jumData = $dataa['jumData'];

										$jumPage = ceil($jumData/$dataPerPage);


										$active = "<li class='active'><a href='#'>";


										if ($noPage > 1) {
											echo  "<li><a href='".$urlbase."artikel/kategori/".$urlkate."/page/".($noPage-1)."'>Prev</a></li>";
										}

										// memunculkan nomor halaman dan linknya

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
													echo $active." ".$page." </a></li>";
												else
													echo " <li><a class='page' href='".$urlbase."artikel/kategori/".$urlkate."/page/".$page."'>".$page."</a> </li>";
												$showPage = $page;
											}
										}

										// menampilkan link next

										if ($noPage < $jumPage){
											echo "<li><a href='".$urlbase."artikel/kategori/".$urlkate."/page/".($noPage+1)."'>Next</a></li>";
										}

									?>
								</ul><!-- /.list-inline -->
							</div>
						</div><!-- /.text-right -->
					</div>
					</div><!-- /.scroll-tabs -->
				</div>
			</div>
		</div>
	</div>
	</div>


	 <?php include '../footer.php'; ?>

</body>
</html>

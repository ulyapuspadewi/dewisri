			<div>
				<div class="head"><h2 class="sidebar-title">Kategori </h2></div>
				<nav class="yamm megamenu-horizontal" role="navigation">
					<ul class="nav">
						<?php
							$sql = "SELECT * FROM kategoriartikel ORDER BY namaKa";
							$hasil = mysqli_query($link,$sql);
							while($data = mysqli_fetch_array($hasil)){
								?>
									<li class="dropdown menu-item">
										<a href="<?php echo $urlbase."artikel/kategori.php?urlArtikel=".$data['url']; ?>" class="dropdown-toggle"><?php echo $data['namaKa']; ?></a>
									</li>
								<?php
							}
						?>

					</ul>
				</nav>
			</div>

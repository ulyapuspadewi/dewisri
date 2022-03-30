<?php

	include '../config.php';
	session_start();
	if (empty($_SESSION['id'])) {
  echo '<script>alert("anda harus login");window.location.href="'.$urlbase.'login.php"</script>';
}
?>
<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>
<div class="single-product-area">
<div class="zigzag-bottom"></div>
<div class="container">
		<div class="row">

		<div class="col-md-12 contact-form">
	<div class="col-md-12 contact-title">
		 <legend>Konfirmasi Pembayaran</legend>
        <p>Pastikan Anda mengisi data dengan benar </p>
	</div>
	<div class="col-md-12 ">
		<form class="register-form" role="form" action="" method="POST" enctype="multipart/form-data" >
								<div class="col-sm-6">
									<div class="form-group">
									<label class="info-title" >Nama pengirim</label>
									<input type="text" class="form-control unicase-form-control text-input" name="nama" placeholder="Isikan nama anda" required>
								  </div>
								  </div>


									  <div class="col-sm-6">
									  <div class="form-group">
										<label class="info-title" >Jumlah transfer</label>
										<input type="number" min="0" class="form-control unicase-form-control text-input" name="jumlah" placeholder="Rp."required>
									  </div>
									  </div>
									  <div class="col-sm-6">
									  <div class="form-group">
										<label class="info-title" >Tanggal Transfer</label>
										<input type="date" class="form-control " name="date" placeholder="Tanggal Transfer" required>
									  </div>
									  </div>
										<div class="col-sm-6">
									  <div class="form-group">
										<label class="info-title" >Kode Unik</label>
										<select class="form-control" name="kode_unik" required>
										<?php
												$que = "select * from transaksipenjualan where id_member = '".$_SESSION['id']."' and status='Menunggu'";
												$hasilk = mysqli_query($link,$que);
												while($k = mysqli_fetch_array($hasilk)){
													$que2 = "SELECT * FROM konfirmasipembayaran Where kode_unik = '".$k['kode_unik']."'and statusKonf='Disetujui'";
							                        $hasilk2 = mysqli_query($link,$que2);
							                        $k2 = mysqli_fetch_array($hasilk2);
							                        if (empty($k2)) {
													echo '<option value="'.$k['kode_unik'].'">'.$k['kode_unik'].'</option>';
												}
												}
										 ?>
										 </select>
										<!-- <input type="number" class="form-control unicase-form-control text-input" name="kode_unik" required> -->
									  </div>
									  </div>
									    <div class="col-sm-6">
											<div class="form-group">
												<label class="info-title" >Nama Rekening</label>
												 <select  class="form-control unicase-form-control text-input" name="namaRek" placeholder="Nama rekening" required>
												<?php
												$sql = "select * from rekeningbank";
												$hasil = mysqli_query ($link, $sql);
												while($record = mysqli_fetch_array ($hasil)){
												?>
												<option value="<?php echo $record['id_rekening']?>"> <?php echo $record['bankRekening']?></option>
												<?php
												}
												?>
												</select>
									  </div>
									  </div>
									  <div class="col-sm-6">
									  <div class="form-group">
										<label class="info-title" >Lampiran</label>
										<input type="file" accept="image/*" class="form-control unicase-form-control text-input" name="gambar" >
									  </div>
									  </div>

									  <div class="col-md-12 outer-bottom-small m-t-20 text-center">
										<button type="submit" class="btn btn-primary"  name="submit">Konfirmasi</button>
										</div>
					</form>
					</div>


				</div>
				</div>
				</div>
				</div>


<?php include '../footer.php'; ?>


<?php
if(isset($_POST['submit'])){
		function string_limit_words($string, $word_limit) {
			$words = explode(' ', $string);
			return implode(' ', array_slice($words, 0, $word_limit));
		}



		$gambar = "Images-".Date("Y-m-d-H-i-s").".png";
			// Simpan di Folder Gambar
			move_uploaded_file($_FILES['gambar']['tmp_name'], "../admin/img/".$gambar);
		$sql = "INSERT INTO konfirmasipembayaran (id_member, id_rekening, id_admin, namaPengirim, kode_unik, jumlahTransfer, tanggalKonfirmasi, statusKonf, lampiran)
				VALUES ('".$_SESSION['id']."','".$_POST['namaRek']."','".$_SESSION['adminChar']."','".$_POST['nama']."', '".$_POST['kode_unik']."','".$_POST['jumlah']."','".$_POST['date']."','Menunggu','".$gambar."')";
		mysqli_query($link, $sql);
		if(mysqli_affected_rows($link) > 0){
			?>
				<script>
					alert("konfirmasi Berhasil ");
					window.location = '?action=tambahBarang';
				</script>
			<?php
		}else{
			?>
				<script>
					alert("Terjadi kesalahan! Kategori tidak berhasil ditambahkan!");
				</script>
			<?php
		}
	}

?>

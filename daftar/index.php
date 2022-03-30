<?php
	include '../config.php';

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="description" content="<?php echo $dataWebsite['deskripsi']; ?>">
		<meta name="author" content="">
	    <meta name="keywords" content="<?php echo $dataWebsite['keyword']; ?>">
	    <meta name="robots" content="all">

	    <title><?php echo $dataWebsite['namaWebsite']." - ".$dataWebsite['deskripsi']; ?></title>

	    <?php include '../menu.php'; ?>

	</head>
    <body class="cnt-home">

		<?php include '../header.php'; ?>

<div class="single-product-area">
 	<div class="zigzag-bottom"></div>
	<div class="container">
	<div class="row">

			<div class="col-md-12">
		<h2>Daftar Member</h2>
		<span class="title-tag inner-top-vs">Dewi Sri ingin mangajak Anda untuk bergabung menjadi bagian dari jaringan kami.
		Silahkan isi form dibawah, agar terdaftar sebagai member Dewi Sri. </br>Pastikan anda mengisi data dengan benar! </span>
	<form class="register-form outer-top-xs" role="form" action="" method="POST" enctype="multipart/form-data">
	   <div class="col-sm-6">
				<div class="form-group">
				    <label class="info-title" for="exampleOrderId1">Nama</label>
				    <input type="text" class="form-control unicase-form-control text-input" name="namaMember" required>
				</div>
		</div>
		<div class="col-sm-6">
				<div class="form-group">
				    <label class="info-title" for="exampleOrderId1">Nama Toko</label>
				    <input type="text" class="form-control unicase-form-control text-input" name="namaToko" placeholder="Isikan jika ada" required>
				</div>
		</div>
		<div class="col-sm-6">
				<div class="form-group">
				    <label class="info-title" for="exampleOrderId1">NIK</label>
				    <input type="number" class="form-control unicase-form-control text-input" name="NIK" required>
				</div>
		</div>
		<div class="col-sm-6">
				<div class="form-group">
					<label class="info-title" for="exampleBillingEmail1">Jenis Kelamin</label>
					<select name="txtKelamin" class="form-control unicase-form-control text-input" required>
						<option value="Laki-laki">Laki-laki</option>
						<option value="Perempuan">Perempuan</option>
					</select>
				</div>
		</div>
		<div class="col-sm-6">
				<div class="form-group">
					<label class="info-title" for="exampleBillingEmail1">Email</label>
					<input type="email" class="form-control unicase-form-control text-input" name="email" required>
				</div>
		</div>
		<div class="col-sm-6">
				<div class="form-group">
					<label class="info-title" for="exampleBillingEmail1">Password</label>
					<input type="text" class="form-control unicase-form-control text-input" name="password" required>
				</div>
		</div>

		<div class="col-sm-6">
				<div class="form-group">
					<label class="info-title" for="exampleBillingEmail1">No Hp</label>
					<input type="number" class="form-control unicase-form-control text-input" name="no" required>
				</div>
		</div>
		<div class="col-sm-6">
				<div class="form-group">
					<label class="info-title" for="exampleBillingEmail1">Provinsi</label>
					<input type="text" class="form-control unicase-form-control text-input" name="provinsi" required>
				</div>
		</div>
		<div class="col-sm-6">
				<div class="form-group">
					<label class="info-title" for="exampleBillingEmail1">Kota/Kabupaten</label>
					<input type="text" class="form-control unicase-form-control text-input" name="kota" required>
				</div>
		</div>
		<div class="col-sm-6">
				<div class="form-group">
					<label class="info-title" for="exampleBillingEmail1">Alamat</label>
					<textarea type="text" name="alamat" class="form-control unicase-form-control text-input"  required ></textarea>
				</div>
		</div>
		<div class="col-sm-12 text-center">
	  	<button type="submit" name="submit" class="btn-upper btn btn-primary checkout-page-button">Daftar</button>
		</div>
	</form>
	</div>
	</div>



		</div><br><!-- /.homebanner-holder -->
		<!-- ============================================== CONTENT : END ============================================== -->
	</div><!-- /.row -->

	</div><!-- /.container -->
</div><!-- /#top-banner-and-menu -->


<?php include '../footer.php'; ?>



</body>
</html>
<?php
if(isset($_POST['submit'])){
		function string_limit_words($string, $word_limit) {
			$words = explode(' ', $string);
			return implode(' ', array_slice($words, 0, $word_limit));
		}

		$email = $_POST['email'];
		$sql12 = "select * from member where email='".$email."'";
		$q = mysqli_query($link, $sql12);
		$we = mysqli_fetch_array($q);
		if (empty($we)) {
			$sql = "INSERT INTO member(nama, namaToko, NIK, email, jenisKelamin, alamat, noHp, Provinsi, Kota, password, statusMember)
			VALUES (
				'".$_POST['namaMember']."', '".$_POST['namaToko']."', '".$_POST['NIK']."','".$_POST['email']."','".$_POST['txtKelamin']."','".$_POST['alamat']."','".$_POST['no']."','".$_POST['provinsi']."','".$_POST['kota']."','".$_POST['password']."','Aktif')";
			//echo $sql;
			mysqli_query($link, $sql);
			if(mysqli_affected_rows($link) > 0){
				?>
					<script>
						alert("selamat menjadi member ");
						window.location = '?action=member';
					</script>
				<?php
			}else{
				?>
					<script>
						alert("Terjadi kesalahan! Kategori tidak berhasil ditambahkan!");
					</script>
				<?php
			}
		}else {
			?>
			<script>
				alert("email sudah digunakan");
			</script>
			<?php
		}

	}

?>

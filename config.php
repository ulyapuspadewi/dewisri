<?php
	//ATRIBUT WEBSITE
	date_default_timezone_set("Asia/Jakarta");

	$urlbase		= 'http://localhost/dewisri/';
	$webtitle		= "Dewi Sri";
	$description 	= "";
	$keyword		= "";


	$tanggalSekarang= date("Y-m-d H:i:s");

	//ATRIBUT KONEKSI
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = '';
	$dbname = 'dewisri';
	$link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	if ($link->connect_error) {
	   die('Maaf koneksi gagal: '. $link->connect_error);
	}

	$sqlWebsite = "SELECT * FROM pengaturan";
	$dataWebsite = mysqli_fetch_array(mysqli_query($link,$sqlWebsite));
?>

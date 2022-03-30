<?php
	function FormatTanggal($date) {

		$BulanIndo = array("Januari", "Februari", "Maret",
						   "April", "Mei", "Juni",
						   "Juli", "Agustus", "September",
						   "Oktober", "November", "Desember");

		$tahun = substr($date, 0, 4);
		$bulan = substr($date, 5, 2);
		$tgl   = substr($date, 8, 2);

		$result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;
		return($result);
	}

	function FormatTanggaltime($date) {

		$BulanIndo = array("Januari", "Februari", "Maret",
						   "April", "Mei", "Juni",
						   "Juli", "Agustus", "September",
						   "Oktober", "November", "Desember");

		$tahun = substr($date, 0, 4);
		$bulan = substr($date, 5, 2);
		$tgl   = substr($date, 8, 2);

		$jam = strtotime($date);

		$result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun." | ".date('H:i', $jam);
		return($result);
	}

	function FormatTanggal2($date) {

		$BulanIndo = array("Januari", "Februari", "Maret",
						   "April", "Mei", "Juni",
						   "Juli", "Agustus", "September",
						   "Oktober", "November", "Desember");

		$tahun = substr($date, 0, 4);
		$bulan = substr($date, 5, 2);
		$tgl   = substr($date, 8, 2);

		$result = $BulanIndo[(int)$bulan-1] . " ". $tahun;
		return($result);
	}

	function FormatTanggal3($date) {

		$BulanIndo = array("Jan", "Feb", "Mar",
						   "Apr", "Mei", "Jun",
						   "Jul", "Agu", "Sep",
						   "Okt", "Nov", "Des");

		$tahun = substr($date, 0, 4);
		$bulan = substr($date, 5, 2);
		$tgl   = substr($date, 8, 2);

		$result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;
		return($result);
	}


	function FormatRupiah($nominal){
		$Rupiah = number_format($nominal,0,',','.');
		return "Rp.".$Rupiah;
	}
?>

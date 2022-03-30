<?php

include '../../config.php';

if (!empty($_GET['p'])) {
	$tempprov	= explode(" - ", $_GET['p']);
	if (ctype_digit($tempprov[0])) {
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://api.rajaongkir.com/starter/city?province=".$tempprov[0]."",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
		    "key: 5cc85ff7a586d26b9fb20c7cb439b95c"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  $result = json_decode($response, true);

		  echo"<option selected value=''>Pilih Kota/Kab</option>";
		  foreach($result['rajaongkir']['results'] as $data){
		    // echo $data['city_id']." ".$data['city_name']."<br/>";
		    echo "<option value='".$data['city_id']." - ".$data['city_name']."'>".$data['city_name']."</option>";
		  }
		}
	}
}


if (!empty($_GET['k']) and !empty($_GET['b'])) {
	$tempkota	= explode(" - ", $_GET['k']);
	if (ctype_digit($tempkota[0]) and ctype_digit($_GET['b'])) {
		$curl = curl_init();
		
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "origin=".$dataPengirimanBase."&destination=".$tempkota[0]."&weight=".$_GET['b']."&courier=jne",
		  CURLOPT_HTTPHEADER => array(
		    "content-type: application/x-www-form-urlencoded",
		    "key: 5cc85ff7a586d26b9fb20c7cb439b95c"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  $result = json_decode($response, true);

		  echo"<option selected value=''>Pilih Harga</option>";

		  foreach($result['rajaongkir']['results'] as $data){
		    foreach ($data['costs'] as $ongkir) {
		      #echo $ongkir['service']." ";
		      #echo "<option value='".$data['code']."'>".$ongkir['service']." - ";
		      foreach ($ongkir['cost'] as $a) {
		        #echo $a['value']."</option>";
		        echo "<option value='".$data['code']." - ".$ongkir['service']." - ".$a['value']."'>".$ongkir['service']." - ".$a['value']."</option>";
		      }
		    }
		  }
		}

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "origin=".$dataPengirimanBase."&destination=".$tempkota[0]."&weight=".$_GET['b']."&courier=pos",
		  CURLOPT_HTTPHEADER => array(
		    "content-type: application/x-www-form-urlencoded",
		    "key: 5cc85ff7a586d26b9fb20c7cb439b95c"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  $result = json_decode($response, true);

		  foreach($result['rajaongkir']['results'] as $data){
		    foreach ($data['costs'] as $ongkir) {
		      #echo $ongkir['service']." ";
		      #echo "<option value='".$data['code']." - ".$ongkir['service']." - ".$a['value']."'>".$ongkir['service']." - ".$a['value']."</option>";
		      foreach ($ongkir['cost'] as $a) {
		        #echo $a['value']."</option>";
		        echo "<option value='".$data['code']." - ".$ongkir['service']." - ".$a['value']."'>".$ongkir['service']." - ".$a['value']."</option>";
		      }
		    }
		  }
		}
	}
}

if (!empty($_GET['n'])) {
	function FormatRupiah($nominal){
		$Rupiah = "Rp " . number_format($nominal,0,',','.');
		return $Rupiah;
	}

	$ongkir = explode(" - ", $_GET['n']);
	$data['jasa'] = $ongkir[0];
	$data['paket'] = $ongkir[1];
	$data['harga'] = $ongkir[2];
	print_r(json_encode($data));
}

// if (!empty($_GET['n']) and !empty($_GET['t'])) {
// 	if (ctype_digit($_GET['t'])) {
// 		function FormatRupiah($nominal){
// 			$Rupiah = "Rp " . number_format($nominal,0,',','.');
// 			return $Rupiah;
// 		}

// 		$ongkir = explode(" - ", $_GET['n']);
// 		$_SESSION['total'] = $_GET['t'] + $ongkir[1];
// 		echo FormatRupiah($ongkir[1])."-".FormatRupiah($_SESSION['total'])z;
// 	}
// }


/*-----------------------------*/

if (!empty($_GET['pd'])) {
	$tempprov	= explode(" - ", $_GET['pd']);
	if (ctype_digit($tempprov[0])) {
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://api.rajaongkir.com/starter/city?province=".$tempprov[0]."",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
		    "key: 5cc85ff7a586d26b9fb20c7cb439b95c"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  $result = json_decode($response, true);

		  echo"<option selected value=''>Pilih Kota/Kab</option>";
		  foreach($result['rajaongkir']['results'] as $data){
		    // echo $data['city_id']." ".$data['city_name']."<br/>";
		    echo "<option value='".$data['city_id']." - ".$data['city_name']."'>".$data['city_name']."</option>";
		  }
		}
	}
}
?>

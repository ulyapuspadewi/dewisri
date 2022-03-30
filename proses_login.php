<?php
session_start();
include './config.php';

$username = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT * FROM member WHERE email = '".$username."' AND password = '".$password."' AND statusMember = 'Aktif'";
$result = $link->query($query);
$count = $result->num_rows;
if($count > 0){
  while ($data = $result->fetch_assoc()) {
    $_SESSION['nama'] = $data['nama'];
    $_SESSION['username'] = $data['email'];
    $_SESSION['password'] = $data['password'];
    $_SESSION['id'] = $data['id_member'];
    $_SESSION['memberChar'] = 1;
    echo '
    <script>
      window.location.href="'.$urlbase.'";
    </script>
    ';
  }
}else{
  echo '
  <script>
    alert("username atau password anda tidak tersedia");
    window.location.href="'.$urlbase.'login.php";
  </script>
  ';
}

?>

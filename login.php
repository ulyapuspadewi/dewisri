<?php
include './config.php';
session_start();
if (!empty($_SESSION['memberChar'])) {
  echo '<script>window.location.href="'.$urlbase.'"</script>';
}

 ?>
<!DOCTYPE html>
<html style="height:auto">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="./admin/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="./admin/plugins/daterangepicker/daterangepicker-bs3.css">
    <link rel="stylesheet" href="./admin/plugins/iCheck/all.css">
    <link rel="stylesheet" href="./admin/plugins/colorpicker/bootstrap-colorpicker.min.css">
    <link rel="stylesheet" href="./admin/plugins/timepicker/bootstrap-timepicker.min.css">
    <link rel="stylesheet" href="./admin/plugins/select2/select2.min.css">
    <link rel="stylesheet" href="./admin/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="./admin/dist/css/skins/_all-skins.min.css">
	  <link rel="shortcut icon" href="<?php echo $urlbase."assets/images/design/favicon.png"; ?>">
    <style>
      .form-login{
        margin-top: 10%;
        padding-left: 30px;
        padding-right: 30px;
        border: solid 1px #d0d0d0;
        border-radius: 5px;
      }
    </style>
  </head>

  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="../"><b>Dewi Sri</b> Login</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Mulai menggunakan aplikasi</p>
        <form action="proses_login.php" method="post">
          <div class="form-group has-feedback">
            <input type="email" class="form-control" placeholder="Email" name="email">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">

            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

  </body>
</html>

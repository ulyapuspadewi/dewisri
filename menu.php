<div class="header-area">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="user-menu">
                  <ul>
                    <li><a href="<?php echo $urlbase.'akun'?>"><i class="icon fa fa-user"></i>Akun Saya</a></li>
                    <li><a href="<?php echo $urlbase.'produk'?>"><i class="icon fa fa-shopping-cart"></i>Keranjang Saya</a></li>
                    <?php if(empty($_SESSION['memberChar'])){ ?>
                    <li><a href="<?php echo $urlbase.'daftar/'?>"><i class="icon fa fa-sign-in"></i>Daftar</a></li>
                    <li><a href="<?php echo $urlbase.'login.php'?>"><i class="icon fa fa-sign-in"></i>Masuk</a></li>
                    <?php }else{?>
                    <li><a href="<?php echo $urlbase.'logout.php'?>"><i class="icon fa fa-sign-in"></i>Keluar</a></li>
                    <?php }?>
                  </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="site-branding-area">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="logo">
                    <a href="<?php echo $urlbase; ?>">
                         <h1><img src="<?php echo $urlbase.'assets/'?>img/dewisri.png"></h1>
                    </a>                
                </div>
            </div>
			<div class="col-sm-4">
				<div class="ulya">
					<i class="icon fa fa-phone"></i> <?php echo $dataWebsite['noHp']; ?> | 
				    <i class="icon fa fa-envelope"></i> <?php echo $dataWebsite['email']; ?>

				</div>
    
            </div>
            <div class="col-sm-4">
                <div class="shopping-item">
                  <a href="<?php echo $urlbase.'produk'?>">Keranjang - <span class="cart-amunt">
                  <?php
                    $hrg = 0;
                    $jml = 0;
                      if(!empty($_SESSION['cart_product'][@$_SESSION['id']])){
                        foreach ($_SESSION['cart_product'][@$_SESSION['id']] as $key => $value) {
                          $hrg = $hrg+$value['subtotal'];
                          $jml = $jml+1;
                        }
                        echo FormatRupiah($hrg);
                      }
                     ?>
                   </span> <i class="fa fa-shopping-cart"></i> <span class="product-count"><?php echo $jml; ?></span></a>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End site branding area -->

<div class="mainmenu-area" 
    style="background-color: #42ca98;"
>

    <div class="container">
        <div class="row">
<div class="col-md-8">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="<?php echo (empty($uri_segments[2])) ? 'active' : ''; ?>"><a href="<?php echo $urlbase;?>">Beranda</a></li>
                    <li class="<?php echo ($uri_segments[2] == 'produk') ? 'active' : ''; ?>"><a href="<?php echo $urlbase.'produk';?>">Produk</a></li>
                    <li class="<?php echo ($uri_segments[2] == 'artikel') ? 'active' : ''; ?>"><a href="<?php echo $urlbase.'artikel';?>">Artikel</a></li>
                    <li class="<?php echo ($uri_segments[2] == 'contact') ? 'active' : ''; ?>"><a href="<?php echo $urlbase.'contact';?>">Kontak</a></li>
                    <li class="<?php echo ($uri_segments[2] == 'testimoni') ? 'active' : ''; ?>"><a href="<?php echo $urlbase.'testimoni';?>">Testimoni</a></li>
                    <li class="<?php echo ($uri_segments[2] == 'konfirmasi') ? 'active' : ''; ?>"><a href="<?php echo $urlbase.'konfirmasi';?>">Kofirmasi</a></li>
                    <li class="<?php echo ($uri_segments[2] == 'retur') ? 'active' : ''; ?>"><a href="<?php echo $urlbase.'retur';?>">Retur</a></li>
                </ul>
            </div>
        </div>
		</div>
    </div>
	
</div>


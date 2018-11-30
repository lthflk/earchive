<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>E-ARSIP KABUPATEN BENGKALIS<?php if (isset($title)) {
    echo " - " . $title;
}
?></title>

    <!-- Bootstrap Core CSS -->
	<link type="text/css" rel="stylesheet" href="<?php echo base_url('/public/css/flatly.bootstrap.min.css') ?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo base_url('/public/css/tabs.css') ?>" />
	<link type="text/css" rel="stylesheet" href="<?php echo base_url('/public/css/heroic-features.css') ?>" />
	<link type="text/css" rel="stylesheet" href="<?php echo base_url('/public/css/jquery-ui.min.css') ?>" />
	<link type="text/css" rel="stylesheet" href="<?php echo base_url('/public/css/jquery-ui.structure.min.css') ?>" />
	<link type="text/css" rel="stylesheet" href="<?php echo base_url('/public/css/jquery-ui.theme.min.css') ?>" />
	<link type="text/css" rel="stylesheet" href="<?php echo base_url('/public/css/chosen.css') ?>" />
	<link type="text/css" rel="stylesheet" href="<?php echo base_url('/public/css/jquery.auto-complete.css') ?>" />
	<link type="text/css" rel="stylesheet" href="<?php echo base_url('/public/css/custom.css') ?>" />
	<script>
		var base_url = '<?php echo base_url(); ?>';
		var site_url = '<?php echo site_url(); ?>';
	</script>
    <link href="<?php echo base_url('/public/logoatas.png') ?>" rel="icon" />

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">

            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-menu">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a style="padding-top: 13px;" class="navbar-brand" href="<?php echo site_url('/home'); ?>"><img src="<?php echo base_url('/public/images/logo.png'); ?>" alt="KABUPATEN BENGKALIS" height="35"></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="main-menu">
                <ul class="nav navbar-nav">
					<?php
                    // echo $_SESSION['nama_dep'];
                    if (isset($_SESSION['akses_modul']['entridata']) && $_SESSION['akses_modul']['entridata'] == 'on') {
                        echo '<li><a href="' . site_url('/admin/entr') . '"><i class="glyphicon glyphicon-plus"></i> Entri Data Baru</a></li>';
                    }
                    if (isset($_SESSION['akses_modul']['sirkulasi']) && $_SESSION['akses_modul']['sirkulasi'] == 'on') {
                        echo '<li><a href="' . site_url('/sirkulasi') . '"><i class="glyphicon glyphicon-refresh"></i> Sirkulasi</a></li>';
                    }
                    if ($_SESSION['menu_master']) {
                         echo '<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<i class="glyphicon glyphicon-th-large"></i> Data Master <span class="caret"></span></a><ul class="dropdown-menu">';
                        if (isset($_SESSION['akses_modul']['klasifikasi']) && $_SESSION['akses_modul']['klasifikasi'] == 'on') {
                            echo "<li><a href=\"" . site_url('admin/klas') . "\"><i class=\"glyphicon glyphicon-tag\"></i> Klasifikasi</a></li>";
                        }
                        if (isset($_SESSION['akses_modul']['pencipta']) && $_SESSION['akses_modul']['pencipta'] == 'on') {
                            echo "<li><a href=\"" . site_url('admin/penc') . "\"><i class=\"glyphicon glyphicon-home\"></i> Pencipta arsip</a></li>";
                        }
                        if (isset($_SESSION['akses_modul']['pengolah']) && $_SESSION['akses_modul']['pengolah'] == 'on') {
                            echo "<li><a href=\"" . site_url('admin/pengolah') . "\"><i class=\"glyphicon glyphicon-home\"></i> Unit Pengolah</a></li>";
                        }
                        if (isset($_SESSION['akses_modul']['lokasi']) && $_SESSION['akses_modul']['lokasi'] == 'on') {
                            echo "<li><a href=\"" . site_url('admin/lokasi') . "\"><i class=\"glyphicon glyphicon-map-marker\"></i> Lokasi</a></li>";
                        }
                        if (isset($_SESSION['akses_modul']['media']) && $_SESSION['akses_modul']['media'] == 'on') {
                            echo "<li><a href=\"" . site_url('admin/media') . "\"><i class=\"glyphicon glyphicon-film\"></i> Media</a></li>";
                        }
                        if (isset($_SESSION['akses_modul']['user']) && $_SESSION['akses_modul']['user'] == 'on') {
                            echo "<li><a href=\"" . site_url('admin/vuser') . "\"><i class=\"glyphicon glyphicon-user\"></i> User</a></li>";
                        }
                         if (isset($_SESSION['akses_modul']['departemen']) && $_SESSION['akses_modul']['departemen'] == 'on') {
                            echo "<li><a href=\"" . site_url('admin/departemen') . "\"><i class=\"glyphicon glyphicon-th\"></i> Departemen</a></li>";
                         }
                        if (isset($_SESSION['akses_modul']['import']) && $_SESSION['akses_modul']['import'] == 'on') {
                            echo "<li><a href=\"" . site_url('admin/import') . "\"><i class=\"glyphicon glyphicon-tasks\"></i> Import Data</a></li>";
                        }
                         if ((isset($_SESSION['akses_modul']['backupdb']) && $_SESSION['akses_modul']['backupdb'] == 'on') && $_SESSION['tipe'] == 'sumin'){
                            echo "<li><a href=\"" . site_url('admin/backupdb') . "\"><i class=\"glyphicon glyphicon-tasks\"></i> Cadangkan Database</a></li>";
                        }

                        echo "</ul>
                        </li>";
                    }
                    echo "<li><a href=\"#\" data-toggle=\"modal\" data-backdrop=\"false\" data-target=\"#panduan\"><span class=\"nav navbar-nav navbar-left\"></span> Panduan</a></li>";
?>
                    <!-- pandaun -->
                    <div class="modal fade" id="panduan">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title">Lihat Panduan</h4>
                          </div>
                          <div class="modal-body">
                            <form id="fpanduan" class="form-horizontal" role="form" method="post" action="">
                        
                                <object 
                                data= <?php echo base_url('/public/panduan.pdf'); 
                                        ?>
                                
                                type="application/pdf" width="100%" height="750px">
                                <embed src= <?php echo base_url('/public/panduan.pdf'); 
                                                ?>>

                                    <p>This browser does not support PDFs. Please download the PDF to view it: 
                                        <a href= <?php echo base_url('/public/panduan.pdf'); 
                                                    ?>>

                                        Download PDF
                                        </a>.
                                    </p>
                                </embed>
                                </object>

                            </form>
                          </div>
                        </div><!-- /.modal-content -->
                      </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                 <!-- pandaun -->

                </ul>
				<ul class="nav navbar-nav navbar-right">
					<?php
if (isset($_SESSION['username'])) {
    echo "<li><a href=\"#\"><span class=\"nav navbar-nav navbar-left\"></span> " . $_SESSION['nama_dep'] . "</a></li>";
    echo "<li><a href=\"#\"><span class=\"glyphicon glyphicon-user\"></span> " . $_SESSION['username'] . "</a></li>";
    echo "<li><a href=\"" . site_url('home/logout') . "\"><span class=\"glyphicon glyphicon-log-out\"></span> Logout</a></li>";
} else {
    echo "<li><a href=\"" . site_url('home/login') . "\"><span class=\"glyphicon glyphicon-log-in\"></span> Login</a></li>";
}
?>
				</ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

	<!-- Page Content -->
    <div class="container">
    
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 // $this->load->view('header-lokasi');
?>
<nav class="navbar navbar-inverse navbar-submenu">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#module-submenu" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" >Data Baris Arsip</a>
    </div>
    <form class="navbar-form navbar-left width-half-full" method="get" action="<?php echo site_url('/admin/baris'); ?>">
    </form>
  
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="module-submenu">
      <ul class="nav navbar-nav navbar-right">
	       <?php if(isset($_SESSION['akses_modul']['lokasi']) && $_SESSION['akses_modul']['lokasi']=='on') : ?>
	       <li><a href="#" data-toggle="modal" data-target="#addbar"><i class="glyphicon glyphicon-plus"></i> Entry Data Baru</a></li>
        <?php endif; ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="space12"> <!-- mengambil nilai dari GET -->
        <a class="btn btn-default" href="<?php echo site_url('/admin/lokasi'); ?>">
        Lokasi : <i>"<?php echo $nama_lokasi; ?>"</i>
        </a>
        <a class="btn btn-default" href="<?php echo base_url()."index.php/admin/lantai?id_lokasi=".$_GET['id_lokasi']; ?>">
        Lantai : <i>"<?php echo $nomor_lantai; ?>"</i>
        </a>
        <a class="btn btn-default" href="<?php echo base_url()."index.php/admin/ruangan?id_lantai=".$_GET['id_lantai']."&id_lokasi=".$_GET['id_lokasi']; ?>">
        Ruangan : <i>"<?php echo $nama_ruangan; ?>"</i>
        </a>
        <a class="btn btn-default" href="<?php echo base_url()."index.php/admin/lemari?id_ruangan=".$_GET['id_ruangan']."&id_lantai=".$_GET['id_lantai']."&id_lokasi=".$_GET['id_lokasi']; ?>">
        Lemari : <i>"<?php echo $nomor_lemari; ?>"</i>
        </a>
        <a class="btn btn-default" href="">
        Baris
        </a>
</div>

<div class="row">
    <div class="col-md-12" id="divtabelbar">
    <table class="table table-bordered" name="vbar" id="vbar">
    <thead>
        <th class="width-sm">No</th>
        <th>No Baris</th>
        <th class='width-sm'></th>
        <th class='width-sm'></th>
    </thead>
    <?php
        if(isset($bar)){
            $no=1;
            foreach($bar as $u) {
                echo "<tr>";
                echo "<td>".$no."</td>";
                $link_baris = base_url()."index.php/admin/baris?id_ruangan=".$u['id_baris'];
                echo "<td>" . $u['no_baris'] . "</td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#editbar\" class='edbar' href='#' id='" . $u['id_baris'] . "' title=\"Edit\" )'><i class=\"glyphicon glyphicon-edit\"></i> </a></td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#delbar\" class='delbar' href='#' id='" . $u['id_baris'] . "' title=\"Delete\"><i class=\"glyphicon glyphicon-trash\"></i> </a></td>";
                echo "</tr>";
                $no++;
            }
        }
    ?>
    </table>
    </div>
</div>

<div class="modal fade" id="addbar">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Tambah Baris Arsip</h4>
      </div>
	  <div class="modal-body">
		<form id="faddbar" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/admin/addbar"); ?>">
      <input type="hidden" name="id_lemari" value="<?php echo $_GET['id_lemari']; ?>">
      <div class="form-group">
				<label class="col-sm-2 control-label" for="no_baris">No Baris</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="no_baris" name="no_baris" />
				</div>
			</div>
		</form>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="addbargo">Simpan</button>
	  </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" id="editbar">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Edit Baris Arsip</h4>
      </div>
	  <div class="modal-body">
		<form id="fedbar" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/admin/edbar"); ?>">
            <input type="hidden" name="id_baris" id="edidbar" value="">
      <div class="form-group">
				<label class="col-sm-2 control-label" for="no_baris">Nama Baris</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="eno_baris" name="no_baris" />
				</div>
			</div>
		</form>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="editbargo">Simpan</button>
	  </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="delbar">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Delete Baris Arsip</h4>
      </div>
	  <div class="modal-body">
		<form id="fdelbar" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/admin/delbar"); ?>">
			<h4 class="modal-title">Yakin ingin Hapus data ini?</h4>
            <input type="hidden" name="id" id="delidbar" value="">
		</form>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="delbargo">Hapus</button>
	  </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
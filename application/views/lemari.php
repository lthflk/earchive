<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
      <a class="navbar-brand">Data Lemari Arsip</a>
    </div>
    <form class="navbar-form navbar-left width-half-full" method="get" action="<?php echo site_url('/admin/lemari'); ?>">
    </form>
  
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="module-submenu">
      <ul class="nav navbar-nav navbar-right">
	       <?php if(isset($_SESSION['akses_modul']['lokasi']) && $_SESSION['akses_modul']['lokasi']=='on') : ?>
	       <li><a href="#" data-toggle="modal" data-target="#addlem"><i class="glyphicon glyphicon-plus"></i> Entry Data Baru</a></li>
        <?php endif; ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="space12">
        <a class="btn btn-default" href="<?php echo site_url('/admin/lokasi'); ?>">
        Lokasi : <i>"<?php echo $nama_lokasi; ?>"</i>
        </a>
        <a class="btn btn-default" href="<?php echo base_url()."index.php/admin/lantai?id_lokasi=".$_GET['id_lokasi']; ?>">
        Lantai : <i>"<?php echo $nomor_lantai; ?>"</i>
        </a>
        <a class="btn btn-default" href="<?php echo base_url()."index.php/admin/ruangan?id_lantai=".$_GET['id_lantai']."&id_lokasi=".$_GET['id_lokasi']; ?>">
        Ruangan : <i>"<?php echo $nama_ruangan; ?>"</i>
        </a>
        <a class="btn btn-default" href="">
        Lemari
        </a>
</div>

<div class="row">
    <div class="col-md-12" id="divtabellem">
    <table class="table table-bordered" name="vlem" id="vlem">
    <thead>
        <th class="width-sm">No</th>
        <th>No Lemari</th>
        <th class='width-sm'></th>
        <th class='width-sm'></th>
    </thead>
    <?php
        if(isset($lem)){
            $no=1;
            foreach($lem as $u) {
                echo "<tr>";
                echo "<td>".$no."</td>";
                $link_lemari = base_url()."index.php/admin/baris?id_lemari=".$u['id_lemari']."&id_ruangan=".$_GET['id_ruangan']."&id_lantai=".$_GET['id_lantai']."&id_lokasi=".$_GET['id_lokasi'];
                echo "<td><a href='".$link_lemari."'>" . $u['no_lemari'] . "</td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#editlem\" class='edlem' href='#' id='" . $u['id_lemari'] . "' title=\"Edit\" )'><i class=\"glyphicon glyphicon-edit\"></i> </a></td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#dellem\" class='dellem' href='#' id='" . $u['id_lemari'] . "' title=\"Delete\"><i class=\"glyphicon glyphicon-trash\"></i> </a></td>";
                echo "</tr>";
                $no++;
            }
        }
    ?>
    </table>
    </div>
</div>

<div class="modal fade" id="addlem">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Tambah Lemari Arsip</h4>
      </div>
	  <div class="modal-body">
		<form id="faddlem" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/admin/addlem"); ?>">
      <input type="hidden" name="id_ruangan" value="<?php echo $_GET['id_ruangan']; ?>">
      <div class="form-group">
				<label class="col-sm-2 control-label" for="no_lemari">No Lemari</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="no_lemari" name="no_lemari" />
				</div>
			</div>
		</form>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="addlemgo">Simpan</button>
	  </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" id="editlem">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Edit Lemari Arsip</h4>
      </div>
	  <div class="modal-body">
		<form id="fedlem" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/admin/edlem"); ?>">
            <input type="hidden" name="id_lemari" id="edidlem" value="">
      <div class="form-group">
				<label class="col-sm-2 control-label" for="no_lemari">No Lemari</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="eno_lemari" name="no_lemari" />
				</div>
			</div>
		</form>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="editlemgo">Simpan</button>
	  </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="dellem">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Delete Lemari Arsip</h4>
      </div>
	  <div class="modal-body">
		<form id="fdellem" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/admin/dellem"); ?>">
			<h4 class="modal-title">Yakin ingin Hapus data ini?</h4>
            <input type="hidden" name="id" id="delidlem" value="">
		</form>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="dellemgo">Hapus</button>
	  </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
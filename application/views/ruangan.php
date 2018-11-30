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
      <a class="navbar-brand">Data Ruangan Arsip</a>
    </div>
    <form class="navbar-form navbar-left width-half-full" method="get" action="<?php echo site_url('/admin/ruangan'); ?>">
    </form>
  
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="module-submenu">
      <ul class="nav navbar-nav navbar-right">
	       <?php if(isset($_SESSION['akses_modul']['lokasi']) && $_SESSION['akses_modul']['lokasi']=='on') : ?>
	       <li><a href="#" data-toggle="modal" data-target="#addrua"><i class="glyphicon glyphicon-plus"></i> Entry Data Baru</a></li>
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
        <a class="btn btn-default" href="">
        Ruangan
        </a>
</div>

<div class="row">
    <div class="col-md-12" id="divtabelrua">
    <table class="table table-bordered" name="vrua" id="vrua">
    <thead>
        <th class="width-sm">No</th>
        <th>Nama Ruangan</th>
        <th class='width-sm'></th>
        <th class='width-sm'></th>
    </thead>
    <?php
        if(isset($rua)){
            $no=1;
            foreach($rua as $u) {
                echo "<tr>";
                echo "<td>".$no."</td>";
                $link_ruangan = base_url()."index.php/admin/lemari?id_ruangan=".$u['id_ruangan']."&id_lantai=".$_GET['id_lantai']."&id_lokasi=".$_GET['id_lokasi'];
                echo "<td><a href='".$link_ruangan."'>" . $u['nama_ruangan'] . "</td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#editrua\" class='edrua' href='#' id='" . $u['id_ruangan'] . "' title=\"Edit\" )'><i class=\"glyphicon glyphicon-edit\"></i> </a></td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#delrua\" class='delrua' href='#' id='" . $u['id_ruangan'] . "' title=\"Delete\"><i class=\"glyphicon glyphicon-trash\"></i> </a></td>";
                echo "</tr>";
                $no++;
            }
        }
    ?>
    </table>
    </div>
</div>

<div class="modal fade" id="addrua">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Tambah Ruangan Arsip</h4>
      </div>
	  <div class="modal-body">
		<form id="faddrua" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/admin/addrua"); ?>">
      <input type="hidden" name="id_lantai" value="<?php echo $_GET['id_lantai']; ?>">
      <div class="form-group">
				<label class="col-sm-2 control-label" for="nama_ruangan">Nama ruangan</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="nama_ruangan" name="nama_ruangan" />
				</div>
			</div>
		</form>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="addruago">Simpan</button>
	  </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" id="editrua">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Edit Ruangan Arsip</h4>
      </div>
	  <div class="modal-body">
		<form id="fedrua" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/admin/edrua"); ?>">
            <input type="hidden" name="id_ruangan" id="edidrua" value="">
      <div class="form-group">
				<label class="col-sm-2 control-label" for="nama_ruangan">Nama Ruangan</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="enama_ruangan" name="nama_ruangan" />
				</div>
			</div>
		</form>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="editruago">Simpan</button>
	  </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="delrua">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Delete Ruangan Arsip</h4>
      </div>
	  <div class="modal-body">
		<form id="fdelrua" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/admin/delrua"); ?>">
			<h4 class="modal-title">Yakin ingin Hapus data ini?</h4>
            <input type="hidden" name="id" id="delidrua" value="">
		</form>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="delruago">Hapus</button>
	  </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
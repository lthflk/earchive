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
      <a class="navbar-brand" href="<?php echo site_url('/admin/departemen'); ?>">Departemen</a>
    </div>
    <form class="navbar-form navbar-left width-half-full" method="get" action="<?php echo site_url('/admin/departemen'); ?>">
    	  <div class="input-group width-full">
    	  <input type="text" name="katakunci" class="form-control" placeholder="kata kunci nama/kode/keterangan" /><span class="input-group-btn">
    	  	<button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i></button></span>
        </div>
    </form>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="module-submenu">
      <ul class="nav navbar-nav navbar-right">
	       <?php if(isset($_SESSION['akses_modul']['departemen']) && $_SESSION['akses_modul']['departemen']=='on') : ?>
          <?php if ($_SESSION['tipe'] == "sumin") {
	         echo '<li><a href="#" data-toggle="modal" data-target="#adddep"><i class="glyphicon glyphicon-plus"></i> Entry Departemen Baru</a></li>';
         } ?>
        <?php endif; ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="row">
    <div class="col-md-12" id="divtabeldept">
    <table class="table table-bordered" name="departemen" id="departemen">
    <thead>
        <th class="width-sm">No</th>
        <th>Kode Departemen</th>
        <th>Nama Departemen</th>
        <th>Keterangan</th>
        <?php if($_SESSION['tipe'] == "sumin"){
          echo '<th class="width-sm"></th>';
          echo '<th class="width-sm"></th>';
        }
        ?>
    </thead>
    <?php
        if(isset($dep)){
            $no=1;
            foreach($dep as $u) {
            	// var_dump($u);
                echo "<tr>";
                echo "<td>".$no."</td>";
                echo "<td>".$u['kode_dep']."</td>";
                echo "<td>".$u['nama_dep']."</td>";
				echo "</td>";
				echo "<td>".$u['keterangan']."</td>";
        if($_SESSION['tipe'] == "sumin"){
                echo "<td><a data-toggle=\"modal\" data-target=\"#editdep\" class='eddep' href='#' id='".$u['id_dep']."' title=\"Edit\" data-kode_dep='".$u['kode_dep']."' data-nama_dep='".$u['nama_dep']."' data-keterangan='".$u['keterangan']."'><i class=\"glyphicon glyphicon-edit\"></i> </a></td>";
        }
        if($_SESSION['tipe'] == "sumin"){
                echo "<td><a data-toggle=\"modal\" data-target=\"#deldep\" class='deldep' href='#' id='".$u['id_dep']."' title=\"Delete\"><i class=\"glyphicon glyphicon-trash\"></i> </a></td>";
        }
                echo "</tr>";
                $no++;
            }
        }
    ?>
    </table>
    </div>
</div>

<div class="modal fade" id="adddep">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Tambah Departemen</h4>
      </div>
	  <div class="modal-body">
		<form id="fadddep" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/admin/adddep"); ?>">
			<div class="form-group">
				<label class="col-sm-2 control-label" for="kode">Kode</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="kode" name="kode" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="nama">Nama</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="nama" name="nama" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="keterangan">Uraian</label>
				<div class="col-sm-10"/>
			  <textarea id="keterangan" name="keterangan" class="form-control" rows="3"></textarea>
				</div>
			</div>
			<input type="hidden" name="id_dep" value="" id="id_dep">
		</form>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="adddepgo">Simpan</button>
	  </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" id="editdep">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Edit Departemen</h4>
      </div>
	  <div class="modal-body">
		<form id="feddep" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/admin/eddep"); ?>">
            <input type="hidden" name="id" id="ediddep" value="">
			<div class="form-group">
				<label class="col-sm-2 control-label" for="kode">Kode</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="ekode" name="kode" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="depname">Name</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="ename" name="name" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="keterangan">Uraian</label>
				<div class="col-sm-10"/>
			  <textarea id="eketerangan" name="keterangan" class="form-control" rows="3"></textarea>
				</div>
			</div>
   				
		</form>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="editdepgo">Simpan</button>
	  </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="deldep">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Hapus Departemen</h4>
      </div>
	  <div class="modal-body">
		<form id="fdeldep" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/admin/deldep"); ?>">
			<h4 class="modal-title">Yakin ingin Hapus data ini?</h4>
            <input type="hidden" name="id" id="deliddep" value="">
		</form>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="deldepgo">Hapus</button>
	  </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
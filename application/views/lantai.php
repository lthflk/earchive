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
      <a class="navbar-brand">Data Lantai Arsip</a>
    </div>
    <form class="navbar-form navbar-left width-half-full" method="get" action="<?php echo site_url('/admin/lantai'); ?>">
    </form>
  
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="module-submenu">
      <ul class="nav navbar-nav navbar-right">
	       <?php if(isset($_SESSION['akses_modul']['lokasi']) && $_SESSION['akses_modul']['lokasi']=='on') : ?>
	       <li><a href="#" data-toggle="modal" data-target="#addlan"><i class="glyphicon glyphicon-plus"></i> Entry Data Baru</a></li>
        <?php endif; ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="space12">
        <a class="btn btn-default" href="<?php echo site_url('/admin/lokasi'); ?>">
        Lokasi : <i>"<?php echo $nama_lokasi; ?>"</i>
        </a>
        <a class="btn btn-default" href="">
        Lantai
        </a>
</div>

<div class="row">
    <div class="col-md-12" id="divtabellan">
    <table class="table table-bordered" name="vlan" id="vlan">
    <thead>
        <th class="width-sm">No</th>
        <th>No Lantai</th>
        <th class='width-sm'></th>
        <th class='width-sm'></th>
    </thead>
    <?php
        if(isset($lan)){
            $no=1;
            foreach($lan as $u) {
                echo "<tr>";
                echo "<td>".$no."</td>";
                $link_lantai = base_url()."index.php/admin/ruangan?id_lantai=".$u['id_lantai']."&id_lokasi=".$_GET['id_lokasi'];
                echo "<td><a href='".$link_lantai."'>" . $u['no_lantai'] . "</td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#editlan\" class='edlan' href='#' id='" . $u['id_lantai'] . "' title=\"Edit\" )'><i class=\"glyphicon glyphicon-edit\"></i> </a></td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#dellan\" class='dellan' href='#' id='" . $u['id_lantai'] . "' title=\"Delete\"><i class=\"glyphicon glyphicon-trash\"></i> </a></td>";
                echo "</tr>";
                $no++;
            }
        }
    ?>
    </table>
    </div>
</div>

<div class="modal fade" id="addlan">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Tambah Lantai Arsip</h4>
      </div>
	  <div class="modal-body">
		<form id="faddlan" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/admin/addlan"); ?>">
      <input type="hidden" name="id_lokasi" value="<?php echo $_GET['id_lokasi']; ?>">
      <div class="form-group">
				<label class="col-sm-2 control-label" for="no_lantai">No Lantai</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="no_lantai" name="no_lantai" />
				</div>
			</div>
		</form>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="addlango">Simpan</button>
	  </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" id="editlan">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Edit Lantai Arsip</h4>
      </div>
	  <div class="modal-body">
		<form id="fedlan" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/admin/edlan"); ?>">
            <input type="hidden" name="id_lantai" id="edidlan" value="">
      <div class="form-group">
				<label class="col-sm-2 control-label" for="no_lantai">No Lantai</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="eno_lantai" name="no_lantai" />
				</div>
			</div>
		</form>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="editlango">Simpan</button>
	  </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="dellan">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Delete Lantai Arsip</h4>
      </div>
	  <div class="modal-body">
		<form id="fdellan" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/admin/dellan"); ?>">
			<h4 class="modal-title">Yakin ingin Hapus data ini?</h4>
            <input type="hidden" name="id" id="delidlan" value="">
		</form>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="dellango">Hapus</button>
	  </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
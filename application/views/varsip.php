<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
<nav class="navbar navbar-inverse navbar-submenu">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="na�bar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#module-submenu" aria-expanded="false">
      </button>
      <a class="navbar-brand" href="#">Data Arsip</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->

<?php
// print_r($data);

if ($jenisdok == 1 && $_SESSION['tipe'] == "admin" || $_SESSION['tipe'] == "sumin"){

 echo '<div class="collapse navbar-collapse" id="module-submenu">
      <ul class="nav navbar-nav navbar-right">
		  <li><a href="'.site_url('/admin/vedit/'.$id); echo'"><i class="glyphicon glyphicon-pencil"></i> Edit Arsip</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->';
}
?>

  </div><!-- /.container-fluid -->
</nav>

<!-- Form Name -->
<div class="row">
<div class="col-md-6"> <!-- 1st column -->

<div class="view-group row">
	<label class="col-md-6 control-label" for="noarsip">Departemen</label>
	<label class="col-md-6 isi"><?php echo $kode_dep .' <br> ' . $nama_dep; ?></label>
</div>
<div class="view-group row">
	<label class="col-md-6 control-label" for="noarsip">Nomor Arsip</label>
	<label class="col-md-6 isi"><?php echo $noarsip; ?></label>
</div>

<div class="view-group row">
	<label class="col-md-6 control-label" for="tanggal">Tanggal Penciptaan</label>
	<label class="col-md-6 isi"><?php echo  date_format(date_create($tanggal),'d-M-Y');
		if($f=='sudah') {
			echo "<br /><b>Retensi Sudah Lewat : ".date_format(date_create($b),'d-M-Y')."</b>";
		}else {
			echo "<br />Retensi tanggal : ".date_format(date_create($b),'d-M-Y');
		}
	?>
	</label>
</div>

<div class="view-group row">
	<label class="col-md-6 control-label" for="pencipta">Pencipta Arsip</label>
	<label class="col-md-6 isi"><?php echo $nama_pencipta; ?></label>
</div>

<div class="view-group row">
	<label class="col-md-6 control-label" for="unitpengolah">Unit Pengolah</label>
	<label class="col-md-6 isi"><?php echo $nama_pengolah; ?></label>
</div>

<div class="view-group row">
	<label class="col-md-6 control-label" for="kode">Kode Klasifikasi</label>
	<label class="col-md-6 isi"><?php echo $nama_kode." - ".$nama; ?></label>
</div>

<div class="view-group row">
	<label class="col-md-6 control-label" for="uraian">Uraian</label>
	<label class="col-md-6 isi"><?php echo $uraian; ?></label>
</div>

</div><!-- /1st column -->

<div class="col-md-6"><!-- 2nd column -->
<div class="view-group row">
	<label class="col-md-6 control-label" for="lokasi">Lokasi Arsip</label>
	<label class="col-md-6 isi"><?php echo $nama_lokasi; ?></label>
</div>

<div class="view-group row">
	<label class="col-md-6 control-label" for="lantai">Lantai Arsip</label>
	<label class="col-md-6 isi"><?php echo $no_lantai; ?></label>
</div>

<div class="view-group row">
	<label class="col-md-6 control-label" for="ruangan">Ruangan Arsip</label>
	<label class="col-md-6 isi"><?php echo $nama_ruangan; ?></label>
</div>

<div class="view-group row">
	<label class="col-md-6 control-label" for="lemari">Lemari Arsip</label>
	<label class="col-md-6 isi"><?php echo $no_lemari; ?></label>
</div>

<div class="view-group row">
	<label class="col-md-6 control-label" for="baris">Baris Arsip</label>
	<label class="col-md-6 isi"><?php echo $no_baris; ?></label>
</div>

<div class="view-group row">
	<label class="col-md-6 control-label" for="media">Jenis Media</label>
	<label class="col-md-6 isi"><?php echo $nama_media; ?></label>
</div>

<div class="view-group row">
	<label class="col-md-6 control-label" for="ket">Keterangan Keaslian</label>
	<label class="col-md-6 isi"><?php echo $ket; ?></label>
</div>

<div class="view-group row">
	<label class="col-md-6 control-label" for="jenisdok">Jenis Data</label>
	<label class="col-md-6 isi"><?php echo ($jenisdok == 1?"Biasa":"Rahasia"); ?></label>
</div>
<div class="view-group row">
	<label class="col-md-6 control-label" for="jumlah">Jumlah</label>
	<label class="col-md-6 isi"><?php echo $jumlah; ?></label>
</div>

<div class="view-group row">
	<label class="col-md-6 control-label" for="nobox">Nomor Box</label>
	<label class="col-md-6 isi"><?php echo $nobox; ?></label>
</div>

<div class="view-group row">
	<label class="col-md-6 control-label" for="nobox">File</label>
	<label class="col-md-6 isi"><?php echo ($file==""?"":"<a href='".base_url('files/'.$file)."' target='_blank'>".$file."</a>"); ?><br>
	<?php if($file != null){ ?>
	<a href="#" data-toggle="modal" data-target="#file"><i class="glyphicon glyphicon-eye-open"></i> Lihat File</a><label>
						<?php }else
							{

						}
						?>
</div>

<div class="modal fade" id="file">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Lihat File</h4>
      </div>
	  <div class="modal-body">
		<form id="ffile" class="form-horizontal" role="form" method="post" action="">
	
		<?php
	if ($file != null) { 
?>
		<object 
		data= <?php echo base_url('files/'.$file); 
				?>
		
		type="application/pdf" width="100%" height="750px">
	    <embed src= <?php echo base_url('files/'.$file); 
	    				?>>

	        <p>This browser does not support PDFs. Please download the PDF to view it: 
	        	<a href= <?php echo base_url('files/'.$file); 
	        				?>>

	        	Download PDF
	        	</a>.
	        </p>
	    </embed>
		</object>
<?php
	} else {
	
	}
?>

		</form>
	  </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="view-group row">
	<label class="col-md-6 control-label" for="nobox">Nama penginput</label>
	<label class="col-md-6 isi"><?php echo $username; ?></label>
</div>

<div class = "view-group row" style="border-top:1px solid #999">
	<div class="col-md-12">
		<?php
		// var_dump($_SESSION['tipe']);
		if ($_SESSION['tipe'] == "admin" || $_SESSION['tipe'] == "sumin"){
			echo "Telah dilihat oleh :";
		//looping untuk generate nama, biar ada koma
			for ($i=0; $i < count($visitor); $i++) { 
					echo $visitor[$i]['username']." (".$visitor[$i]['visited_times']." kali)";
					if($i != count($visitor)-1){
						echo ", ";
					}
				}
		} else {
			echo "Telah dilihat sebanyak : ";
			echo $visitor[0]['visited_times']." kali";
		}

		?>
	</div>

</div>

</div><!-- /2nd column -->
</div><!-- /.row -->
</div>
</div>
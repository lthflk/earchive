<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<form class="form-horizontal" data-toggle="validator" action="<?php echo site_url('/admin/edit'); ?>" method="post" enctype="multipart/form-data">
<fieldset>
<input type="hidden" name="id" value="<?php echo $id ?>">
<input type="hidden" name="previous" value="<?php echo $previous ?>">
<!-- Form Name -->
<legend>Entri Data</legend>
<div class="row">
<div class="col-md-6"> <!-- 1st column -->

<?php
if($_SESSION['tipe'] == 'sumin')
{
}
else{
echo '<input type="hidden" name="departemen" value="' .$_SESSION["depar"].'">';
}
?>

<div class="form-group">
	<label class="col-md-4 control-label" for="departemen">Departemen</label>
	<div class="col-md-8">
	<select id="departemen" name="departemen" class="form-control input-md" 
	<?php
	if($_SESSION['tipe'] != 'sumin')
		{
			echo 'disabled';	
		}
	?>
	>
	<?php
		if(isset($departemen2)){
			foreach($departemen2 as $k) {
				echo "<option value='".$k['id_dep']."'".($dep==$k['id_dep']?"selected=selected":"")." >".$k['nama_dep']."</option>";
			}
		}
	?>
	</select>
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label" for="noarsip">Nomor Arsip</label>
	<div class="col-md-8">
	<input id="noarsip" name="noarsip" class="form-control input-md" type="text" value="<?php echo $noarsip ?>">
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label" for="tanggal">Tanggal Penciptaan</label>
	<div class="col-md-8">
  <div class="input-group">
    <div class="input-group-addon">(yyyy-mm-dd)</div>
    <input id="tanggal" name="tanggal" class="form-control input-md" type="text" value="<?php echo $tanggal ?>">
	</div>
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label" for="pencipta">Pencipta Arsip</label>
	<div class="col-md-8">
	<select id="pencipta" name="pencipta" class="form-control input-md chosen">
	<?php
		if(isset($pencipta2)){
			foreach($pencipta2 as $k) {
				echo "<option value='".$k['id']."'".($pencipta==$k['id']?"selected=selected":"")." >".$k['nama_pencipta']."</option>";
			}
		}
	?>
	</select>
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label" for="unitpengolah">Unit Pengolah</label>
	<div class="col-md-8">
	<select id="unitpengolah" name="unitpengolah" class="form-control input-md chosen">
	<?php
		if(isset($unitpengolah2)){
			foreach($unitpengolah2 as $k) {
				echo "<option value='".$k['id']."'".($unitpengolah==$k['id']?"selected=selected":"")." >".$k['nama_pengolah']."</option>";
			}
		}
	?>
	</select>
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label" for="kode">Kode Klasifikasi</label>
	<div class="col-md-8">
	<select id="kode" name="kode" class="form-control input-md chosen">
	<?php
		if(isset($kode2)){
			foreach($kode2 as $k) {
				echo "<option value='".$k['id']."'".($kode==$k['id']?"selected=selected":"")." >".$k['nama']." - ".$k['kode']."</option>";
			}
		}
	?>
	</select>
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label" for="uraian">Uraian</label>
	<div class="col-md-8">
  <textarea id="uraian" name="uraian" class="form-control" rows="3"><?php echo $uraian ?></textarea>
	</div>
</div>
</div><!-- /1st column -->

<div class="col-md-6"><!-- 2nd column -->
<div class="form-group">
	<label class="col-md-4 control-label" for="lokasi">Lokasi Arsip</label>
	<div class="col-md-8">
	<select id="lokasi_arsip" name="lokasi" class="form-control input-md chosen">
	<?php
		if(isset($lokasi2)){
			foreach($lokasi2 as $k) {
				echo "<option value='".$k['id']."'".($lokasi==$k['id']?"selected=selected":"")." >".$k['nama_lokasi']."</option>";
			}
		}
	?>
	</select>
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label" for="lantai">Lantai Arsip</label>
	<div class="col-md-8">
	<select id="lantai_arsip" name="lantai" class="form-control input-md">
	<?php
		if(isset($lantai2)){
			foreach($lantai2 as $k) {
				if($lokasi == $k['id']){
					echo "<option value='".$k['id_lantai']."'".($lantai==$k['id_lantai']?"selected=selected":"")." >".$k['no_lantai']."</option>";
				}
				
			}
		}
	?>
	</select>
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label" for="ruangan">ruangan Arsip</label>
	<div class="col-md-8">
	<select id="ruangan_arsip" name="ruangan" class="form-control input-md">
	<?php
		if(isset($ruangan2)){
			foreach($ruangan2 as $k) {
				if($lantai==$k['id_lantai']){
				echo "<option value='".$k['id_ruangan']."'".($ruangan==$k['id_ruangan']?"selected=selected":"")." >".$k['nama_ruangan']."</option>";
				}
			}
		}
	?>
	</select>
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label" for="lemari">lemari Arsip</label>
	<div class="col-md-8">
	<select id="lemari_arsip" name="lemari" class="form-control input-md">
	<?php
		if(isset($lemari2)){
			foreach($lemari2 as $k) {
				if($ruangan==$k['id_ruangan']){
				echo "<option value='".$k['id_lemari']."'".($lemari==$k['id_lemari']?"selected=selected":"")." >".$k['no_lemari']."</option>";
				}
			}		
		}
	?>
	</select>
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label" for="baris">baris Arsip</label>
	<div class="col-md-8">
	<select id="baris_arsip" name="baris" class="form-control input-md">
	<?php
		if(isset($baris2)){
			foreach($baris2 as $k) {
				if($lemari==$k['id_lemari']){
				echo "<option value='".$k['id_baris']."'".($baris==$k['id_baris']?"selected=selected":"")." >".$k['no_baris']."</option>";
				}
			}
		}
	?>
	</select>
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label" for="media">Jenis Media</label>
	<div class="col-md-8">
	<select id="media" name="media" class="form-control input-md">
	<?php
		if(isset($media2)){
			foreach($media2 as $k) {
				echo "<option value='".$k['id']."'".($media==$k['id']?"selected=selected":"")." >".$k['nama_media']."</option>";
			}
		}
	?>
	</select>
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label" for="ket">Keterangan Keaslian</label>
	<div class="col-md-8">
	<select class="form-control" name="ket" id="ket">
      <option value="asli" <?php echo ($ket=='asli'?"selected=selected":"") ?> >Asli</option>
      <option value="copy" <?php echo ($ket=='copy'?"selected=selected":"") ?> >Copy</option>
    </select>
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label" for="jendok">Jenis Data</label>
	<div class="col-md-8">
	<select class="form-control" name="jenisdok" id="jenisdok">
      <option value="1" <?php echo ($jenisdok=='1'?"selected=selected":"") ?> >Biasa</option>
      <option value="2" <?php echo ($jenisdok=='2'?"selected=selected":"") ?> >Rahasia</option>
    </select>
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label" for="jumlah">Jumlah</label>
	<div class="col-md-8">
	<input id="jumlah" name="jumlah" class="form-control input-md" type="text" value="<?php echo $jumlah ?>">
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label" for="nobox">Nomor Box</label>
	<div class="col-md-8">
	<input id="nobox" name="nobox" class="form-control input-md" type="text" value="<?php echo $nobox ?>">
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label" for="nobox">File</label>
	<div class="col-md-8">
	<?php
		if($file!="") {
			echo "<span style='text-overflow:ellipsis;overflow:hidden;' id='linkfile' class='form-control'><a href='".base_url('files/'.$file)."'>$file</a></span>";
			echo "<span class='pull-right'><a href='#' data-toggle=\"modal\" data-target=\"#delfile\"><span class='glyphicon glyphicon-remove' style='color:red' aria-hidden='true'></span></a></span>";
			echo "<div id='uplodfile' style='display:none;'>";
		}else {
			echo "<div id='uplodfile'>";
		}
		echo "<input type='file' id='file' name='file' accept='.doc,.docx,.pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf'>
		<p class='help-block'>Ukuran Maksimal ".number_format(ceil(max_file_upload_in_bytes()/20000))."MB</p>";
		echo "</div>";
	?>
	</div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-8">
    <button id="singlebutton" name="singlebutton" class="btn btn-success">Simpan</button>
  </div>
</div>

</div><!-- /2nd column -->
</div><!-- /.row -->


</fieldset>
</form>

<div class="modal fade" id="delfile">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Delete File</h4>
      </div>
	  <div class="modal-body">
		<form id="fdelfile" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/admin/delfile"); ?>">
			<h4 class="modal-title">Yakin ingin Hapus File ini?</h4>
            <input type="hidden" name="id" id="delidfile" value="<?php echo $id ?>">
		</form>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="delfilego">Hapus</button>
	  </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php
function return_bytes($val) {
    $val = trim($val);
    $last = strtolower($val[strlen($val)-1]);
	$val = (int)trim($val);
    switch($last)
    {
        case 'g':
        $val *= 1024;
        case 'm':
        $val *= 1024;
        case 'k':
        $val *= 1024;
    }
    return $val;
}

function max_file_upload_in_bytes() {
    //select maximum upload size
    $max_upload = return_bytes(ini_get('upload_max_filesize'));
    //select post limit
    $max_post = return_bytes(ini_get('post_max_size'));
    //select memory limit
    $memory_limit = return_bytes(ini_get('memory_limit'));
    // return the smallest of them, this defines the real limit
    return min($max_upload, $max_post, $memory_limit);
}
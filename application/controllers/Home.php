<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	private $data_per_page = 20;
	/**
	 * Konstruktor kelas pengontrol
	 *
	 */
	public function __construct()
	{
		parent::__construct();

		if(!$this->session->username && $this->uri->segment(2)!='login' && $this->uri->segment(2)!='gologin') {
			redirect('/home/login', 'refresh');
		}
		if($this->session->pagination){
			$this->data_per_page=$this->session->pagination;
		}
	}

	/**
	 * Method to output complete page with header and footer
	 *
	 */
	protected function __output($nview,$data=null)
	{
		$this->load->view('header',$data);
		$this->load->view($nview,$data);
		$this->load->view('footer');


	}

	/**
	 * Method to sanitize input data
	 *
	 * @return String
	 *
	 */
	protected function __sanitizeString($str)
	{
		return html_purify($str);
	}

	/**
	 * Method to compile SQL query based on search criteria
	 *
	 * @return Array or String
	 *
	 */
  protected function src($srcdata=false)
  {
		// simple search
		$katakunci=$this->__sanitizeString($this->input->get('katakunci'));
		// advanced search
  		$noarsip=$this->__sanitizeString($this->input->get('noarsip'));
  		$dep=$this->__sanitizeString($this->input->get('dep'));
		$tanggal=$this->__sanitizeString($this->input->get('tanggal'));
		$uraian=$this->__sanitizeString($this->input->get('uraian'));
		$ket=$this->__sanitizeString($this->input->get('ket'));
		$jenisdok = $this->__sanitizeString($this->input->post('jenisdok'));
		$kode=$this->__sanitizeString($this->input->get('kode'));
		$retensi=$this->__sanitizeString($this->input->get('retensi'));
		$penc=$this->__sanitizeString($this->input->get('penc'));
		$peng=$this->__sanitizeString($this->input->get('peng'));
		$lok=$this->__sanitizeString($this->input->get('lok'));
		$lan=$this->__sanitizeString($this->input->get('lan'));
		$rua=$this->__sanitizeString($this->input->get('rua'));
		$lem=$this->__sanitizeString($this->input->get('lem'));
		$bar=$this->__sanitizeString($this->input->get('bar'));
		$med=$this->__sanitizeString($this->input->get('med'));
		$nobox=$this->__sanitizeString($this->input->get('nobox'));

		$w = array();
		$klas = array();
		if ($katakunci != "") {
		  // simple search
		  $w[] = " noarsip like \"%".$katakunci."%\"";
		  $w[] = " uraian like \"%".$katakunci."%\"";
		  $w[] = " nobox like \"%".$katakunci."%\"";
		} else {
			// advanced search
			if($noarsip!="") {
				$w[] = " noarsip like '%".$noarsip."%'";
			}
			if($tanggal!="") {
				$w[] = " tanggal like '%".$tanggal."%'";
			}
			if($kode!="" && $kode!="all") {
				//$w[] = " a.kode like '".$kode."%'";
				$klas[] = $kode;
			}
			if($ket!="" && $ket!="all") {
				$w[] = " ket='".$ket."'";
			}
			if($jenisdok!="" && $jenisdok!="all") {
				$w[] = " jenisdok='".$jenisdok."'";
			}
			if($uraian!="") {
				$w[] = " uraian like '%".$uraian."%'";
			}
			if($retensi!="" && $retensi!="all") {
				$w[] = " f='".$retensi."'";
			}
			if($penc!="" && $penc!="all") {
				$w[] = " pencipta ='".$penc."'";
			}
			if($peng!="" && $peng!="all") {
				$w[] = " unit_pengolah ='".$peng."'";
			}
			if($lok!="" && $lok!="all") {
				$w[] = " lokasi ='".$lok."'";
			}
			if($lan!="" && $lan!="all") {
				$w[] = " lantai ='".$lan."'";
			}
			if($rua!="" && $rua!="all") {
				$w[] = " ruangan ='".$rua."'";
			}
			if($lem!="" && $lem!="all") {
				$w[] = " lemari ='".$lem."'";
			}
			if($bar!="" && $bar!="all") {
				$w[] = " baris ='".$bar."'";
			}
			if($med!="" && $med!="all") {
				$w[] = " media ='".$med."'";
			}
			if($dep!="" && $dep!="all") {
				$w[] = " id_dep ='".$dep."'";
			}
			if($nobox!="") {
				$w[] = " nobox like '%".$nobox."%'";
			}
		}

		$q = "SELECT a.*, k.retensi, DATE_ADD(a.tanggal,INTERVAL k.retensi YEAR) AS b,k.kode nama_kode, l2.no_lantai,r.nama_ruangan,l3.no_lemari,b.no_baris,d.id_dep,d.nama_dep,(IF(DATE_ADD(a.tanggal,INTERVAL k.retensi YEAR) < CURDATE(),'sudah','belum')) AS f,
		  nama_lokasi,nama_media,nama_pencipta,nama_pengolah
		  FROM data_arsip AS a
		  JOIN master_kode AS k ON k.id=a.kode
		  JOIN master_lokasi AS l ON l.id=a.lokasi
		  JOIN master_lantai AS l2 ON l2.id_lantai=a.lantai
		  JOIN master_ruangan AS r ON r.id_ruangan=a.ruangan
		  JOIN master_lemari AS l3 ON l3.id_lemari=a.lemari
		  JOIN master_baris AS b ON b.id_baris=a.baris
		  JOIN master_media AS m ON m.id=a.media
		  JOIN master_departemen AS d ON d.id_dep=a.dep
		  JOIN master_pencipta AS p ON p.id=a.pencipta
		  JOIN master_pengolah AS pn ON pn.id=a.unit_pengolah
		   ";

		$q_count = "SELECT COUNT(*) AS jmldata
		FROM data_arsip AS a
		JOIN master_kode AS k ON k.id=a.kode
		JOIN master_lokasi AS l ON l.id=a.lokasi
		JOIN master_lantai AS l2 ON l2.id_lantai=a.lantai
		JOIN master_ruangan AS r ON r.id_ruangan=a.ruangan
		JOIN master_lemari AS l3 ON l3.id_lemari=a.lemari
		JOIN master_baris AS b ON b.id_baris=a.baris
		JOIN master_media AS m ON m.id=a.media
		JOIN master_departemen AS d ON d.id_dep=a.dep
		JOIN master_pencipta AS p ON p.id=a.pencipta
		JOIN master_pengolah AS pn ON pn.id=a.unit_pengolah";
		$filter_by_user = [];
		if($_SESSION['tipe'] == "user"){
			$filter_by_user[] = "jenisdok = 1";
			$filter_by_user[] = "dep = ".$_SESSION['depar'];
		}else if($_SESSION['tipe'] == "admin"){
			$filter_by_user[] = "dep = ".$_SESSION['depar'];
		}

		if($_SESSION['akses_klas']!='') {
			$k = explode(',',$_SESSION['akses_klas']);
			$k = array_filter($k);
			sort($k);
			if(count($k)>0) {
				$klas=array_merge($klas,$k);
			}
		}

		if(count($klas)>0) {
			$w[] = " k.kode regexp '".implode('|',$klas)."'";
		}

		//var_dump($w); die();
		//print_r($filter_by_user); die();
		if ($katakunci != "") {
			
			$q .= " where (".implode(" OR ",$w).")";
			$q_count .= " where (".implode(" OR ",$w).")";
			$src = array("noarsip"=>$katakunci,"tanggal"=>"","uraian"=>$katakunci,"dep"=>"","ket"=>"","jenisdok"=>"","kode"=>"","retensi"=>"","penc"=>"","peng"=>"","lok"=>"","med"=>"","nobox"=>$nobox);

			if(count($filter_by_user)>0){
				$q .= " and (".implode(" AND ", $filter_by_user).")";
				$q_count .= " and (".implode(" AND ", $filter_by_user).")";
			}
			$qq = array($q, $q_count, $src);
			return $qq;
		} else {
			if(count($w) > 0) {
			$q .= " where (".implode(" AND ",$w).")";
			$q_count .= " where (".implode(" AND ",$w).")";
					if(count($filter_by_user)>0){
						$q .= " and (".implode(" AND ", $filter_by_user).")";
						$q_count .= " and (".implode(" AND ", $filter_by_user).")";
					}
			}
		}
		if(count($filter_by_user)>0){
						$q .= " and (".implode(" AND ", $filter_by_user).")";
						$q_count .= " and (".implode(" AND ", $filter_by_user).")";
					}
		//var_dump($q);
    if(!$katakunci && $srcdata) {
      $src = array("noarsip"=>$noarsip,"tanggal"=>$tanggal,"uraian"=>$uraian,"dep"=>$dep,"ket"=>$ket,"jenisdok"=>$jenisdok,"kode"=>$kode,"retensi"=>$retensi,"penc"=>$penc,"peng"=>$peng,"lok"=>$lok,"med"=>$med,"nobox"=>$nobox);
      return array($q, $q_count, $src);
    } else {
		$src = array("Kata kunci"=>$katakunci);
      return array($q, $q_count, $src);
    }
	}

	/**
	 * Default route for Home controller
	 * internal instance redirect to 'search' method
	 *
	 */
	public function index()
	{
		$this->search();
	}

	/**
	 * Showing list of existing archives and search form
	 *
	 */
	public function search($offset=0)
	{
		$qq = $this->src(true); //print_r($qq); die();
		$q = $qq[0]; //var_dump($q); die();
		$data['src']=$qq[2]; //var_dump($qq[2]); die();

		//echo $q;

		$q2 = $qq[1];
		$q .= " LIMIT $this->data_per_page ";

		$data['current_page'] = 1;
		if ($offset>=$this->data_per_page) {
			$data['current_page'] = floor(($offset+$this->data_per_page)/$this->data_per_page);
		}
		if ($offset>0) $q .= "OFFSET $offset";
		//echo($q); die();

		$hsl = $this->db->query($q);
		$data['data'] = $hsl->result_array();

		$jmldata = $this->db->query($q2)->row()->jmldata;
		$data['jml']=$jmldata;

		$q = "select distinct ket from data_arsip order by ket asc";
		$hsl = $this->db->query($q);
		$data['ket'] = $hsl->result_array();
		$q = "select kode,nama from master_kode order by kode asc";
		$hsl = $this->db->query($q);
		$data['kode'] = $hsl->result_array();
		$q = "select * from master_pencipta order by nama_pencipta asc";
		$hsl = $this->db->query($q);
		$data['penc'] = $hsl->result_array();
		$q = "select * from master_pengolah order by nama_pengolah asc";
		$hsl = $this->db->query($q);
		$data['peng'] = $hsl->result_array();
		$q = "select * from master_lokasi order by nama_lokasi asc";
		$hsl = $this->db->query($q);
		$data['lok'] = $hsl->result_array();
		$q = "select * from master_lantai order by no_lantai asc";
		$hsl = $this->db->query($q);
		$data['lan'] = $hsl->result_array();
		$q = "select * from master_ruangan order by nama_ruangan asc";
		$hsl = $this->db->query($q);
		$data['rua'] = $hsl->result_array();
		$q = "select * from master_lemari order by no_lemari asc";
		$hsl = $this->db->query($q);
		$data['lem'] = $hsl->result_array();
		$q = "select * from master_baris order by no_baris asc";
		$hsl = $this->db->query($q);
		$data['bar'] = $hsl->result_array();
		$q = "select * from master_media order by nama_media asc";
		$hsl = $this->db->query($q);
		$data['med'] = $hsl->result_array();
		$q = "select * from master_departemen order by nama_dep asc";
		$hsl = $this->db->query($q);
		$data['dep'] = $hsl->result_array();

		$this->load->library('pagination');
		$config['base_url'] = site_url('/home/search/');
		$config['reuse_query_string'] = true;
		$config['total_rows'] = $jmldata;
		$config['per_page'] = $this->data_per_page;
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="javascript: void(0)" disabled>';
		$config['cur_tag_close'] = '</a></li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$this->pagination->initialize($config);
		$data['pages']=$this->pagination->create_links();

		//Ambil id dep di table user
		$q = $this->db->query("select depar from master_user where id=".$_SESSION['id_user']);
		$res = $q->result_array();
		$id_depar = $res[0]['depar'];
		$data['id_depar_user'] = $id_depar;

		$this->__output('main',$data);
	}

	/**
	 * Download current archives data in Excel format
	 *
	 */
  public function dl()
  {
  	$q = $this->src();
  	$hsl = $this->db->query($q[0]);
		$data = $hsl->result_array();
  	$this->load->library('excel');
  	//activate worksheet number 1
  	$this->excel->setActiveSheetIndex(0);
  	//name the worksheet
  	//$this->excel->getActiveSheet()->setTitle('test worksheet');
  	//set cell A1 content with some text
  	$this->excel->getActiveSheet()->setCellValue('A1', 'Data Arsip');
  	//change the font size
  	$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(14);
  	//make the font become bold
  	$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
  	//merge cell A1 until D1
  	$this->excel->getActiveSheet()->mergeCells('A1:D1');
  	//set aligment to center for that merged cell (A1 to D1)
  	$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

  	$this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, 2, 'No.');
  	$this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, 2, 'Departemen');
  	$this->excel->getActiveSheet()->setCellValueByColumnAndRow(2, 2, 'No.Arsip');
  	$this->excel->getActiveSheet()->setCellValueByColumnAndRow(3, 2, 'Tanggal');
  	$this->excel->getActiveSheet()->setCellValueByColumnAndRow(4, 2, 'Kode Klasifikasi');
  	$this->excel->getActiveSheet()->setCellValueByColumnAndRow(5, 2, 'Uraian');
  	$this->excel->getActiveSheet()->setCellValueByColumnAndRow(6, 2, 'Pencipta');
  	$this->excel->getActiveSheet()->setCellValueByColumnAndRow(7, 2, 'Pengolah');
  	$this->excel->getActiveSheet()->setCellValueByColumnAndRow(8, 2, 'Media');
  	$this->excel->getActiveSheet()->setCellValueByColumnAndRow(9, 2, 'Lokasi');
  	$this->excel->getActiveSheet()->setCellValueByColumnAndRow(10, 2, 'Lantai');
  	$this->excel->getActiveSheet()->setCellValueByColumnAndRow(11, 2, 'Ruangan');
  	$this->excel->getActiveSheet()->setCellValueByColumnAndRow(12, 2, 'Lemari');
  	$this->excel->getActiveSheet()->setCellValueByColumnAndRow(13, 2, 'Baris');
  	$this->excel->getActiveSheet()->setCellValueByColumnAndRow(14, 2, 'Ket');
  	$this->excel->getActiveSheet()->setCellValueByColumnAndRow(15, 2, 'Jenis Data');
  	$this->excel->getActiveSheet()->setCellValueByColumnAndRow(16, 2, 'Jumlah');
  	$this->excel->getActiveSheet()->setCellValueByColumnAndRow(17, 2, 'No.Box');
  	$this->excel->getActiveSheet()->setCellValueByColumnAndRow(18, 2, 'Nama File');
  	$this->excel->getActiveSheet()->setCellValueByColumnAndRow(19, 2, 'Retensi');

  	$row=3;
  	$redblock = array('fill' => array(
  		'type' => PHPExcel_Style_Fill::FILL_SOLID,
			'color' => array('rgb' => 'FF0000')));
	$no=1;
  	foreach($data as $d) {
  	  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $no);
  	  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $d['nama_dep']);
  	  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $d['noarsip']);
  	  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $d['tanggal']);
  	  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $d['nama_kode']);
  	  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(5, $row, $d['uraian']);
  	  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(6, $row, $d['nama_pencipta']);
  	  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(7, $row, $d['nama_pengolah']);
  	  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(8, $row, $d['nama_media']);
  	  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(9, $row, $d['nama_lokasi']);
  	  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(10, $row, $d['no_lantai']);
  	  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(11, $row, $d['nama_ruangan']);
  	  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(12, $row, $d['no_lemari']);
  	  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(13, $row, $d['no_baris']);
  	  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(14, $row, $d['ket']);
  	  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(15, $row, $d['jenisdok']==1?"Biasa":"Rahasia");
  	  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(16, $row, $d['jumlah']);
  	  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(17, $row, $d['nobox']);
  	  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(18, $row, $d['file']);
  	  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(19, $row, $d['b']);
  	  if($d['f']=='sudah') {
  	      $this->excel->getActiveSheet()->getStyleByColumnAndRow(19, $row)->applyFromArray($redblock);
  	  }
		$row++;
		$no++;
  	}

  	// $filename='Data Arsip Arteri-'.getdate()[0].'.xls'; //save our workbook as this file name
  	$filename='Data Arsip-'.getdate()[0].'.xls'; //save our workbook as this file name
  	header('Content-Type: application/vnd.ms-excel'); //mime type
  	header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
  	header('Cache-Control: max-age=0'); //no cache
  	$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
  	$objWriter->save('php://output');
  }

	/**
	 * Showing login page
	 *
	 */
	public function login()
	{
		$data=[];
		if(isset($_SERVER['HTTP_REFERER'])) {
			$previous = $_SERVER['HTTP_REFERER'];
			$data['previous'] = $previous;
		}
		$this->load->view('login',$data);
	}

	/**
	 * Login authentication process
	 *
	 */
	public function gologin()
	{
		$username=$this->__sanitizeString($this->input->post('username'));
		$password=$this->__sanitizeString($this->input->post('password')) ;
		
		$previous=$this->__sanitizeString($this->input->post('previous'));
		$q = "SELECT a.*,d.nama_dep FROM master_user a INNER JOIN master_departemen d ON a.depar=d.id_dep WHERE username='$username' ";
		$user = $this->db->query($q)->row();
		
    if($user) {
			// check password
			if (password_verify($password, $user->password) && $user->status == 'active') {	
				$_SESSION['username'] = $username;
				$_SESSION['id_user'] = $user->id;
				$_SESSION['status'] = $user->status;
				$_SESSION['tipe'] = $user->tipe;
				$_SESSION['akses_klas'] = $user->akses_klas;
				$_SESSION['akses_modul'] = json_decode($user->akses_modul,true);
				$_SESSION['menu_master'] = false;
				$_SESSION['depar'] = $user->depar;
				$_SESSION['nama_dep'] = $user->nama_dep;

				if(count($_SESSION['akses_modul'])>0) {
					$no=0;
					foreach($_SESSION['akses_modul'] as $key=>$val) {
						if($key=='klasifikasi') $no++;
						if($key=='pencipta') $no++;
						if($key=='pengolah') $no++;
						if($key=='lokasi') $no++;
						if($key=='media') $no++;
						if($key=='user') $no++;
						if($key=='import') $no++;
					}
					if($no>0) {
						$_SESSION['menu_master'] = true;
					}
				}
				if($previous=="") {
					redirect('/home', 'refresh');
				} else {
					header('Location: ' . $previous);
				}
			} else {
				$this->session->set_flashdata('erorlogin', 'Username atau password yang anda masukkan salah');
			  	if(password_verify($password, $user->password) && $user->status != 'active') {
			  		$this->session->set_flashdata('erorlogin','Status akun anda '.$user->status .', mohon hubungi admin');
			  	}
			  	else{
			  		$this->session->set_flashdata('erorlogin', 'Username atau password yang anda masukkan salah');
			  	}
			  redirect('/home/login', 'refresh');
			}
    } else {
			$this->session->set_flashdata('erorlogin', 'Username atau password yang anda masukkan salah');
			$this->load->view("login");
    		}
	}

	/**
	 * Logout process
	 *
	 */
	public function logout()
	{
		unset($_SESSION['username']);
		unset($_SESSION['id_user']);
		unset($_SESSION['status']);
		unset($_SESSION['tipe']);
		unset($_SESSION['akses_klas']);
		unset($_SESSION['akses_modul']);
		unset($_SESSION['menu_master']);
		unset($_SESSION['visited_page']);
		redirect('/home', 'refresh');
	}

	/**
	 * Archive detail page
	 *
	 */
	public function view($id)
	{
		// VISITOR CODE
		if(empty($_SESSION['visited_page'])){
			$_SESSION['visited_page'] = array();
		}
		if(count($_SESSION['visited_page']) > -1){
			$belum_dikunjungi = true;

			//cari
			for ($i=0; $i < count($_SESSION['visited_page']); $i++) { 
				if($_SESSION['visited_page'][$i] == $id){
					$belum_dikunjungi = false;
				}
			}
			if($belum_dikunjungi){
					$insert_visitor = [
					"id_file"=>$id,
					"id_user"=>$_SESSION['id_user'],
					"time_visit" => date('Y-m-d G:i:s'),
				];
				$insert = $this->db->insert("visitor_file", $insert_visitor);

				$_SESSION['visited_page'][] = $id;
			}
		}

		//MENCARI SIAPA YANG MELIHAT FILE
		if($_SESSION['tipe'] == "admin" || $_SESSION['tipe'] == "sumin"){
			//jika login sbg admin
			$src_q = "SELECT username, count(id_visit) as `visited_times` FROM `visitor_file` JOIN master_user on visitor_file.id_user = master_user.id where id_file=".$id." group by id_user";
		}else{
			//jika login sbg user biasa
			$src_q = "SELECT count(id_visit) as `visited_times` FROM `visitor_file` where id_file=".$id;

			}
		$src_q_run = $this->db->query($src_q);
		$hasil = $src_q_run->result_array();
		
	//********************* 


		$q="SELECT a.*,p.nama_pencipta,p2.nama_pengolah,k.nama,k.kode nama_kode,l.nama_lokasi,l2.no_lantai,r.nama_ruangan,l3.no_lemari,b.no_baris,m.nama_media,d.nama_dep,d.kode_dep,
			DATE_ADD(a.tanggal,INTERVAL k.retensi YEAR) AS b,
			(IF(DATE_ADD(a.tanggal,INTERVAL k.retensi YEAR)<CURDATE(),'sudah','belum')) AS f
			FROM data_arsip a
			LEFT JOIN master_pencipta p ON p.id=a.pencipta
			LEFT JOIN master_pengolah p2 ON p2.id=a.unit_pengolah
			LEFT JOIN master_kode k ON k.id=a.kode
			LEFT JOIN master_lokasi l ON l.id=a.lokasi
			LEFT JOIN master_lantai l2 ON l2.id_lantai=a.lantai
			LEFT JOIN master_ruangan r ON r.id_ruangan=a.ruangan
			LEFT JOIN master_lemari l3 ON l3.id_lemari=a.lemari
			LEFT JOIN master_baris b ON b.id_baris=a.baris
			LEFT JOIN master_media m ON m.id=a.media
			LEFT JOIN master_departemen d ON d.id_dep=a.dep
			WHERE a.id=$id";
		$data=$this->db->query($q)->row_array();
		$data['visitor'] = $hasil;
		$this->__output('varsip',$data);
	}
	public function set_pagination(){
		$this->session->set_userdata('pagination', $_POST['jumlah_perpage']);
		// var_dump($_POST);
		redirect('/home');
	}
}
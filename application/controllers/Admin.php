<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    /**
     * Controller class constructor
     *
     */
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->tipe == 'admin') {
            redirect('/home/login', 'refresh');
        }
        
    }

    /**
     * Method to output complete page with header and footer
     *
     */
    protected function __output($nview, $data = null)
    {
        $this->load->view('header', $data);
        $this->load->view($nview, $data);
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
     * Method to compile SQL query for master data
     * and return data in array format
     *
     * @return Array
     *
     */
    protected function masterlist($tipe)
    {
        $data;
        switch ($tipe) {
            case "kode":
                $q = "SELECT * FROM master_kode ORDER BY kode ASC";
                $hsl = $this->db->query($q);
                $data = $hsl->result_array();
                break;
            case "pencipta":
                $q = "SELECT * FROM master_pencipta ORDER BY nama_pencipta ASC";
                $hsl = $this->db->query($q);
                $data = $hsl->result_array();
                break;
            case "unitpengolah":
                $q = "SELECT * FROM master_pengolah ORDER BY nama_pengolah ASC";
                $hsl = $this->db->query($q);
                $data = $hsl->result_array();
                break;
            case "lokasi":
                $q = "SELECT * FROM master_lokasi ORDER BY nama_lokasi ASC";
                $hsl = $this->db->query($q);
                $data = $hsl->result_array();
                break;
            case "lantai":
                $q = "SELECT * FROM master_lantai ORDER BY no_lantai ASC";
                $hsl = $this->db->query($q);
                $data = $hsl->result_array();
                break;
            case "ruangan":
                $q = "SELECT * FROM master_ruangan ORDER BY nama_ruangan ASC";
                $hsl = $this->db->query($q);
                $data = $hsl->result_array();
                break;
            case "lemari":
                $q = "SELECT * FROM master_lemari ORDER BY no_lemari ASC";
                $hsl = $this->db->query($q);
                $data = $hsl->result_array();
                break;
            case "baris":
                $q = "SELECT * FROM master_baris ORDER BY no_baris ASC";
                $hsl = $this->db->query($q);
                $data = $hsl->result_array();
                break;
            case "media":
                $q = "SELECT * FROM master_media ORDER BY nama_media ASC";
                $hsl = $this->db->query($q);
                $data = $hsl->result_array();
                break;
            case "departemen":
                $q = "SELECT * FROM master_departemen ORDER BY nama_dep ASC";
                $hsl = $this->db->query($q);
                $data = $hsl->result_array();
                break;
        }

        return $data;
    }

    /**
     * Show archive entry form
     *
     */
    public function entr()
    {
        if (isset($_SESSION['akses_modul']['entridata']) && $_SESSION['akses_modul']['entridata'] == 'on') {
        $data["departemen"] = $this->masterlist("departemen");
        // var_dump( $data["departemen"]); die();
        $data["kode"] = $this->masterlist("kode");
        $data["pencipta"] = $this->masterlist("pencipta");
        $data["unitpengolah"] = $this->masterlist("unitpengolah");
        $data["lokasi"] = $this->masterlist("lokasi");
        $data["lantai"] = $this->masterlist("lantai");
        $data["ruangan"] = $this->masterlist("ruangan");
        $data["lemari"] = $this->masterlist("lemari");
        $data["baris"] = $this->masterlist("baris");
        $data["media"] = $this->masterlist("media");
        $data["title"] = "Tambah Arsip";

        $this->__output('entri1', $data);
         }else{
                redirect('/home');
                }
    }

    /**
     * Process input data from archive entry form
     *
     */
    public function gentr()
    {   
        $dep = $this->__sanitizeString($this->input->post('departemen'));
        $noarsip = $this->__sanitizeString($this->input->post('noarsip'));
        $tanggal = $this->__sanitizeString($this->input->post('tanggal'));
        // var_dump($dep); die();
        $uraian = $this->__sanitizeString($this->input->post('uraian'));
        $kode = $this->__sanitizeString($this->input->post('kode'));
        $pencipta = $this->__sanitizeString($this->input->post('pencipta'));
        $unitpengolah = $this->__sanitizeString($this->input->post('unitpengolah'));
        $lokasi = $this->__sanitizeString($this->input->post('lokasi'));
        $lantai = $this->__sanitizeString($this->input->post('lantai'));
        $ruangan = $this->__sanitizeString($this->input->post('ruangan'));
        $lemari = $this->__sanitizeString($this->input->post('lemari'));
        $baris = $this->__sanitizeString($this->input->post('baris'));
        $media = $this->__sanitizeString($this->input->post('media'));
        $ket = $this->__sanitizeString($this->input->post('ket'));
        $jenisdok = $this->__sanitizeString($this->input->post('jenisdok'));
        $nobox = $this->__sanitizeString($this->input->post('nobox'));
        $jumlah = $this->__sanitizeString($this->input->post('jumlah'));
        $file = "";
        $config['upload_path'] = 'files/';
        $config['allowed_types'] = 'pdf|docx|doc';
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('file')) {
            $datafile = $this->upload->data();
            //$file = $datafile['full_path'];
            $file = $datafile['file_name'];
        } else {
        }
        $insert_data = [
            "noarsip"=>$noarsip,
            "tanggal"=>$tanggal,
            "uraian"=>$uraian,
            "kode"=>$kode,
            "ket"=>$ket,
            "jenisdok"=>$jenisdok,
            "nobox"=>$nobox,
            "file"=>$file,
            "jumlah"=>$jumlah,
            "pencipta"=>$pencipta,
            "unit_pengolah"=>$unitpengolah,
            "lokasi"=>$lokasi,
            "lantai"=>$lantai,
            "ruangan"=>$ruangan,
            "lemari"=>$lemari,
            "baris"=>$baris,
            "media"=>$media,
            "dep"=>$dep,
            "tgl_input"=>date("Y-m-d H:i:s"),
            "username"=>$_SESSION['username'],
        ];
        $this->db->insert("data_arsip", $insert_data);
        $q = "SELECT LAST_INSERT_ID() as vid;";
        $hsl = $this->db->query($q);
        $row = $hsl->row_array();
        $v = $row['vid'];
        //var_dump($row);
        redirect('/home/view/' . $v, 'refresh');

    }

    /**
     * Edit archive data form
     *
     * @param $id The ID of archive
     *
     */
    public function vedit($id)
    {
        if ($id != "") {
            $q = sprintf("SELECT * FROM data_arsip WHERE id=%d", $id);
            $hsl = $this->db->query($q);
            $row = $hsl->row_array();
            $previous = "";
            if (isset($_SERVER['HTTP_REFERER'])) {
                $previous = $_SERVER['HTTP_REFERER'];
                $row['previous'] = $previous;
            }
            $row['database'] = $row;
            $row["kode2"] = $this->masterlist("kode");
            $row["pencipta2"] = $this->masterlist("pencipta");
            $row["unitpengolah2"] = $this->masterlist("unitpengolah");
            $row["lokasi2"] = $this->masterlist("lokasi");
            $row["lantai2"] = $this->masterlist("lantai");
            $row["ruangan2"] = $this->masterlist("ruangan");
            $row["lemari2"] = $this->masterlist("lemari");
            $row["baris2"] = $this->masterlist("baris");
            $row["media2"] = $this->masterlist("media");
            $row["departemen2"] = $this->masterlist("departemen");
            $row["title"] = "Ubah Arsip";
            if (count($row) > 0) {
                $this->__output('edit1', $row);
            } else {
                redirect('/home/', 'refresh');
            }
        } else {
            redirect('/home/', 'refresh');
        }
    }

    /**
     * Process input data from archive edit form
     *
     */
    public function edit()
    {   
        $dep = $this->__sanitizeString($this->input->post('departemen'));
        $noarsip = $this->__sanitizeString($this->input->post('noarsip'));
        $tanggal = $this->__sanitizeString($this->input->post('tanggal'));
        $uraian = $this->__sanitizeString($this->input->post('uraian'));
        $kode = $this->__sanitizeString($this->input->post('kode'));
        $ket = $this->__sanitizeString($this->input->post('ket'));
        $jenisdok = $this->__sanitizeString($this->input->post('jenisdok'));
        $pencipta = $this->__sanitizeString($this->input->post('pencipta'));
        $unitpengolah = $this->__sanitizeString($this->input->post('unitpengolah'));
        $lokasi = $this->__sanitizeString($this->input->post('lokasi'));
        $lantai = $this->__sanitizeString($this->input->post('lantai'));
        $ruangan = $this->__sanitizeString($this->input->post('ruangan'));
        $lemari = $this->__sanitizeString($this->input->post('lemari'));
        $baris = $this->__sanitizeString($this->input->post('baris'));
        $media = $this->__sanitizeString($this->input->post('media'));
        $nobox = $this->__sanitizeString($this->input->post('nobox'));
        $jumlah = $this->__sanitizeString($this->input->post('jumlah'));
        $id = $this->__sanitizeString($this->input->post('id'));
        $previous = $this->__sanitizeString($this->input->post('previous'));
        $file = "";
        $config['upload_path'] = 'files/';
        $config['allowed_types'] = 'pdf|docx|doc';
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('file')) {
            $datafile = $this->upload->data();
            //$file = $datafile['full_path'];
            $file = $datafile['file_name'];
        } else {
            $q = "SELECT file FROM data_arsip WHERE id=$id";
            $d = $this->db->query($q)->row_array()['file'];
            $file = $d;
        }

        if (isset($_POST)) {
            $q = sprintf("UPDATE data_arsip SET noarsip='%s',tanggal='%s',uraian='%s',kode='%s',
							ket='%s',jenisdok='%s',nobox='%s',file='%s',jumlah='%d',
							pencipta=%d,unit_pengolah=%d,lokasi=%d,lantai=%d,ruangan=%d,lemari=%d,baris=%d,media=%d,dep=%s WHERE id=$id",
                $noarsip, $tanggal, $uraian, $kode,
                $ket, $jenisdok, $nobox, $file, $jumlah,
                $pencipta, $unitpengolah, $lokasi, $lantai, $ruangan, $lemari, $baris, $media, $dep);
            $hsl = $this->db->query($q);
        }
        redirect('/home/view/' . $id, 'refresh');
    }

    /**
     * Delete archive file value in archive record
     *
     */
    public function delfile()
    {
        $id = $this->__sanitizeString($this->input->post('id'));
        $q = "SELECT file FROM data_arsip WHERE id=$id";
        $hsl = $this->db->query($q);
        $row = $hsl->row_array()['file'];
        if ($row != "") {
            $alamat = ROOTPATH . "/files/" . $row;
            unlink($alamat);
        }
        $q = sprintf("UPDATE data_arsip SET file=NULL WHERE id=%d", $id);
        $hsl = $this->db->query($q);
    }

    /**
     * Delete archive file
     *
     */
    public function del1()
    {
        $id = $this->__sanitizeString($this->input->post('id'));
        $q = sprintf("SELECT file FROM data_arsip WHERE id=%d", $id);
        $hsl = $this->db->query($q);
        $row = $hsl->row_array()['file'];
        if ($row != "") {
            $alamat = ROOTPATH . "/files/" . $row;
            unlink($alamat);
        }
        $q = sprintf("DELETE FROM data_arsip WHERE id=%d", $id);
        $hsl = $this->db->query($q);
        if ($hsl) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * Show classification data page
     *
     */
    public function klas()
    {
    if (isset($_SESSION['akses_modul']['klasifikasi']) && $_SESSION['akses_modul']['klasifikasi'] == 'on') {

            $katakunci = $this->__sanitizeString($this->input->get('katakunci'));

            $q = "SELECT * FROM master_kode ";
            if ($katakunci) {
                $q .= ' WHERE kode LIKE \'%' . $katakunci . '%\' OR nama LIKE \'%' . $katakunci . '%\' ';
            }
            $q .= " ORDER BY kode ASC";
            $hsl = $this->db->query($q);
            $data['user'] = $hsl->result_array();
            $this->__output('klas', $data);

            }else{
                redirect('/home');
                }
    }

    /**
     * Add classification data and respond in JSON format
     *
     */
    public function addkode()
    {
        $kode = $this->__sanitizeString($this->input->post('kode'));
        $nama = $this->__sanitizeString($this->input->post('nama'));
        $retensi = $this->__sanitizeString($this->input->post('retensi'));
        $q = sprintf("INSERT INTO master_kode (kode,nama,retensi) VALUES ('%s','%s','%s')",
            $kode, $nama, $retensi);
        $hsl = $this->db->query($q);
        if ($hsl) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * Update classification data and respond in JSON format
     *
     */
    public function edkode()
    {
        $kode = $this->__sanitizeString($this->input->post('kode'));
        $nama = $this->__sanitizeString($this->input->post('nama'));
        $retensi = $this->__sanitizeString($this->input->post('retensi'));
        $id = $this->__sanitizeString($this->input->post('id'));
        $q = sprintf("UPDATE master_kode SET kode='%s',nama='%s',retensi='%s' WHERE id=%d",
            $kode, $nama, $retensi, $id);
        $hsl = $this->db->query($q);
        if ($hsl) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * Delete classification data and respond in JSON format
     *
     */
    public function delkode()
    {
        $id = $this->__sanitizeString($this->input->post('id'));
        //cek dulu apakah ada arsip yang menggunakan klasifikasi ini
        $q = sprintf("SELECT count(id) jml FROM data_arsip WHERE kode=%d", $id);
        $jml = $this->db->query($q)->row_array()['jml'];
        if ($jml == 0) { //kalau tidak data arsip yang menggunakan, boleh dihapus
            $q = sprintf("DELETE FROM master_kode WHERE id=%d", $id);
            $hsl = $this->db->query($q);
            if ($hsl) {
                echo json_encode(array('status' => 'success'));
            } else {
                echo '[]';
            }
            exit();
        } else { //ada arsip yng menggunakan, klasifikasi jangan dihapus dulu

        }

    }

    /**
     * Get classification data and respond in JSON format
     *
     */
    public function akode()
    {
        $id = $this->__sanitizeString($this->input->post('id'));
        $q = sprintf("SELECT * FROM master_kode WHERE id=%d", $id);
        $hsl = $this->db->query($q);
        $row = $hsl->row_array();
        if ($row) {
            echo json_encode($row);
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * AJAX reload for classification data
     *
     */
    public function reloadkode()
    {
        $q = "SELECT * FROM master_kode ORDER BY kode ASC";
        $hsl = $this->db->query($q);
        $row = $hsl->result_array();
        if ($row) {
            echo "<table class='table table-bordered' name='vkode' id='vkode'>
			<thead>
				<th>Kode</th>
				<th>Nama</th>
				<th>Retensi</th>
				<th class='width-sm'></th>
				<th class='width-sm'></th>
			</thead>";
            $no = 1;
            foreach ($row as $u) {
                echo "<tr>";
                echo "<td>" . $u['kode'] . "</td>";
                echo "<td>" . $u['nama'] . "</td>";
                echo "<td>" . $u['retensi'] . " Tahun</td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#editkode\" class='edkode' href='#' id='" . $u['id'] . "' title=\"Edit\"><i class=\"glyphicon glyphicon-edit\"></i> </a></td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#delkode\" class='delkode' href='#' id='" . $u['id'] . "' title=\"Delete\"><i class=\"glyphicon glyphicon-trash\"></i> </a></td>";
                echo "</tr>";
                $no++;
            }
            echo "</table>";
        }
    }

    /**
     * Show archive author/creator data page
     *
     */
    public function penc()
    {
        if (isset($_SESSION['akses_modul']['pencipta']) && $_SESSION['akses_modul']['pencipta'] == 'on') {
        $katakunci = $this->__sanitizeString($this->input->get('katakunci'));

        $q = "SELECT * FROM master_pencipta ";
        if ($katakunci) {
            $q .= ' WHERE nama_pencipta LIKE \'%' . $katakunci . '%\' OR id LIKE \'%' . $katakunci . '%\' ';
        }
        $q .= " ORDER BY nama_pencipta ASC";
        $hsl = $this->db->query($q);
        $data['penc'] = $hsl->result_array();
        $this->__output('pencipta', $data);
        }else{
                redirect('/home');
                }
    }

    /**
     * Add archive creator data and respond in JSON format
     *
     */
    public function addpenc()
    {
        $nama = $this->__sanitizeString($this->input->post('nama'));
        $q = sprintf("INSERT INTO master_pencipta (nama_pencipta) VALUES ('%s')", $nama);
        $hsl = $this->db->query($q);
        if ($hsl) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * Update archive creator data and respond in JSON format
     *
     */
    public function edpenc()
    {
        $nama = $this->__sanitizeString($this->input->post('nama'));
        $id = $this->__sanitizeString($this->input->post('id'));
        $q = sprintf("UPDATE master_pencipta SET nama_pencipta='%s' WHERE id=%d", $nama, $id);
        $hsl = $this->db->query($q);
        if ($hsl) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * Delete archive creator data and respond in JSON format
     *
     */
    public function delpenc()
    {
        $id = $this->__sanitizeString($this->input->post('id'));
        //cek dulu apakah ada arsip yang menggunakan pencipta ini
        $q = sprintf("SELECT count(id) jml FROM data_arsip WHERE pencipta=%d", $id);
        $jml = $this->db->query($q)->row_array()['jml'];
        if ($jml == 0) { //kalau tidak data arsip yang menggunakan, boleh dihapus
            $q = sprintf("DELETE FROM master_pencipta WHERE id=%d", $id);
            $hsl = $this->db->query($q);
            if ($hsl) {
                echo json_encode(array('status' => 'success'));
            } else {
                echo '[]';
            }
            exit();
        } else {

        }
    }

    /**
     * Get archive creator data and respond in JSON format
     *
     */
    public function apenc()
    {
        $id = $this->__sanitizeString($this->input->post('id'));
        $q = sprintf("SELECT * FROM master_pencipta WHERE id=%d", $id);
        $hsl = $this->db->query($q);
        $row = $hsl->row_array();
        if ($row) {
            echo json_encode($row);
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * AJAX reload for archive creator
     *
     */
    public function reloadpenc()
    {
        $q = "SELECT * FROM master_pencipta ORDER BY nama_pencipta ASC";
        $hsl = $this->db->query($q);
        $row = $hsl->result_array();
        if ($row) {
            echo "<table class='table table-bordered' name='vpenc' id='vpenc'>
			<thead>
				<th class='width-sm'>No</th>
				<th>Nama</th>
				<th class='width-sm'></th>
				<th class='width-sm'></th>
			</thead>";
            $no = 1;
            foreach ($row as $u) {
                echo "<tr>";
                echo "<td>" . $no . "</td>";
                echo "<td>" . $u['nama_pencipta'] . "</td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#editpenc\" class='edpenc' href='#' id='" . $u['id'] . "' title=\"Edit\"><i class=\"glyphicon glyphicon-edit\"></i> </a></td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#delpenc\" class='delpenc' href='#' id='" . $u['id'] . "' title=\"Delete\"><i class=\"glyphicon glyphicon-trash\"></i> </a></td>";
                echo "</tr>";
                echo "</tr>";
                $no++;
            }
            echo "</table>";
        }
    }

    /**
     * Show archival unit/manager data page
     *
     */
    public function pengolah()
    {
        if (isset($_SESSION['akses_modul']['pengolah']) && $_SESSION['akses_modul']['pengolah'] == 'on') {

        $katakunci = $this->__sanitizeString($this->input->get('katakunci'));

        $q = "SELECT * FROM master_pengolah ";
        if ($katakunci) {
            $q .= ' WHERE nama_pengolah LIKE \'%' . $katakunci . '%\' OR id LIKE \'%' . $katakunci . '%\' ';
        }
        $q .= " ORDER BY nama_pengolah ASC";
        $hsl = $this->db->query($q);
        $data['peng'] = $hsl->result_array();
        $this->__output('pengolah', $data);
        }else{
                redirect('/home');
                }
    }

    /**
     * Add archival unit data and respond in JSON format
     *
     */
    public function addpeng()
    {
        $nama = $this->__sanitizeString($this->input->post('nama'));
        $q = sprintf("INSERT INTO master_pengolah (nama_pengolah) VALUES ('%s')", $nama);
        $hsl = $this->db->query($q);
        if ($hsl) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * Update archival unit data and respond in JSON format
     *
     */
    public function edpeng()
    {
        $nama = $this->__sanitizeString($this->input->post('nama'));
        $id = $this->__sanitizeString($this->input->post('id'));
        $q = sprintf("UPDATE master_pengolah SET nama_pengolah='%s'", $nama);
        $q .= " WHERE id=$id";
        $hsl = $this->db->query($q);
        if ($hsl) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * Delete archival unit data and respond in JSON format
     *
     */
    public function delpeng()
    {
        $id = $this->__sanitizeString($this->input->post('id'));
        //cek dulu apakah ada arsip yang menggunakan unit pengolah ini
        $q = sprintf("SELECT count(id) jml FROM data_arsip WHERE unit_pengolah=%d", $id);
        $jml = $this->db->query($q)->row_array()['jml'];
        if ($jml == 0) { //kalau tidak data arsip yang menggunakan, boleh dihapus
            $q = sprintf("DELETE FROM master_pengolah WHERE id=%d", $id);
            $hsl = $this->db->query($q);
            if ($hsl) {
                echo json_encode(array('status' => 'success'));
            } else {
                echo '[]';
            }
            exit();
        } else {

        }
    }

    /**
     * Get archival unit data and respond in JSON format
     *
     */
    public function apeng()
    {
        $id = $this->__sanitizeString($this->input->post('id'));
        $q = sprintf("SELECT * FROM master_pengolah WHERE id=%d", $id);
        $hsl = $this->db->query($q);
        $row = $hsl->row_array();
        if ($row) {
            echo json_encode($row);
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * AJAX reload for archival unit data
     *
     */
    public function reloadpeng()
    {
        $q = "SELECT * FROM master_pengolah ORDER BY nama_pengolah ASC";
        $hsl = $this->db->query($q);
        $row = $hsl->result_array();
        if ($row) {
            echo "<table class='table table-bordered' name='vpeng' id='vpeng'>
			<thead>
				<th class='width-sm'>No</th>
				<th>Nama</th>
				<th class='width-sm'></th>
				<th class='width-sm'></th>
			</thead>";
            $no = 1;
            foreach ($row as $u) {
                echo "<tr>";
                echo "<td>" . $no . "</td>";
                echo "<td>" . $u['nama_pengolah'] . "</td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#editpeng\" class='edpeng' href='#' id='" . $u['id'] . "' title=\"Edit\"><i class=\"glyphicon glyphicon-edit\"></i> </a></td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#delpeng\" class='delpeng' href='#' id='" . $u['id'] . "' title=\"Delete\"><i class=\"glyphicon glyphicon-trash\"></i> </a></td>";
                echo "</tr>";
                $no++;
            }
            echo "</table>";
        }
    }

   /**
     * Show archive location data page
     *
     */
    public function lokasi()
    {
        $katakunci = $this->__sanitizeString($this->input->get('katakunci'));

        $q = "SELECT * FROM master_lokasi ";
        if ($katakunci) {
            $q .= ' WHERE nama_lokasi LIKE \'%' . $katakunci . '%\' OR id LIKE \'%' . $katakunci . '%\' ';
        }
        $q .= " ORDER BY nama_lokasi ASC";
        $hsl = $this->db->query($q);
        $data['lok'] = $hsl->result_array();
        $this->__output('lokasi', $data);
    }

    /**
     * Add archive location data and respond in JSON format
     *
     */
    public function addlok()
    {
        $nama = $this->__sanitizeString($this->input->post('nama'));
        $q = sprintf("INSERT INTO master_lokasi (nama_lokasi) VALUES ('%s')", $nama);
        $hsl = $this->db->query($q);
        if ($hsl) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * Update archive location data and respond in JSON format
     *
     */
    public function edlok()
    {
        $nama = $this->__sanitizeString($this->input->post('nama'));
        $id = $this->__sanitizeString($this->input->post('id'));
        $q = sprintf("UPDATE master_lokasi SET nama_lokasi='%s' WHERE id=%d", $nama, $id);
        $hsl = $this->db->query($q);
        if ($hsl) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * Delete archive location data and respond in JSON format
     *
     */
    public function dellok()
    {
        $id = $this->__sanitizeString($this->input->post('id'));
        //cek dulu apakah ada arsip yang menggunakan lokasi ini
        $q = sprintf("SELECT count(id) jml FROM data_arsip WHERE lokasi=%d", $id);
        $jml = $this->db->query($q)->row_array()['jml'];
        if ($jml == 0) { //kalau tidak data arsip yang menggunakan, boleh dihapus
            $q = sprintf("DELETE FROM master_lokasi WHERE id=%d", $id);
            $hsl = $this->db->query($q);
            if ($hsl) {
                echo json_encode(array('status' => 'success'));
            } else {
                echo '[]';
            }
            exit();
        } else {

        }
    }

    /**
     * Get archive location data and respond in JSON format
     *
     */
    public function alok()
    {
        $id = $this->__sanitizeString($this->input->post('id'));
        $q = "SELECT * FROM master_lokasi WHERE id=$id";
        $hsl = $this->db->query($q);
        $row = $hsl->row_array();
        if ($row) {
            echo json_encode($row);
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * AJAX reload for location data
     *
     */
    public function reloadlok()
    {
        $q = "SELECT * FROM master_lokasi ORDER BY nama_lokasi ASC";
        $hsl = $this->db->query($q);
        $row = $hsl->result_array();
        if ($row) {
            echo "<table class='table table-bordered' name='vlok' id='vlok'>
            <thead>
                <th class='width-sm'>No</th>
                <th>Nama Baka</th>
                <th class='width-sm'></th>
                <th class='width-sm'></th>
            </thead>";
            $no = 1;
            foreach ($row as $u) {
                echo "<tr>";
                echo "<td>" . $no . "</td>";
                $link_lantai = base_url()."index.php/admin/lantai?id_lokasi=".$u['id'];
                echo "<td><a href='".$link_lantai."'>".$u['nama_lokasi']."</a></td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#editlok\" class='edlok' href='#' id='" . $u['id'] . "' title=\"Edit\"><i class=\"glyphicon glyphicon-edit\"></i> </a></td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#dellok\" class='dellok' href='#' id='" . $u['id'] . "' title=\"Delete\"><i class=\"glyphicon glyphicon-trash\"></i> </a></td>";
                echo "</tr>";
                $no++;
            }
            echo "</table>";
        }
    }

    /**
     * Show archive lemari data page
     *
     */
    public function lantai()
    {   
        if (isset($_SESSION['akses_modul']['lokasi']) && $_SESSION['akses_modul']['lokasi'] == 'on') {

        $katakunci = $this->__sanitizeString($this->input->get('katakunci'));
        $id_gedung = $this->__sanitizeString($this->input->get('id_lokasi'));

        $q = "SELECT * FROM master_lantai WHERE id=".$id_gedung."";
        if ($katakunci) {
            $q .= ' AND no_lantai LIKE \'%' . $katakunci . '%\'';
        }
        $q .= " ORDER BY no_lantai ASC";

        $q2 = "SELECT * FROM master_lantai where id=".$id_gedung." ORDER BY no_lantai ASC" ;

        $nama_lokasi = $this->get_lokasi_id($this->input->get("id_lokasi"))[0]['nama_lokasi'];
        $data['nama_lokasi'] = $nama_lokasi;

        $hsl = $this->db->query($q);
        $data['lan'] = $hsl->result_array();
        $data["lokasi"] = $this->masterlist("lokasi");
        $this->__output('lantai', $data);
        }else{
                redirect('/home');
                }
    }

    /**
     * Add archive location data and respond in JSON format
     *
     */
    public function addlan()
    {
        $id = $this->__sanitizeString($this->input->post('id_lokasi'));
        $no_lantai = $this->__sanitizeString($this->input->post('no_lantai'));
        $q = sprintf("INSERT INTO master_lantai (id,no_lantai) VALUES ('%d','%d')", $id, $no_lantai);
        $hsl = $this->db->query($q);
        if ($hsl) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * Update archive location data and respond in JSON format
     *
     */
    public function edlan()
    {
        $no_lantai = $this->__sanitizeString($this->input->post('no_lantai'));
        $id_lantai = $this->__sanitizeString($this->input->post('id_lantai'));
        $q = sprintf("UPDATE master_lantai SET no_lantai='%d' WHERE id_lantai=%d", $no_lantai, $id_lantai);
        $hsl = $this->db->query($q);
        if ($hsl) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * Delete archive location data and respond in JSON format
     *
     */
    public function dellan()
    {
        $id_lantai = $this->__sanitizeString($this->input->post('id'));
        //cek dulu apakah ada arsip yang menggunakan lantai ini
        $q = sprintf("SELECT count(id) jml FROM data_arsip WHERE lantai=%d", $id_lantai);
        $jml = $this->db->query($q)->row_array()['jml'];
        if ($jml == 0) { //kalau tidak data arsip yang menggunakan, boleh dihapus
            $q = sprintf("DELETE FROM master_lantai WHERE id_lantai=%d", $id_lantai);
            $hsl = $this->db->query($q);
            if ($hsl) {
                echo json_encode(array('status' => 'success'));
            } else {
                echo '[]';
            }
            exit();
        } else {

        }
    }

    /**
     * Get archive location data and respond in JSON format
     *
     */
    public function alan()
    {
        $id_lantai = $this->__sanitizeString($this->input->post('id'));
        $q = "SELECT * FROM master_lantai INNER JOIN master_lokasi ON master_lokasi.id=master_lantai.id WHERE id_lantai=$id_lantai";
        $hsl = $this->db->query($q);
        $row = $hsl->row_array();
        if ($row) {
            echo json_encode($row);
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * AJAX reload for location data
     *
     */ 
    public function reloadlan()
    {
        $q = "SELECT * FROM master_lantai INNER JOIN master_lokasi ON master_lokasi.id=master_lantai.id ORDER BY no_lantai ASC";
        $hsl = $this->db->query($q);
        $row = $hsl->result_array();
        if ($row) {
            echo "<table class='table table-bordered' name='vlan' id='vlan'>
            <thead>
                <th class='width-sm'>No</th>
                <th>Nama lokasi</th>
                <th>No Lantai</th>
                <th class='width-sm'></th>
                <th class='width-sm'></th>
            </thead>";
            $no = 1;
            foreach ($row as $u) {
                echo "<tr>";
                echo "<td>" . $no . "</td>";
                echo "<td>" . $u['nama_lokasi'] . "</td>";
                echo "<td>" . $u['no_lantai'] . "</td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#editlan\" class='edlan' href='#' id='" . $u['id_lantai'] . "' title=\"Edit\"><i class=\"glyphicon glyphicon-edit\"></i> </a></td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#dellan\" class='dellan' href='#' id='" . $u['id_lantai'] . "' title=\"Delete\"><i class=\"glyphicon glyphicon-trash\"></i> </a></td>";
                echo "</tr>";
                $no++;
            }
            echo "</table>";
        }
    }

        /**
     * Show archive ruangan data page
     *
     */
    public function ruangan()
    {   
        if (isset($_SESSION['akses_modul']['lokasi']) && $_SESSION['akses_modul']['lokasi'] == 'on') {

        $katakunci = $this->__sanitizeString($this->input->get('katakunci'));

        $q = "SELECT * FROM master_ruangan INNER JOIN master_lokasi ON master_lokasi.id=master_ruangan.id ";
        if ($katakunci) {
            $q .= ' WHERE nama_ruangan LIKE \'%' . $katakunci . '%\' OR id LIKE \'%' . $katakunci . '%\' ';
        }
        $q .= " ORDER BY nama_ruangan ASC";

        $id = $this->__sanitizeString($this->input->get('id_lantai'));
        $q2 = "SELECT * FROM master_ruangan where id_lantai=".$id." ORDER BY nama_ruangan ASC" ;

        $nama_lokasi = $this->get_lokasi_id($this->input->get("id_lokasi"))[0]['nama_lokasi'];
        $data['nama_lokasi'] = $nama_lokasi;
        $data['nomor_lantai'] = $this->get_lantai_id($this->input->get("id_lantai"))[0]['no_lantai'];
        $hsl = $this->db->query($q2);
        $data['rua'] = $hsl->result_array();
        $this->__output('ruangan', $data);
        }else{
                redirect('/home');
                }
    }

    public function get_lokasi_id($id){
        $q = "SELECT * FROM master_lokasi where id=".$id;
        $get = $this->db->query($q);
        $hasil = $get->result_array();
        return $hasil;
    }
    public function get_lantai_id($id){
        $q = "SELECT * FROM master_lantai where id_lantai=".$id;
        $get = $this->db->query($q);
        $hasil = $get->result_array();
        return $hasil;
    }
     public function get_ruangan_id($id){
        $q = "SELECT * FROM master_ruangan where id_ruangan=".$id;
        $get = $this->db->query($q);
        $hasil = $get->result_array();
        return $hasil;
    }
    public function get_lemari_id($id){
        $q = "SELECT * FROM master_lemari where id_lemari=".$id;
        $get = $this->db->query($q);
        $hasil = $get->result_array();
        return $hasil;
    }
     public function get_baris_id($id){
        $q = "SELECT * FROM master_baris where id_baris=".$id;
        $get = $this->db->query($q);
        $hasil = $get->result_array();
        return $hasil;
    }
    /**
     * Add archive location data and respond in JSON format
     *
     */
    public function addrua()
    {
        $id = $this->__sanitizeString($this->input->post('id_lantai'));
        $nama_ruangan = $this->__sanitizeString($this->input->post('nama_ruangan'));
        $q = sprintf("INSERT INTO master_ruangan (id_lantai,nama_ruangan) VALUES ('%d','%s')", $id, $nama_ruangan);
        $hsl = $this->db->query($q);
        if ($hsl) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * Update archive location data and respond in JSON format
     *
     */
    public function edrua()
    {
        $nama_ruangan = $this->__sanitizeString($this->input->post('nama_ruangan'));
        $id = $this->__sanitizeString($this->input->post('id_ruangan'));
        $q = sprintf("UPDATE master_ruangan SET nama_ruangan='%s' WHERE id_ruangan=%d", $nama_ruangan, $id);
        $hsl = $this->db->query($q);
        if ($hsl) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * Delete archive location data and respond in JSON format
     *
     */
    public function delrua()
    {
        $id = $this->__sanitizeString($this->input->post('id'));
        //cek dulu apakah ada arsip yang menggunakan lantai ini
         $q = sprintf("SELECT count(id) jml FROM data_arsip WHERE ruangan=%d", $id);
         $jml = $this->db->query($q)->row_array()['jml'];
         if ($jml == 0) { //kalau tidak data arsip yang menggunakan, boleh dihapus
            $q = sprintf("DELETE FROM master_ruangan WHERE id_ruangan=%d", $id);
            $hsl = $this->db->query($q);
            if ($hsl) {
                echo json_encode(array('status' => 'success'));
            } else {
                echo '[]';
            }
            exit();
         } else {

         }
    }

    /**
     * Get archive location data and respond in JSON format
     *
     */
    public function arua()
    {
        $id = $this->__sanitizeString($this->input->post('id'));
        $q = "SELECT * FROM master_ruangan WHERE id_ruangan=$id";
        $hsl = $this->db->query($q);
        $row = $hsl->row_array();
        if ($row) {
            echo json_encode($row);
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * Show archive lemari data page
     *
     */
    public function lemari()
    {   
        if (isset($_SESSION['akses_modul']['lokasi']) && $_SESSION['akses_modul']['lokasi'] == 'on') {

        $katakunci = $this->__sanitizeString($this->input->get('katakunci'));

        $q = "SELECT * FROM master_lemari INNER JOIN master_lokasi ON master_lokasi.id=master_lemari.id ";
        if ($katakunci) {
            $q .= ' WHERE nama_lemari LIKE \'%' . $katakunci . '%\' OR id LIKE \'%' . $katakunci . '%\' ';
        }
        $q .= " ORDER BY nama_lemari ASC";

        $id = $this->__sanitizeString($this->input->get('id_ruangan'));
        $q2 = "SELECT * FROM master_lemari where id_ruangan=".$id." ORDER BY no_lemari ASC" ;

        $nama_lokasi = $this->get_lokasi_id($this->input->get("id_lokasi"))[0]['nama_lokasi'];
        $data['nama_lokasi'] = $nama_lokasi;
        $data['nomor_lantai'] = $this->get_lantai_id($this->input->get("id_lantai"))[0]['no_lantai'];
        $data['nama_ruangan'] = $this->get_ruangan_id($this->input->get("id_ruangan"))[0]['nama_ruangan'];

        $hsl = $this->db->query($q2);
        $data['lem'] = $hsl->result_array();
        $this->__output('lemari', $data);
        }else{
                redirect('/home');
                }
    }

    /**
     * Add archive location data and respond in JSON format
     *
     */
    public function addlem()
    {
        $id = $this->__sanitizeString($this->input->post('id_ruangan'));
        $no_lemari = $this->__sanitizeString($this->input->post('no_lemari'));
        $q = sprintf("INSERT INTO master_lemari (id_ruangan,no_lemari) VALUES ('%d','%s')", $id, $no_lemari);
        $hsl = $this->db->query($q);
        if ($hsl) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * Update archive location data and respond in JSON format
     *
     */
    public function edlem()
    {
        $no_lemari = $this->__sanitizeString($this->input->post('no_lemari'));
        $id = $this->__sanitizeString($this->input->post('id_lemari'));
        $q = sprintf("UPDATE master_lemari SET no_lemari='%s' WHERE id_lemari=%d", $no_lemari, $id);
        $hsl = $this->db->query($q);
        if ($hsl) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * Delete archive location data and respond in JSON format
     *
     */
    public function dellem()
    {
        $id = $this->__sanitizeString($this->input->post('id'));
        //cek dulu apakah ada arsip yang menggunakan lantai ini
         $q = sprintf("SELECT count(id) jml FROM data_arsip WHERE lemari=%d", $id);
         $jml = $this->db->query($q)->row_array()['jml'];
         if ($jml == 0) { //kalau tidak data arsip yang menggunakan, boleh dihapus
            $q = sprintf("DELETE FROM master_lemari WHERE id_lemari=%d", $id);
            $hsl = $this->db->query($q);
            if ($hsl) {
                echo json_encode(array('status' => 'success'));
            } else {
                echo '[]';
            }
            exit();
         } else {

         }
    }

    /**
     * Get archive location data and respond in JSON format
     *
     */
    public function alem()
    {
        $id = $this->__sanitizeString($this->input->post('id'));
        $q = "SELECT * FROM master_lemari WHERE id_lemari=$id";
        $hsl = $this->db->query($q);
        $row = $hsl->row_array();
        if ($row) {
            echo json_encode($row);
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * Show archive ruangan data page
     *
     */
    public function baris()
    {   
        if (isset($_SESSION['akses_modul']['lokasi']) && $_SESSION['akses_modul']['lokasi'] == 'on') {

        $katakunci = $this->__sanitizeString($this->input->get('katakunci'));

        $q = "SELECT * FROM master_baris INNER JOIN master_lokasi ON master_lokasi.id=master_baris.id ";
        if ($katakunci) {
            $q .= ' WHERE nama_baris LIKE \'%' . $katakunci . '%\' OR id LIKE \'%' . $katakunci . '%\' ';
        }
        $q .= " ORDER BY nama_baris ASC";

        $id = $this->__sanitizeString($this->input->get('id_lemari'));
        $q2 = "SELECT * FROM master_baris where id_lemari=".$id." ORDER BY no_baris ASC" ;

               $nama_lokasi = $this->get_lokasi_id($this->input->get("id_lokasi"))[0]['nama_lokasi'];
        $data['nama_lokasi'] = $nama_lokasi;
        $data['nomor_lantai'] = $this->get_lantai_id($this->input->get("id_lantai"))[0]['no_lantai'];
        $data['nama_ruangan'] = $this->get_ruangan_id($this->input->get("id_ruangan"))[0]['nama_ruangan'];
        $data['nomor_lemari'] = $this->get_lemari_id($this->input->get("id_lemari"))[0]['no_lemari'];

        $hsl = $this->db->query($q2);
        $data['bar'] = $hsl->result_array();
        $this->__output('baris', $data);
        }else{
                redirect('/home');
                }
    }

    /**
     * Add archive location data and respond in JSON format
     *
     */
    public function addbar()
    {
        $id = $this->__sanitizeString($this->input->post('id_lemari'));
        $no_baris = $this->__sanitizeString($this->input->post('no_baris'));
        $q = sprintf("INSERT INTO master_baris (id_lemari,no_baris) VALUES ('%d','%d')", $id, $no_baris);
        $hsl = $this->db->query($q);
        if ($hsl) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * Update archive location data and respond in JSON format
     *
     */
    public function edbar()
    {
        $no_baris = $this->__sanitizeString($this->input->post('no_baris'));
        $id = $this->__sanitizeString($this->input->post('id_baris'));
        $q = sprintf("UPDATE master_baris SET no_baris='%d' WHERE id_baris=%d", $no_baris, $id);
        $hsl = $this->db->query($q);
        if ($hsl) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * Delete archive location data and respond in JSON format
     *
     */
    public function delbar()
    {
        $id = $this->__sanitizeString($this->input->post('id'));
        //cek dulu apakah ada arsip yang menggunakan lantai ini
         $q = sprintf("SELECT count(id) jml FROM data_arsip WHERE baris=%d", $id);
         $jml = $this->db->query($q)->row_array()['jml'];
         if ($jml == 0) { //kalau tidak data arsip yang menggunakan, boleh dihapus
            $q = sprintf("DELETE FROM master_baris WHERE id_baris=%d", $id);
            $hsl = $this->db->query($q);
            if ($hsl) {
                echo json_encode(array('status' => 'success'));
            } else {
                echo '[]';
            }
            exit();
         } else {

         }
    }

    /**
     * Get archive location data and respond in JSON format
     *
     */
    public function abar()
    {
        $id = $this->__sanitizeString($this->input->post('id'));
        $q = "SELECT * FROM master_baris WHERE id_baris=$id";
        $hsl = $this->db->query($q);
        $row = $hsl->row_array();
        if ($row) {
            echo json_encode($row);
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * Show media data page
     *
     */
    public function media()
    {   
        if (isset($_SESSION['akses_modul']['media']) && $_SESSION['akses_modul']['media'] == 'on') {

        $katakunci = $this->__sanitizeString($this->input->get('katakunci'));

        $q = "SELECT * FROM master_media ";
        if ($katakunci) {
            $q .= ' WHERE nama_media LIKE \'%' . $katakunci . '%\' OR id LIKE \'%' . $katakunci . '%\' ';
        }
        $q .= " ORDER BY nama_media ASC";
        $hsl = $this->db->query($q);
        $data['med'] = $hsl->result_array();
        $this->__output('media', $data);
        }else{
                redirect('/home');
                }
    }

    /**
     * Add media data and respond in JSON format
     *
     */
    public function addmed()
    {
        $nama = $this->__sanitizeString($this->input->post('nama'));
        $q = sprintf("INSERT INTO master_media (nama_media) VALUES ('%s')", $nama);
        $hsl = $this->db->query($q);
        if ($hsl) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * Update media data and respond in JSON format
     *
     */
    public function edmed()
    {
        $nama = $this->__sanitizeString($this->input->post('nama'));
        $id = $this->__sanitizeString($this->input->post('id'));
        $q = sprintf("UPDATE master_media SET nama_media='%s' WHERE id=%d", $nama, $id);
        $hsl = $this->db->query($q);
        if ($hsl) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * Delete media data and respond in JSON format
     *
     */
    public function delmed()
    {
        $id = $this->__sanitizeString($this->input->post('id'));
        //cek dulu apakah ada arsip yang menggunakan media ini
        $q = sprintf("SELECT count(id) jml FROM data_arsip WHERE media=%d", $id);
        $jml = $this->db->query($q)->row_array()['jml'];
        if ($jml == 0) { //kalau tidak data arsip yang menggunakan, boleh dihapus
            $q = sprintf("DELETE FROM master_media WHERE id=%d", $id);
            $hsl = $this->db->query($q);
            if ($hsl) {
                echo json_encode(array('status' => 'success'));
            } else {
                echo '[]';
            }
            exit();
        } else {

        }
    }

    /**
     * Get media data and respond in JSON format
     *
     */
    public function amed()
    {
        $id = $this->__sanitizeString($this->input->post('id'));
        $q = "SELECT * FROM master_media WHERE id=$id";
        $hsl = $this->db->query($q);
        $row = $hsl->row_array();
        if ($row) {
            echo json_encode($row);
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * AJAX reload for media data
     *
     */
    public function reloadmed()
    {
        $q = "SELECT * FROM master_media ORDER BY nama_media ASC";
        $hsl = $this->db->query($q);
        $row = $hsl->result_array();
        if ($row) {
            echo "<table class='table table-bordered' name='vmed' id='vmed'>
			<thead>
				<th class='width-sm'>No</th>
				<th>Nama</th>
				<th class='width-sm'></th>
				<th class='width-sm'></th>
			</thead>";
            $no = 1;
            foreach ($row as $u) {
                echo "<tr>";
                echo "<td>" . $no . "</td>";
                echo "<td>" . $u['nama_media'] . "</td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#editmed\" class='edmed' href='#' id='" . $u['id'] . "' title=\"Edit\"><i class=\"glyphicon glyphicon-edit\"></i> </a></td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#delmed\" class='delmed' href='#' id='" . $u['id'] . "' title=\"Delete\"><i class=\"glyphicon glyphicon-trash\"></i> </a></td>";
                echo "</tr>";
                $no++;
            }
            echo "</table>";
        }
    }

    /**
     * Show user data page
     *
     */
    public function vuser()
    {   
        if (isset($_SESSION['akses_modul']['user']) && $_SESSION['akses_modul']['user'] == 'on') {
        $katakunci = $this->__sanitizeString($this->input->get('katakunci'));

        $q = "SELECT * FROM master_user ";
        if ($katakunci) {
            $q .= ' WHERE username LIKE \'%' . $katakunci . '%\' OR tipe LIKE \'%' . $katakunci . '%\' ';
        }
        $q .= " ORDER BY username ASC";
        $hsl = $this->db->query($q);
        $data['user'] = $hsl->result_array();
        $data["departemen"] = $this->masterlist("departemen");
        $data["depar"] = $this->masterlist("departemen");
        $this->__output('vuser', $data);
        }else{
                redirect('/home');
                }
    }

    /**
     * Check for user data and respond in JSON format
     *
     */
    public function cekuser()
    {
        $username = $this->__sanitizeString($this->input->post('username'));
        $q = "SELECT username FROM master_user WHERE username='$username'";
        $hsl = $this->db->query($q)->row_array();
        if ($hsl['username'] == $username) {
            echo json_encode(array('msg' => 'error'));
        } else {
            echo json_encode(array('msg' => 'ok'));
        }
    }

    /**
     * Add user data and respond in JSON format
     *
     */
    public function adduser()
    {
        $password_str = $this->input->post('password');
        $conf_password_str = $this->input->post('conf_password');
        if ($password_str !== $conf_password_str) {
            echo json_encode(array('status' => 'error', 'pesan' => 'PASSWORD_UNMATCH'));exit();
        }

        $username = $this->__sanitizeString($this->input->post('username'));
        $password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
        $status = $this->__sanitizeString($this->input->post('status'));
        $tipe = $this->__sanitizeString($this->input->post('tipe'));
        $akses_klas = $this->__sanitizeString($this->input->post('akses_klas'));
        $akses_modul = json_encode($this->input->post('modul'));
        $dep = $this->__sanitizeString($this->input->post('departemen'));
        $q = sprintf("INSERT INTO master_user (username,password,status,tipe,akses_klas,akses_modul,depar) VALUES ('%s','%s','%s','%s','%s','%s','%s')",
            $username, $password, $status, $tipe, $akses_klas, $akses_modul, $dep);
        $hsl = $this->db->query($q);
        if ($hsl) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * Update user data and respond in JSON format
     *
     */
    public function eduser()
    {
        $username = $this->__sanitizeString($this->input->post('username'));
        $password = "";
        if ($this->input->post('password') != "") {
            $password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
        }
        $status = $this->__sanitizeString($this->input->post('status'));
        $tipe = $this->__sanitizeString($this->input->post('tipe'));
        $akses_klas = $this->__sanitizeString($this->input->post('akses_klas'));
        $akses_modul = json_encode($this->input->post('modul'));
        $dep = $this->__sanitizeString($this->input->post('departemen'));
        $id = $this->__sanitizeString($this->input->post('id'));
        $q = sprintf("UPDATE master_user SET username='%s'", $username);
        if ($password != "") {
            $q .= sprintf(",password='%s'", $password);
        }

        $q .= sprintf(",status='%s',tipe='%s',akses_klas='%s',akses_modul='%s',depar='%s' WHERE id=%d",
            $status, $tipe, $akses_klas, $akses_modul, $dep, $id);
        $hsl = $this->db->query($q);
        if ($hsl) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * Delete user data and respond in JSON format
     *
     */
    public function deluser()
    {
        $id = $this->__sanitizeString($this->input->post('id'));
        $q = sprintf("DELETE FROM master_user WHERE id=%d", $id);
        $hsl = $this->db->query($q);
        if ($hsl) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * Get user data in JSON format
     *
     */
    public function auser()
    {
        $id = $this->__sanitizeString($this->input->post('id'));
        $q = sprintf("SELECT * FROM master_user WHERE id=%d", $id);
        $hsl = $this->db->query($q);
        $row = $hsl->row_array();
        if ($row) {
            echo json_encode($row);
        } else {
            echo '[]';
        }
        exit();
    }

    /**
     * AJAX reload for user data
     *
     */
    public function reloaduser()
    {
        $q = "SELECT * FROM master_user";
        $hsl = $this->db->query($q);
        $row = $hsl->result_array();
        if ($row) {
            echo "<table class='table table-bordered' name='vuser' id='vuser'>
			<thead>
				<th class='width-sm'>No</th>
				<th>Username1</th>
				<th>Akses Klasifikasi</th>
				<th>Akses Modul</th>
                <th>Status</th>
				<th>Tipe</th>
				<th class='width-sm'></th>
				<th class='width-sm'></th>
			</thead>";
            $no = 1;
            foreach ($row as $u) {
                echo "<tr>";
                echo "<td>" . $no . "</td>";
                echo "<td>" . $u['username'] . "</td>";
                echo "<td>" . $u['akses_klas'] . "</td>";
                echo "<td>";
                $mm = $u['akses_modul'];
                if ($mm != "") {
                    $mm = json_decode($mm);
                    if ($mm) {
                        foreach ($mm as $key => $val) {
                            echo $key . ",";
                        }
                    }
                }
                echo "</td>";
                echo "<td>" . $u['status'] . "</td>";
                echo "<td>" . $u['tipe'] . "</td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#edituser\" class='eduser' href='#' id='" . $u['id'] . "' title=\"Edit\"><i class=\"glyphicon glyphicon-edit\"></i> </a></td>";
                echo "<td><a data-toggle=\"modal\" data-target=\"#deluser\" class='deluser' href='#' id='" . $u['id'] . "' title=\"Delete\"><i class=\"glyphicon glyphicon-trash\"></i> </a></td>";
                echo "</tr>";
                $no++;
            }
            echo "</table>";
        }
    }

        function departemen () {
        if (isset($_SESSION['akses_modul']['departemen']) && $_SESSION['akses_modul']['departemen'] == 'on') {
        $katakunci = $this->__sanitizeString($this->input->get('katakunci'));

        $q = "SELECT * FROM master_departemen ";
        if ($katakunci) {
            $q .= ' WHERE kode_dep LIKE \'%' . $katakunci . '%\' OR nama_dep LIKE \'%' . $katakunci . '%\' OR keterangan LIKE \'%' . $katakunci . '%\' ';
        }
        $q .= " ORDER BY kode_dep ASC";
        $hsl = $this->db->query($q);
        $data['dep'] = $hsl->result_array();
        $this->__output('departemen', $data);
        }else{
                redirect('/home');
                }
    }

        public function adddep()
    {
        $kode = $this->__sanitizeString($this->input->post('kode'));
        $nama = $this->__sanitizeString($this->input->post('nama'));
        $keterangan = $this->__sanitizeString($this->input->post('keterangan'));
       
        $insert_data = [
            "kode_dep"=>$kode,
            "nama_dep"=>$nama,
            "keterangan"=>$keterangan,
                        ];
        $this->db->insert("master_departemen", $insert_data);
        if ($insert_data) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo '[]';
        }
        exit();
    }

     public function eddep()
    {
        $kode = $this->__sanitizeString($this->input->post('kode'));
        $nama = $this->__sanitizeString($this->input->post('nama'));
        $keterangan = $this->__sanitizeString($this->input->post('keterangan'));        
        $id = $this->__sanitizeString($this->input->post('id'));

        $update_data = [
            "kode_dep"=>$kode,
            "nama_dep"=>$nama,
            "keterangan"=>$keterangan];

        $this->db->where("id_dep", $id);
        $hasil = $this->db->update("master_departemen", $update_data);

        if ($hasil) {
            http_response_code(200);
            echo json_encode(array('status' => 'success'));
        } else {
            http_response_code(304);
            echo '[]';
        }
        exit();
    }

    /**
     * Delete archive location data and respond in JSON format
     *
     */
    public function deldep()
    {
        $id = $this->__sanitizeString($this->input->post('id'));
        //cek dulu apakah ada arsip yang menggunakan lokasi ini
        $q = sprintf("SELECT count(id) jml FROM data_arsip WHERE id_dep=%d", $id);
        $jml = $this->db->query($q)->row_array()['jml'];
        if ($jml == 0) { //kalau tidak data arsip yang menggunakan, boleh dihapus
            $q = sprintf("DELETE FROM master_departemen WHERE id_dep=%d", $id);
            $hsl = $this->db->query($q);
            if ($hsl) {
                echo json_encode(array('status' => 'success'));
            } else {
                echo '[]';
            }
            exit();
        } else {

        }
    }

    /**
     * Get archive location data and respond in JSON format
     *
     */
    public function adep()
    {
        $id = $this->__sanitizeString($this->input->post('id'));
        $q = "SELECT * FROM master_departemen WHERE id_dep=$id";
        $hsl = $this->db->query($q);
        $row = $hsl->row_array();
        if ($row) {
            echo json_encode($row);
        } else {
            echo '[]';
        }
        exit();
    }

        public function get_lantai(){
        $id_gedung = $this->input->get("id_lokasi");
        $q = $this->db->query("select * from master_lantai where id=".$id_gedung." ORDER BY no_lantai ASC");
        $hasil = $q->result_array();
        echo json_encode($hasil);
    }

    public function get_ruangan(){
        $id_lantai = $this->input->get("id_lantai");
        $q = $this->db->query("select * from master_ruangan where id_lantai=".$id_lantai." ORDER BY nama_ruangan ASC");
        $hasil = $q->result_array();
        echo json_encode($hasil);
    }

    public function get_lemari(){
        $id_ruangan = $this->input->get("id_ruangan");
        $q = $this->db->query("select * from master_lemari where id_ruangan=".$id_ruangan." ORDER BY no_lemari ASC");
        $hasil = $q->result_array();
        echo json_encode($hasil);
    }

    public function get_baris(){
        $id_lemari = $this->input->get("id_lemari");
        $q = $this->db->query("select * from master_baris where id_lemari=".$id_lemari." ORDER BY no_baris ASC");
        $hasil = $q->result_array();
        echo json_encode($hasil);
    }


    /**
     * Export database
     *
     */

function backupdatabase(){ //proses backup

    // Load the DB utility class
        $this->load->dbutil();

        $prefs = array(    
                'format'      => 'zip',            
                'filename'    => 'db_backup.sql'
              );


        $backup =& $this->dbutil->backup($prefs);

        $db_name = 'backup-on-'. date("Y-m-d-H-i-s") .'.zip';
        $save = FCPATH.'/'.$db_name;

        $this->load->helper('file');
        write_file($save, $backup);


        $this->load->helper('download');
        force_download($db_name, $backup);
        // $this->__output('backup');
}  
function backupdb(){
    if ((isset($_SESSION['akses_modul']['backupdb']) && $_SESSION['akses_modul']['backupdb'] == 'on') && $_SESSION['tipe'] == 'sumin') {
    $this->load->view("header");
    $this->load->view("backupdb");
    $this->load->view("footer");
    }else{
        redirect('/home');
        }
}

//$this->__output('backup');

    /**
     * Export/import data page
     *
     */
    public function import()
    {
        if (isset($_SESSION['akses_modul']['import']) && $_SESSION['akses_modul']['import'] == 'on') {
        $this->__output('import');
        }else{
                redirect('/home');
                }
    }

    /**
     * Export data to Excel file
     *
     */
    public function exportdata()
    {
        include 'dbimexport.php';
        $db_config = array(
            'dbtype' => "MYSQL",
            'host' => $this->db->hostname,
            'database' => $this->db->database,
            'user' => $this->db->username,
            'password' => $this->db->password,
        );
        $dbimexport = new dbimexport($db_config);
        $dbimexport->download_path = "";
        $dbimexport->download = true;
        $dbimexport->file_name = "backup_database_DA_" . date("Y-m-d_H-i-s");
        $dbimexport->export();
    }

    /**
     * Import data from Excel file
     *
     */
    public function importdata()
    {
        if ($_FILES["up_file"]["name"]) {
            $source = $_FILES["up_file"]["tmp_name"];
            $this->load->library('excel');
            $read = PHPExcel_IOFactory::createReaderForFile($source);
            $read->setReadDataOnly(true);
            $excel = $read->load($source);
            $sheets = $read->listWorksheetNames($source); //baca semua sheet yang ada
            foreach ($sheets as $sheet) {
                $_sheet = $excel->setActiveSheetIndexByName($sheet); //Kunci sheetnye biar kagak lepas :-p
                $maxRow = $_sheet->getHighestRow();
                $maxCol = $_sheet->getHighestColumn();
                $field = array();
                $sql = array();
                $AllCol = range('A', $maxCol);
                //echo implode(",", $AllCol);
                foreach ($AllCol as $key => $coloumn) {
                    $field[$key] = $this->__sanitizeString($_sheet->getCell($coloumn . '2')->getCalculatedValue()); //Kolom pertama sebagai field list pada table
                }
                for ($i = 3; $i <= $maxRow; $i++) {
                    foreach ($AllCol as $k => $coloumn) {
                        $sql[$field[$k]] = $this->__sanitizeString($_sheet->getCell($coloumn . $i)->getCalculatedValue());
                    }
                    $noarsip = (isset($sql['No.Arsip']) ? $sql['No.Arsip'] : "");
                    $tanggal = (isset($sql['Tanggal']) ? $sql['Tanggal'] : "");
                    $uraian = (isset($sql['Uraian']) ? $sql['Uraian'] : "");
                    $id_kode = "";
                    $ket = (isset($sql['Ket']) ? $sql['Ket'] : "");
                    $jenisdok = (isset($sql['Jenis Data']) ? $sql['Jenis Data']=="Biasa"?"1":"2" : "");
                    $nobox = (isset($sql['No.Box']) ? $sql['No.Box'] : "");
                    $file = "";
                    $jumlah = (isset($sql['Jumlah']) ? $sql['Jumlah'] : "");
                    $id_penc = "";
                    $id_peng = "";
                    $id_lok = "";
                    $id_lan = "";
                    $id_rua = "";
                    $id_lem = "";
                    $id_bar = "";
                    $id_med = "";
                    $user = (isset($sql['username']) ? $sql['username'] : "");
                    if (isset($sql["Kode Klasifikasi"]) && $sql["Kode Klasifikasi"] != "") {
                        $s = $sql["Kode Klasifikasi"];
                        $this->db->where('kode', $s);
                        $kode = $this->db->get('master_kode')->result_array();
                        if (count($kode) > 0) {
                            $id_kode = $kode[0]['id'];
                        } else {
                            $q = "insert ignore into master_kode (kode) values('$s');";
                            $this->db->query($q);
                            $id_kode = $this->db->insert_id();
                        }
                        $sql["Kode Klasifikasi"] = $id_kode;
                    }
                    if (isset($sql["Pencipta"]) && $sql["Pencipta"] != "") {
                        $s = $sql["Pencipta"];
                        $this->db->where('nama_pencipta', $s);
                        $kode = $this->db->get('master_pencipta')->result_array();
                        if (count($kode) > 0) {
                            $id_penc = $kode[0]['id'];
                        } else {
                            $q = "insert ignore into master_pencipta (nama_pencipta) values('$s');";
                            $this->db->query($q);
                            $id_penc = $this->db->insert_id();
                        }
                        $sql["Pencipta"] = $id_penc;
                    }
                    if (isset($sql["Pengolah"]) && $sql["Pengolah"] != "") {
                        $s = $sql["Pengolah"];
                        $this->db->where('nama_pengolah', $s);
                        $kode = $this->db->get('master_pengolah')->result_array();
                        if (count($kode) > 0) {
                            $id_peng = $kode[0]['id'];
                        } else {
                            $q = "insert ignore into master_pengolah (nama_pengolah) values('$s');";
                            $this->db->query($q);
                            $id_peng = $this->db->insert_id();
                        }
                        $sql["Pengolah"] = $id_peng;
                    }
                    if (isset($sql["Media"]) && $sql["Media"] != "") {
                        $s = $sql["Media"];
                        $this->db->where('nama_media', $s);
                        $kode = $this->db->get('master_media')->result_array();
                        if (count($kode) > 0) {
                            $id_med = $kode[0]['id'];
                        } else {
                            $q = "insert ignore into master_media (nama_media) values('$s');";
                            $this->db->query($q);
                            $id_med = $this->db->insert_id();
                        }
                        $sql["Media"] = $id_med;
                    }
                    if (isset($sql["Lokasi"]) && $sql["Lokasi"] != "") {
                        $s = $sql["Lokasi"];
                        $this->db->where('nama_lokasi', $s);
                        $kode = $this->db->get('master_lokasi')->result_array();
                        if (count($kode) > 0) {
                            $id_lok = $kode[0]['id'];
                        } else {
                            $q = "insert ignore into master_lokasi (nama_lokasi) values('$s');";
                            $this->db->query($q);
                            $id_lok = $this->db->insert_id();
                        }
                        $sql["Lokasi"] = $id_lok;
                    }
                    if (isset($sql["Lantai"]) && $sql["Lantai"] != "") {
                        $s = $sql["Lantai"];
                        $this->db->where('no_lantai', $s);
                        $this->db->where('id', $id_lok);
                        $kode = $this->db->get('master_lantai')->result_array();
                        if (count($kode) > 0) {
                            $id_lan = $kode[0]['id_lantai'];
                        } else {
                            $q = "insert ignore into master_lantai (no_lantai) values('$s');";
                            $this->db->query($q);
                            $id_lan = $this->db->insert_id();
                        }
                        $sql["Lantai"] = $id_lan;
                    }
                    if (isset($sql["Ruangan"]) && $sql["Ruangan"] != "") {
                        $s = $sql["Ruangan"];
                        $this->db->where('nama_ruangan', $s);
                        $this->db->where('id_lantai', $id_lan);
                        $kode = $this->db->get('master_ruangan')->result_array();
                        if (count($kode) > 0) {
                            $id_rua = $kode[0]['id_ruangan'];
                        } else {
                            $q = "insert ignore into master_ruangan (nama_ruangan) values('$s');";
                            $this->db->query($q);
                            $id_rua = $this->db->insert_id();
                        }
                        $sql["Ruangan"] = $id_rua;
                    }
                    if (isset($sql["Lemari"]) && $sql["Lemari"] != "") {
                        $s = $sql["Lemari"];
                        $this->db->where('no_lemari', $s);
                        $this->db->where('id_ruangan', $id_rua);
                        $kode = $this->db->get('master_lemari')->result_array();
                        if (count($kode) > 0) {
                            $id_lem = $kode[0]['id_lemari'];
                        } else {
                            $q = "insert ignore into master_lemari (no_lemari) values('$s');";
                            $this->db->query($q);
                            $id_lem = $this->db->insert_id();
                        }
                        $sql["Lemari"] = $id_lem;
                    }
                    if (isset($sql["Baris"]) && $sql["Baris"] != "") {
                        $s = $sql["Baris"];
                        $this->db->where('no_baris', $s);
                        $this->db->where('id_lemari', $id_lem);
                        $kode = $this->db->get('master_baris')->result_array();
                        if (count($kode) > 0) {
                            $id_bar = $kode[0]['id_baris'];
                        } else {
                            $q = "insert ignore into master_baris (no_baris) values('$s');";
                            $this->db->query($q);
                            $id_bar = $this->db->insert_id();
                        }
                        $sql["Baris"] = $id_bar;
                    }
                    if (isset($sql["Departemen"]) && $sql["Departemen"] != "") {
                        $s = $sql["Departemen"];
                        $this->db->where('nama_dep', $s);
                        $kode = $this->db->get('master_departemen')->result_array();
                        if (count($kode) > 0) {
                            $id_dep = $kode[0]['id_dep'];
                        } else {
                            $q = "insert ignore into master_departemen (nama_dep) values('$s');";
                            $this->db->query($q);
                            $id_dep = $this->db->insert_id();
                        }
                        $sql["Departemen"] = $id_dep;
                    }
                     // echo "<pre>" . var_dump($sql) . "</pre>";
                    $q = sprintf("INSERT IGNORE INTO data_arsip (noarsip,tanggal,uraian,kode,ket,jenisdok,nobox,file,jumlah,pencipta,unit_pengolah,lokasi,lantai,ruangan,lemari,baris,media,username,dep)
			        VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%d',%d,%d,%d,%d,'%s',%d,%d,%d,'%s','%s')",
                        $noarsip,
                        $tanggal,
                        $uraian,
                        $id_kode,
                        $ket,
                        $jenisdok,
                        $nobox,
                        $file,
                        $jumlah,
                        $id_penc,
                        $id_peng,
                        $id_lok,
                        $id_lan,
                        $id_rua,
                        $id_lem,
                        $id_bar,
                        $id_med,
                        $user,
                        $id_dep);
                    //echo $q . "<br/>";
                    $this->db->query($q);
                }
            }

            $this->session->set_flashdata('zz', "Data berhasil diimport");
            redirect('/admin/import', 'refresh');
        } else {
            $this->session->set_flashdata('zz', "Tidak ada file yang diupload");
            redirect('/admin/import', 'refresh');
        }
    }

}
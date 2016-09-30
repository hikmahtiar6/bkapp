<?php
/**
* Author M.Febriansyah
*/
class Pemohon extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_global');
		$this->load->model('supermodel');
		 if($this->session->userdata('getLoginAct')==FALSE) {
		 		echo"<script>alert('Anda belum login !!!');document.location.href='".site_url('login_daftar_member/index')."'</script>";
		 }

	}

	function index(){
			$id = $this->session->userdata('member_id');
			$data['sql'] = $this->supermodel->queryManual("	SELECT 
															p.*,
															p.member_id,
															kc.kecamatan_nama,
															kl.kelurahan_nama
															FROM 
															pemohon p,kecamatan kc, kelurahan kl
															WHERE 
															p.kelurahan_id = kl.kelurahan_id AND
															kl.kecamatan_id = kc.kecamatan_id AND
															member_id = '".$id."' ORDER BY pemohon_id DESC ");
			$data['konten'] = "izin_lingkungan/form_pemohon";
			$this->load->view('izin_lingkungan/template',$data);
	}
	
	function tambah() { 
			$data['konten'] = "izin_lingkungan/tambah_pemohon";
			$this->load->view('izin_lingkungan/template',$data);
	}

	function simpan() {
		$nik = $this->input->post('nik');
		$nama = $this->input->post('nama');
		$jabatan = $this->input->post('jabatan');
		$alamat = $this->input->post('alamat');
		$kelurahan = $this->input->post('kelurahan');
		$no_telp = $this->input->post('no_telp');
		$member_id = $this->session->userdata('member_id');

		
		if (isset($_POST['simpan'])){
			$data=array(
				'nik' => $nik,
				'nama' => $nama,
				'jabatan' => $jabatan,
				'alamat' => $alamat,
				'kelurahan_id' => $kelurahan,
				'no_telp' => $no_telp,
				'member_id' => $member_id
				);
			$jalan = $this->supermodel->InsertData('pemohon',$data);
			if ($jalan){
				echo"<script>alert('Berhasil menyimpan data');document.location.href='index'</script>";
			}	
		}
	}

	function edit($pemohon_id){
			$r = $this->supermodel->queryManual("SELECT 
															p.*,
															kc.*,
															kl.*
															FROM 
															pemohon p,kecamatan kc, kelurahan kl
															WHERE 
															p.kelurahan_id = kl.kelurahan_id AND
															kl.kecamatan_id = kc.kecamatan_id AND
															pemohon_id = '".$pemohon_id."'")->row_array();
			$data = array('pemohon_id' => $r['pemohon_id'],
						'nik' => $r['nik'],
						'nama' => $r['nama'],
						'jabatan' => $r['jabatan'],
						'alamat' => $r['alamat'],
						'kec' => $r['kecamatan_id'],
						'kel' => $r['kelurahan_id'],
						'no_telp' => $r['no_telp']
						);

			$data['konten'] = "izin_lingkungan/edit_pemohon";
			$this->load->view('izin_lingkungan/template',$data);
	}

	function update() {
		$pemohon_id = $this->input->post('pemohon_id');
		$nik = $this->input->post('nik');
		$nama = $this->input->post('nama');
		$jabatan = $this->input->post('jabatan');
		$alamat = $this->input->post('alamat');
		$kelurahan = $this->input->post('kelurahan');
		$no_telp = $this->input->post('no_telp');
		$member_id = $this->session->userdata('member_id');

		
		if (isset($_POST['update'])){
			$data=array(
				'nik' => $nik,
				'nama' => $nama,
				'jabatan' => $jabatan,
				'alamat' => $alamat,
				'kelurahan_id' => $kelurahan,
				'no_telp' => $no_telp
				);
			$where = "pemohon_id = '$pemohon_id'";
			$jalan = $this->supermodel->updateData('pemohon',$data,$where,$field="");
			if ($jalan){
				echo"<script>alert('Berhasil merubah data');document.location.href='index'</script>";
			}	
		}
	}

	function kel($id=null){
		$daerah = $this->db->get_where('kelurahan', array('kecamatan_id'=>$id));
		foreach ($daerah->result() as $r) {
			echo '<option value="'.$r->kelurahan_id.'" >'.$r->kelurahan_nama.'</option>';
		}
	}

 }
?>
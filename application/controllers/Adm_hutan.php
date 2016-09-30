<?php
/**
* Author Imam Teguh
*/
class Adm_hutan extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_global');
		$this->load->model('supermodel');
		if($this->session->userdata('getLoginAct')==FALSE) {
			$this->session->set_flashdata('error', 'Tidak ada akses untuk ini!!!');
			redirect('loginweb');
		}
	}

	function index()
	{
		$data['title'] = "Data Hutan Kota";
		$data['konten'] = 'admin/hutan/index';
		$link = 'adm_hutan/index/';
		$limit= 10;
		$uri_segment= 3;
		$offset= $this->uri->segment($uri_segment);
		$jum = $this->supermodel->getData('hutan_kota');
		$data['tgl1'] = '';
		$data['tgl2'] = '';
		$data['listview'] = $this->supermodel->getData('hutan_kota',$field='', $order='tahun_pendataan', $dasc='DESC', $limit, $offset);
		$this->supermodel->paging($link,$jum,$limit,$uri_segment);
		$data['offset'] = $offset;
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function view_map()
	{
		$data['id'] = $this->uri->segment(3);
		$this->load->view('admin/hutan/map', $data);
	}

	function xmlmap($id=null)
	{
		header("Content-type: text/xml");
		// Parent node XML
		echo '<markers>';

		$dt = $this->supermodel->getData('hutan_kota',array('hutan_kota_id'=>$id));
		foreach ($dt->result() as $rows) {
		echo '<marker ';
		echo 'nama="Nama Lokasi = '.$rows->nama_lokasi.'" ';
		echo 'coords="'.$rows->area.'" ';
		echo 'warna="'.$rows->warna.'" ';

		echo '/>';
		}
		// Menambahkan ke node dokumen XML

		echo '</markers>';
	}

	function tambah()
	{
		$this->form_validation->set_rules('nama_lokasi','Nama Lokasi','required');
		$this->form_validation->set_rules('tahun_pendataan','Tanggal pendataan','required');
		$this->form_validation->set_rules('area','Area','required');
		$this->form_validation->set_rules('kelurahan','Kelurahan','required');
		if($this->form_validation->run()===TRUE) {
			$in['nama_lokasi'] = $this->input->post('nama_lokasi');
			$in['area'] = $this->input->post('area');
			$in['tahun_pendataan'] = $this->input->post('tahun_pendataan');
			$in['luasan'] = $this->input->post('luasan');
			$in['warna'] = $this->input->post('warna');
			$in['keterangan'] = $this->input->post('keterangan');
			$in['kelurahan_id'] = $this->input->post('kelurahan');
			$in['jenis_tanaman'] = $this->input->post('jenis_tanaman');
			if($_FILES['foto']['name']) {
				$ext = end(explode(".", $_FILES['foto']['name']));
				$rand = rand(000,999);
				$name = "hutan-".$rand.'.'.$ext;
				$unggah = $this->supermodel->unggah_gambar('ragamdata/hutan/','foto',$name,true);
				if($unggah===false) {
					$this->session->set_flashdata('error', 'Upload gagal!!');
					redirect('adm_hutan/tambah');
				}
				$in['foto'] = $name;
			}
			$this->supermodel->insertData('hutan_kota',$in);
			$this->session->set_flashdata('success', 'Penyimpanan data sukses');
			$this->m_global->activities('Menyimpan data hasil pengujian hutan kota '.$in['nama_lokasi']);
			redirect('adm_hutan/tambah');
		}
		$data['title'] = "Tambah Data Hutan Kota";
		$data['konten'] = 'admin/hutan/tambah';
		$data['kecamatan'] = $this->supermodel->getData('kecamatan');
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function edit($id=null)
	{
		$this->form_validation->set_rules('nama_lokasi','Nama Lokasi','required');
		$this->form_validation->set_rules('tahun_pendataan','Tanggal pendataan','required');
		$this->form_validation->set_rules('area','Area','required');
		$this->form_validation->set_rules('kelurahan','Kelurahan','required');
		if($this->form_validation->run()===TRUE) {
			$id = $this->input->post('id');
			$in['nama_lokasi'] = $this->input->post('nama_lokasi');
			$in['area'] = $this->input->post('area');
			$in['tahun_pendataan'] = $this->input->post('tahun_pendataan');
			$in['luasan'] = $this->input->post('luasan');
			$in['warna'] = $this->input->post('warna');
			$in['keterangan'] = $this->input->post('keterangan');
			$in['kelurahan_id'] = $this->input->post('kelurahan');
			$in['jenis_tanaman'] = $this->input->post('jenis_tanaman');
			if($_FILES['foto']['name']) {
				$cek = $this->supermodel->getData('hutan_kota',array('hutan_kota_id'=>$id))->row();
				if($cek->foto!='') {
					@unlink('./uploads/ragamdata/hutan/'.$cek->foto);
					@unlink('./uploads/ragamdata/hutan/thumb/'.$cek->foto);
				}
				$ext = end(explode(".", $_FILES['foto']['name']));
				$rand = rand(000,999);
				$name = "hutan-".$rand.'.'.$ext;
				$unggah = $this->supermodel->unggah_gambar('ragamdata/hutan/','foto',$name,true);
				if($unggah===false) {
					$this->session->set_flashdata('error', 'Upload gagal!!');
					redirect('adm_hutan/edit/'.$id);
				}
				$in['foto'] = $name;
			}
			$this->supermodel->updateData('hutan_kota',$in,'hutan_kota_id',$id);
			$this->session->set_flashdata('success', 'Perubahan data sukses');
			$this->m_global->activities('Menyimpan data hasil pengujian hutan kota '.$in['nama_lokasi']);
			redirect('adm_hutan/edit/'.$id);
		}
		$data['title'] = "Edit Data Hutan Kota";
		$data['konten'] = 'admin/hutan/edit';
		$data['kecamatan'] = $this->supermodel->getData('kecamatan');
		$data['item'] = $this->supermodel->getData('hutan_kota',array('hutan_kota_id'=>$id))->row_array();
		$data['kelurahan'] = $this->supermodel->getData('kelurahan', array('kelurahan_id'=>$data['item']['kelurahan_id']))->row_array();
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function cetak(){
		$data['filename'] = 'Hutan_kota';
		$tgl1 = $this->input->get('tgl1');
		$tgl2 = $this->input->get('tgl2');
		if($tgl1=='')
		{
			$data['listview'] = $this->supermodel->getData('hutan_kota','','tahun_pendataan','asc');
		}
		else
		{
			$data['listview'] = $this->db->query("select * from hutan_kota where tahun_pendataan between '$tgl1' and '$tgl2'");
		}
		
		$this->load->view('cetak/cetak_hutan_kota', $data);
	}

	function cari()
	{
		$data['title'] = "Data Hutan Kota";
		$data['konten'] = 'admin/hutan/index';
		$link = 'adm_hutan/index/';
		$limit= 10;
		$uri_segment= 3;
		$offset= $this->uri->segment($uri_segment);
		$jum = $this->supermodel->getData('hutan_kota');
		$tgl1 = $this->input->post('tahun_pengujian1');
		$tgl2 = $this->input->post('tahun_pengujian2');
		$data['tgl1'] = $tgl1;
		$data['tgl2'] = $tgl2;
		$data['listview'] = $this->db->query("select * from hutan_kota where tahun_pendataan between '$tgl1' and '$tgl2'");
		$this->supermodel->paging($link,$jum,$limit,$uri_segment);
		$data['offset'] = $offset;
		$this->load->vars($data);
		$this->load->view('admin/template');
	}
}
?>
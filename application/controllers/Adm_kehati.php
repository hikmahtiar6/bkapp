<?php
/**
* Author Tri Wanda
*/
class Adm_kehati extends CI_Controller
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
		$data['title'] = "Data Konservasi KEHATI";
		$data['konten'] = 'admin/Konservasi/kehati/index';
		$link = 'adm_kehati/index/';
		$limit= 10;
		$uri_segment= 3;
		$offset= $this->uri->segment($uri_segment);
		$jum = $this->supermodel->getData('skp');
		$data['tgl1'] = '';
		$data['tgl2'] = '';
		$data['listview'] = $this->supermodel->getData('skp',$field=array('kategori'=>'Kehati'), $order='tahun_pendataan', $dasc='DESC', $limit, $offset);
		$this->supermodel->paging($link,$jum,$limit,$uri_segment);
		$data['offset'] = $offset;
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function tambah()
	{
		$this->form_validation->set_rules('nama_lokasi','Nama Lokasi','required');
		$this->form_validation->set_rules('tahun_pendataan','Tanggal Pendataan','required');
		if($this->form_validation->run()===TRUE) {
			$in['nama_lokasi'] = $this->input->post('nama_lokasi');
			$in['kategori'] = "Kehati";
			$in['lat'] = $this->input->post('lat');
			$in['lng'] = $this->input->post('lng');
			$in['tahun_pendataan'] = $this->input->post('tahun_pendataan');
			//$in['description'] = $this->input->post('keterangan');
			$in['kelurahan_id'] = $this->input->post('kelurahan');
			$in['marker-color'] = "#99FF00";
			$in['marker-size'] = "medium";
			$in['description'] = $this->input->post('keterangan');
			$in['marker-symbol'] = "commercial";
			
			
			$kecamatan = $this->supermodel->getData('kecamatan',array('kecamatan_id'=>$this->input->post('kecamatan')));
			$kelurahan = $this->supermodel->getData('kelurahan',array('kelurahan_id'=>$this->input->post('kelurahan')));	
			
			$keca = $kecamatan->row_array();
			$kelu = $kelurahan->row_array();

			//$in['kecamatan'] = $keca['kecamatan_nama'];
			//$in['kelurahan'] = $kelu['kelurahan_nama'];
			$in['icon_map'] = "icon-kehati.png";
			if($_FILES['foto']['name']) {
				$ext = end(explode(".", $_FILES['foto']['name']));
				$rand = rand(000,999);
				$name = "kehati-".$rand.'.'.$ext;
				$unggah = $this->supermodel->unggah_gambar('ragamdata/Konservasi/kehati/','foto',$name,true);
				if($unggah===false) {
					$this->session->set_flashdata('error', 'Upload gagal!!');
					redirect('adm_kehati/tambah');
				}
				$in['foto'] = $name;
			}
			$this->supermodel->insertData('skp',$in);
			$this->session->set_flashdata('success', 'Penyimpanan data sukses');
			$this->m_global->activities('Menyimpan data Konservasi KEHATI '.$in['nama_lokasi']);
			redirect('adm_kehati/tambah');
		}
		$data['title'] = "Tambah Data Konservasi KEHATI";
		$data['konten'] = 'admin/Konservasi/kehati/tambah';
		$data['kecamatan'] = $this->supermodel->getData('kecamatan');
		$data['icon'] = $this->supermodel->getData('icon');
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function edit($id=null)
	{
		$this->form_validation->set_rules('nama_lokasi','Nama Lokasi','required');
		$this->form_validation->set_rules('tahun_pendataan','Tanggal Pendataan','required');
		if($this->form_validation->run()===TRUE) {
			$id = $this->input->post('id');
			$in['nama_lokasi'] = $this->input->post('nama_lokasi');
			$in['kategori'] = "Kehati";
			$in['lat'] = $this->input->post('lat');
			$in['lng'] = $this->input->post('lng');
			$in['tahun_pendataan'] = $this->input->post('tahun_pendataan');
			$in['marker-color'] = "#99FF00";
			$in['marker-size'] = "medium";
			$in['description'] = $this->input->post('keterangan');
			$in['marker-symbol'] = "commercial";
			
			$kecamatan = $this->supermodel->getData('kecamatan',array('kecamatan_id'=>$this->input->post('kecamatan')));
			$kelurahan = $this->supermodel->getData('kelurahan',array('kelurahan_id'=>$this->input->post('kelurahan')));	
			
			$keca = $kecamatan->row_array();
			$kelu = $kelurahan->row_array();

			//$in['kecamatan'] = $keca['kecamatan_nama'];
			//$in['kelurahan'] = $kelu['kelurahan_nama'];
			$in['kelurahan_id'] = $this->input->post('kelurahan');
			$in['icon_map'] = "icon-kehati.png";
			if($_FILES['foto']['name']) {
				$cek = $this->supermodel->getData('skp',array('skp_id'=>$id))->row();
				if($cek->foto!='') {
					@unlink('./uploads/ragamdata/Konservasi/kehati/'.$cek->foto);
					@unlink('./uploads/ragamdata/Konservasi/kehati/thumb/'.$cek->foto);
				}
				$ext = end(explode(".", $_FILES['foto']['name']));
				$rand = rand(000,999);
				$name = "kehati-".$rand.'.'.$ext;
				$unggah = $this->supermodel->unggah_gambar('ragamdata/Konservasi/kehati/','foto',$name,true);
				if($unggah===false) {
					$this->session->set_flashdata('error', 'Upload gagal!!');
					redirect('adm_kehati/tambah');
				}
				$in['foto'] = $name;
			}
			$this->supermodel->updateData('skp',$in,'skp_id',$id);
			$this->session->set_flashdata('success', 'Perubahan data sukses');
			$this->m_global->activities('Menyimpan data Konservasi KEHATI '.$in['nama_lokasi']);
			redirect('adm_kehati/edit/'.$id);
		}
		$data['title'] = "Edit Data Konservasi KEHATI";
		$data['konten'] = 'admin/konservasi/Kehati/edit';
		$data['kecamatan'] = $this->supermodel->getData('kecamatan');
		$data['icon'] = $this->supermodel->getData('icon');
		$data['item'] = $this->supermodel->getData('skp',array('skp_id'=>$id))->row_array();
		$data['kelurahan'] = $this->supermodel->getData('kelurahan', array('kelurahan_id'=>$data['item']['kelurahan_id']))->row_array();
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function cetak()
	{
		$data['filename'] = 'Kehati';
		$kategori = 'Kehati';
		$data['judul'] = 'Data Kelurahan Keanekaragaman Hayati';
		$tgl1 = $this->input->get('tgl1');
		$tgl2 = $this->input->get('tgl2');
		if($tgl1=='')
		{
			$data['listview'] = $this->supermodel->getData('skp',array('kategori'=>$kategori),'tahun_pendataan','asc');
		}
		else
		{
			$data['listview'] = $this->db->query("select * from skp where kategori='Kehati' and tahun_pendataan between '$tgl1' and '$tgl2'");
		}
		
		$this->load->view('cetak/cetak_skp', $data);
	}

	function cari()
	{
		$data['title'] = "Data Konservasi KEHATI";
		$data['konten'] = 'admin/Konservasi/kehati/index';
		$link = 'Adm_kehati/index/';
		$limit= 10;
		$uri_segment= 3;
		$offset= $this->uri->segment($uri_segment);
		$jum = $this->supermodel->getData('skp');
		$tgl1 = $this->input->post('tahun_pengujian1');
		$tgl2 = $this->input->post('tahun_pengujian2');
		$data['tgl1'] = $tgl1;
		$data['tgl2'] = $tgl2;
		//$data['listview'] = $this->db->query("select * from skp where tahun_pengamatan between '$tgl1' and '$tgl2'");
		$data['listview'] = $this->db->query("select * from skp where kategori='Kehati' and tahun_pendataan between '$tgl1' and '$tgl2'");
		$this->supermodel->paging($link,$jum,$limit,$uri_segment);
		$data['offset'] = $offset;
		$this->load->vars($data);
		$this->load->view('admin/template');
	}
}
?>
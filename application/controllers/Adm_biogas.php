<?php
/**
* Author Tri Wanda
* Edit By: rizki Maulana
*/
class Adm_biogas extends CI_Controller
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
		$data['title'] = "Data Upaya Pembangunan Biogas";
		$data['konten'] = 'admin/biogas/index';
		$link = 'adm_biogas/index/';
		$limit= 10;
		$uri_segment= 3;
		$offset= $this->uri->segment($uri_segment);
		$jum = $this->supermodel->getData('biogas');
		$data['listview'] = $this->supermodel->getData('biogas',$field='', $order='tahun_pembuatan', $dasc='DESC', $limit, $offset);
		$this->supermodel->paging($link,$jum,$limit,$uri_segment);
		$data['offset'] = $offset;
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function tambah()
	{
	
		$this->form_validation->set_rules('nama_kepemilikan','Nama Kepemilikan','required');
		$this->form_validation->set_rules('tahun_pembuatan','Tahun Pembuatan','required');
		
		if($this->form_validation->run()===TRUE) {
			$in['nama_pemilik'] = $this->input->post('nama_kepemilikan');
			$in['umur'] = $this->input->post('umur');
			$in['tahun_pembuatan'] = $this->input->post('tahun_pembuatan');
			$in['sumber_energi'] = $this->input->post('sumber_energi');
			
			$in['lat'] = $this->input->post('lat');
			$in['lng'] = $this->input->post('lng');
			$in['kelurahan_id'] = $this->input->post('kelurahan');

			//$in['kecamatan'] = $this->input->post('kecamatan');
			
			//$in['marker-symbol'] = $this->input->post('marker-symbol');
			$in['marker-color'] = "#228B22";
			$in['marker-size'] = "medium";
			$in['description'] = $this->input->post('keterangan');
			$in['marker-symbol'] = "fire-station";
			//$in['kelurahan_nama'] = $this->input->post('kelurahan_nama');
			//$in['kecamatan_nama'] = $this->input->post('kecamatan_nama');	
			$kecamatan = $this->supermodel->getData('kecamatan',array('kecamatan_id'=>$this->input->post('kecamatan')));
			$kelurahan = $this->supermodel->getData('kelurahan',array('kelurahan_id'=>$this->input->post('kelurahan')));	
			
			$keca = $kecamatan->row_array();
			$kelu = $kelurahan->row_array();

		//	$in['kecamatan'] = $keca['kecamatan_nama'];
		//	$in['kelurahan'] = $kelu['kelurahan_nama'];

			$in['kampung'] = $this->input->post('kampung');
			$in['icon_map'] = "icon-biogas.png";
			if($_FILES['foto']['name']) {
				$ext = end(explode(".", $_FILES['foto']['name']));
				$rand = rand(000,999);
				$name = "biogas-".$rand.'.'.$ext;
				$unggah = $this->supermodel->unggah_gambar('ragamdata/upaya_pengendalian/biogas/','foto',$name,true);
				if($unggah===false) {
					$this->session->set_flashdata('error', 'Upload gagal!!');
					redirect('Adm_biogas/tambah');
				}
				$in['foto'] = $name;
			}
			$this->supermodel->insertData('biogas',$in);
			$this->session->set_flashdata('success', 'Penyimpanan data sukses');
			$this->m_global->activities('Menyimpan data upaya pembangunan Biogas '.$in['nama_kepemilikan']);
			redirect('adm_biogas/tambah');
		}
		$data['title'] = "Tambah Data Upaya Pembangunan Biogas";
		$data['konten'] = 'admin/biogas/tambah';
		$data['kecamatan'] = $this->supermodel->getData('kecamatan');
		
		$data['icon'] = $this->supermodel->getData('icon');
		
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function edit($id=null)
	{
		$this->form_validation->set_rules('nama_kepemilikan','Nama Kepemilikan','required');
		$this->form_validation->set_rules('tahun_pembuatan','Tahun Pembuatan','required');
		
		if($this->form_validation->run()===TRUE) {
			$id = $this->input->post('id');
			$in['nama_pemilik'] = $this->input->post('nama_kepemilikan');
			$in['umur'] = $this->input->post('umur');
			$in['tahun_pembuatan'] = $this->input->post('tahun_pembuatan');
			$in['sumber_energi'] = $this->input->post('sumber_energi');
			
			$in['lat'] = $this->input->post('lat');
			$in['lng'] = $this->input->post('lng');
			$in['kelurahan_id'] = $this->input->post('kelurahan');
			
			$in['marker-color'] = "#228B22";
			$in['marker-size'] = "medium";
			$in['description'] = $this->input->post('keterangan');
			$in['marker-symbol'] = "fire-station";
			$kecamatan = $this->supermodel->getData('kecamatan',array('kecamatan_id'=>$this->input->post('kecamatan')));
			$kelurahan = $this->supermodel->getData('kelurahan',array('kelurahan_id'=>$this->input->post('kelurahan')));	
			
			$keca = $kecamatan->row_array();
			$kelu = $kelurahan->row_array();

			//$in['kecamatan'] = $keca['kecamatan_nama'];
			//$in['kelurahan'] = $kelu['kelurahan_nama'];
			
			//$in['kelurahan_nama'] = $this->input->post('kelurahan_nama');
			//$in['kecamatan_nama'] = $this->input->post('kecamatan_nama');				
			
			
			$in['kampung'] = $this->input->post('kampung');
			$in['icon_map'] = "icon-biogas.png";
			if($_FILES['foto']['name']) {
				$cek = $this->supermodel->getData('biogas',array('biogas_id'=>$id))->row();
				if($cek->foto!='') {
					@unlink('./uploads/ragamdata/upaya_pengendalian/biogas/'.$cek->foto);
					@unlink('./uploads/ragamdata/upaya_pengendalian/biogas/thumb/'.$cek->foto);
				}
				$ext = end(explode(".", $_FILES['foto']['name']));
				$rand = rand(000,999);
				$name = "b3-".$rand.'.'.$ext;
				$unggah = $this->supermodel->unggah_gambar('ragamdata/upaya_pengendalian/biogas/','foto',$name,true);
				if($unggah===false) {
					$this->session->set_flashdata('error', 'Upload gagal!!');
					redirect('adm_biogas/tambah');
				}
				$in['foto'] = $name;
			}
			$this->supermodel->updateData('biogas',$in,'biogas_id',$id);
			$this->session->set_flashdata('success', 'Perubahan data sukses');
			$this->m_global->activities('Menyimpan data upaya Pembangunan Biogas '.$in['nama_kepemilikan']);
			redirect('Adm_biogas/edit/'.$id);
		}
		$data['title'] = "Edit Data Pengendalian Limbah B3";
		$data['konten'] = 'admin/biogas/edit';
		$data['kecamatan'] = $this->supermodel->getData('kecamatan');
		
		$data['icon'] = $this->supermodel->getData('icon');
		
		$data['item'] = $this->supermodel->getData('biogas',array('biogas_id'=>$id))->row_array();
		
		$data['kelurahan'] = $this->supermodel->getData('kelurahan', array('kelurahan_id'=>$data['item']['kelurahan_id']))->row_array();
		//$data['icon'] = $this->supermodel->getData('icon', array('id_icon'=>$data['icon1']['id_icon']))->row_array();
		$this->load->vars($data);
		$this->load->view('admin/template');
	}
}
?>

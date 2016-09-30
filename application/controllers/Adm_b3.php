<?php
/**
* Author Tri Wanda
*/
class Adm_b3 extends CI_Controller
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
		$data['title'] = "Data Upaya Pengendalian Limbah B3";
		$data['konten'] = 'admin/b3/index';
		$link = 'adm_b3/index/';
		$limit= 10;
		$uri_segment= 3;
		$offset= $this->uri->segment($uri_segment);
		$jum = $this->supermodel->getData('izin_btiga');
		$data['listview'] = $this->supermodel->getData('izin_btiga',$field='', $order='tgl_terbitizin', $dasc='DESC', $limit, $offset);
		$this->supermodel->paging($link,$jum,$limit,$uri_segment);
		$data['offset'] = $offset;
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function tambah()
	{
		$this->form_validation->set_rules('nama_kegiatan','Nama Kegiatan','required');
		$this->form_validation->set_rules('tgl_terbitizin','Tanggal Terbit Izin','required');
		$this->form_validation->set_rules('jenis_kegiatan','Jenis Kegiatan','required');
		$this->form_validation->set_rules('no_izin','No Izin','required');
		//$this->form_validation->set_rules('kelurahan_id','kelurahan','required');
		$this->form_validation->set_rules('alamat','Alamat','required');
		if($this->form_validation->run()===TRUE) {
			$in['jenis_kegiatan'] = $this->input->post('jenis_kegiatan');
			$in['nama_kegiatan'] = $this->input->post('nama_kegiatan');
			$in['tgl_terbitizin'] = $this->input->post('tgl_terbitizin');
			$in['pimpinan'] = $this->input->post('pimpinan');
			$in['status'] = $this->input->post('status');
			$in['kontak'] = $this->input->post('kontak');
			$in['telepon'] = $this->input->post('telepon');
			$in['no_izin'] = $this->input->post('no_izin');
			$in['masa_berlaku'] = $this->input->post('masa_berlaku');
			$in['lat'] = $this->input->post('lat');
			$in['lng'] = $this->input->post('lng');
			$in['kelurahan_id'] = $this->input->post('kelurahan');
			$in['alamat'] = $this->input->post('alamat');
			$in['icon_map'] = "icon-b3.png";
			
			$in['marker-color'] = "#ff3333";
			$in['marker-size'] = "medium";
			$in['description'] = $this->input->post('keterangan');
			$in['marker-symbol'] = "danger";
			//$in['kelurahan_nama'] = $this->input->post('kelurahan_nama');
			//$in['kecamatan_nama'] = $this->input->post('kecamatan_nama');	
			$kecamatan = $this->supermodel->getData('kecamatan',array('kecamatan_id'=>$this->input->post('kecamatan')));
			$kelurahan = $this->supermodel->getData('kelurahan',array('kelurahan_id'=>$this->input->post('kelurahan')));	
			
			$keca = $kecamatan->row_array();
			$kelu = $kelurahan->row_array();

			//$in['kecamatan'] = $keca['kecamatan_nama'];
			//$in['kelurahan'] = $kelu['kelurahan_nama'];
			

			$this->supermodel->insertData('izin_btiga',$in);
			$this->session->set_flashdata('success', 'Penyimpanan data sukses');
			$this->m_global->activities('Menyimpan data upaya pengendalian Limbah B3 '.$in['nama_kegiatan']);
			redirect('adm_b3/tambah');
		}
		$data['title'] = "Tambah Data Upaya Pengendalian Limbah B3";
		$data['konten'] = 'admin/b3/tambah';
		$data['icon'] = $this->supermodel->getData('icon');
		$data['kecamatan'] = $this->supermodel->getData('kecamatan');
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function edit($id=null)
	{
		$this->form_validation->set_rules('nama_kegiatan','Nama Kegiatan','required');
		$this->form_validation->set_rules('tgl_terbitizin','Tanggal Terbit Izin','required');
		$this->form_validation->set_rules('jenis_kegiatan','Jenis Kegiatan','required');
		$this->form_validation->set_rules('no_izin','No Izin','required');
		$this->form_validation->set_rules('alamat','alamat','required');
		if($this->form_validation->run()===TRUE) {
			$id = $this->input->post('id');
			$in['jenis_kegiatan'] = $this->input->post('jenis_kegiatan');
			$in['nama_kegiatan'] = $this->input->post('nama_kegiatan');
			$in['tgl_terbitizin'] = $this->input->post('tgl_terbitizin');
			$in['pimpinan'] = $this->input->post('pimpinan');
			$in['status'] = $this->input->post('status');
			$in['kontak'] = $this->input->post('kontak');
			$in['telepon'] = $this->input->post('telepon');
			$in['no_izin'] = $this->input->post('no_izin');
			$in['masa_berlaku'] = $this->input->post('masa_berlaku');
			$in['lat'] = $this->input->post('lat');
			$in['lng'] = $this->input->post('lng');
			$in['kelurahan_id'] = $this->input->post('kelurahan');
			$in['alamat'] = $this->input->post('alamat');
			$in['icon_map'] = "icon-b3.png";
			
			$in['marker-color'] = "#ff3333";
			$in['marker-size'] = "medium";
			$in['description'] = $this->input->post('keterangan');
			$in['marker-symbol'] = "danger";
			$kecamatan = $this->supermodel->getData('kecamatan',array('kecamatan_id'=>$this->input->post('kecamatan')));
			$kelurahan = $this->supermodel->getData('kelurahan',array('kelurahan_id'=>$this->input->post('kelurahan')));	
			
			$keca = $kecamatan->row_array();
			$kelu = $kelurahan->row_array();

			//$in['kecamatan'] = $keca['kecamatan_nama'];
			//$in['kelurahan'] = $kelu['kelurahan_nama'];
			

			$this->supermodel->updateData('izin_btiga',$in,'izin_btiga_id',$id);
			$this->session->set_flashdata('success', 'Perubahan data sukses');
			$this->m_global->activities('Menyimpan data upaya pengendalian limbah B3 '.$in['nama_kegiatan']);
			redirect('adm_b3/edit/'.$id);
		}
		$data['title'] = "Edit Data Pengendalian Limbah B3";
		$data['konten'] = 'admin/b3/edit';
		$data['kecamatan'] = $this->supermodel->getData('kecamatan');
		$data['icon'] = $this->supermodel->getData('icon');
		$data['item'] = $this->supermodel->getData('izin_btiga',array('izin_btiga_id'=>$id))->row_array();
		$data['kelurahan'] = $this->supermodel->getData('kelurahan', array('kelurahan_id'=>$data['item']['kelurahan_id']))->row_array();
		$this->load->vars($data);
		$this->load->view('admin/template');
	}
}
?>
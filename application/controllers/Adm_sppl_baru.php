<?php
/**
* Author Tri Wanda
*/
class Adm_sppl_baru extends CI_Controller
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
		$data['title'] = "Data SPPL";
		$data['konten'] = 'admin/perizinan/sppl/index';
		$link = 'adm_sppl/index/';
		$limit= 10;
		$uri_segment= 3;
		$offset= $this->uri->segment($uri_segment);
		$jum = $this->supermodel->getData('sppl');
		$data['listview'] = $this->supermodel->getData('sppl',$field='', $order='sppl_id', $dasc='DESC', $limit, $offset);
		$this->supermodel->paging($link,$jum,$limit,$uri_segment);
		$data['offset'] = $offset;
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function tambah()
	{
		$this->form_validation->set_rules('tgl_sppl','tgl_sppl','required');
		$this->form_validation->set_rules('nomor_sppl','nomor_sppl','required');
		$this->form_validation->set_rules('tahun','tahun','required');
		$this->form_validation->set_rules('jenis_kegiatanusaha','jenis_kegiatanusaha','required');
		$this->form_validation->set_rules('kelurahan','kelurahan','required');
		$this->form_validation->set_rules('alamat_usaha','alamat_usaha','required');
		$this->form_validation->set_rules('nama_pemilik','nama_pemilik','required');
		$this->form_validation->set_rules('alamat_pemilik','alamat_pemilik','required');
		
		if($this->form_validation->run()===TRUE) {
			$in['tgl_sppl'] = $this->input->post('tgl_sppl');
			$in['nomor_sppl'] = $this->input->post('nomor_sppl');
			$in['tahun'] = $this->input->post('tahun');
			$in['jenis_kegiatanusaha'] = $this->input->post('jenis_kegiatanusaha');
			$in['kelurahan_id'] = $this->input->post('kelurahan');
			$in['alamat_usaha'] = $this->input->post('alamat_usaha');
			$in['nama_pemilik'] = $this->input->post('nama_pemilik');
			$in['alamat_pemilik'] = $this->input->post('alamat_pemilik');
			
			$this->supermodel->insertData('sppl',$in);
			$this->session->set_flashdata('success', 'Penyimpanan data sukses');
			$this->m_global->activities('Menyimpan data SPPL '.$in['jenis_kegiatanusaha']);
			redirect('adm_sppl_baru/tambah');
		}
		$data['title'] = "Tambah Data SPPL";
		$data['konten'] = 'admin/perizinan/sppl/tambah';
		$data['kecamatan'] = $this->supermodel->getData('kecamatan');
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function edit($id=null)
	{
		$this->form_validation->set_rules('tgl_sppl','tgl_sppl','required');
		$this->form_validation->set_rules('nomor_sppl','nomor_sppl','required');
		$this->form_validation->set_rules('tahun','tahun','required');
		$this->form_validation->set_rules('jenis_kegiatanusaha','jenis_kegiatanusaha','required');
		$this->form_validation->set_rules('kelurahan','kelurahan','required');
		$this->form_validation->set_rules('alamat_usaha','alamat_usaha','required');
		$this->form_validation->set_rules('nama_pemilik','nama_pemilik','required');
		$this->form_validation->set_rules('alamat_pemilik','alamat_pemilik','required');

		if($this->form_validation->run()===TRUE) {
			$id = $this->input->post('id');
			$in['tgl_sppl'] = $this->input->post('tgl_sppl');
			$in['nomor_sppl'] = $this->input->post('nomor_sppl');
			$in['tahun'] = $this->input->post('tahun');
			$in['jenis_kegiatanusaha'] = $this->input->post('jenis_kegiatanusaha');
			$in['kelurahan_id'] = $this->input->post('kelurahan');
			$in['alamat_usaha'] = $this->input->post('alamat_usaha');
			$in['nama_pemilik'] = $this->input->post('nama_pemilik');
			$in['alamat_pemilik'] = $this->input->post('alamat_pemilik');

			$this->supermodel->updateData('sppl',$in,'sppl_id',$id);
			$this->session->set_flashdata('success', 'Perubahan data sukses');
			$this->m_global->activities('Merubah data SPPL '.$in['jenis_kegiatanusaha']);
			redirect('adm_sppl_baru/edit/'.$id);
		}
		$data['title'] = "Edit Data SPPL";
		$data['konten'] = 'admin/perizinan/sppl/edit';
		$data['kecamatan'] = $this->supermodel->getData('kecamatan');
		$data['item'] = $this->supermodel->getData('sppl',array('sppl_id'=>$id))->row_array();
		$data['kelurahan'] = $this->supermodel->getData('kelurahan', array('kelurahan_id'=>$data['item']['kelurahan_id']))->row_array();

		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	
}
?>
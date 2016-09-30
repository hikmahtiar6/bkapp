<?php
/**
* Author Tri Wanda
*/
class Adm_sppl extends CI_Controller
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
		$data['konten'] = 'admin/perizinan/sppl/index_lama';
		$link = 'adm_sppl/index_lama/';
		$limit= 10;
		$uri_segment= 3;
		$offset= $this->uri->segment($uri_segment);
		$jum = $this->supermodel->getData('sppl_lama');
		$data['listview'] = $this->supermodel->getData('sppl_lama',$field='', $order='sppl_lama_id', $dasc='DESC', $limit, $offset);
		$this->supermodel->paging($link,$jum,$limit,$uri_segment);
		$data['offset'] = $offset;
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function tambah()
	{
		//$this->form_validation->set_rules('nama','Nama','required');
		//$this->form_validation->set_rules('jabatan','Jabatan','required');
		$this->form_validation->set_rules('nama_perusahaan','Nama Perusahaan','required');
		//$this->form_validation->set_rules('alamat','Alamat','required');
		//$this->form_validation->set_rules('alamat_perusahaan','Alamat Perusahaan','required');
		if($this->form_validation->run()===TRUE) {
			$in['nama'] = $this->input->post('nama');
			$in['jabatan'] = $this->input->post('jabatan');
			$in['alamat'] = $this->input->post('alamat');
			$in['no_telp'] = $this->input->post('no_telp');
			$in['nama_perusahaan'] = $this->input->post('nama_perusahaan');
			$in['alamat_perusahaan'] = $this->input->post('alamat_perusahaan');
			$in['no_telp_perusahaan'] = $this->input->post('no_telp_perusahaan');
			$in['jenis_sifat'] = $this->input->post('jenis_usaha');
			$in['kapasitas_produksi'] = $this->input->post('kapasitas_produksi');
			$in['luas_lahan'] = $this->input->post('luas_lahan');
			$in['kondisi_lahan'] = $this->input->post('kondisi_lahan');
			$in['tanggal'] = $this->input->post('tanggal');
			
			$this->supermodel->insertData('sppl_lama',$in);
			$this->session->set_flashdata('success', 'Penyimpanan data sukses');
			$this->m_global->activities('Menyimpan data SPPL '.$in['nama_perusahaan']);
			redirect('adm_sppl/tambah');
		}
		$data['title'] = "Tambah Data SPPL";
		$data['konten'] = 'admin/perizinan/sppl/tambah_lama';
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function edit($id=null)
	{
		//$this->form_validation->set_rules('nama','Nama','required');
		//$this->form_validation->set_rules('jabatan','Jabatan','required');
		$this->form_validation->set_rules('nama_perusahaan','Nama Perusahaan','required');
		//$this->form_validation->set_rules('alamat','Alamat','required');
		//$this->form_validation->set_rules('alamat_perusahaan','Alamat Perusahaan','required');
		if($this->form_validation->run()===TRUE) {
			$id = $this->input->post('id');
			$in['nama'] = $this->input->post('nama');
			$in['jabatan'] = $this->input->post('jabatan');
			$in['alamat'] = $this->input->post('alamat');
			$in['no_telp'] = $this->input->post('no_telp');
			$in['nama_perusahaan'] = $this->input->post('nama_perusahaan');
			$in['alamat_perusahaan'] = $this->input->post('alamat_perusahaan');
			$in['no_telp_perusahaan'] = $this->input->post('no_telp_perusahaan');
			$in['jenis_sifat'] = $this->input->post('jenis_usaha');
			$in['kapasitas_produksi'] = $this->input->post('kapasitas_produksi');
			$in['luas_lahan'] = $this->input->post('luas_lahan');
			$in['kondisi_lahan'] = $this->input->post('kondisi_lahan');
			$in['tanggal'] = $this->input->post('tanggal');
			$in['status'] = "$this->input->post('status')";
			$this->supermodel->updateData('sppl_lama',$in,'sppl_lama_id',$id);
			$this->session->set_flashdata('success', 'Perubahan data sukses');
			$this->m_global->activities('Merubah data SPPL '.$in['nama_perusahaan']);
			redirect('adm_sppl/edit/'.$id);
		}
		$data['title'] = "Edit Data SPPL";
		$data['konten'] = 'admin/perizinan/sppl/edit_lama';
		$data['kecamatan'] = $this->supermodel->getData('kecamatan');
		$data['item'] = $this->supermodel->getData('sppl_lama',array('sppl_lama_id'=>$id))->row_array();
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function approve($id=null)
	{
		if($id=null)
		{
			$this->session->set_flashdata('Error','Tidak Berhasil Menghapus Data');
			redirect('adm_sppl/index');
		}
		else
		{
			$aye = $this->supermodel->getData('sppl_lama')->row_array();
			$in['status'] = '1';
			$dltuser = $this->supermodel->updateData('sppl_lama',$in,'sppl_lama_id',$aye['sppl_lama_id']);
			$this->session->set_flashdata('success', 'Status Permohonan Telah Dirubah');
			redirect('adm_sppl/index');
		}
	}
}
?>
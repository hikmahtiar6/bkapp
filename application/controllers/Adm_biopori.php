<?php
/**
* Author Tri Wanda
*/
class Adm_biopori extends CI_Controller
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
		$data['title'] = "Data Konservasi Biopori";
		$data['konten'] = 'admin/Konservasi/biopori/index';
		$link = 'adm_biopori/Konservasi/biopori/';
		$limit= 10;
		$uri_segment= 3;
		$offset= $this->uri->segment($uri_segment);
		$jum = $this->supermodel->getData('biopori');
		$data['listview'] = $this->supermodel->getData('biopori', $field='', $order='tahun_pendataan', $dasc='DESC', $limit, $offset);
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
			$in['jumlah'] = $this->input->post('jumlah');
			$in['tahun_pendataan'] = $this->input->post('tahun_pendataan');
			$in['keterangan'] = $this->input->post('keterangan');
			$in['kelurahan_id'] = $this->input->post('kelurahan');
			if($_FILES['foto']['name']) {
				$ext = end(explode(".", $_FILES['foto']['name']));
				$rand = rand(000,999);
				$name = "biopori-".$rand.'.'.$ext;
				$unggah = $this->supermodel->unggah_gambar('ragamdata/Konservasi/biopori/','foto',$name,true);
				if($unggah===false) {
					$this->session->set_flashdata('error', 'Upload gagal!!');
					redirect('adm_biopori/tambah');
				}
				$in['foto'] = $name;
			}
			$this->supermodel->insertData('biopori',$in);
			$this->session->set_flashdata('success', 'Penyimpanan data sukses');
			$this->m_global->activities('Menyimpan data Konservasi Biopori '.$in['nama_lokasi']);
			redirect('adm_biopori/tambah');
		}
		$data['title'] = "Tambah Data Konservasi Biopori";
		$data['konten'] = 'admin/Konservasi/biopori/tambah';
		$data['kecamatan'] = $this->supermodel->getData('kecamatan');
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
			$in['jumlah'] = $this->input->post('jumlah');
			$in['tahun_pendataan'] = $this->input->post('tahun_pendataan');
			$in['keterangan'] = $this->input->post('keterangan');
			$in['kelurahan_id'] = $this->input->post('kelurahan');
			if($_FILES['foto']['name']) {
				$cek = $this->supermodel->getData('biopori',array('biopori_id'=>$id))->row();
				if($cek->foto!='') {
					@unlink('./uploads/ragamdata/konservasi/biopori/'.$cek->foto);
					@unlink('./uploads/ragamdata/konservasi/biopori/thumb/'.$cek->foto);
				}
				$ext = end(explode(".", $_FILES['foto']['name']));
				$rand = rand(000,999);
				$name = "biopori-".$rand.'.'.$ext;
				$unggah = $this->supermodel->unggah_gambar('ragamdata/konservasi/biopori/','foto',$name,true);
				if($unggah===false) {
					$this->session->set_flashdata('error', 'Upload gagal!!');
					redirect('adm_biopori/tambah');
				}
				$in['foto'] = $name;
			}
			$this->supermodel->updateData('biopori',$in,'biopori_id',$id);
			$this->session->set_flashdata('success', 'Perubahan data sukses');
			$this->m_global->activities('Menyimpan data Konservasi Biopori '.$in['nama_lokasi']);
			redirect('adm_biopori/edit/'.$id);
		}
		$data['title'] = "Edit Data Konservasi Biopori";
		$data['konten'] = 'admin/konservasi/biopori/edit';
		$data['kecamatan'] = $this->supermodel->getData('kecamatan');
		$data['item'] = $this->supermodel->getData('biopori',array('biopori_id'=>$id))->row_array();
		$data['kelurahan'] = $this->supermodel->getData('kelurahan', array('kelurahan_id'=>$data['item']['kelurahan_id']))->row_array();
		$this->load->vars($data);
		$this->load->view('admin/template');
	}
}
?>
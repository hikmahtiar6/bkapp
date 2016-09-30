<?php
/**
* Author Tri Wanda
*/
class Adm_galeri extends CI_Controller
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
		$data['title'] = "Galeri";
		$data['konten'] = 'admin/galeri/index';
		$link = 'adm_galeri/index/';
		$limit= 10;
		$uri_segment= 3;
		$offset= $this->uri->segment($uri_segment);
		$data['list'] = $this->supermodel->getData('album');
		$jum = $this->supermodel->getData('galeri');
		$data['listview'] = $this->supermodel->getData('galeri',$field='', $order='upload_date', $dasc='DESC');
		$this->supermodel->paging($link,$jum,$limit,$uri_segment);
		$data['offset'] = $offset;
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function tambah()
	{
		$this->form_validation->set_rules('galeri_title','Judul Foto','required');
		//$this->form_validation->set_rules('tahun_pembuatan','Tahun Pembuatan','required');
		//$this->form_validation->set_rules('hasil_pengawasan','Hasil Pengawasan','required');
		//$this->form_validation->set_rules('kelurahan_id','kelurahan','required');
		//$this->form_validation->set_rules('alamat','alamat','required');
		if($this->form_validation->run()===TRUE) {
			$in['galeri_title'] = $this->input->post('galeri_title');
			$in['album_id'] = $this->input->post('parent');
			$in['description'] = $this->input->post('description');
			$in['image'] = $this->input->post('youtube');
			$in['tipe'] = $this->input->post('type');
			$in['upload_date'] = date("Y-m-d");
			if($_FILES['image']['name']) 
			{
				$cek = $this->supermodel->getData('galeri',array('galeri_id'=>$id))->row();
				if($cek->image!='') {
					@unlink('./uploads/galeri/'.$cek->image);
					@unlink('./uploads/galeri/thumb/'.$cek->image);
				}
				$ext = end(explode(".", $_FILES['image']['name']));
				$rand = rand(000,999);
				$name = date("Ymd").$rand.'.'.$ext;
				$unggah = $this->supermodel->unggah_gambar('galeri/','image',$name,true);
				if($unggah===false) {
					$this->session->set_flashdata('error', 'Upload gagal!!');
					redirect('album_galeri/foto?album_id='.$album_id);
				}
				$in['image'] = $name;
			}
			$this->supermodel->insertData('galeri',$in);
			$this->session->set_flashdata('success', 'Penyimpanan data sukses');
			$this->m_global->activities('Menyimpan Galeri Foto '.$in['galeri_title']);
			redirect('adm_galeri');
		}
		$data['title'] = "Tambah Galeri";
		$data['konten'] = 'admin/galeri/index';
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function edit($id=null)
	{
		$this->form_validation->set_rules('galeri_title','Judul Foto','required');
		//$this->form_validation->set_rules('tahun_pembuatan','Tahun Pembuatan','required');
		//$this->form_validation->set_rules('kelurahan_id','kelurahan','required');
		//$this->form_validation->set_rules('alamat','alamat','required');
		if($this->form_validation->run()===TRUE) {
			$id = $this->input->post('id');
			$in['galeri_title'] = $this->input->post('galeri_title');
			$in['album_id'] = $this->input->post('parent');
			$in['description'] = $this->input->post('description');
			//$in['image'] = $this->input->post('youtube');
			$in['tipe'] = $this->input->post('type');
			$in['upload_date'] = date("Y-m-d");
			if($in['tipe']=='Foto')
			{
				if($_FILES['image']['name']) 
				{	
				$cek = $this->supermodel->getData('galeri',array('galeri_id'=>$id))->row();
				if($cek->image!='') {
					@unlink('./uploads/galeri/'.$cek->image);
					@unlink('./uploads/galeri/thumb/'.$cek->image);
				}
				$ext = end(explode(".", $_FILES['image']['name']));
				$rand = rand(000,999);
				$name = date("Ymd").$rand.'.'.$ext;
				$unggah = $this->supermodel->unggah_gambar('galeri/','image',$name,true);
				if($unggah===false) {
					$this->session->set_flashdata('error', 'Upload gagal!!');
					redirect('adm_galeri/edit/'.$id);
				}
				$in['image'] = $name;
				}

			}
			else{
				$in['image'] = $this->input->post('youtube');
			}
			$this->supermodel->updateData('galeri',$in,'galeri_id',$id);
			$this->session->set_flashdata('success', 'Update data sukses');
			$this->m_global->activities('Mengubah Galeri '.$in['galeri_title']);
			redirect('adm_galeri');
		}
		$data['title'] = "Edit Galeri";
		$data['konten'] = 'admin/galeri/edit';
		$data['item'] = $this->supermodel->getData('galeri',array('galeri_id'=>$id))->row_array();
		$data['listview'] = $this->supermodel->getData('album');
		$this->load->vars($data);
		$this->load->view('admin/template');
	}
}
?>
<?php
/**
* Author Imam Teguh
* Juni 2015
* album_galeri.php
*/
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Album_galeri extends CI_Controller
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

	function index($id=null)
	{
		$data['row'] = array('album_id'=>'','album_title'=>'','parent'=>'');
		$data['title'] = "Albums";
		$data['konten'] = 'admin/album_galeri/album';
		if($id!=null) {
			$data['row'] = $this->supermodel->getData('album',array('album_id'=>$id))->row_array();
		}
		$this->form_validation->set_rules('album_title','album title', 'required');
		if($this->form_validation->run()===TRUE) {
			$id = $this->input->post('id');
			$in['album_title'] = $this->input->post('album_title');
			$in['parent'] = $this->input->post('parent');

			if($id==null) {
				$this->supermodel->insertData('album',$in);
				$this->session->set_flashdata('success','Simpan data berhasil');
				$this->m_global->activities('Menyimpan album '.$in['album_title']);
			} else {
				$this->supermodel->updateData('album',$in,'album_id',$id);
				$this->session->set_flashdata('success','Update data berhasil');
				$this->m_global->activities('Mengupdate album '.$in['album_title']);
			}
			redirect('album_galeri'); 
		}
		$data['album'] = $this->supermodel->getData('album',array('parent'=>0));
		$data['listview'] = $this->supermodel->getData('album');
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function foto() {
		$data['row'] = array('album_id'=>'','galeri_id'=>'','galeri_title'=>'','image'=>'','description'=>'','upload_date'=>'');
		$data['title'] = "Galeri";
		$data['konten'] = 'admin/album_galeri/foto';
		$this->form_validation->set_rules('galeri_title','judul foto', 'required');
		//$this->form_validation->set_rules('image','foto', 'required');
		if($this->form_validation->run()===TRUE) {
			$id = $this->input->post('id');
			$in['galeri_title'] = $this->input->post('galeri_title');
			$in['album_id'] = $this->input->post('album_id');
			$in['description'] = $this->input->post('description');
			$in['upload_date'] = date("Y-m-d");
			if($_FILES['image']['name']) {
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

			if($id==null) {
				$this->supermodel->insertData('galeri',$in);
				$this->session->set_flashdata('success','Simpan data berhasil');
				$this->m_global->activities('Menyimpan galeri foto '.$in['galeri_title']);
			} else {
				$this->supermodel->updateData('galeri',$in,'galeri_id',$id);
				$this->session->set_flashdata('success','Update data berhasil');
				$this->m_global->activities('Mengupdate galeri foto '.$in['galeri_title']);
			}
			redirect('album_galeri/foto?album_id='.$album_id); 
		}
		$data['album'] = $this->supermodel->getData('album')->row_array();
		$data['listview'] = $this->supermodel->getData('galeri');
		$this->load->vars($data);
		$this->load->view('admin/template');
	}
	

}


/* End of file album_galeri.php */
/* Location: ./application/controllers/album_galeri.php */
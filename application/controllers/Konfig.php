<?php
/**
* Author Imam Teguh
* Juni 2015
* konfig.php
*/
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Konfig extends CI_Controller
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
		$id = 1;
		$name = '';
		$this->form_validation->set_rules('name_site','Name Site','required');
		if($this->form_validation->run()===TRUE) {
			$in['name_site'] = $this->input->post('name_site');
			$in['fb_site'] = $this->input->post('fb_site');
			$in['description_site'] = $this->input->post('description_site');
			$in['twitter_site'] = $this->input->post('twitter_site');
			$in['mail_site'] = $this->input->post('mail_site');
			$in['sub_title'] = $this->input->post('sub_title');
			$in['alamat'] = $this->input->post('alamat');
			$in['no_telp'] = $this->input->post('no_telp');
			$in['sambutan'] = $this->input->post('sambutan');
			$in['embed_map'] = $this->input->post('embed_map');
			if($_FILES['icon_site']['name']) {
				$cek = $this->supermodel->getData('webconfig',array('webconfig_id'=>$id))->row();
				if($cek->icon_site!='') {
					@unlink('./uploads/'.$cek->icon_site);
				}
				$ext = end(explode(".", $_FILES['icon_site']['name']));
				$rand = rand(000,999);
				$name = date("Ymd").$rand.'.'.$ext;
				$unggah = $this->supermodel->unggah_gambar('','icon_site',$name);
				if($unggah===false) {
					$this->session->set_flashdata('error', 'Upload gagal!!');
					redirect('adminweb/konfig');
				}
				$in['icon_site'] = $name;
			} 
			$this->supermodel->updateData('webconfig',$in,'webconfig_id',$id);
			$this->m_global->activities('Mengupdate konfigurasi web');
			redirect('konfig');
			
		}
		$data['title'] = "Settings";
		$data['konten'] = 'admin/konfig';
		$data['web'] = $this->supermodel->getData('webconfig',array('webconfig_id'=>$id))->row_array();
		$data['sambutan'] = $this->m_global->getPost(array('type'=>0,'status'=>1));
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

}


/* End of file konfig.php */
/* Location: ./application/controllers/konfig.php */
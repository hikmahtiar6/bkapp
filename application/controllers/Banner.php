<?php
/**
* Author Imam Teguh
* Juni 2015
* banner.php
*/
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Banner extends CI_Controller
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
		$data['row'] = array('banner_id'=>'','banner_file'=>'','link'=>'',
			'position'=>'','status'=>'','title'=>'');
		$data['title'] = "Banner";
		$data['konten'] = 'admin/banner';
		if($id!=null) {
			$data['row'] = $this->supermodel->getData('banner',array('banner_id'=>$id))->row_array();
		}
		$this->form_validation->set_rules('title','title', 'required');
		if($this->form_validation->run()===TRUE) {
			$name = '';
			$id = $this->input->post('id');
			$in['title'] = $this->input->post('title');
			$in['link'] = $this->input->post('link');
			$in['status'] = $this->input->post('status');
			$in['position'] = $this->input->post('position');
			if($_FILES['banner_file']['name']) {
				$cek = $this->supermodel->getData('banner',array('banner_id'=>$id))->row();
				if($cek->banner_file!='') {
					@unlink('./uploads/banner/'.$cek->banner_file);
				}
				$ext = end(explode(".", $_FILES['banner_file']['name']));
				$rand = rand(000,999);
				$name = date("Ymd").$rand.'.'.$ext;
				$unggah = $this->supermodel->unggah_gambar('banner/','banner_file',$name);
				if($unggah===false) {
					$this->session->set_flashdata('error', 'Upload gagal!!');
					redirect('banner');
				}
				$in['banner_file'] = $name;
			} 

			if($id==null) {
				$this->supermodel->insertData('banner',$in);
				$this->session->set_flashdata('success','Simpan data berhasil');
				$this->m_global->activities('Menyimpan banner '.$in['title']);
			} else {
				$this->supermodel->updateData('banner',$in,'banner_id',$id);
				$this->session->set_flashdata('success','Update data berhasil');
				$this->m_global->activities('Mengupdate banner '.$in['title']);
			}
			redirect('banner'); 
		}
		
		$data['sts'] = array('Draft','Publish');
		$data['position'] = posisi_banner();
		$data['listview'] = $this->supermodel->getData('banner');
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

}


/* End of file banner.php */
/* Location: ./application/controllers/banner.php */
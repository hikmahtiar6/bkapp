<?php
/**
* Author Tri Wanda
* Juni 2015
* slide.php
*/
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Slide extends CI_Controller
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
		$data['row'] = array('slide_id'=>'','slide_file'=>'','link'=>'','status'=>'','title'=>'');
		$data['title'] = "Slide";
		$data['konten'] = 'admin/slide';
		if($id!=null) {
			$data['row'] = $this->supermodel->getData('slide',array('slide_id'=>$id))->row_array();
		}
		$this->form_validation->set_rules('link','link', 'required');
		if($this->form_validation->run()===TRUE) {
			$name = '';
			$id = $this->input->post('id');
			$in['link'] = $this->input->post('link');
			$in['status'] = $this->input->post('status');
			if($_FILES['slide_file']['name']) {
				$cek = $this->supermodel->getData('slide',array('slide_id'=>$id))->row();
				if($cek->banner_file!='') {
					@unlink('./uploads/slide/'.$cek->slide_file);
				}
				$ext = end(explode(".", $_FILES['slide_file']['name']));
				$rand = rand(000,999);
				$name = date("Ymd").$rand.'.'.$ext;
				$unggah = $this->supermodel->unggah_gambar('slide/','slide_file',$name);
				if($unggah===false) {
					$this->session->set_flashdata('error', 'Upload gagal!!');
					redirect('slide');
				}
				$in['slide_file'] = $name;
			} 

			if($id==null)
			{
				$this->supermodel->insertData('slide',$in);
				$this->session->set_flashdata('success','Simpan data berhasil');
				$this->m_global->activities('Menyimpan Slider '.$in['title']);
			} 
			else 
			{
				$this->supermodel->updateData('slide',$in,'slide_id',$id);
				$this->session->set_flashdata('success','Update data berhasil');
				$this->m_global->activities('Mengupdate Slider '.$in['title']);
			}
			redirect('slide'); 
		}
		
		$data['sts'] = array('Draft','Publish');
		$data['listview'] = $this->supermodel->getData('slide');
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

}


/* End of file banner.php */
/* Location: ./application/controllers/banner.php */
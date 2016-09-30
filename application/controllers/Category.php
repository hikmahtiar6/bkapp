<?php
/**
* Author Imam Teguh
* Juni 2015
* Category.php
*/
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Category extends CI_Controller
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
		$data['row'] = array('category_id'=>'','category_name'=>'','parent'=>'',
			'sort'=>'','type'=>'','color'=>'');
		$data['title'] = "Kategori";
		$data['konten'] = 'admin/category';
		if($id!=null) {
			$data['row'] = $this->supermodel->getData('category',array('category_id'=>$id))->row_array();
		}
		$this->form_validation->set_rules('category_name','Nama Kategori', 'required');
		if($this->form_validation->run()===TRUE) {
			$id = $this->input->post('id');
			$in['category_name'] = $this->input->post('category_name');
			$in['parent'] = $this->input->post('parent');
			$in['sort'] = $this->input->post('sort');
			$in['type'] = $this->input->post('type');
			$in['color'] = $this->input->post('color');

			if($id==null) {
				$this->supermodel->insertData('category',$in);
				$this->session->set_flashdata('success','Simpan data berhasil');
				$this->m_global->activities('Menyimpan category '.$in['category_name']);
			} else {
				$this->supermodel->updateData('category',$in,'category_id',$id);
				$this->session->set_flashdata('success','Update data berhasil');
				$this->m_global->activities('Mengupdate category '.$in['category_name']);
			}
			redirect('category'); 
		}
		
		$data['type'] = array('static','dinamis','media');
		$data['color'] = color();
		$data['listview'] = $this->supermodel->getData('category');
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

}


/* End of file category.php */
/* Location: ./application/controllers/category.php */
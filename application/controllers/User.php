<?php
/**
* Author Imam Teguh
* Juni 2015
* user.php
*/
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Controller
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
		$data['row'] = array('user_id'=>'','user_name'=>'','username'=>'','level'=>'');
		$data['title'] = "Users";
		$data['konten'] = 'admin/user';
		if($id!=null) {
			$data['row'] = $this->supermodel->getData('user',array('user_id'=>$id))->row_array();
		}
		$this->form_validation->set_rules('user_name','user name', 'required');
		$this->form_validation->set_rules('username','username', 'required');
		$this->form_validation->set_rules('password','password', 'md5');
		if($this->form_validation->run()===TRUE) {
			$id = $this->input->post('id');
			$in['user_name'] = $this->input->post('user_name');
			$in['username'] = $this->input->post('username');
			if($this->input->post('password')) {
				$in['password'] = $this->input->post('password');
			}
			$in['level'] = $this->input->post('level');

			if($id==null) {
				$this->supermodel->insertData('user',$in);
				$this->session->set_flashdata('success','Simpan data berhasil');
				$this->m_global->activities('Menyimpan user '.$in['user_name']);
			} else {
				$this->supermodel->updateData('user',$in,'user_id',$id);
				$this->session->set_flashdata('success','Update data berhasil');
				$this->m_global->activities('Mengupdate user '.$in['user_name']);
			}
			redirect('user'); 
		}
		$data['level'] = array('Superadmin','Operator');
		$data['listview'] = $this->supermodel->getData('user');
		$this->load->vars($data);
		$this->load->view('admin/template');
	}


}


/* End of file user.php */
/* Location: ./application/controllers/user.php */
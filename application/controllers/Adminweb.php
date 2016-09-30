<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Author Imam Teguh
* Date Mei 2015
* Namefile Adminweb.php
*/
class Adminweb extends CI_Controller
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

	function index() { $this->dashboard(); /*redirect('adminweb/dashboard');*/ }

	function dashboard()
	{
		$data['title'] = "Dashboard";
		$data['konten'] = 'admin/dashboard';
		$data['activity'] = $this->m_global->getAct();
		$this->load->vars($data);
		$this->load->view('admin/template');	
	}
	
	function edit_profile()
	{
		$id = $this->session->userdata('userid');
		$this->form_validation->set_rules('user_name','user name', 'required');
		$this->form_validation->set_rules('username','username', 'required');
		$this->form_validation->set_rules('password','password', 'md5');
		if($this->form_validation->run()===TRUE) {
			$in['user_name'] = $this->input->post('user_name');
			$in['username'] = $this->input->post('username');
			if($this->input->post('password')) {
				$in['password'] = $this->input->post('password');
			}
			$in['level'] = $this->input->post('level');
			$this->supermodel->updateData('user',$in,'user_id',$id);
			$this->m_global->activities('Edit profile');
			redirect('adminweb/edit_profile');
			
		}
		$data['title'] = "Edit Profil";
		$data['konten'] = 'admin/edit_profile';
		$data['level'] = array('Superadmin','Operator');
		$data['row'] = $this->supermodel->getData('user',array('user_id'=>$id))->row_array();
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	//load kelurahan dari kecamatan
	function load_kelurahan()
	{
		$id= $this->input->get('id_kec');
		$id_kel = $this->input->get('id_kel');
		$kel = $this->supermodel->getData('kelurahan',array('kecamatan_id'=>$id));
		echo "<option value=''>- Pilih -</option>";
		foreach ($kel->result() as $row) {
			$sel = '';
			if($id_kel==$row->kelurahan_id) {
				$sel = 'selected';
			}
			echo "<option value='".$row->kelurahan_id."' ".$sel.">".$row->kelurahan_nama."</option>";
		}
	}

	// Fungsi Keluar
	function logout() {
		$this->m_global->activities('Logout administrator');
		$this->session->sess_destroy();
		redirect('loginweb');
	}

}

/* End of file adminweb.php */
/* Location: ./application/controllers/adminweb.php */
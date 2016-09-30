<?php
/**
* Author M.Febriansyah
*/
class Dashboard_member extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_global');
		$this->load->model('supermodel');
		 if($this->session->userdata('getLoginAct')==FALSE) {
		 		echo"<script>alert('Anda belum login !!!');document.location.href='".site_url('login_daftar_member/index')."'</script>";
		 }
	}

	function index(){
		$data['konten'] = "izin_lingkungan/dashboard_member";
		$this->load->view('izin_lingkungan/template',$data);
	}


 }
?>
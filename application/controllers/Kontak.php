<?php
/**
* 
*/
class Kontak extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_global');
		$this->load->model('supermodel');
	}

	function index()
	{
		$konfig = $this->m_global->get_konfig();

		$data['banner'] = $this->supermodel->getData('banner',array('status'=>1));
		$data['unduh'] = $this->m_global->getPostAll(array('p.status'=>1,'c.type'=>2),'p.date_publish','desc',6);
		$data['galeri'] = $this->supermodel->getData('galeri',$field='', $order='', $dasc='DESC', $limit='8');

		$data['populer'] = $this->m_global->getPostAll(array('p.status'=>1,'c.type'=>1),'p.view','desc',3);

		$data['konten'] = 'kontak';
		$data['category'] = array('category_id'=>'');
		$data['breadcrumb'] = "Kontak Kami";
		
		$vrs = array_merge($konfig,$data);
		$this->load->vars($vrs);
		$this->load->view('template');
	}
}
?>
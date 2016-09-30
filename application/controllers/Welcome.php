<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_global');
		$this->load->model('supermodel');
	}

	function index()
	{
		$konfig = $this->m_global->get_konfig();

		$data['konten'] = '';
		$data['sambutan'] = $this->supermodel->getData('post',array('post_id'=>$konfig['sambutan']));
		$data['populer'] = $this->m_global->getPostAll(array('p.status'=>1,'c.type'=>1),'p.view','desc',6);
		$data['terbaru'] = $this->m_global->getPostAll(array('p.status'=>1,'c.type'=>1),'p.date_publish','desc',3);
		$data['slide'] = $this->supermodel->getData('slide',array('status'=>1));

		$data['banner'] = $this->supermodel->getData('banner',array('status'=>1));
		$data['unduh'] = $this->m_global->getPostAll(array('p.status'=>1,'c.type'=>2),'p.post_id','desc',6);
		$data['galeri'] = $this->supermodel->getData('galeri',$field='', $order='', $dasc='DESC', $limit='8');
		
		$vrs = array_merge($konfig,$data);
		$this->load->vars($vrs);
		$this->load->view('portal');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
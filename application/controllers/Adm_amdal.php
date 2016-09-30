<?php
/**
* Author Tri Wanda
*/
class Adm_amdal extends CI_Controller
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
		$data['title'] = "Data AMDAL";
		$data['konten'] = 'admin/perizinan/amdal/index';
		$link = 'adm_amdal/index/';
		$limit= 10;
		$uri_segment= 3;
		$offset= $this->uri->segment($uri_segment);
		$jum = $this->supermodel->getData('amdal');
		$data['listview'] = $this->supermodel->getData('amdal',$field='', $order='amdal_id', $dasc='DESC', $limit, $offset);
		$this->supermodel->paging($link,$jum,$limit,$uri_segment);
		$data['offset'] = $offset;
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function tambah()
	{
		$this->form_validation->set_rules('jenis_kegiatanusaha','jenis_kegiatanusaha','required');
		$this->form_validation->set_rules('tahun','tahun','required');
		$this->form_validation->set_rules('kelurahan','kelurahan','required');
		$this->form_validation->set_rules('alamat','Alamat','required');
		
		if($this->form_validation->run()===TRUE) {
			$in['jenis_kegiatanusaha'] = $this->input->post('jenis_kegiatanusaha');
			$in['tahun'] = $this->input->post('tahun');
			$in['kelurahan_id'] = $this->input->post('kelurahan');
			$in['alamat'] = $this->input->post('alamat');
			$in['rekom_kaamdal'] = $this->input->post('rekom_kaamdal');
			$in['rekom_amdal'] = $this->input->post('rekom_amdal');
			$in['keterangan'] = $this->input->post('keterangan');
			
			$this->supermodel->insertData('amdal',$in);
			$this->session->set_flashdata('success', 'Penyimpanan data sukses');
			$this->m_global->activities('Menyimpan data Amdal '.$in['jenis_kegiatanusaha']);
			redirect('adm_amdal/tambah');
		}
		$data['title'] = "Tambah Data AMDAL";
		$data['konten'] = 'admin/perizinan/amdal/tambah';
		$data['kecamatan'] = $this->supermodel->getData('kecamatan');
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function edit($id=null)
	{
		$this->form_validation->set_rules('jenis_kegiatanusaha','jenis_kegiatanusaha','required');
		$this->form_validation->set_rules('tahun','tahun','required');
		//$this->form_validation->set_rules('kelurahan','kelurahan','required');
		//$this->form_validation->set_rules('alamat','Alamat','required');

		if($this->form_validation->run()===TRUE) {
			$id = $this->input->post('id');
			$in['jenis_kegiatanusaha'] = $this->input->post('jenis_kegiatanusaha');
			$in['tahun'] = $this->input->post('tahun');
			$in['kelurahan_id'] = $this->input->post('kelurahan');
			$in['alamat'] = $this->input->post('alamat');
			$in['rekom_kaamdal'] = $this->input->post('rekom_kaamdal');
			$in['rekom_amdal'] = $this->input->post('rekom_amdal');
			$in['keterangan'] = $this->input->post('keterangan');

			$this->supermodel->updateData('amdal',$in,'amdal_id',$id);
			$this->session->set_flashdata('success', 'Perubahan data sukses');
			$this->m_global->activities('Merubah data AMDAL '.$in['jenis_kegiatanusaha']);
			redirect('adm_amdal/edit/'.$id);
		}
		$data['title'] = "Edit Data AMDAL";
		$data['konten'] = 'admin/perizinan/amdal/edit';

		$data['kecamatan'] = $this->supermodel->getData('kecamatan');
		$data['item'] = $this->supermodel->getData('amdal',array('amdal_id'=>$id))->row_array();
		$data['kelurahan'] = $this->supermodel->getData('kelurahan', array('kelurahan_id'=>$data['item']['kelurahan_id']))->row_array();

		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function importdata() {

		$config['upload_path'] = './uploads/dataimport/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '9000';

        $this->load->library('upload', $config);

            $file_data = $this->upload->data();
            $file_path =  './uploads/dataimport/'.$file_data['file_name'];
            
            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
                foreach ($csv_array as $row) {
                    $insert_data = array(
                        'jenis_kegiatanusaha'=>$row['jenis_kegiatanusaha'],
                        'tahun'=>$row['tahun'],
                        'kelurahan_id'=>$row['kelurahan_id'],
                        'alamat'=>$row['alamat'],
                        'rekom_kaamdal'=>$row['rekom_kaamdal'],
                        'rekom_amdal'=>$row['rekom_amdal'],
                        'keterangan'=>$row['keterangan']
                    );
                    $this->supermodel->insertData('amdal', $insert_data);
                }
                echo "<div class='alert alert-info'><button type='button' class='close' data-dismiss='alert' >×</button>Import data berhasil</div>";
                $this->load->view('admin/perizinan/amdal/index', $data);
            } else {
                echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' >×</button>Error, file tidak memenuhi kriteria</div>";
                $this->load->view('admin/perizinan/amdal/index', $data);
            }
        
	}

}
?>
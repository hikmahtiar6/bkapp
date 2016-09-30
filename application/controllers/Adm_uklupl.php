<?php
/**
* Author Tri Wanda
*/
class Adm_uklupl extends CI_Controller
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
		$data['title'] = "Data UKL-UPL";
		$data['konten'] = 'admin/perizinan/ukl-upl/index';
		$link = 'adm_uklupl/index/';
		$limit= 10;
		$uri_segment= 3;
		$offset= $this->uri->segment($uri_segment);
		$jum = $this->supermodel->getData('ukl_upl');
		$data['listview'] = $this->supermodel->getData('ukl_upl',$field='', $order='ukl_upl_id', $dasc='DESC', $limit, $offset);
		$this->supermodel->paging($link,$jum,$limit,$uri_segment);
		$data['offset'] = $offset;
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function tambah()
	{
		$this->form_validation->set_rules('nomor_surat','nomor_surat','required');
		$this->form_validation->set_rules('tgl_surat','tgl_surat','required');
		$this->form_validation->set_rules('tahun','tahun','required');
		$this->form_validation->set_rules('jenis_kegiatanusaha','jenis_kegiatanusaha','required');
		$this->form_validation->set_rules('kelurahan','kelurahan','required');
		$this->form_validation->set_rules('alamat_usaha','alamat_usaha','required');
		$this->form_validation->set_rules('nama_pemilik','nama_pemilik','required');
		$this->form_validation->set_rules('alamat_pemilik','alamat_pemilik','required');

		if($this->form_validation->run()===TRUE) {
			$in['nomor_surat'] = $this->input->post('nomor_surat');
			$in['tgl_surat'] = $this->input->post('tgl_surat');
			$in['tahun'] = $this->input->post('tahun');
			$in['jenis_kegiatanusaha'] = $this->input->post('jenis_kegiatanusaha');
			$in['kelurahan_id'] = $this->input->post('kelurahan');
			$in['alamat_usaha'] = $this->input->post('alamat_usaha');
			$in['nama_pemilik'] = $this->input->post('nama_pemilik');
			$in['alamat_pemilik'] = $this->input->post('alamat_pemilik');
			$in['konsultan'] = $this->input->post('konsultan');
			$in['keterangan'] = $this->input->post('keterangan');
			
			$this->supermodel->insertData('ukl_upl',$in);
			$this->session->set_flashdata('success', 'Penyimpanan data sukses');
			$this->m_global->activities('Menyimpan data UKL-UPL '.$in['jenis_kegiatanusaha']);
			redirect('adm_uklupl/tambah');
		}
		$data['title'] = "Tambah Data UKL-UPL";
		$data['konten'] = 'admin/perizinan/ukl-upl/tambah';
		$data['kecamatan'] = $this->supermodel->getData('kecamatan');
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function edit($id=null)
	{
		$this->form_validation->set_rules('nomor_surat','nomor_surat','required');
		$this->form_validation->set_rules('tgl_surat','tgl_surat','required');
		$this->form_validation->set_rules('tahun','tahun','required');
		$this->form_validation->set_rules('jenis_kegiatanusaha','jenis_kegiatanusaha','required');
		$this->form_validation->set_rules('kelurahan','kelurahan','required');
		$this->form_validation->set_rules('alamat_usaha','alamat_usaha','required');
		$this->form_validation->set_rules('nama_pemilik','nama_pemilik','required');
		$this->form_validation->set_rules('alamat_pemilik','alamat_pemilik','required');

		if($this->form_validation->run()===TRUE) {
			$id = $this->input->post('id');
			$in['nomor_surat'] = $this->input->post('nomor_surat');
			$in['tgl_surat'] = $this->input->post('tgl_surat');
			$in['tahun'] = $this->input->post('tahun');
			$in['jenis_kegiatanusaha'] = $this->input->post('jenis_kegiatanusaha');
			$in['kelurahan_id'] = $this->input->post('kelurahan');
			$in['alamat_usaha'] = $this->input->post('alamat_usaha');
			$in['nama_pemilik'] = $this->input->post('nama_pemilik');
			$in['alamat_pemilik'] = $this->input->post('alamat_pemilik');
			$in['konsultan'] = $this->input->post('konsultan');
			$in['keterangan'] = $this->input->post('keterangan');

			$this->supermodel->updateData('ukl_upl',$in,'ukl_upl_id',$id);
			$this->session->set_flashdata('success', 'Perubahan data sukses');
			$this->m_global->activities('Merubah data UKL-UPL '.$in['jenis_kegiatanusaha']);
			redirect('adm_uklupl/edit/'.$id);
		}
		$data['title'] = "Edit Data UKL-UPL";
		$data['konten'] = 'admin/perizinan/ukl-upl/edit';

		$data['kecamatan'] = $this->supermodel->getData('kecamatan');
		$data['item'] = $this->supermodel->getData('ukl_upl',array('ukl_upl_id'=>$id))->row_array();
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
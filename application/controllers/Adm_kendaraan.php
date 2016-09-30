<?php
/**
* Author Tri Wanda
* Edit By: rizki Maulana
*/
class Adm_kendaraan extends CI_Controller
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
		$data['title'] = "Pengujian kendaraan";
		$data['konten'] = 'admin/kendaraan/emisi_kdr';	

		$data['kdr'] = $this->supermodel->queryManual('select * from emisi_kdr order by emisi_kdr_id desc');

		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function tmb_emisi()
	{
		$this->form_validation->set_rules('tahunuji','Tahun Uji','required');
		$this->form_validation->set_rules('lokasiuji','Lokasi Uji','required');
		if($this->form_validation->run()===TRUE) {
			$in['tahunuji'] = $this->input->post('tahunuji');
			$in['lokasiuji'] = $this->input->post('lokasiuji');
			$in['jum_kdr_bensin'] = $this->input->post('jum_kdr_bensin');
			$in['bensin_lulus'] = $this->input->post('bensin_lulus');
			$in['bensin_non_lulus'] = $this->input->post('bensin_non_lulus');
			$in['jum_kdr_solar'] = $this->input->post('jum_kdr_solar');
			$in['solar_lulus'] = $this->input->post('solar_lulus');
			$in['solar_non_lulus'] = $this->input->post('solar_non_lulus');
			$in['keterangan'] = $this->input->post('keterangan');
			$this->supermodel->insertData('emisi_kdr',$in);
			$this->session->set_flashdata('success', 'Penyimpanan data sukses');
			$this->m_global->activities('Menyimpan data emisi kendaraan tahun '.$in['tahunuji']);
			redirect('adm_kendaraan/tmb_emisi');
		}
		$data['title'] = "Tambah Data Hasil Pengujian kendaraan";
		$data['konten'] = 'admin/kendaraan/tambah_kdr';
		$this->load->vars($data);
		$this->load->view('admin/template');
	}
	function edit_emisi($id=null)
	{
		$this->form_validation->set_rules('tahunuji','Tahun Uji','required');
		$this->form_validation->set_rules('lokasiuji','Lokasi Uji','required');
		if($this->form_validation->run()===TRUE) {
			$id = $this->input->post('id');
			$in['tahunuji'] = $this->input->post('tahunuji');
			$in['lokasiuji'] = $this->input->post('lokasiuji');
			$in['jum_kdr_bensin'] = $this->input->post('jum_kdr_bensin');
			$in['bensin_lulus'] = $this->input->post('bensin_lulus');
			$in['bensin_non_lulus'] = $this->input->post('bensin_non_lulus');
			$in['jum_kdr_solar'] = $this->input->post('jum_kdr_solar');
			$in['solar_lulus'] = $this->input->post('solar_lulus');
			$in['keterangan'] = $this->input->post('keterangan');
			$in['solar_non_lulus'] = $this->input->post('solar_non_lulus');
			$this->supermodel->updateData('emisi_kdr',$in, 'emisi_kdr_id', $id);
			$this->session->set_flashdata('success', 'Edit data sukses');
			$this->m_global->activities('Menyimpan data emisi kendaraan tahun '.$in['tahunuji']);
			redirect('adm_kendaraan/edit_emisi/'.$id);
		}
		$data['title'] = "Edit Data Hasil Pengujian kendaraan";
		$data['konten'] = 'admin/kendaraan/edit_kdr';
		$data['row'] = $this->supermodel->getData('emisi_kdr',array('emisi_kdr_id'=>$id))->row_array();
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	// function index()
	// {
	// 	$data['title'] = "Pengujian kendaraan";
	// 	$data['konten'] = 'admin/kendaraan/index';	

	// 	$data['tahun'] = $this->supermodel->queryManual('select * from tahunuji_kendaraan order by tahunuji_kendaraan desc');

	// 	$this->load->vars($data);
	// 	$this->load->view('admin/template');
	// }

	function lokasiuji()
	{
		$data['title'] = "Lokasi Uji kendaraan";
		$data['konten'] = 'admin/kendaraan/index_lokasi';

		$data['listview'] = $this->supermodel->getData('lokasiuji_kendaraan');

		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function tmb_lokasiuji()
	{
		$this->form_validation->set_rules('nama_lokasi','Nama Lokasi','required');
		if($this->form_validation->run()===TRUE) {
			$in['nama_lokasi'] = $this->input->post('nama_lokasi');
			$in['kelurahan_id'] = $this->input->post('kelurahan_id');
			$this->supermodel->insertData('lokasiuji_kendaraan',$in);
			$this->session->set_flashdata('success', 'Penyimpanan data sukses');
			$this->m_global->activities('Menyimpan data lokasi pengujian kendaraan '.$in['nama_lokasi']);
			redirect('adm_kendaraan/tmb_lokasiuji');
		}
		$data['title'] = "Tambah Data Lokasi Pengujian kendaraan";
		$data['kecamatan'] = $this->supermodel->getData('kecamatan');
		$data['konten'] = 'admin/kendaraan/tambah';
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function edit_lokasiuji($id=null)
	{
		$this->form_validation->set_rules('nama_lokasi','Nama Lokasi','required');
		if($this->form_validation->run()===TRUE) {
			$id = $this->input->post('id');
			$in['nama_lokasi'] = $this->input->post('nama_lokasi');
			$in['kelurahan_id'] = $this->input->post('kelurahan_id');
			$this->supermodel->updateData('lokasiuji_kendaraan',$in, 'lokasiuji_kendaraan_id', $id);
			$this->session->set_flashdata('success', 'Penyimpanan data sukses');
			$this->m_global->activities('Mengedit data lokasi pengujian kendaraan '.$in['nama_lokasi']);
			redirect('adm_kendaraan/edit_lokasiuji/'.$id);
		}
		$data['title'] = "Edit Data Lokasi Pengujian kendaraan";
		$data['kecamatan'] = $this->supermodel->getData('kecamatan');
		$data['row'] = $this->supermodel->getData('lokasiuji_kendaraan',array('lokasiuji_kendaraan_id'=>$id))->row_array();
		$data['kelurahan'] = $this->supermodel->getData('kelurahan', array('kelurahan_id'=>$data['row']['kelurahan_id']))->row_array();
		$data['konten'] = 'admin/kendaraan/edit';
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function tmb_tahunuji()
	{
		$this->form_validation->set_rules('tahun','Tahun','required');
		$this->form_validation->set_rules('keterangan','Keterangan','required');
		if($this->form_validation->run()===TRUE) {
			$in['tahunuji_kendaraan'] = $this->input->post('tahun');
			$in['Keterangan'] = $this->input->post('keterangan');
			$this->supermodel->insertData('tahunuji_kendaraan',$in);
			$this->session->set_flashdata('success', 'Penyimpanan data sukses');
			$this->m_global->activities('Menyimpan data tahun pengujian kendaraan '.$in['tahunuji_kendaraan']);
			redirect('adm_kendaraan/tmb_tahunuji');
		}
		$data['title'] = "Tambah Tahun Pengujian kendaraan";
		$data['konten'] = 'admin/kendaraan/tambah_tahun';
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function edit_tahunuji($tahun=NULL)
	{
		$this->form_validation->set_rules('tahun','Tahun','required');
		$this->form_validation->set_rules('keterangan','Keterangan','required');
		if($this->form_validation->run()===TRUE) {
			$tahun = $this->input->post('tahun');
			$in['Keterangan'] = $this->input->post('keterangan');
			$this->supermodel->updateData('tahunuji_kendaraan',$in, 'tahunuji_kendaraan', $tahun);
			$this->session->set_flashdata('success', 'Penyimpanan data sukses');
			$this->m_global->activities('Mengedit data tahun pengujian kendaraan '.$tahun);
			redirect('adm_kendaraan/edit_tahunuji/'.$tahun);
		}
		$data['dt'] = $this->supermodel->queryManual('select * from tahunuji_kendaraan where tahunuji_kendaraan="'.$tahun.'" ')->row_array();
		$data['title'] = "Edit Tahun Pengujian kendaraan";
		$data['konten'] = 'admin/kendaraan/edit_tahun';
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function hapus_tahunuji($tahun=NULL)
	{
		$del = $this->supermodel->queryManual('delete from tahunuji_kendaraan where tahunuji_kendaraan = '.$tahun);
		if($del) {
			$this->session->set_flashdata('success','Hapus data berhasil');
			$this->m_global->activities('Menghapus tahun uji kendaraan dengan tahun uji '.$tahun);
			redirect('adm_kendaraan');
		} else {
			$this->session->set_flashdata('success','Hapus data gagal');
			redirect('adm_kendaraan');
		}
	}

	function tmb_hasiluji($tahun=NULL)
	{
		$data['title'] = "Data Pengujian kendaraan";
		$data['lokasiuji'] = $this->supermodel->getData('lokasiuji_kendaraan');
		$data['konten'] = 'admin/kendaraan/tambah_hasil';
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function cekdatapengujian()
	{
		$tahun = $this->input->post('tahunuji');
		$lokasi = $this->input->post('lokasiuji');
		$data['datahasiluji'] = $this->m_global->getHasilUjikendaraan(array('lokasiuji_kendaraan_id'=>$lokasi,'tahunuji_kendaraan'=>$tahun));
		$data['tahun'] = $tahun;
		$data['lokasi'] = $lokasi;
		$data['parameter'] = $this->supermodel->getData('par_kendaraan');
		$this->load->view('admin/kendaraan/parameter', $data);
	}

	function tmbhasiluji()
	{
		$in['par_kendaraan_id'] = $this->input->post('parameter');
		$in['tahunuji_kendaraan'] = $this->input->post('tahunuji');
		$in['lokasiuji_kendaraan_id'] = $this->input->post('lokasiuji');
		$in['baku_mutu'] = $this->input->post('bakumutu');
		$in['tandabaca'] = $this->input->post('tandabaca');
		$in['hasil_uji'] = $this->input->post('hasiluji');
		$in['ket_akhir'] = $this->input->post('ket');
		
		$ceking = $this->m_global->getHasilUjikendaraan(array('lokasiuji_kendaraan_id'=>$in['lokasiuji_kendaraan_id'],'tahunuji_kendaraan'=>$in['tahunuji_kendaraan'],'a.par_kendaraan_id'=>$in['par_kendaraan_id']));
		if($ceking->num_rows()>0) {
			$up = $this->supermodel->queryManual('update hasiluji_kendaraan set baku_mutu="'.$in['baku_mutu'].'", tandabaca="'.$in['tandabaca'].'", hasil_uji="'.$in['hasil_uji'].'", ket_akhir="'.$in['ket_akhir'].'" where par_kendaraan_id="'.$in['par_kendaraan_id'].'" and tahunuji_kendaraan="'.$in['tahunuji_kendaraan'].'" and lokasiuji_kendaraan_id="'.$in['lokasiuji_kendaraan_id'].'" ');
			if($up) {
				$data['datahasiluji'] = $this->m_global->getHasilUjikendaraan(array('lokasiuji_kendaraan_id'=>$in['lokasiuji_kendaraan_id'],'tahunuji_kendaraan'=>$in['tahunuji_kendaraan']));
				$data['tahun'] = $in['tahunuji_kendaraan'];
				$data['lokasi'] = $in['lokasiuji_kendaraan_id'];
				$data['parameter'] = $this->supermodel->getData('par_kendaraan');
				$this->load->view('admin/kendaraan/parameter', $data);

				echo "<div class='alert alert-info'><button type='button' class='close' data-dismiss='alert' >×</button>Update data berhasil</div>";
			}
		} else {
			$save = $this->supermodel->insertData('hasiluji_kendaraan', $in);
			if($save) {
				$data['datahasiluji'] = $this->m_global->getHasilUjikendaraan(array('lokasiuji_kendaraan_id'=>$in['lokasiuji_kendaraan_id'],'tahunuji_kendaraan'=>$in['tahunuji_kendaraan']));
				$data['tahun'] = $in['tahunuji_kendaraan'];
				$data['lokasi'] = $in['lokasiuji_kendaraan_id'];
				$data['parameter'] = $this->supermodel->getData('par_kendaraan');
				$this->load->view('admin/kendaraan/parameter', $data);
			}
		}
		
	}

	function hapushasiluji()
	{
		$tahun = $this->input->post('tahun');
		$lokasi = $this->input->post('lokasi');
		$parameter = $this->input->post('parameter');
		$hps = $this->supermodel->queryManual('delete from hasiluji_kendaraan where lokasiuji_kendaraan_id="'.$lokasi.'" and tahunuji_kendaraan="'.$tahun.'" and par_kendaraan_id="'.$parameter.'" ');
		if($hps) {
			$data['datahasiluji'] = $this->m_global->getHasilUjikendaraan(array('lokasiuji_kendaraan_id'=>$lokasi,'tahunuji_kendaraan'=>$tahun));
			$data['tahun'] = $tahun;
			$data['lokasi'] = $lokasi;
			$data['parameter'] = $this->supermodel->getData('par_kendaraan');
			$this->load->view('admin/kendaraan/parameter', $data);
		}
	}

	function importdata()
	{
		$this->load->library('csvimport');

		$tahun = $this->input->post('t');
		$lokasi = $this->input->post('l');
		$config['upload_path'] = './uploads/dataimport/';
        $config['allowed_types'] = 'xls|csv';
        $config['max_size'] = '9000';

        $this->load->library('upload', $config);


        // If upload failed, display error
        if (!$this->upload->do_upload('csvfile')) {
            echo $this->upload->display_errors();
            $data['datahasiluji'] = $this->m_global->getHasilUjikendaraan(array('lokasiuji_kendaraan_id'=>$lokasi,'tahunuji_kendaraan'=>$tahun));
			$data['tahun'] = $tahun;
			$data['lokasi'] = $lokasi;
			$data['parameter'] = $this->supermodel->getData('par_kendaraan');
			$this->load->view('admin/kendaraan/parameter', $data);
        } else {
            $file_data = $this->upload->data();
            $file_path =  './uploads/dataimport/'.$file_data['file_name'];
            
            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
                foreach ($csv_array as $row) {
                    $insert_data = array(
                        'lokasiuji_kendaraan_id'=>$lokasi,
                        'tahunuji_kendaraan'=>$tahun,
                        'par_kendaraan_id'=>$row['parameter'],
                        'baku_mutu'=>$row['baku_mutu'],
                        'tandabaca'=>$row['tandabaca'],
                        'hasil_uji'=>$row['hasil_uji'],
                        'ket_akhir'=>$row['keterangan']
                    );
                    $this->supermodel->insertData('hasiluji_kendaraan', $insert_data);
                }
                echo "<div class='alert alert-info'><button type='button' class='close' data-dismiss='alert' >×</button>Import data berhasil</div>";
                $data['datahasiluji'] = $this->m_global->getHasilUjikendaraan(array('lokasiuji_kendaraan_id'=>$lokasi,'tahunuji_kendaraan'=>$tahun));
				$data['tahun'] = $tahun;
				$data['lokasi'] = $lokasi;
				$data['parameter'] = $this->supermodel->getData('par_kendaraan');
				$this->load->view('admin/kendaraan/parameter', $data);
            } else {
                echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' >×</button>Error, file tidak memenuhi kriteria</div>";
                $data['datahasiluji'] = $this->m_global->getHasilUjikendaraan(array('lokasiuji_kendaraan_id'=>$lokasi,'tahunuji_kendaraan'=>$tahun));
				$data['tahun'] = $tahun;
				$data['lokasi'] = $lokasi;
				$data['parameter'] = $this->supermodel->getData('par_kendaraan');
				$this->load->view('admin/kendaraan/parameter', $data);
            }
            
        }
	}
}
?>
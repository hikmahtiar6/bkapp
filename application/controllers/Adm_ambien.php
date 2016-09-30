<?php
/**
* Author Imam Teguh
* Edit By: rizki Maulana
*/
class Adm_ambien extends CI_Controller
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
		$data['title'] = "Pengujian ambien";
		$data['konten'] = 'admin/ambien/index';	

		$data['tahun'] = $this->supermodel->queryManual('select * from tahunuji_ambien order by tahunuji_ambien desc');

		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function lokasiuji()
	{
		$data['title'] = "Lokasi Uji ambien";
		$data['konten'] = 'admin/ambien/index_lokasi';

		$data['listview'] = $this->supermodel->getData('lokasiuji_ambien');

		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function tmb_lokasiuji()
	{
		$this->form_validation->set_rules('nama_lokasi','Nama Lokasi','required');
		if($this->form_validation->run()===TRUE) {
			$in['nama_lokasi'] = $this->input->post('nama_lokasi');
			$in['kelurahan_id'] = $this->input->post('kelurahan');
			$in['lat'] = $this->input->post('lat');
			$in['lng'] = $this->input->post('lng');
			$in['icon_map'] = 'icon-ambien.png';
			
			$in['marker-color'] = $this->input->post('marker-color');
			$in['marker-size'] = $this->input->post('marker-size');
			$in['description'] = $this->input->post('keterangan');
			$in['marker-symbol'] = $this->input->post('icon');
			//$in['kelurahan_nama'] = $this->input->post('kelurahan_nama');
			//$in['kecamatan_nama'] = $this->input->post('kecamatan_nama');	
			$kecamatan = $this->supermodel->getData('kecamatan',array('kecamatan_id'=>$this->input->post('kecamatan')));
			$kelurahan = $this->supermodel->getData('kelurahan',array('kelurahan_id'=>$this->input->post('kelurahan')));	
			
			$keca = $kecamatan->row_array();
			$kelu = $kelurahan->row_array();

			//$in['kecamatan'] = $keca['kecamatan_nama'];
			//$in['kelurahan'] = $kelu['kelurahan_nama'];

			
			$this->supermodel->insertData('lokasiuji_ambien',$in);
			$this->session->set_flashdata('success', 'Penyimpanan data sukses');
			$this->m_global->activities('Menyimpan data lokasi pengujian ambien '.$in['nama_lokasi']);
			redirect('adm_ambien/tmb_lokasiuji');
		}
		$data['title'] = "Tambah Data Lokasi Pengujian ambien";
		$data['kecamatan'] = $this->supermodel->getData('kecamatan');
		$data['icon'] = $this->supermodel->getData('icon');
		$data['konten'] = 'admin/ambien/tambah';
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function edit_lokasiuji($id=null)
	{
		$this->form_validation->set_rules('nama_lokasi','Nama Lokasi','required');
		if($this->form_validation->run()===TRUE) {
			$id = $this->input->post('id');
			$in['nama_lokasi'] = $this->input->post('nama_lokasi');
			$in['kelurahan_id'] = $this->input->post('kelurahan');
			$in['lat'] = $this->input->post('lat');
			$in['lng'] = $this->input->post('lng');
			$in['icon_map'] = 'icon-ambien.png';
			
			$in['marker-color'] = $this->input->post('marker-color');
			$in['marker-symbol'] = $this->input->post('icon');
			$in['marker-size'] = $this->input->post('marker-size');
			$in['description'] = $this->input->post('keterangan');
			$kecamatan = $this->supermodel->getData('kecamatan',array('kecamatan_id'=>$this->input->post('kecamatan')));
			$kelurahan = $this->supermodel->getData('kelurahan',array('kelurahan_id'=>$this->input->post('kelurahan')));	
			
			$keca = $kecamatan->row_array();
			$kelu = $kelurahan->row_array();

			//$in['kecamatan'] = $keca['kecamatan_nama'];
			//$in['kelurahan'] = $kelu['kelurahan_nama'];
			
			$this->supermodel->updateData('lokasiuji_ambien',$in, 'lokasiuji_ambien_id', $id);
			$this->session->set_flashdata('success', 'Penyimpanan data sukses');
			$this->m_global->activities('Mengedit data lokasi pengujian ambien '.$in['nama_lokasi']);
			redirect('adm_ambien/edit_lokasiuji/'.$id);
		}
		$data['title'] = "Edit Data Lokasi Pengujian ambien";
		$data['kecamatan'] = $this->supermodel->getData('kecamatan');
		$data['icon'] = $this->supermodel->getData('icon');
		$data['row'] = $this->supermodel->getData('lokasiuji_ambien',array('lokasiuji_ambien_id'=>$id))->row_array();
		$data['kelurahan'] = $this->supermodel->getData('kelurahan', array('kelurahan_id'=>$data['row']['kelurahan_id']))->row_array();
		$data['konten'] = 'admin/ambien/edit';
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function tmb_tahunuji()
	{
		$this->form_validation->set_rules('tahun','Tahun','required');
		$this->form_validation->set_rules('keterangan','Keterangan','required');
		if($this->form_validation->run()===TRUE) {
			$in['tahunuji_ambien'] = $this->input->post('tahun');
			$in['Keterangan'] = $this->input->post('keterangan');
			$this->supermodel->insertData('tahunuji_ambien',$in);
			$this->session->set_flashdata('success', 'Penyimpanan data sukses');
			$this->m_global->activities('Menyimpan data tahun pengujian ambien '.$in['tahunuji_ambien']);
			redirect('adm_ambien/tmb_tahunuji');
		}
		$data['title'] = "Tambah Tahun Pengujian ambien";
		$data['konten'] = 'admin/ambien/tambah_tahun';
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
			$this->supermodel->updateData('tahunuji_ambien',$in, 'tahunuji_ambien', $tahun);
			$this->session->set_flashdata('success', 'Penyimpanan data sukses');
			$this->m_global->activities('Mengedit data tahun pengujian ambien '.$tahun);
			redirect('adm_ambien/edit_tahunuji/'.$tahun);
		}
		$data['dt'] = $this->supermodel->queryManual('select * from tahunuji_ambien where tahunuji_ambien="'.$tahun.'" ')->row_array();
		$data['title'] = "Edit Tahun Pengujian ambien";
		$data['konten'] = 'admin/ambien/edit_tahun';
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function hapus_tahunuji($tahun=NULL)
	{
		$del = $this->supermodel->queryManual('delete from tahunuji_ambien where tahunuji_ambien = '.$tahun);
		if($del) {
			$this->session->set_flashdata('success','Hapus data berhasil');
			$this->m_global->activities('Menghapus tahun uji ambien dengan tahun uji '.$tahun);
			redirect('adm_ambien');
		} else {
			$this->session->set_flashdata('success','Hapus data gagal');
			redirect('adm_ambien');
		}
	}

	function tmb_hasiluji($tahun=NULL)
	{
		$data['title'] = "Data Pengujian ambien";
		$data['lokasiuji'] = $this->supermodel->getData('lokasiuji_ambien');
		$data['konten'] = 'admin/ambien/tambah_hasil';
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function cekdatapengujian()
	{
		$tahun = $this->input->post('tahunuji');
		$lokasi = $this->input->post('lokasiuji');
		$data['datahasiluji'] = $this->m_global->getHasilUjiambien(array('lokasiuji_ambien_id'=>$lokasi,'tahunuji_ambien'=>$tahun));
		$data['tahun'] = $tahun;
		$data['lokasi'] = $lokasi;
		$data['parameter'] = $this->supermodel->getData('par_ambien');
		$this->load->view('admin/ambien/parameter', $data);
	}

	function tmbhasiluji()
	{
		$in['par_ambien_id'] = $this->input->post('parameter');
		$in['tahunuji_ambien'] = $this->input->post('tahunuji');
		$in['lokasiuji_ambien_id'] = $this->input->post('lokasiuji');
		$in['baku_mutu'] = $this->input->post('bakumutu');
		$in['tandabaca'] = $this->input->post('tandabaca');
		$in['hasil_uji'] = $this->input->post('hasiluji');
		$in['ket_akhir'] = $this->input->post('ket');
		
		$ceking = $this->m_global->getHasilUjiambien(array('lokasiuji_ambien_id'=>$in['lokasiuji_ambien_id'],'tahunuji_ambien'=>$in['tahunuji_ambien'],'a.par_ambien_id'=>$in['par_ambien_id']));
		if($ceking->num_rows()>0) {
			$up = $this->supermodel->queryManual('update hasiluji_ambien set baku_mutu="'.$in['baku_mutu'].'", tandabaca="'.$in['tandabaca'].'", hasil_uji="'.$in['hasil_uji'].'", ket_akhir="'.$in['ket_akhir'].'" where par_ambien_id="'.$in['par_ambien_id'].'" and tahunuji_ambien="'.$in['tahunuji_ambien'].'" and lokasiuji_ambien_id="'.$in['lokasiuji_ambien_id'].'" ');
			if($up) {
				$data['datahasiluji'] = $this->m_global->getHasilUjiambien(array('lokasiuji_ambien_id'=>$in['lokasiuji_ambien_id'],'tahunuji_ambien'=>$in['tahunuji_ambien']));
				$data['tahun'] = $in['tahunuji_ambien'];
				$data['lokasi'] = $in['lokasiuji_ambien_id'];
				$data['parameter'] = $this->supermodel->getData('par_ambien');
				$this->load->view('admin/ambien/parameter', $data);

				echo "<div class='alert alert-info'><button type='button' class='close' data-dismiss='alert' >×</button>Update data berhasil</div>";
			}
		} else {
			$save = $this->supermodel->insertData('hasiluji_ambien', $in);
			if($save) {
				$data['datahasiluji'] = $this->m_global->getHasilUjiambien(array('lokasiuji_ambien_id'=>$in['lokasiuji_ambien_id'],'tahunuji_ambien'=>$in['tahunuji_ambien']));
				$data['tahun'] = $in['tahunuji_ambien'];
				$data['lokasi'] = $in['lokasiuji_ambien_id'];
				$data['parameter'] = $this->supermodel->getData('par_ambien');
				$this->load->view('admin/ambien/parameter', $data);
			}
		}
		
	}

	function hapushasiluji()
	{
		$tahun = $this->input->post('tahun');
		$lokasi = $this->input->post('lokasi');
		$parameter = $this->input->post('parameter');
		$hps = $this->supermodel->queryManual('delete from hasiluji_ambien where lokasiuji_ambien_id="'.$lokasi.'" and tahunuji_ambien="'.$tahun.'" and par_ambien_id="'.$parameter.'" ');
		if($hps) {
			$data['datahasiluji'] = $this->m_global->getHasilUjiambien(array('lokasiuji_ambien_id'=>$lokasi,'tahunuji_ambien'=>$tahun));
			$data['tahun'] = $tahun;
			$data['lokasi'] = $lokasi;
			$data['parameter'] = $this->supermodel->getData('par_ambien');
			$this->load->view('admin/ambien/parameter', $data);
		}
	}

	function chart()
	{
		$this->load->helper('ambien');
		$data['title'] = "Pengujian ambien";
		$data['konten'] = 'admin/ambien/chart';
		$data['tahun'] = $this->supermodel->queryManual('select * from tahunuji_ambien order by tahunuji_ambien desc');
		$data['parameter'] = $this->supermodel->getData('par_ambien');
		$data['lokasi'] = $this->supermodel->getData('lokasiuji_ambien');

		$data['dt'] = array('parameter'=>'');
		$data['thn'] = '';
		$data['idp'] = '';
		$data['bakumutu'] = '';
		if(isset($_GET['filter'])) {
			$idp = $this->input->get('parameter');
			$thn = $this->input->get('tahun');
			$data['dt'] = $this->supermodel->getData('par_ambien',array('par_ambien_id'=>$idp))->row_array();
			$data['thn'] = $thn;
			$data['idp'] = $idp;
			$bk = $this->supermodel->queryManual('select baku_mutu from hasiluji_ambien where par_ambien_id='.$idp.' group by baku_mutu')->row_array();

			$data['bakumutu'] = $bk['baku_mutu'];
		}

		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function chart_tahun()
	{
		$this->load->helper('ambien');
		$data['title'] = "Pengujian ambien";
		$data['konten'] = 'admin/ambien/chart-tahun';
		$data['tahun'] = $this->supermodel->queryManual('select * from tahunuji_ambien order by tahunuji_ambien desc');
		$data['parameter'] = $this->supermodel->getData('par_ambien');
		$data['lokasi'] = $this->supermodel->getData('lokasiuji_ambien');


		$ynow = date('Y');
		$ylast = date('Y') - 4;
		$data['tahun1'] = $ynow;
		$data['tahun2'] = $ylast;
		$data['ambien'] = '';
		$data['par'] = '';

		$data['dt'] = array('parameter'=>'');
		$data['bakumutu'] = '';
		if(isset($_GET['filter'])) {
			$data['tahun1'] = $this->input->get('tahun1');
			$data['tahun2'] = $this->input->get('tahun2');
			$data['ambien'] = $this->input->get('ambien');
			$data['par'] = $this->input->get('parameter');

			$data['dt'] = $this->supermodel->getData('par_ambien',array('par_ambien_id'=>$data['par']))->row_array();

			$bk = $this->supermodel->queryManual('select baku_mutu from hasiluji_ambien where par_ambien_id='.$data['par'].' group by baku_mutu')->row_array();

			$data['bakumutu'] = $bk['baku_mutu'];
		} 

		$this->load->vars($data);
		$this->load->view('admin/template');
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
            $data['datahasiluji'] = $this->m_global->getHasilUjiambien(array('lokasiuji_ambien_id'=>$lokasi,'tahunuji_ambien'=>$tahun));
			$data['tahun'] = $tahun;
			$data['lokasi'] = $lokasi;
			$data['parameter'] = $this->supermodel->getData('par_ambien');
			$this->load->view('admin/ambien/parameter', $data);
        } else {
            $file_data = $this->upload->data();
            $file_path =  './uploads/dataimport/'.$file_data['file_name'];
            
            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
                foreach ($csv_array as $row) {
                    $insert_data = array(
                        'lokasiuji_ambien_id'=>$lokasi,
                        'tahunuji_ambien'=>$tahun,
                        'par_ambien_id'=>$row['parameter'],
                        'baku_mutu'=>$row['baku_mutu'],
                        'tandabaca'=>$row['tandabaca'],
                        'hasil_uji'=>$row['hasil_uji'],
                        'ket_akhir'=>$row['keterangan']
                    );
                    $this->supermodel->insertData('hasiluji_ambien', $insert_data);
                }
                echo "<div class='alert alert-info'><button type='button' class='close' data-dismiss='alert' >×</button>Import data berhasil</div>";
                $data['datahasiluji'] = $this->m_global->getHasilUjiambien(array('lokasiuji_ambien_id'=>$lokasi,'tahunuji_ambien'=>$tahun));
				$data['tahun'] = $tahun;
				$data['lokasi'] = $lokasi;
				$data['parameter'] = $this->supermodel->getData('par_ambien');
				$this->load->view('admin/ambien/parameter', $data);
            } else {
                echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' >×</button>Error, file tidak memenuhi kriteria</div>";
                $data['datahasiluji'] = $this->m_global->getHasilUjiambien(array('lokasiuji_ambien_id'=>$lokasi,'tahunuji_ambien'=>$tahun));
				$data['tahun'] = $tahun;
				$data['lokasi'] = $lokasi;
				$data['parameter'] = $this->supermodel->getData('par_ambien');
				$this->load->view('admin/ambien/parameter', $data);
            }
            
        }
	}
	
}
?>
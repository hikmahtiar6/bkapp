<?php
/**
* Author Imam Teguh
* Edit By Rizki Maulana
*/
class Adm_tanah extends CI_Controller
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
		$data['title'] = "Pengujian tanah";
		$data['konten'] = 'admin/tanah/index';

		$data['tahun'] = $this->supermodel->queryManual('select * from tahunuji_tanah order by tahunuji_tanah desc');

		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function lokasiuji()
	{
		$data['title'] = "Lokasi Uji tanah";
		$data['konten'] = 'admin/tanah/index_lokasi';

		$data['listview'] = $this->supermodel->getData('lokasiuji_tanah');

		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function tmb_lokasiuji()
	{
		$this->form_validation->set_rules('nama_lokasi','Nama Lokasi','required');
		if($this->form_validation->run()===TRUE) {
			$in['alamat'] = $this->input->post('alamat');
			$in['nama_lokasi'] = $this->input->post('nama_lokasi');
			$in['kelurahan_id'] = $this->input->post('kelurahan_id');
			//$in['marker-symbol'] = $this->input->post('marker-symbol');
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
			$in['lat'] = $this->input->post('lat');
			$in['lng'] = $this->input->post('lng');
			$in['icon_map'] = 'icon-tanah.png';
			$this->supermodel->insertData('lokasiuji_tanah',$in);
			$this->session->set_flashdata('success', 'Penyimpanan data sukses');
			$this->m_global->activities('Menyimpan data lokasi pengujian tanah '.$in['nama_lokasi']);
			redirect('adm_tanah/tmb_lokasiuji');
		}
		$data['title'] = "Tambah Data Lokasi Pengujian tanah";
		$data['kecamatan'] = $this->supermodel->getData('kecamatan');
		$data['icon'] = $this->supermodel->getData('icon');
		$data['konten'] = 'admin/tanah/tambah';
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function edit_lokasiuji($id=null)
	{
		$this->form_validation->set_rules('nama_lokasi','Nama Lokasi','required');
		if($this->form_validation->run()===TRUE) {
			$id = $this->input->post('id');
			$in['alamat'] = $this->input->post('alamat');
			$in['nama_lokasi'] = $this->input->post('nama_lokasi');
			$in['kelurahan_id'] = $this->input->post('kelurahan_id');
			$in['lat'] = $this->input->post('lat');
			$in['lng'] = $this->input->post('lng');
			$in['icon_map'] = 'icon-tanah.png';
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
			
			//$in['kelurahan_nama'] = $this->input->post('kelurahan_nama');
			//$in['kecamatan_nama'] = $this->input->post('kecamatan_nama');	
			$this->supermodel->updateData('lokasiuji_tanah',$in, 'lokasiuji_tanah_id', $id);
			$this->session->set_flashdata('success', 'Penyimpanan data sukses');
			$this->m_global->activities('Mengedit data lokasi pengujian situ '.$in['nama_lokasi']);
			redirect('adm_tanah/edit_lokasiuji/'.$id);
		}
		$data['title'] = "Edit Data Lokasi Pengujian tanah";
		$data['kecamatan'] = $this->supermodel->getData('kecamatan');
		$data['icon'] = $this->supermodel->getData('icon');
		$data['row'] = $this->supermodel->getData('lokasiuji_tanah',array('lokasiuji_tanah_id'=>$id))->row_array();
		$data['kelurahan'] = $this->supermodel->getData('kelurahan', array('kelurahan_id'=>$data['row']['kelurahan_id']))->row_array();
		$data['konten'] = 'admin/tanah/edit';
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function tmb_tahunuji()
	{
		$this->form_validation->set_rules('tahun','Tahun','required');
		$this->form_validation->set_rules('keterangan','Keterangan','required');
		if($this->form_validation->run()===TRUE) {
			$in['tahunuji_tanah'] = $this->input->post('tahun');
			$in['Keterangan'] = $this->input->post('keterangan');
			$this->supermodel->insertData('tahunuji_tanah',$in);
			$this->session->set_flashdata('success', 'Penyimpanan data sukses');
			$this->m_global->activities('Menyimpan data tahun pengujian tanah '.$in['tahunuji_tanah']);
			redirect('adm_tanah/tmb_tahunuji');
		}
		$data['title'] = "Tambah Tahun Pengujian tanah";
		$data['konten'] = 'admin/tanah/tambah_tahun';
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
			$this->supermodel->updateData('tahunuji_tanah',$in, 'tahunuji_tanah', $tahun);
			$this->session->set_flashdata('success', 'Penyimpanan data sukses');
			$this->m_global->activities('Mengedit data tahun pengujian tanah '.$tahun);
			redirect('adm_tanah/edit_tahunuji/'.$tahun);
		}
		$data['dt'] = $this->supermodel->queryManual('select * from tahunuji_tanah where tahunuji_tanah="'.$tahun.'" ')->row_array();
		$data['title'] = "Edit Tahun Pengujian tanah";
		$data['konten'] = 'admin/tanah/edit_tahun';
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function hapus_tahunuji($tahun=NULL)
	{
		$del = $this->supermodel->queryManual('delete from tahunuji_tanah where tahunuji_tanah = '.$tahun);
		if($del) {
			$this->session->set_flashdata('success','Hapus data berhasil');
			$this->m_global->activities('Menghapus tahun uji tanah dengan tahun uji '.$tahun);
			redirect('adm_tanah');
		} else {
			$this->session->set_flashdata('success','Hapus data gagal');
			redirect('adm_tanah');
		}
	}

	function hapushasiluji()
	{
		$tahun = $this->input->post('tahun');
		$lokasi = $this->input->post('lokasi');
		$parameter = $this->input->post('parameter');
		$hps = $this->supermodel->queryManual('delete from hasiluji_tanah where lokasiuji_tanah_id="'.$lokasi.'" and tahunuji_tanah="'.$tahun.'" and par_tanah_id="'.$parameter.'" ');
		if($hps) {
			$data['datahasiluji'] = $this->m_global->getHasilUjitanah(array('lokasiuji_tanah_id'=>$lokasi,'tahunuji_tanah'=>$tahun));
			$data['tahun'] = $tahun;
			$data['lokasi'] = $lokasi;
			$data['parameter'] = $this->supermodel->getData('par_tanah');
			$this->load->view('admin/tanah/parameter', $data);
		}
	}


	function tmb_hasiluji($tahun=NULL)
	{
		$data['title'] = "Data Pengujian tanah";
		$data['lokasiuji'] = $this->supermodel->getData('lokasiuji_tanah');
		$data['konten'] = 'admin/tanah/tambah_hasil';
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function cekdatapengujian()
	{
		$tahun = $this->input->post('tahunuji');
		$lokasi = $this->input->post('lokasiuji');
		$data['datahasiluji'] = $this->m_global->getHasilUjitanah(array('lokasiuji_tanah_id'=>$lokasi,'tahunuji_tanah'=>$tahun));
		$data['tahun'] = $tahun;
		$data['lokasi'] = $lokasi;
		$data['parameter'] = $this->supermodel->getData('par_tanah');
		$this->load->view('admin/tanah/parameter', $data);
	}

	function tmbhasiluji()
	{
		$in['par_tanah_id'] = $this->input->post('parameter');
		$in['tahunuji_tanah'] = $this->input->post('tahunuji');
		$in['lokasiuji_tanah_id'] = $this->input->post('lokasiuji');
		$in['baku_mutu'] = $this->input->post('bakumutu');
		$in['hasil_uji'] = $this->input->post('hasiluji');
		$in['ket_akhir'] = $this->input->post('ket');
		
		$ceking = $this->m_global->getHasilUjitanah(array('lokasiuji_tanah_id'=>$in['lokasiuji_tanah_id'],'tahunuji_tanah'=>$in['tahunuji_tanah'],'a.par_tanah_id'=>$in['par_tanah_id']));
		if($ceking->num_rows()>0) {
			$up = $this->supermodel->queryManual('update hasiluji_tanah set baku_mutu="'.$in['baku_mutu'].'", hasil_uji="'.$in['hasil_uji'].'", ket_akhir="'.$in['ket_akhir'].'" where par_tanah_id="'.$in['par_tanah_id'].'" and tahunuji_tanah="'.$in['tahunuji_tanah'].'" and lokasiuji_tanah_id="'.$in['lokasiuji_tanah_id'].'" ');
			if($up) {
				$data['datahasiluji'] = $this->m_global->getHasilUjitanah(array('lokasiuji_tanah_id'=>$in['lokasiuji_tanah_id'],'tahunuji_tanah'=>$in['tahunuji_tanah']));
				$data['tahun'] = $in['tahunuji_tanah'];
				$data['lokasi'] = $in['lokasiuji_tanah_id'];
				$data['parameter'] = $this->supermodel->getData('par_tanah');
				$this->load->view('admin/tanah/parameter', $data);

				echo "<div class='alert alert-info'><button type='button' class='close' data-dismiss='alert' >×</button>Update data berhasil</div>";
			}
		} else {
			$save = $this->supermodel->insertData('hasiluji_tanah', $in);
			if($save) {
				$data['datahasiluji'] = $this->m_global->getHasilUjitanah(array('lokasiuji_tanah_id'=>$in['lokasiuji_tanah_id'],'tahunuji_tanah'=>$in['tahunuji_tanah']));
				$data['tahun'] = $in['tahunuji_tanah'];
				$data['lokasi'] = $in['lokasiuji_tanah_id'];
				$data['parameter'] = $this->supermodel->getData('par_tanah');
				$this->load->view('admin/tanah/parameter', $data);
			}
		}
		
	}

	function chart()
	{
		$data['title'] = "Pengujian Tanah";
		$data['konten'] = 'admin/tanah/chart';
		$data['tahun'] = $this->supermodel->queryManual('select * from tahunuji_tanah order by tahunuji_tanah desc');
		$data['parameter'] = $this->supermodel->getData('par_tanah');
		$data['lokasi'] = $this->supermodel->getData('lokasiuji_tanah');

		if(isset($_GET['filter'])) {
			$idp = $this->input->get('parameter');
			$thn = $this->input->get('tahun');
			$data['dt'] = $this->supermodel->getData('par_tanah',array('par_tanah_id'=>$idp))->row();
			$data['thn'] = $thn;
			$data['idp'] = $idp;
		} else {
			$data['dt'] = $this->supermodel->getData('par_tanah',array('par_tanah_id'=>5))->row();
			$data['thn'] = 2010;
			$data['idp'] = 5;
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
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '9000';

        $this->load->library('upload', $config);


        // If upload failed, display error
        if (!$this->upload->do_upload('csvfile')) {
            echo $this->upload->display_errors();
            $data['datahasiluji'] = $this->m_global->getHasilUjitanah(array('lokasiuji_tanah_id'=>$lokasi,'tahunuji_tanah'=>$tahun));
			$data['tahun'] = $tahun;
			$data['lokasi'] = $lokasi;
			$data['parameter'] = $this->supermodel->getData('par_tanah');
			$this->load->view('admin/tanah/parameter', $data);
        } else {
            $file_data = $this->upload->data();
            $file_path =  './uploads/dataimport/'.$file_data['file_name'];
            
            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
                foreach ($csv_array as $row) {
                    $insert_data = array(
                        'lokasiuji_tanah_id'=>$lokasi,
                        'tahunuji_tanah'=>$tahun,
                        'par_tanah'=>$row['parameter'],
                        'baku_mutu'=>$row['baku_mutu'],
                        'tandabaca'=>$row['tandabaca'],
                        'hasil_uji'=>$row['hasil_uji'],
                        'ket_akhir'=>$row['keterangan']
                    );
                    $this->supermodel->insertData('hasiluji_sungai', $insert_data);
                }
                echo "<div class='alert alert-info'><button type='button' class='close' data-dismiss='alert' >×</button>Import data berhasil</div>";
                $data['datahasiluji'] = $this->m_global->getHasilUjitanah(array('lokasiuji_tanah_id'=>$lokasi,'tahunuji_tanah'=>$tahun));
				$data['tahun'] = $tahun;
				$data['lokasi'] = $lokasi;
				$data['parameter'] = $this->supermodel->getData('par_tanah');
				$this->load->view('admin/tanah/parameter', $data);
            } else {
                echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' >×</button>Error, file tidak memenuhi kriteria</div>";
                $data['datahasiluji'] = $this->m_global->getHasilUjitanah(array('lokasiuji_tanah_id'=>$lokasi,'tahunuji_tanah'=>$tahun));
				$data['tahun'] = $tahun;
				$data['lokasi'] = $lokasi;
				$data['parameter'] = $this->supermodel->getData('par_tanah');
				$this->load->view('admin/tanah/parameter', $data);
            }
            
        }
	}
	
}
?>
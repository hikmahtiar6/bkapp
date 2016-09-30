<?php
/**
* Author Imam Teguh
*/
class Adm_sungai extends CI_Controller
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
		$data['title'] = "Pengujian Sungai";
		$data['konten'] = 'admin/sungai/index';

		$data['tahun'] = $this->supermodel->queryManual('select * from tahunuji_sungai order by tahunuji_sungai desc');

		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function lokasiuji()
	{
		$data['title'] = "Lokasi Uji Sungai";
		$data['konten'] = 'admin/sungai/index_lokasi';

		$data['listview'] = $this->supermodel->queryManual('select b.nama_sungai, a.lokasi_uji, a.nama_lokasi, a.lokasiuji_sungai_id from lokasiuji_sungai a, sungai b where a.sungai_id=b.sungai_id order by lokasiuji_sungai_id desc');

		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function tmb_lokasiuji()
	{
		$this->form_validation->set_rules('sungai_id','Sungai','required');
		$this->form_validation->set_rules('nama_lokasi','Nama Lokasi','required');
		if($this->form_validation->run()===TRUE) {
			$in['sungai_id'] = $this->input->post('sungai_id');
			$in['nama_lokasi'] = $this->input->post('nama_lokasi');
			$in['lokasi_uji'] = $this->input->post('lokasi_uji');
			//$in['kecamatan'] = $this->input->post('kecamatan');
			
			//$in['marker-symbol'] = $this->input->post('marker-symbol');
			$in['icon_map'] = 'icon-limbah_cair.png';
			$in['marker-color'] = "#20B2AA";
			$in['marker-size'] = "medium";
			$in['description'] = $this->input->post('keterangan');
			$in['marker-symbol'] = "water";
			//$in['kelurahan_nama'] = $this->input->post('kelurahan_nama');
			//$in['kecamatan_nama'] = $this->input->post('kecamatan_nama');	
			$kecamatan = $this->supermodel->getData('kecamatan',array('kecamatan_id'=>$this->input->post('kecamatan')));
			$kelurahan = $this->supermodel->getData('kelurahan',array('kelurahan_id'=>$this->input->post('kelurahan')));	
			
			$keca = $kecamatan->row_array();
			$kelu = $kelurahan->row_array();

			//$in['kecamatan'] = $keca['kecamatan_nama'];
			//$in['kelurahan'] = $kelu['kelurahan_nama'];
			$in['kelurahan_id'] = $this->input->post('kelurahan_id');
			$in['lat'] = $this->input->post('lat');
			$in['lng'] = $this->input->post('lng');
			$in['icon_map'] = strtolower($this->input->post('lokasi_uji')).'.png';
			$this->supermodel->insertData('lokasiuji_sungai',$in);
			$this->session->set_flashdata('success', 'Penyimpanan data sukses');
			$this->m_global->activities('Menyimpan data lokasi pengujian sungai '.$in['nama_lokasi']);
			redirect('adm_sungai/tmb_lokasiuji');
		}
		$data['title'] = "Tambah Data Lokasi Pengujian Air Sungai";
		$data['sungai'] = $this->supermodel->getData('sungai');
		$data['lokasiuji'] = array('Hulu','Tengah','Hilir');
		$data['kecamatan'] = $this->supermodel->getData('kecamatan');
		$data['konten'] = 'admin/sungai/tambah';
		$data['icon'] = $this->supermodel->getData('icon');
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function edit_lokasiuji($id=null)
	{
		$this->form_validation->set_rules('sungai_id','Sungai','required');
		$this->form_validation->set_rules('nama_lokasi','Nama Lokasi','required');
		if($this->form_validation->run()===TRUE) {
			$id = $this->input->post('id');
			$in['sungai_id'] = $this->input->post('sungai_id');
			$in['nama_lokasi'] = $this->input->post('nama_lokasi');
			$in['lokasi_uji'] = $this->input->post('lokasi_uji');
			$in['kelurahan_id'] = $this->input->post('kelurahan_id');
			$in['icon_map'] = 'icon-limbah_cair.png';
			$in['marker-color'] = "#20B2AA";
			$in['marker-size'] = "medium";
			$in['marker-symbol'] = "water";
			$in['description'] = $this->input->post('keterangan');
			
			$kecamatan = $this->supermodel->getData('kecamatan',array('kecamatan_id'=>$this->input->post('kecamatan')));
			$kelurahan = $this->supermodel->getData('kelurahan',array('kelurahan_id'=>$this->input->post('kelurahan')));	
			
			$keca = $kecamatan->row_array();
			$kelu = $kelurahan->row_array();

			//$in['kecamatan'] = $keca['kecamatan_nama'];
			//$in['kelurahan'] = $kelu['kelurahan_nama'];
			$in['lat'] = $this->input->post('lat');
			$in['lng'] = $this->input->post('lng');
			$in['icon_map'] = strtolower($this->input->post('lokasi_uji')).'.png';
			$this->supermodel->updateData('lokasiuji_sungai',$in, 'lokasiuji_sungai_id', $id);
			$this->session->set_flashdata('success', 'Penyimpanan data sukses');
			$this->m_global->activities('Mengedit data lokasi pengujian situ '.$in['nama_lokasi']);
			redirect('adm_sungai/edit_lokasiuji/'.$id);
		}
		$data['title'] = "Edit Data Lokasi Pengujian Air Sungai";
		$data['sungai'] = $this->supermodel->getData('sungai');
		$data['lokasiuji'] = array('Hulu','Tengah','Hilir');
		$data['kecamatan'] = $this->supermodel->getData('kecamatan');
		$data['icon'] = $this->supermodel->getData('icon');
		
		$data['row'] = $this->supermodel->getData('lokasiuji_sungai',array('lokasiuji_sungai_id'=>$id))->row_array();
		$data['kelurahan'] = $this->supermodel->getData('kelurahan', array('kelurahan_id'=>$data['row']['kelurahan_id']))->row_array();
		$data['konten'] = 'admin/sungai/edit';
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function tmb_hasiluji($tahun=NULL)
	{
		$data['title'] = "Data Pengujian Sungai";
		$data['lokasiuji'] = $this->supermodel->getData('lokasiuji_sungai');
		$data['periode'] = array("Musim Kemarau","Musim Penghujan");
		$data['konten'] = 'admin/sungai/tambah_hasil';
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function cekdatapengujian()
	{
		$tahun = $this->input->post('tahunuji');
		$lokasi = $this->input->post('lokasiuji');
		$periode = $this->input->post('periode');
		$data['datahasiluji'] = $this->m_global->getHasilUjiSungai(array('lokasiuji_sungai_id'=>$lokasi,'tahunuji_sungai'=>$tahun,'periode'=>$periode));
		//$data['datahasiluji'] = $this->supermodel->queryManual('select * from hasiluji_sungai where lokasiuji_sungai_id="'.$lokasi.'" and tahunuji_sungai="'.$tahun.'" and periode="'.$periode.'" ');
		$data['tahun'] = $tahun;
		$data['lokasi'] = $lokasi;
		$data['periode'] = $periode;
		$data['parameter'] = $this->supermodel->getData('par_sungai_situ');
		$this->load->view('admin/sungai/parameter', $data);
	}


	function tmbhasiluji()
	{
		$in['par_sungai_situ_id'] = $this->input->post('parameter');
		$in['tahunuji_sungai'] = $this->input->post('tahunuji');
		$in['lokasiuji_sungai_id'] = $this->input->post('lokasiuji');
		$in['periode'] = $this->input->post('periode');
		$in['baku_mutu'] = $this->input->post('bakumutu');
		$in['hasil_uji'] = $this->input->post('hasiluji');
		$in['ket_akhir'] = $this->input->post('ket');
		
		$ceking = $this->m_global->getHasilUjiSungai(array('lokasiuji_sungai_id'=>$in['lokasiuji_sungai_id'],'tahunuji_sungai'=>$in['tahunuji_sungai'],'periode'=>$in['periode'], 'a.par_sungai_situ_id'=>$in['par_sungai_situ_id']));
		if($ceking->num_rows()>0) {
			$up = $this->supermodel->queryManual('update hasiluji_sungai set baku_mutu="'.$in['baku_mutu'].'", hasil_uji="'.$in['hasil_uji'].'", ket_akhir="'.$in['ket_akhir'].'" where par_sungai_situ_id="'.$in['par_sungai_situ_id'].'" and tahunuji_sungai="'.$in['tahunuji_sungai'].'" and periode="'.$in['periode'].'" and lokasiuji_sungai_id="'.$in['lokasiuji_sungai_id'].'" ');
			if($up) {
				$data['datahasiluji'] = $this->m_global->getHasilUjiSungai(array('lokasiuji_sungai_id'=>$in['lokasiuji_sungai_id'],'tahunuji_sungai'=>$in['tahunuji_sungai'],'periode'=>$in['periode']));
				$data['tahun'] = $in['tahunuji_sungai'];
				$data['lokasi'] = $in['lokasiuji_sungai_id'];
				$data['periode'] = $in['periode'];
				$data['parameter'] = $this->supermodel->getData('par_sungai_situ');
				$this->load->view('admin/sungai/parameter', $data);

				echo "<div class='alert alert-info'><button type='button' class='close' data-dismiss='alert' >×</button>Update data berhasil</div>";
			}
		} else {
			$save = $this->supermodel->insertData('hasiluji_sungai', $in);
			if($save) {
				$data['datahasiluji'] = $this->m_global->getHasilUjiSungai(array('lokasiuji_sungai_id'=>$in['lokasiuji_sungai_id'],'tahunuji_sungai'=>$in['tahunuji_sungai'],'periode'=>$in['periode']));
				$data['tahun'] = $in['tahunuji_sungai'];
				$data['lokasi'] = $in['lokasiuji_sungai_id'];
				$data['periode'] = $in['periode'];
				$data['parameter'] = $this->supermodel->getData('par_sungai_situ');
				$this->load->view('admin/sungai/parameter', $data);
			}
		}
		
	}

	function tmb_tahunuji()
	{
		$this->form_validation->set_rules('tahun','Tahun','required');
		$this->form_validation->set_rules('keterangan','Keterangan','required');
		if($this->form_validation->run()===TRUE) {
			$in['tahunuji_sungai'] = $this->input->post('tahun');
			$in['Keterangan'] = $this->input->post('keterangan');
			$this->supermodel->insertData('tahunuji_sungai',$in);
			$this->session->set_flashdata('success', 'Penyimpanan data sukses');
			$this->m_global->activities('Menyimpan data tahun pengujian sungai '.$in['tahunuji_sungai']);
			redirect('adm_sungai/tmb_tahunuji');
		}
		$data['title'] = "Tambah Tahun Pengujian Sungai";
		$data['konten'] = 'admin/sungai/tambah_tahun';
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
			$this->supermodel->updateData('tahunuji_sungai',$in, 'tahunuji_sungai', $tahun);
			$this->session->set_flashdata('success', 'Penyimpanan data sukses');
			$this->m_global->activities('Mengedit data tahun pengujian sungai '.$tahun);
			redirect('adm_sungai/edit_tahunuji/'.$tahun);
		}
		$data['dt'] = $this->supermodel->queryManual('select * from tahunuji_sungai where tahunuji_sungai="'.$tahun.'" ')->row_array();
		$data['title'] = "Edit Tahun Pengujian Sungai";
		$data['konten'] = 'admin/sungai/edit_tahun';
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function hapus_tahunuji($tahun=NULL)
	{
		$del = $this->supermodel->queryManual('delete from tahunuji_sungai where tahunuji_sungai = '.$tahun);
		if($del) {
			$this->session->set_flashdata('success','Hapus data berhasil');
			$this->m_global->activities('Menghapus tahun uji sungai dengan tahun uji '.$tahun);
			redirect('adm_sungai');
		} else {
			$this->session->set_flashdata('success','Hapus data gagal');
			redirect('adm_sungai');
		}
	}

	function hapushasiluji()
	{
		$tahun = $this->input->post('tahun');
		$lokasi = $this->input->post('lokasi');
		$periode = $this->input->post('periode');
		$parameter = $this->input->post('parameter');
		$hps = $this->supermodel->queryManual('delete from hasiluji_sungai where lokasiuji_sungai_id="'.$lokasi.'" and tahunuji_sungai="'.$tahun.'" and periode="'.$periode.'" and par_sungai_situ_id="'.$parameter.'" ');
		if($hps) {
			$data['datahasiluji'] = $this->m_global->getHasilUjiSungai(array('lokasiuji_sungai_id'=>$lokasi,'tahunuji_sungai'=>$tahun,'periode'=>$periode));
			$data['tahun'] = $tahun;
			$data['lokasi'] = $lokasi;
			$data['periode'] = $periode;
			$data['parameter'] = $this->supermodel->getData('par_sungai_situ');
			$this->load->view('admin/sungai/parameter', $data);
		}
	}

	function chart()
	{
		$data['title'] = "Pengujian Sungai";
		$data['konten'] = 'admin/sungai/chart';
		$data['tahun'] = $this->supermodel->queryManual('select * from tahunuji_sungai order by tahunuji_sungai desc');
		$data['parameter'] = $this->supermodel->getData('par_sungai_situ');
		$data['lokasi'] = $this->supermodel->getData('lokasiuji_sungai');


		$data['dt'] = array('parameter'=>'');
		$data['thn'] = '';
		$data['idp'] = '';
		$data['bakumutu'] = '';
		if(isset($_GET['filter'])) {
			$idp = $this->input->get('parameter');
			$thn = $this->input->get('tahun');
			$data['dt'] = $this->supermodel->getData('par_sungai_situ',array('par_sungai_situ_id'=>$idp))->row_array();
			$data['thn'] = $thn;
			$data['idp'] = $idp;
			$bk = $this->supermodel->queryManual('select baku_mutu from hasiluji_sungai where par_sungai_situ_id='.$idp.' group by baku_mutu')->row_array();

			$data['bakumutu'] = $bk['baku_mutu'];
		}

		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function chart_tahun()
	{
		
		$this->load->helper('sungai');
		$data['title'] = "Pengujian Sungai";
		$data['konten'] = 'admin/sungai/chart-tahun';
		$data['tahun'] = $this->supermodel->queryManual('select * from tahunuji_sungai order by tahunuji_sungai desc');
		$data['parameter'] = $this->supermodel->getData('par_sungai_situ');
		$data['lokasi'] = $this->supermodel->getData('lokasiuji_sungai');

		$ynow = date('Y');
		$ylast = date('Y') - 4;
		$data['tahun1'] = $ynow;
		$data['tahun2'] = $ylast;
		$data['sungai'] = '';
		$data['par'] = '';

		$data['dt'] = array('parameter'=>'');
		$data['bakumutu'] = '';
		if(isset($_GET['filter'])) {
			$data['tahun1'] = $this->input->get('tahun1');
			$data['tahun2'] = $this->input->get('tahun2');
			$data['sungai'] = $this->input->get('sungai');
			$data['par'] = $this->input->get('parameter');
			$data['dt'] = $this->supermodel->getData('par_sungai_situ',array('par_sungai_situ_id'=>$data['par']))->row_array();

			$bk = $this->supermodel->queryManual('select baku_mutu from hasiluji_sungai where par_sungai_situ_id='.$data['par'].' group by baku_mutu')->row_array();

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
		$periode = $this->input->post('p');
		$config['upload_path'] = './uploads/dataimport/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '9000';

        $this->load->library('upload', $config);


        // If upload failed, display error
        if (!$this->upload->do_upload('csvfile')) {
            echo $this->upload->display_errors();
            $data['datahasiluji'] = $this->m_global->getHasilUjiSungai(array('lokasiuji_sungai_id'=>$lokasi,'tahunuji_sungai'=>$tahun,'periode'=>$periode));
			$data['tahun'] = $tahun;
			$data['lokasi'] = $lokasi;
			$data['periode'] = $periode;
            $data['parameter'] = $this->supermodel->getData('par_sungai_situ');
			$this->load->view('admin/sungai/parameter', $data);
        } else {
            $file_data = $this->upload->data();
            $file_path =  './uploads/dataimport/'.$file_data['file_name'];
            
            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
                foreach ($csv_array as $row) {
                    $insert_data = array(
                        'lokasiuji_sungai_id'=>$lokasi,
                        'tahunuji_sungai'=>$tahun,
                        'par_sungai_situ_id'=>$row['parameter'],
                        'periode'=>$periode,
                        'baku_mutu'=>$row['baku_mutu'],
                        'tandabaca'=>$row['tandabaca'],
                        'hasil_uji'=>$row['hasil_uji'],
                        'ket_akhir'=>$row['keterangan']
                    );
                    $this->supermodel->insertData('hasiluji_sungai', $insert_data);
                }
                echo "<div class='alert alert-info'><button type='button' class='close' data-dismiss='alert' >×</button>Import data berhasil</div>";
                $data['datahasiluji'] = $this->m_global->getHasilUjiSungai(array('lokasiuji_sungai_id'=>$lokasi,'tahunuji_sungai'=>$tahun,'periode'=>$periode));
				$data['tahun'] = $tahun;
				$data['lokasi'] = $lokasi;
				$data['periode'] = $periode;
	            $data['parameter'] = $this->supermodel->getData('par_sungai_situ');
				$this->load->view('admin/sungai/parameter', $data);
            } else {
                echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' >×</button>Error, file tidak memenuhi kriteria</div>";
                $data['datahasiluji'] = $this->m_global->getHasilUjiSungai(array('lokasiuji_sungai_id'=>$lokasi,'tahunuji_sungai'=>$tahun,'periode'=>$periode));
				$data['tahun'] = $tahun;
				$data['lokasi'] = $lokasi;
				$data['periode'] = $periode;
	            $data['parameter'] = $this->supermodel->getData('par_sungai_situ');
				$this->load->view('admin/sungai/parameter', $data);
            }
            
        }
	}

}
?>
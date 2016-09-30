<?php
/**
* Author Imam Teguh
*/
class Adm_cerobong extends CI_Controller
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
		$data['title'] = "Pengujian cerobong";
		$data['konten'] = 'admin/cerobong/index';	

		$data['tahun'] = $this->supermodel->queryManual('select * from tahunuji_cerobong order by tahunuji_cerobong desc');

		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function lokasiuji()
	{
		$data['title'] = "Lokasi Uji cerobong";
		$data['konten'] = 'admin/cerobong/index_lokasi';

		$data['listview'] = $this->supermodel->getData('lokasiuji_cerobong');

		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function tmb_lokasiuji()
	{
		$this->form_validation->set_rules('nama_lokasi','Nama Lokasi','required');
		if($this->form_validation->run()===TRUE) {
			$in['nama_lokasi'] = $this->input->post('nama_lokasi');
			$in['alamat'] = $this->input->post('alamat');
			
			$in['kelurahan_id'] = $this->input->post('kelurahan');
			$in['lat'] = $this->input->post('lat');
			$in['lng'] = $this->input->post('lng');
			$in['icon_map'] = 'icon-cerobong.png';
			
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
			$this->supermodel->insertData('lokasiuji_cerobong',$in);
			$this->session->set_flashdata('success', 'Penyimpanan data sukses');
			$this->m_global->activities('Menyimpan data lokasi pengujian cerobong '.$in['nama_lokasi']);
			redirect('adm_cerobong/tmb_lokasiuji');
		}
		$data['title'] = "Tambah Data Lokasi Pengujian cerobong";
		$data['kecamatan'] = $this->supermodel->getData('kecamatan');
		$data['icon'] = $this->supermodel->getData('icon');
		$data['konten'] = 'admin/cerobong/tambah';
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function edit_lokasiuji($id=null)
	{
		$this->form_validation->set_rules('nama_lokasi','Nama Lokasi','required');
		if($this->form_validation->run()===TRUE) {
			$id = $this->input->post('id');
			$in['nama_lokasi'] = $this->input->post('nama_lokasi');
			$in['alamat'] = $this->input->post('alamat');
			$in['description'] = $this->input->post('keterangan');
			$in['kelurahan_id'] = $this->input->post('kelurahan');
			$in['marker-color'] = $this->input->post('marker-color');
			$in['marker-symbol'] = $this->input->post('icon');
			$in['marker-size'] = $this->input->post('marker-size');
			
			$kecamatan = $this->supermodel->getData('kecamatan',array('kecamatan_id'=>$this->input->post('kecamatan')));
			$kelurahan = $this->supermodel->getData('kelurahan',array('kelurahan_id'=>$this->input->post('kelurahan')));	
			
			$keca = $kecamatan->row_array();
			$kelu = $kelurahan->row_array();

			//$in['kecamatan'] = $keca['kecamatan_nama'];
			//$in['kelurahan'] = $kelu['kelurahan_nama'];
			$in['lat'] = $this->input->post('lat');
			$in['lng'] = $this->input->post('lng');
			$in['icon_map'] = 'icon-cerobong.png';
			$this->supermodel->updateData('lokasiuji_cerobong',$in, 'lokasiuji_cerobong_id', $id);
			$this->session->set_flashdata('success', 'Penyimpanan data sukses');
			$this->m_global->activities('Mengedit data lokasi pengujian situ '.$in['nama_lokasi']);
			redirect('adm_cerobong/edit_lokasiuji/'.$id);
		}
		$data['title'] = "Edit Data Lokasi Pengujian cerobong";
		$data['kecamatan'] = $this->supermodel->getData('kecamatan');
		$data['icon'] = $this->supermodel->getData('icon');
		$data['row'] = $this->supermodel->getData('lokasiuji_cerobong',array('lokasiuji_cerobong_id'=>$id))->row_array();
		$data['kelurahan'] = $this->supermodel->getData('kelurahan', array('kelurahan_id'=>$data['row']['kelurahan_id']))->row_array();
		$data['konten'] = 'admin/cerobong/edit';
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function tmb_tahunuji()
	{
		$this->form_validation->set_rules('tahun','Tahun','required');
		$this->form_validation->set_rules('keterangan','Keterangan','required');
		if($this->form_validation->run()===TRUE) {
			$in['tahunuji_cerobong'] = $this->input->post('tahun');
			$in['Keterangan'] = $this->input->post('keterangan');
			$this->supermodel->insertData('tahunuji_cerobong',$in);
			$this->session->set_flashdata('success', 'Penyimpanan data sukses');
			$this->m_global->activities('Menyimpan data tahun pengujian cerobong '.$in['tahunuji_cerobong']);
			redirect('adm_cerobong/tmb_tahunuji');
		}
		$data['title'] = "Tambah Tahun Pengujian cerobong";
		$data['konten'] = 'admin/cerobong/tambah_tahun';
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
			$this->supermodel->updateData('tahunuji_cerobong',$in, 'tahunuji_cerobong', $tahun);
			$this->session->set_flashdata('success', 'Penyimpanan data sukses');
			$this->m_global->activities('Mengedit data tahun pengujian cerobong '.$tahun);
			redirect('adm_cerobong/edit_tahunuji/'.$tahun);
		}
		$data['dt'] = $this->supermodel->queryManual('select * from tahunuji_cerobong where tahunuji_cerobong="'.$tahun.'" ')->row_array();
		$data['title'] = "Edit Tahun Pengujian cerobong";
		$data['konten'] = 'admin/cerobong/edit_tahun';
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function hapus_tahunuji($tahun=NULL)
	{
		$del = $this->supermodel->queryManual('delete from tahunuji_cerobong where tahunuji_cerobong = '.$tahun);
		if($del) {
			$this->session->set_flashdata('success','Hapus data berhasil');
			$this->m_global->activities('Menghapus tahun uji cerobong dengan tahun uji '.$tahun);
			redirect('adm_cerobong');
		} else {
			$this->session->set_flashdata('success','Hapus data gagal');
			redirect('adm_cerobong');
		}
	}

	function tmb_hasiluji($tahun=NULL)
	{
		$data['title'] = "Data Pengujian cerobong";
		$data['lokasiuji'] = $this->supermodel->getData('lokasiuji_cerobong');
		$data['konten'] = 'admin/cerobong/tambah_hasil';
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function cekdatapengujian()
	{
		$tahun = $this->input->post('tahunuji');
		$lokasi = $this->input->post('lokasiuji');
		$data['datahasiluji'] = $this->m_global->getHasilUjicerobong(array('lokasiuji_cerobong_id'=>$lokasi,'tahunuji_cerobong'=>$tahun));
		$data['tahun'] = $tahun;
		$data['lokasi'] = $lokasi;
		$data['parameter'] = $this->supermodel->getData('par_cerobong');
		$this->load->view('admin/cerobong/parameter', $data);
	}

	function tmbhasiluji()
	{
		$in['par_cerobong_id'] = $this->input->post('parameter');
		$in['tahunuji_cerobong'] = $this->input->post('tahunuji');
		$in['lokasiuji_cerobong_id'] = $this->input->post('lokasiuji');
		$in['baku_mutu'] = $this->input->post('bakumutu');
		$in['tandabaca'] = $this->input->post('tandabaca');
		$in['hasil_uji'] = $this->input->post('hasiluji');
		$in['ket_akhir'] = $this->input->post('ket');
		
		$ceking = $this->m_global->getHasilUjicerobong(array('lokasiuji_cerobong_id'=>$in['lokasiuji_cerobong_id'],'tahunuji_cerobong'=>$in['tahunuji_cerobong'],'a.par_cerobong_id'=>$in['par_cerobong_id']));
		if($ceking->num_rows()>0) {
			$up = $this->supermodel->queryManual('update hasiluji_cerobong set baku_mutu="'.$in['baku_mutu'].'", tandabaca="'.$in['tandabaca'].'", hasil_uji="'.$in['hasil_uji'].'", ket_akhir="'.$in['ket_akhir'].'" where par_cerobong_id="'.$in['par_cerobong_id'].'" and tahunuji_cerobong="'.$in['tahunuji_cerobong'].'" and lokasiuji_cerobong_id="'.$in['lokasiuji_cerobong_id'].'" ');
			if($up) {
				$data['datahasiluji'] = $this->m_global->getHasilUjicerobong(array('lokasiuji_cerobong_id'=>$in['lokasiuji_cerobong_id'],'tahunuji_cerobong'=>$in['tahunuji_cerobong']));
				$data['tahun'] = $in['tahunuji_cerobong'];
				$data['lokasi'] = $in['lokasiuji_cerobong_id'];
				$data['parameter'] = $this->supermodel->getData('par_cerobong');
				$this->load->view('admin/cerobong/parameter', $data);

				echo "<div class='alert alert-info'><button type='button' class='close' data-dismiss='alert' >×</button>Update data berhasil</div>";
			}
		} else {
			$save = $this->supermodel->insertData('hasiluji_cerobong', $in);
			if($save) {
				$data['datahasiluji'] = $this->m_global->getHasilUjicerobong(array('lokasiuji_cerobong_id'=>$in['lokasiuji_cerobong_id'],'tahunuji_cerobong'=>$in['tahunuji_cerobong']));
				$data['tahun'] = $in['tahunuji_cerobong'];
				$data['lokasi'] = $in['lokasiuji_cerobong_id'];
				$data['parameter'] = $this->supermodel->getData('par_cerobong');
				$this->load->view('admin/cerobong/parameter', $data);
			}
		}
		
	}

	function hapushasiluji()
	{
		$tahun = $this->input->post('tahun');
		$lokasi = $this->input->post('lokasi');
		$parameter = $this->input->post('parameter');
		$hps = $this->supermodel->queryManual('delete from hasiluji_cerobong where lokasiuji_cerobong_id="'.$lokasi.'" and tahunuji_cerobong="'.$tahun.'" and par_cerobong_id="'.$parameter.'" ');
		if($hps) {
			$data['datahasiluji'] = $this->m_global->getHasilUjicerobong(array('lokasiuji_cerobong_id'=>$lokasi,'tahunuji_cerobong'=>$tahun));
			$data['tahun'] = $tahun;
			$data['lokasi'] = $lokasi;
			$data['parameter'] = $this->supermodel->getData('par_cerobong');
			$this->load->view('admin/cerobong/parameter', $data);
		}
	}

	function chart()
	{
		$this->load->helper('cerobong');
		$data['title'] = "Pengujian cerobong";
		$data['konten'] = 'admin/cerobong/chart';
		$data['tahun'] = $this->supermodel->queryManual('select * from tahunuji_cerobong order by tahunuji_cerobong desc');
		$data['parameter'] = $this->supermodel->getData('par_cerobong');
		$data['lokasi'] = $this->supermodel->getData('lokasiuji_cerobong');

		$data['dt'] = array('parameter'=>'');
		$data['thn'] = '';
		$data['idp'] = '';
		$data['bakumutu'] = '';
		if(isset($_GET['filter'])) {
			$idp = $this->input->get('parameter');
			$thn = $this->input->get('tahun');
			$data['dt'] = $this->supermodel->getData('par_cerobong',array('par_cerobong_id'=>$idp))->row_array();
			$data['thn'] = $thn;
			$data['idp'] = $idp;
			$bk = $this->supermodel->queryManual('select baku_mutu from hasiluji_cerobong where par_cerobong_id='.$idp.' group by baku_mutu')->row_array();

			$data['bakumutu'] = $bk['baku_mutu'];
		} 

		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function chart_tahun()
	{
		$this->load->helper('cerobong');
		$data['title'] = "Pengujian Cerobong";
		$data['konten'] = 'admin/cerobong/chart-tahun';
		$data['tahun'] = $this->supermodel->queryManual('select * from tahunuji_cerobong order by tahunuji_cerobong desc');
		$data['parameter'] = $this->supermodel->getData('par_cerobong');
		$data['lokasi'] = $this->supermodel->getData('lokasiuji_cerobong');

		$ynow = date('Y');
		$ylast = date('Y') - 4;
		$data['tahun1'] = $ynow;
		$data['tahun2'] = $ylast;
		$data['cerobong'] = '';
		$data['par'] = '';
		$data['dt'] = array('parameter'=>'');
		$data['bakumutu'] = '';
		if(isset($_GET['filter'])) {
			$data['tahun1'] = $this->input->get('tahun1');
			$data['tahun2'] = $this->input->get('tahun2');
			$data['cerobong'] = $this->input->get('cerobong');
			$data['par'] = $this->input->get('parameter');
			$data['dt'] = $this->supermodel->getData('par_cerobong',array('par_cerobong_id'=>$data['par']))->row_array();

			$bk = $this->supermodel->queryManual('select baku_mutu from hasiluji_cerobong where par_cerobong_id='.$data['par'].' group by baku_mutu')->row_array();

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
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '9000';

        $this->load->library('upload', $config);


        // If upload failed, display error
        if (!$this->upload->do_upload('csvfile')) {
            echo $this->upload->display_errors();
            $data['datahasiluji'] = $this->m_global->getHasilUjicerobong(array('lokasiuji_cerobong_id'=>$lokasi,'tahunuji_cerobong'=>$tahun));
			$data['tahun'] = $tahun;
			$data['lokasi'] = $lokasi;
			$data['parameter'] = $this->supermodel->getData('par_cerobong');
			$this->load->view('admin/cerobong/parameter', $data);
        } else {
            $file_data = $this->upload->data();
            $file_path =  './uploads/dataimport/'.$file_data['file_name'];
            
            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
                foreach ($csv_array as $row) {
                    $insert_data = array(
                        'lokasiuji_cerobong_id'=>$lokasi,
                        'tahunuji_cerobong'=>$tahun,
                        'par_cerobong_id'=>$row['parameter'],
                        'baku_mutu'=>$row['baku_mutu'],
                        'tandabaca'=>$row['tandabaca'],
                        'hasil_uji'=>$row['hasil_uji'],
                        'ket_akhir'=>$row['keterangan']
                    );
                    $this->supermodel->insertData('hasiluji_cerobong', $insert_data);
                }
                echo "<div class='alert alert-info'><button type='button' class='close' data-dismiss='alert' >×</button>Import data berhasil</div>";
                $data['datahasiluji'] = $this->m_global->getHasilUjicerobong(array('lokasiuji_cerobong_id'=>$lokasi,'tahunuji_cerobong'=>$tahun));
				$data['tahun'] = $tahun;
				$data['lokasi'] = $lokasi;
				$data['parameter'] = $this->supermodel->getData('par_cerobong');
				$this->load->view('admin/cerobong/parameter', $data);
            } else {
                echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' >×</button>Error, file tidak memenuhi kriteria</div>";
                $data['datahasiluji'] = $this->m_global->getHasilUjicerobong(array('lokasiuji_cerobong_id'=>$lokasi,'tahunuji_cerobong'=>$tahun));
				$data['tahun'] = $tahun;
				$data['lokasi'] = $lokasi;
				$data['parameter'] = $this->supermodel->getData('par_cerobong');
				$this->load->view('admin/cerobong/parameter', $data);
            }
            
        }
	}
	
}
?>
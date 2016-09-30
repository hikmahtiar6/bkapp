<?php
/**
* Author Imam Teguh
*/
class adm_sumur extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_global');
		$this->load->model('supermodel');
		//$this->load->library('csvimport');
		if($this->session->userdata('getLoginAct')==FALSE) {
			$this->session->set_flashdata('error', 'Tidak ada akses untuk ini!!!');
			redirect('loginweb');
		}
	}

	function index()
	{
		$data['title'] = "Pengujian sumur";
		$data['konten'] = 'admin/sumur/index';

		$data['tahun'] = $this->supermodel->queryManual('select * from tahunuji_sumur order by tahunuji_sumur desc');

		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function lokasiuji()
	{
		$data['title'] = "Lokasi Uji sumur";
		$data['konten'] = 'admin/sumur/index_lokasi';

		$data['listview'] = $this->supermodel->getData('lokasiuji_sumur');

		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function tmb_lokasiuji()
	{
		$this->form_validation->set_rules('nama_lokasi','Nama Lokasi','required');
		if($this->form_validation->run()===TRUE) {
			$in['alamat'] = $this->input->post('alamat');
			$in['nama_lokasi'] = $this->input->post('nama_lokasi');
			$in['kelurahan_id'] = $this->input->post('kelurahan');
			$in['lat'] = $this->input->post('lat');
			$in['lng'] = $this->input->post('lng');
			$in['icon_map'] = 'icon-sumur.png';
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
			
			$this->supermodel->insertData('lokasiuji_sumur',$in);
			$this->session->set_flashdata('success', 'Penyimpanan data sukses');
			
			$this->m_global->activities('Menyimpan data lokasi pengujian sumur '.$in['nama_lokasi']);
			redirect('adm_sumur/tmb_lokasiuji');
		}
		$data['title'] = "Tambah Data Lokasi Pengujian Air sumur";
		$data['kecamatan'] = $this->supermodel->getData('kecamatan');
		$data['icon'] = $this->supermodel->getData('icon');
		$data['konten'] = 'admin/sumur/tambah';
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
			$in['kelurahan_id'] = $this->input->post('kelurahan');
			$in['lat'] = $this->input->post('lat');
			$in['lng'] = $this->input->post('lng');
			$in['icon_map'] = 'icon-sumur.png';
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
			$this->supermodel->updateData('lokasiuji_sumur',$in, 'lokasiuji_sumur_id', $id);
			$this->session->set_flashdata('success', 'Penyimpanan data sukses');
			$this->m_global->activities('Mengedit data lokasi pengujian situ '.$in['nama_lokasi']);
			redirect('adm_sumur/edit_lokasiuji/'.$id);
		}
		$data['title'] = "Edit Data Lokasi Pengujian Air sumur";
		$data['kecamatan'] = $this->supermodel->getData('kecamatan');
		$data['icon'] = $this->supermodel->getData('icon');
		$data['row'] = $this->supermodel->getData('lokasiuji_sumur',array('lokasiuji_sumur_id'=>$id))->row_array();
		$data['kelurahan'] = $this->supermodel->getData('kelurahan', array('kelurahan_id'=>$data['row']['kelurahan_id']))->row_array();
		$data['konten'] = 'admin/sumur/edit';
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function tmb_hasiluji($tahun=NULL)
	{
		$data['title'] = "Data Pengujian sumur";
		$data['lokasiuji'] = $this->supermodel->getData('lokasiuji_sumur');
		$data['konten'] = 'admin/sumur/tambah_hasil';
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function cekdatapengujian()
	{
		$tahun = $this->input->post('tahunuji');
		$lokasi = $this->input->post('lokasiuji');
		$data['datahasiluji'] = $this->m_global->getHasilUjisumur(array('lokasiuji_sumur_id'=>$lokasi,'tahunuji_sumur'=>$tahun));
		$data['tahun'] = $tahun;
		$data['lokasi'] = $lokasi;
		$data['parameter'] = $this->supermodel->getData('par_sumur');
		$this->load->view('admin/sumur/parameter', $data);
	}


	function tmbhasiluji()
	{
		$in['par_sumur_id'] = $this->input->post('parameter');
		$in['tahunuji_sumur'] = $this->input->post('tahunuji');
		$in['lokasiuji_sumur_id'] = $this->input->post('lokasiuji');
		$in['baku_mutu'] = $this->input->post('bakumutu');
		$in['hasil_uji'] = $this->input->post('hasiluji');
		$in['ket_akhir'] = $this->input->post('ket');
		
		$ceking = $this->m_global->getHasilUjiSumur(array('lokasiuji_sumur_id'=>$in['lokasiuji_sumur_id'],'tahunuji_sumur'=>$in['tahunuji_sumur'],'a.par_sumur_id'=>$in['par_sumur_id']));
		if($ceking->num_rows()>0) {
			$up = $this->supermodel->queryManual('update hasiluji_sumur set baku_mutu="'.$in['baku_mutu'].'", hasil_uji="'.$in['hasil_uji'].'", ket_akhir="'.$in['ket_akhir'].'" where par_sumur_id="'.$in['par_sumur_id'].'" and tahunuji_sumur="'.$in['tahunuji_sumur'].'" and lokasiuji_sumur_id="'.$in['lokasiuji_sumur_id'].'" ');
			if($up) {
				$data['datahasiluji'] = $this->m_global->getHasilUjisumur(array('lokasiuji_sumur_id'=>$in['lokasiuji_sumur_id'],'tahunuji_sumur'=>$in['tahunuji_sumur']));
				$data['tahun'] = $in['tahunuji_sumur'];
				$data['lokasi'] = $in['lokasiuji_sumur_id'];
				$data['parameter'] = $this->supermodel->getData('par_sumur');
				$this->load->view('admin/sumur/parameter', $data);

				echo "<div class='alert alert-info'><button type='button' class='close' data-dismiss='alert' >×</button>Update data berhasil</div>";
			}
		} else {
			$save = $this->supermodel->insertData('hasiluji_sumur', $in);
			if($save) {
				$data['datahasiluji'] = $this->m_global->getHasilUjisumur(array('lokasiuji_sumur_id'=>$in['lokasiuji_sumur_id'],'tahunuji_sumur'=>$in['tahunuji_sumur']));
				$data['tahun'] = $in['tahunuji_sumur'];
				$data['lokasi'] = $in['lokasiuji_sumur_id'];
				$data['parameter'] = $this->supermodel->getData('par_sumur');
				$this->load->view('admin/sumur/parameter', $data);
			}
		}
		
	}

	function tmb_tahunuji()
	{
		$this->form_validation->set_rules('tahun','Tahun','required');
		$this->form_validation->set_rules('keterangan','Keterangan','required');
		if($this->form_validation->run()===TRUE) {
			$in['tahunuji_sumur'] = $this->input->post('tahun');
			$in['Keterangan'] = $this->input->post('keterangan');
			$this->supermodel->insertData('tahunuji_sumur',$in);
			$this->session->set_flashdata('success', 'Penyimpanan data sukses');
			$this->m_global->activities('Menyimpan data tahun pengujian sumur '.$in['tahunuji_sumur']);
			redirect('adm_sumur/tmb_tahunuji');
		}
		$data['title'] = "Tambah Tahun Pengujian sumur";
		$data['konten'] = 'admin/sumur/tambah_tahun';
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
			$this->supermodel->updateData('tahunuji_sumur',$in, 'tahunuji_sumur', $tahun);
			$this->session->set_flashdata('success', 'Penyimpanan data sukses');
			$this->m_global->activities('Mengedit data tahun pengujian sumur '.$tahun);
			redirect('adm_sumur/edit_tahunuji/'.$tahun);
		}
		$data['dt'] = $this->supermodel->queryManual('select * from tahunuji_sumur where tahunuji_sumur="'.$tahun.'" ')->row_array();
		$data['title'] = "Edit Tahun Pengujian sumur";
		$data['konten'] = 'admin/sumur/edit_tahun';
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function hapus_tahunuji($tahun=NULL)
	{
		$del = $this->supermodel->queryManual('delete from tahunuji_sumur where tahunuji_sumur = '.$tahun);
		if($del) {
			$this->session->set_flashdata('success','Hapus data berhasil');
			$this->m_global->activities('Menghapus tahun uji sumur dengan tahun uji '.$tahun);
			redirect('adm_sumur');
		} else {
			$this->session->set_flashdata('success','Hapus data gagal');
			redirect('adm_sumur');
		}
	}

	function hapushasiluji()
	{
		$tahun = $this->input->post('tahun');
		$lokasi = $this->input->post('lokasi');
		$parameter = $this->input->post('parameter');
		$hps = $this->supermodel->queryManual('delete from hasiluji_sumur where lokasiuji_sumur_id="'.$lokasi.'" and tahunuji_sumur="'.$tahun.'" and par_sumur_id="'.$parameter.'" ');
		if($hps) {
			$data['datahasiluji'] = $this->m_global->getHasilUjisumur(array('lokasiuji_sumur_id'=>$lokasi,'tahunuji_sumur'=>$tahun));
			$data['tahun'] = $tahun;
			$data['lokasi'] = $lokasi;
			$data['parameter'] = $this->supermodel->getData('par_sumur');
			$this->load->view('admin/sumur/parameter', $data);
		}
	}

	function chart()
	{
		$data['title'] = "Pengujian Sumur";
		$data['konten'] = 'admin/sumur/chart';
		$data['tahun'] = $this->supermodel->queryManual('select * from tahunuji_sumur order by tahunuji_sumur desc');
		$data['parameter'] = $this->supermodel->getData('par_sumur');
		$data['lokasi'] = $this->supermodel->getData('lokasiuji_sumur');

		$data['dt'] = array('parameter'=>'');
		$data['thn'] = '';
		$data['idp'] = '';
		$data['bakumutu'] = '';
		if(isset($_GET['filter'])) {
			$idp = $this->input->get('parameter');
			$thn = $this->input->get('tahun');
			$data['dt'] = $this->supermodel->getData('par_sumur',array('par_sumur_id'=>$idp))->row_array();
			$data['thn'] = $thn;
			$data['idp'] = $idp;

			$bk = $this->supermodel->queryManual('select baku_mutu from hasiluji_sumur where par_sumur_id='.$idp.' group by baku_mutu')->row_array();

			$data['bakumutu'] = $bk['baku_mutu'];
		} 

		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function chart_tahun()
	{
		$this->load->helper('sumur');
		$data['title'] = "Pengujian Sumur";
		$data['konten'] = 'admin/sumur/chart-tahun';
		$data['tahun'] = $this->supermodel->queryManual('select * from tahunuji_sumur order by tahunuji_sumur desc');
		$data['parameter'] = $this->supermodel->getData('par_sumur');
		$data['lokasi'] = $this->supermodel->getData('lokasiuji_sumur');

		$ynow = date('Y');
		$ylast = date('Y') - 4;
		$data['tahun1'] = $ynow;
		$data['tahun2'] = $ylast;
		$data['sumur'] = '';
		$data['par'] = '';
		$data['dt'] = array('parameter'=>'');
		$data['bakumutu'] = '';
		if(isset($_GET['filter'])) {
			$data['tahun1'] = $this->input->get('tahun1');
			$data['tahun2'] = $this->input->get('tahun2');
			$data['sumur'] = $this->input->get('sumur');
			$data['par'] = $this->input->get('parameter');

			$data['dt'] = $this->supermodel->getData('par_sumur',array('par_sumur_id'=>$data['par']))->row_array();

			$bk = $this->supermodel->queryManual('select baku_mutu from hasiluji_sumur where par_sumur_id='.$data['par'].' group by baku_mutu')->row_array();

			$data['bakumutu'] = $bk['baku_mutu'];
		}

		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function importdata() {

		$tahun = $this->input->post('t');
		$lokasi = $this->input->post('l');

		$config['upload_path'] = './uploads/dataimport/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '9000';

        $this->load->library('upload', $config);


        // If upload failed, display error
        if (!$this->upload->do_upload('csvfile')) {
            echo $this->upload->display_errors();
            $data['datahasiluji'] = $this->m_global->getHasilUjisumur(array('lokasiuji_sumur_id'=>$lokasi,'tahunuji_sumur'=>$tahun));
			$data['tahun'] = $tahun;
			$data['lokasi'] = $lokasi;
			$data['parameter'] = $this->supermodel->getData('par_sumur');
            $this->load->view('admin/sumur/parameter', $data);
			
        } else {
            $file_data = $this->upload->data();
            $file_path =  './uploads/dataimport/'.$file_data['file_name'];
            
            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
                foreach ($csv_array as $row) {
                    $insert_data = array(
                        'lokasiuji_sumur_id'=>$lokasi,
                        'tahunuji_sumur'=>$tahun,
                        'par_sumur_id'=>$row['parameter'],
                        'baku_mutu'=>$row['baku_mutu'],
                        'hasil_uji'=>$row['hasil_uji'],
                        'ket_akhir'=>$row['keterangan']
                    );
                    $this->supermodel->insertData('hasiluji_sumur', $insert_data);
                }
                echo "<div class='alert alert-info'><button type='button' class='close' data-dismiss='alert' >×</button>Import data berhasil</div>";
                $data['datahasiluji'] = $this->m_global->getHasilUjisumur(array('lokasiuji_sumur_id'=>$lokasi,'tahunuji_sumur'=>$tahun));
				$data['tahun'] = $tahun;
				$data['lokasi'] = $lokasi;
				$data['parameter'] = $this->supermodel->getData('par_sumur');
                $this->load->view('admin/sumur/parameter', $data);
            } else {
                echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' >×</button>Error, file tidak memenuhi kriteria</div>";
                $data['datahasiluji'] = $this->m_global->getHasilUjisumur(array('lokasiuji_sumur_id'=>$lokasi,'tahunuji_sumur'=>$tahun));
				$data['tahun'] = $tahun;
				$data['lokasi'] = $lokasi;
				$data['parameter'] = $this->supermodel->getData('par_sumur');
                $this->load->view('admin/sumur/parameter', $data);
            }
            
        }
        
	}
}
?>
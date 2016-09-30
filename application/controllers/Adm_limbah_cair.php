<?php
/**
* Author Imam Teguh
*/
class Adm_limbah_cair extends CI_Controller
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
		$data['title'] = "Pengujian limbah cair";
		$data['konten'] = 'admin/limbah_cair/index';

		$data['tahun'] = $this->supermodel->queryManual('select * from tahunuji_limbah_cair order by tahunuji_limbah_cair desc');

		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function lokasiuji()
	{
		$data['title'] = "Lokasi Uji limbah cair";
		$data['konten'] = 'admin/limbah_cair/index_lokasi';

		$data['listview'] = $this->supermodel->queryManual('select b.nama_objekuji, a.nama_lokasi, a.lokasiuji_limbah_cair_id from lokasiuji_limbah_cair a, limbah_cair b where a.limbah_cair_id=b.limbah_cair_id order by nama_lokasi asc');

		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function tmb_lokasiuji()
	{
		$this->form_validation->set_rules('limbah_cair_id','limbah_cair','required');
		$this->form_validation->set_rules('nama_lokasi','Nama Lokasi','required');
		if($this->form_validation->run()===TRUE) {
			$in['limbah_cair_id'] = $this->input->post('limbah_cair_id');
			$in['nama_lokasi'] = $this->input->post('nama_lokasi');
			$in['alamat'] = $this->input->post('alamat');
			$in['kelurahan_id'] = $this->input->post('kelurahan_id');
			$in['lat'] = $this->input->post('lat');
			$in['lng'] = $this->input->post('lng');
			$in['icon_map'] = 'icon-limbah_cair.png';
			$in['marker-color'] = "#CC66FF";
			$in['marker-size'] = "medium";
			$in['description'] = $this->input->post('keterangan');
			$in['marker-symbol'] = "danger";
			$kecamatan = $this->supermodel->getData('kecamatan',array('kecamatan_id'=>$this->input->post('kecamatan')));
			$kelurahan = $this->supermodel->getData('kelurahan',array('kelurahan_id'=>$this->input->post('kelurahan')));	
			
			$keca = $kecamatan->row_array();
			$kelu = $kelurahan->row_array();

			//$in['kecamatan'] = $keca['kecamatan_nama'];
			//$in['kelurahan'] = $kelu['kelurahan_nama'];
			$this->supermodel->insertData('lokasiuji_limbah_cair',$in);
			$this->session->set_flashdata('success', 'Penyimpanan data sukses');
			$this->m_global->activities('Menyimpan data lokasi pengujian limbah_cair '.$in['nama_lokasi']);
			redirect('adm_limbah_cair/tmb_lokasiuji');
		}
		$data['title'] = "Tambah Data Lokasi Pengujian Air limbah cair";
		$data['limbah_cair'] = $this->supermodel->getData('limbah_cair');
		$data['kecamatan'] = $this->supermodel->getData('kecamatan');
		$data['icon'] = $this->supermodel->getData('icon');
		$data['konten'] = 'admin/limbah_cair/tambah';
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function edit_lokasiuji($id=null)
	{
		$this->form_validation->set_rules('limbah_cair_id','limbah_cair','required');
		$this->form_validation->set_rules('nama_lokasi','Nama Lokasi','required');
		if($this->form_validation->run()===TRUE) {
			$id = $this->input->post('id');
			$in['limbah_cair_id'] = $this->input->post('limbah_cair_id');
			$in['nama_lokasi'] = $this->input->post('nama_lokasi');
			$in['alamat'] = $this->input->post('alamat');
			$in['kelurahan_id'] = $this->input->post('kelurahan_id');
			$in['lat'] = $this->input->post('lat');
			$in['lng'] = $this->input->post('lng');
			$in['icon_map'] = 'icon-limbah_cair.png';
			$in['marker-color'] = "#CC66FF";
			$in['marker-size'] = "medium";
			$in['description'] = $this->input->post('keterangan');
			$in['marker-symbol'] = "danger";
			$kecamatan = $this->supermodel->getData('kecamatan',array('kecamatan_id'=>$this->input->post('kecamatan')));
			$kelurahan = $this->supermodel->getData('kelurahan',array('kelurahan_id'=>$this->input->post('kelurahan')));	
			
			$keca = $kecamatan->row_array();
			$kelu = $kelurahan->row_array();

			//$in['kecamatan'] = $keca['kecamatan_nama'];
			//$in['kelurahan'] = $kelu['kelurahan_nama'];
			$this->supermodel->updateData('lokasiuji_limbah_cair',$in, 'lokasiuji_limbah_cair_id', $id);
			$this->session->set_flashdata('success', 'Penyimpanan data sukses');
			$this->m_global->activities('Mengedit data lokasi pengujian limbah cair '.$in['nama_lokasi']);
			redirect('adm_limbah_cair/edit_lokasiuji/'.$id);
		}
		$data['title'] = "Edit Data Lokasi Pengujian Air limbah cair";
		$data['icon'] = $this->supermodel->getData('icon');
		$data['limbah_cair'] = $this->supermodel->getData('limbah_cair');
		$data['kecamatan'] = $this->supermodel->getData('kecamatan');
		$data['row'] = $this->supermodel->getData('lokasiuji_limbah_cair',array('lokasiuji_limbah_cair_id'=>$id))->row_array();
		$data['kelurahan'] = $this->supermodel->getData('kelurahan', array('kelurahan_id'=>$data['row']['kelurahan_id']))->row_array();
		$data['konten'] = 'admin/limbah_cair/edit';
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function tmb_hasiluji($tahun=NULL)
	{
		$data['title'] = "Data Pengujian limbah cair";
		$data['lokasiuji'] = $this->supermodel->getData('lokasiuji_limbah_cair');
		$data['konten'] = 'admin/limbah_cair/tambah_hasil';
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function cekdatapengujian()
	{
		$tahun = $this->input->post('tahunuji');
		$lokasi = $this->input->post('lokasiuji');
		$data['datahasiluji'] = $this->m_global->getHasilUjilimbahcair(array('lokasiuji_limbah_cair_id'=>$lokasi,'tahunuji_limbah_cair'=>$tahun));
		$ls = $this->supermodel->queryManual('select l.nama_objekuji from limbah_cair l, lokasiuji_limbah_cair k where l.limbah_cair_id=k.limbah_cair_id and k.lokasiuji_limbah_cair_id='.$lokasi)->row();
		$data['tahun'] = $tahun;
		$data['lokasi'] = $lokasi;
		$data['parameter'] = $this->supermodel->getData('par_limbah_cair', array('jenis'=>$ls->nama_objekuji));
		$this->load->view('admin/limbah_cair/parameter', $data);
	}


	function tmbhasiluji()
	{
		$in['par_limbah_cair_id'] = $this->input->post('parameter');
		$in['tahunuji_limbah_cair'] = $this->input->post('tahunuji');
		$in['lokasiuji_limbah_cair_id'] = $this->input->post('lokasiuji');
		$in['baku_mutu'] = $this->input->post('bakumutu');
		$in['tandabaca'] = $this->input->post('tandabaca');
		$in['hasil_uji'] = $this->input->post('hasiluji');
		$in['ket_akhir'] = $this->input->post('ket');
		
		$ceking = $this->m_global->getHasilUjilimbahcair(array('lokasiuji_limbah_cair_id'=>$in['lokasiuji_limbah_cair_id'],'tahunuji_limbah_cair'=>$in['tahunuji_limbah_cair'], 'a.par_limbah_cair_id'=>$in['par_limbah_cair_id']));
		if($ceking->num_rows()>0) {
			$up = $this->supermodel->queryManual('update hasiluji_limbah_cair set baku_mutu="'.$in['baku_mutu'].'", tandabaca="'.$in['tandabaca'].'", hasil_uji="'.$in['hasil_uji'].'", ket_akhir="'.$in['ket_akhir'].'" where par_limbah_cair_id="'.$in['par_limbah_cair_id'].'" and tahunuji_limbah_cair="'.$in['tahunuji_limbah_cair'].'" and lokasiuji_limbah_cair_id="'.$in['lokasiuji_limbah_cair_id'].'" ');
			if($up) {
				$data['datahasiluji'] = $this->m_global->getHasilUjilimbahcair(array('lokasiuji_limbah_cair_id'=>$in['lokasiuji_limbah_cair_id'],'tahunuji_limbah_cair'=>$in['tahunuji_limbah_cair']));
				$ls = $this->supermodel->queryManual('select l.nama_objekuji from limbah_cair l, lokasiuji_limbah_cair k where l.limbah_cair_id=k.limbah_cair_id and k.lokasiuji_limbah_cair_id='.$in['lokasiuji_limbah_cair_id'])->row();
				$data['tahun'] = $in['tahunuji_limbah_cair'];
				$data['lokasi'] = $in['lokasiuji_limbah_cair_id'];
				$data['parameter'] = $this->supermodel->getData('par_limbah_cair', array('jenis'=>$ls->nama_objekuji));
				$this->load->view('admin/limbah_cair/parameter', $data);

				echo "<div class='alert alert-info'><button type='button' class='close' data-dismiss='alert' >×</button>Update data berhasil</div>";
			}
		} else {
			$save = $this->supermodel->insertData('hasiluji_limbah_cair', $in);
			if($save) {
				$data['datahasiluji'] = $this->m_global->getHasilUjilimbahcair(array('lokasiuji_limbah_cair_id'=>$in['lokasiuji_limbah_cair_id'],'tahunuji_limbah_cair'=>$in['tahunuji_limbah_cair']));
				$ls = $this->supermodel->queryManual('select l.nama_objekuji from limbah_cair l, lokasiuji_limbah_cair k where l.limbah_cair_id=k.limbah_cair_id and k.lokasiuji_limbah_cair_id='.$in['lokasiuji_limbah_cair_id'])->row();
				$data['tahun'] = $in['tahunuji_limbah_cair'];
				$data['lokasi'] = $in['lokasiuji_limbah_cair_id'];
				$data['parameter'] = $this->supermodel->getData('par_limbah_cair', array('jenis'=>$ls->nama_objekuji));
				$this->load->view('admin/limbah_cair/parameter', $data);
			}
		}
		
	}

	function tmb_tahunuji()
	{
		$this->form_validation->set_rules('tahun','Tahun','required');
		$this->form_validation->set_rules('keterangan','Keterangan','required');
		if($this->form_validation->run()===TRUE) {
			$in['tahunuji_limbah_cair'] = $this->input->post('tahun');
			$in['Keterangan'] = $this->input->post('keterangan');
			$this->supermodel->insertData('tahunuji_limbah_cair',$in);
			$this->session->set_flashdata('success', 'Penyimpanan data sukses');
			$this->m_global->activities('Menyimpan data tahun pengujian limbah_cair '.$in['tahunuji_limbah_cair']);
			redirect('adm_limbah_cair/tmb_tahunuji');
		}
		$data['title'] = "Tambah Tahun Pengujian limbah cair";
		$data['konten'] = 'admin/limbah_cair/tambah_tahun';
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
			$this->supermodel->updateData('tahunuji_limbah_cair',$in, 'tahunuji_limbah_cair', $tahun);
			$this->session->set_flashdata('success', 'Penyimpanan data sukses');
			$this->m_global->activities('Mengedit data tahun pengujian limbah_cair '.$tahun);
			redirect('adm_limbah_cair/edit_tahunuji/'.$tahun);
		}
		$data['dt'] = $this->supermodel->queryManual('select * from tahunuji_limbah_cair where tahunuji_limbah_cair="'.$tahun.'" ')->row_array();
		$data['title'] = "Edit Tahun Pengujian limbah cair";
		$data['konten'] = 'admin/limbah_cair/edit_tahun';
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function hapus_tahunuji($tahun=NULL)
	{
		$del = $this->supermodel->queryManual('delete from tahunuji_limbah_cair where tahunuji_limbah_cair = '.$tahun);
		if($del) {
			$this->session->set_flashdata('success','Hapus data berhasil');
			$this->m_global->activities('Menghapus tahun uji limbah_cair dengan tahun uji '.$tahun);
			redirect('adm_limbah_cair');
		} else {
			$this->session->set_flashdata('success','Hapus data gagal');
			redirect('adm_limbah_cair');
		}
	}

	function hapushasiluji()
	{
		$tahun = $this->input->post('tahun');
		$lokasi = $this->input->post('lokasi');
		$parameter = $this->input->post('parameter');
		$hps = $this->supermodel->queryManual('delete from hasiluji_limbah_cair where lokasiuji_limbah_cair_id="'.$lokasi.'" and tahunuji_limbah_cair="'.$tahun.'" and par_limbah_cair_id="'.$parameter.'" ');
		if($hps) {
			$data['datahasiluji'] = $this->m_global->getHasilUjilimbahcair(array('lokasiuji_limbah_cair_id'=>$lokasi,'tahunuji_limbah_cair'=>$tahun));
			$ls = $this->supermodel->queryManual('select l.nama_objekuji from limbah_cair l, lokasiuji_limbah_cair k where l.limbah_cair_id=k.limbah_cair_id and k.lokasiuji_limbah_cair_id='.$lokasi)->row();
			$data['tahun'] = $tahun;
			$data['lokasi'] = $lokasi;
			$data['parameter'] = $this->supermodel->getData('par_limbah_cair', array('jenis'=>$ls->nama_objekuji));
			$this->load->view('admin/limbah_cair/parameter', $data);
		}
	}

	function chart()
	{
		$data['title'] = "Pengujian limbah cair";
		$data['konten'] = 'admin/limbah_cair/chart';
		$data['tahun'] = $this->supermodel->queryManual('select * from tahunuji_limbah_cair order by tahunuji_limbah_cair desc');
		$data['parameter'] = $this->supermodel->getData('par_limbah_cair');
		$data['lokasi'] = $this->supermodel->getData('lokasiuji_limbah_cair');

		if(isset($_GET['filter'])) {
			$idp = $this->input->get('parameter');
			$thn = $this->input->get('tahun');
			$data['dt'] = $this->supermodel->getData('par_limbah_cair_situ',array('par_limbah_cair_id'=>$idp))->row();
			$data['thn'] = $thn;
			$data['idp'] = $idp;
		} else {
			$data['dt'] = $this->supermodel->getData('par_limbah_cair_situ',array('par_limbah_cair_id'=>5))->row();
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
            $data['datahasiluji'] = $this->m_global->getHasilUjilimbahcair(array('lokasiuji_limbah_cair_id'=>$lokasi,'tahunuji_limbah_cair'=>$tahun));
			$ls = $this->supermodel->queryManual('select l.nama_objekuji from limbah_cair l, lokasiuji_limbah_cair k where l.limbah_cair_id=k.limbah_cair_id and k.lokasiuji_limbah_cair_id='.$lokasi)->row();
			$data['tahun'] = $tahun;
			$data['lokasi'] = $lokasi;
            $data['parameter'] = $this->supermodel->getData('par_limbah_cair', array('jenis'=>$ls->nama_objekuji));
			$this->load->view('admin/limbah_cair/parameter', $data);
        } else {
            $file_data = $this->upload->data();
            $file_path =  './uploads/dataimport/'.$file_data['file_name'];
            
            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
                foreach ($csv_array as $row) {
                    $insert_data = array(
                        'lokasiuji_limbah_cair_id'=>$lokasi,
                        'tahunuji_limbah_cair'=>$tahun,
                        'par_limbah_cair_id'=>$row['parameter'],
                        'tandabaca'=>$row['tandabaca'],
                        'baku_mutu'=>$row['baku_mutu'],
                        'hasil_uji'=>$row['hasil_uji'],
                        'ket_akhir'=>$row['keterangan']
                    );
                    $this->supermodel->insertData('hasiluji_limbah_cair', $insert_data);
                }
                echo "<div class='alert alert-info'><button type='button' class='close' data-dismiss='alert' >×</button>Import data berhasil</div>";
                $data['datahasiluji'] = $this->m_global->getHasilUjilimbahcair(array('lokasiuji_limbah_cair_id'=>$lokasi,'tahunuji_limbah_cair'=>$tahun));
				$ls = $this->supermodel->queryManual('select l.nama_objekuji from limbah_cair l, lokasiuji_limbah_cair k where l.limbah_cair_id=k.limbah_cair_id and k.lokasiuji_limbah_cair_id='.$lokasi)->row();
				$data['tahun'] = $tahun;
				$data['lokasi'] = $lokasi;
	            $data['parameter'] = $this->supermodel->getData('par_limbah_cair', array('jenis'=>$ls->nama_objekuji));
				$this->load->view('admin/limbah_cair/parameter', $data);
            } else {
                echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' >×</button>Error, file tidak memenuhi kriteria</div>";
                $data['datahasiluji'] = $this->m_global->getHasilUjilimbahcair(array('lokasiuji_limbah_cair_id'=>$lokasi,'tahunuji_limbah_cair'=>$tahun));
				$ls = $this->supermodel->queryManual('select l.nama_objekuji from limbah_cair l, lokasiuji_limbah_cair k where l.limbah_cair_id=k.limbah_cair_id and k.lokasiuji_limbah_cair_id='.$lokasi)->row();
				$data['tahun'] = $tahun;
				$data['lokasi'] = $lokasi;
	            $data['parameter'] = $this->supermodel->getData('par_limbah_cair', array('jenis'=>$ls->nama_objekuji));
				$this->load->view('admin/limbah_cair/parameter', $data);
            }
            
        }
	}

}
?>
<?php
/**
* Author Rizki Maulana
*/
class adm_csv extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_global');
		$this->load->model('supermodel');
		$this->load->library('csvimport');
		if($this->session->userdata('getLoginAct')==FALSE) {
			$this->session->set_flashdata('error', 'Tidak ada akses untuk ini!!!');
			redirect('loginweb');
		}
	}

	function index()
	{
		$data['title'] = "CSV";
		$data['konten'] = 'admin/csv/index';
		$link = 'adm_csv/index/';
		$limit= 10;
		$uri_segment= 3;
		$offset= $this->uri->segment($uri_segment);
		
		$data['list'] = $this->supermodel->getData('pengujian_sungai');
		$jum = $this->supermodel->getData('pengujian_sungai');
		
		$data['listview'] = $this->supermodel->getData('pengujian_sungai',$field='', $order='pengujian_sungai_id', $dasc='DESC');
		
		$this->supermodel->paging($link,$jum,$limit,$uri_segment);
		$data['offset'] = $offset;
		$this->load->vars($data);
		$this->load->view('admin/template');
	}
	function cetak()
	{
		//$data['title'] = "CSV";
		$data['konten'] = 'admin/csv/cetak';
		$link = 'adm_csv/cetak/';
		$limit= 10;
		$uri_segment= 3;
		$offset= $this->uri->segment($uri_segment);
		
		$data['list'] = $this->supermodel->getData('pengujian_sungai');
		$jum = $this->supermodel->getData('pengujian_sungai');
		
		$data['listview'] = $this->supermodel->getData('pengujian_sungai',$field='', $order='pengujian_sungai_id', $dasc='DESC');
		
		$this->supermodel->paging($link,$jum,$limit,$uri_segment);
		$data['offset'] = $offset;
		$this->load->vars($data);
		$this->load->view('admin/template1');
	}
	
	function importcsv() {
        $data['pengujian_sungai'] = $this->supermodel->get_pengujian_sungai();
        $data['error'] = '';    //initialize image upload error array to empty
 
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '1000';
 
        $this->load->library('upload', $config);
 
 
        // If upload failed, display error
        if (!$this->upload->do_upload()) {
            $data['error'] = $this->upload->display_errors();
 
            $data['title'] = "Tambah CSV";
			$data['konten'] = 'admin/csv/index';
			$this->load->vars($data);
			$this->load->view('admin/template');
        } else {
            $file_data = $this->upload->data();
            $file_path =  './uploads/'.$file_data['file_name'];
 
            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
                foreach ($csv_array as $row) {
                    $insert_data = array(
                        'pengujian_sungai_id'=>$row['pengujian_sungai_id'],
						'nama_sungai'=>$row['nama_sungai'],
						'lat'=>$row['lat'],
						'lng'=>$row['lng'],
						'waktu_pengujian'=>$row['waktu_pengujian'],
						'periode_uji'=>$row['periode_uji'],
						'temperature'=>$row['temperature'],
						'tds'=>$row['tds'],
						'tss'=>$row['tss'],
						'debit'=>$row['debit'],
						'ph'=>$row['ph'],
						'bod'=>$row['bod'],
						'cod'=>$row['cod'],
						'do'=>$row['do'],
						'total_phospate_po4'=>$row['total_phospate_po4'],
						'nitrate_no3'=>$row['nitrate_no3'],
						'arsenic_as'=>$row['arsenic_as'],
						'cobalt_co'=>$row['cobalt_co'],
						'boron_b'=>$row['boron_b'],
						'selenium_se'=>$row['selenium_se'],
						'cadmium_cd'=>$row['cadmium_cd'],
						'chrom_hexavalen_cr6'=>$row['chrom_hexavalen_cr6'],
						'copper_cu'=>$row['copper_cu'],
						'lead_pb'=>$row['lead_pb'],
						'mercury_hg'=>$row['mercury_hg'],
						'zinc_zn'=>$row['zinc_zn'],
						'cyanide_cn'=>$row['cyanide_cn'],
						'flouride_f'=>$row['flouride_f'],
						'nitrite_no2'=>$row['nitrite_no2'],
						'free_chlorine_cl2'=>$row['free_chlorine_cl2'],
						'sulfide_h2s'=>$row['sulfide_h2s'],
						'ammonia'=>$row['ammonia'],
						'chloride_cl'=>$row['chloride_cl'],
						'iron_fe'=>$row['iron_fe'],
						'manganese_mn'=>$row['manganese_mn'],
						'barium_ba'=>$row['barium_ba'],
						'sulfat'=>$row['sulfat'],
						'fecal_coliform'=>$row['fecal_coliform'],
						'total_coliform'=>$row['total_coliform'],
						'oil_fat'=>$row['oil_fat'],
						'detergent_mbas'=>$row['detergent_mbas'],
						'phenol'=>$row['phenol'],
                    );
                    $this->supermodel->insert_csv($insert_data);
                }
				$data['error'] = "Sukses";
                redirect("adm_csv/index");
			//	echo "Data Berhasil Di Simpan";
               // echo "<pre>"; print_r($insert_data);
            } else {
                $data['error'] = "Error occured";
                $this->load->view('csvindex', $data);
            }
 
        } 
}	
function edit($id=null)
	{
		$this->form_validation->set_rules('nama_sungai','lat','required');
		
		if($this->form_validation->run()===TRUE) {
			$id = $this->input->post('id');
			
			$in['nama_sungai'] = $this->input->post('nama_sungai');
			$in['lat'] = $this->input->post('lat');
			$in['lng'] = $this->input->post('lng');
			$in['waktu_pengujian'] = $this->input->post('waktu_pengujian');
			$in['periode_uji'] = $this->input->post('periode_uji');
			$in['temperature'] = $this->input->post('temperature');
			$in['tds'] = $this->input->post('tds');
			$in['tss'] = $this->input->post('tss');
			$in['debit'] = $this->input->post('debit');
			$in['ph'] = $this->input->post('ph');
			$in['bod'] = $this->input->post('bod');
			$in['cod'] = $this->input->post('cod');
			$in['do'] = $this->input->post('do');
			$in['total_phospate_po4'] = $this->input->post('total_phospate_po4');
			$in['nitrate_no3'] = $this->input->post('nitrate_no3');
			$in['arsenic_as'] = $this->input->post('arsenic_as');
			$in['cobalt_co'] = $this->input->post('cobalt_co');
			$in['boron_b'] = $this->input->post('boron_b');
			$in['selenium_se'] = $this->input->post('selenium_se');
			$in['cadmium_cd'] = $this->input->post('cadmium_cd');
			$in['chrom_hexavalen_cr6'] = $this->input->post('chrom_hexavalen_cr6');
			$in['copper_cu'] = $this->input->post('copper_cu');
			$in['lead_pb'] = $this->input->post('lead_pb');
			$in['mercury_hg'] = $this->input->post('mercury_hg');
			$in['zinc_zn'] = $this->input->post('zinc_zn');
			$in['cyanide_cn'] = $this->input->post('cyanide_cn');
			$in['flouride_f'] = $this->input->post('flouride_f');
			$in['nitrite_no2'] = $this->input->post('nitrite_no2');
			$in['free_chlorine_cl2'] = $this->input->post('free_chlorine_cl2');
			$in['sulfide_h2s'] = $this->input->post('sulfide_h2s');
			$in['ammonia'] = $this->input->post('ammonia');
			$in['chloride_cl'] = $this->input->post('chloride_cl');
			$in['iron_fe'] = $this->input->post('iron_fe');
			$in['manganese_mn'] = $this->input->post('manganese_mn');
			$in['barium_ba'] = $this->input->post('barium_ba');
			$in['sulfat'] = $this->input->post('sulfat');
			$in['fecal_coliform'] = $this->input->post('fecal_coliform');
			$in['total_coliform'] = $this->input->post('total_coliform');
			$in['oil_fat'] = $this->input->post('oil_fat');
			$in['detergent_mbas'] = $this->input->post('detergent_mbas');
			$in['phenol'] = $this->input->post('phenol');
			
			
			$this->supermodel->updateData('pengujian_sungai',$in,'pengujian_sungai_id',$id);
			
			$this->session->set_flashdata('success', 'Perubahan data sukses');
			$this->m_global->activities('Menyimpan data Pengujian Sungai '.$in['nama_sungai']);
			redirect('adm_csv/edit/'.$id);
		}
		$data['title'] = "Edit Data Pengujian Sungai";
		$data['konten'] = 'admin/csv/edit';
		$data['pengujian_sungai'] = $this->supermodel->getData('pengujian_sungai');
		
		
		$data['item'] = $this->supermodel->getData('pengujian_sungai',array('pengujian_sungai_id'=>$id))->row_array();
		
		
		
		//$data['icon'] = $this->supermodel->getData('icon', array('id_icon'=>$data['icon1']['id_icon']))->row_array();
		$this->load->vars($data);
		$this->load->view('admin/template');
	}


	function tambah()
	{
		//$this->form_validation->set_rules('galeri_title','Judul Foto','required');
		//$this->form_validation->set_rules('tahun_pembuatan','Tahun Pembuatan','required');
		//$this->form_validation->set_rules('hasil_pengawasan','Hasil Pengawasan','required');
		//$this->form_validation->set_rules('kelurahan_id','kelurahan','required');
		//$this->form_validation->set_rules('alamat','alamat','required');
		if($this->form_validation->run()===TRUE) {
			$in['pengujian_sungai_id'] = $this->input->post('pengujian_sungai_id');
			$in['nama_sungai'] = $this->input->post('nama_sungai');
			$in['lat'] = $this->input->post('lat');
			$in['lng'] = $this->input->post('lng');
			$in['waktu_pengujian'] = $this->input->post('waktu_pengujian');
			$in['periode_uji'] = $this->input->post('periode_uji');
			$in['temperature'] = $this->input->post('temperature');
			$in['tds'] = $this->input->post('tds');
			$in['tss'] = $this->input->post('tss');
			$in['debit'] = $this->input->post('debit');
			$in['ph'] = $this->input->post('ph');
			$in['bod'] = $this->input->post('bod');
			$in['cod'] = $this->input->post('cod');
			$in['do'] = $this->input->post('do');
			$in['total_phospate_po4'] = $this->input->post('total_phospate_po4');
			$in['nitrate_no3'] = $this->input->post('nitrate_no3');
			$in['arsenic_as'] = $this->input->post('arsenic_as');
			$in['cobalt_co'] = $this->input->post('cobalt_co');
			$in['boron_b'] = $this->input->post('boron_b');
			$in['selenium_se'] = $this->input->post('selenium_se');
			$in['cadmium_cd'] = $this->input->post('cadmium_cd');
			$in['chrom_hexavalen_cr6'] = $this->input->post('chrom_hexavalen_cr6');
			$in['copper_cu'] = $this->input->post('copper_cu');
			$in['lead_pb'] = $this->input->post('lead_pb');
			$in['mercury_hg'] = $this->input->post('mercury_hg');
			$in['zinc_zn'] = $this->input->post('zinc_zn');
			$in['cyanide_cn'] = $this->input->post('cyanide_cn');
			$in['flouride_f'] = $this->input->post('flouride_f');
			$in['nitrite_no2'] = $this->input->post('nitrite_no2');
			$in['free_chlorine_cl2'] = $this->input->post('free_chlorine_cl2');
			$in['sulfide_h2s'] = $this->input->post('sulfide_h2s');
			$in['ammonia'] = $this->input->post('ammonia');
			$in['chloride_cl'] = $this->input->post('chloride_cl');
			$in['iron_fe'] = $this->input->post('iron_fe');
			$in['manganese_mn'] = $this->input->post('manganese_mn');
			$in['barium_ba'] = $this->input->post('barium_ba');
			$in['sulfat'] = $this->input->post('sulfat');
			$in['fecal_coliform'] = $this->input->post('fecal_coliform');
			$in['total_coliform'] = $this->input->post('total_coliform');
			$in['oil_fat'] = $this->input->post('oil_fat');
			$in['detergent_mbas'] = $this->input->post('detergent_mbas');
			$in['phenol'] = $this->input->post('phenol');
			
			$this->supermodel->insertData('pengujian_sungai',$in);
			$this->session->set_flashdata('success', 'Penyimpanan data sukses');
			redirect('adm_csv');
		}
		$data['title'] = "Tambah CSV";
		$data['konten'] = 'admin/csv/index';
		$this->load->vars($data);
		$this->load->view('admin/template');
	}


	
	


}
?>
<?php
/**
* Author M.Febriansyah
*/
class Perusahaan extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_global');
		$this->load->model('supermodel');
		 if($this->session->userdata('getLoginAct')==FALSE) {
		 		echo"<script>alert('Anda belum login !!!');document.location.href='".site_url('login_daftar_member/index')."'</script>";
		 }

	}

	function index(){
			$id = $this->session->userdata('member_id');
			$data['sql'] = $this->supermodel->queryManual("	SELECT 
															p.*,
															kc.kecamatan_nama,
															kl.kelurahan_nama
															FROM 
															perusahaan p,kecamatan kc, kelurahan kl
															WHERE 
															p.kelurahan_id = kl.kelurahan_id AND
															kl.kecamatan_id = kc.kecamatan_id AND
															member_id = '".$id."' ORDER BY perusahaan_id DESC");
			$data['konten'] = "izin_lingkungan/form_perusahaan";
			$this->load->view('izin_lingkungan/template',$data);
	}

	function tambah() { 
			$data['konten'] = "izin_lingkungan/tambah_perusahaan";
			$this->load->view('izin_lingkungan/template',$data);
	}
	function simpan(){
			$nama = $this->input->post('nama');
			$status = $this->input->post('status');
			$alamat = $this->input->post('alamat');
			$kelurahan = $this->input->post('kelurahan');
			$lat = $this->input->post('lat');
			$lng = $this->input->post('lng');
			$no_telp = $this->input->post('no_telp');
			$jenis_usaha = $this->input->post('jenis_usaha');
			$kapasitas_produksi = $this->input->post('kapasitas_produksi');
			$luas_lahan = $this->input->post('luas_lahan');
			$luas_bangunan = $this->input->post('luas_bangunan');
			$kondisi = $this->input->post('kondisi');
			$member_id = $this->session->userdata('member_id');

			if (isset($_POST['simpan'])){
				$data =array('nama' => $nama,
							 'status' => $status,
							 'alamat' => $alamat,
							 'kelurahan_id' => $kelurahan,
							 'lat' => $lat,
							 'lng' => $lng,
							 'no_telp' => $no_telp,
							 'jenis_usaha' => $jenis_usaha,
							 'kapasitas_produksi' => $kapasitas_produksi,
							 'luas_lahan' => $luas_lahan,
							 'luas_bangunan' => $luas_bangunan,
							 'kondisi' => $kondisi,
							 'member_id' => $member_id
							 );
				$jalan = $this->supermodel->insertData('perusahaan',$data);
				if ($jalan){
					echo"<script>alert('Data Berhasil Disimpan');document.location.href='index'</script>";
				}else{
					echo"<script>alert('Gagal Menyimpan Data');</script>";
				}	
			}
	}

	function edit($perusahaan_id){
		$r = $this->supermodel->queryManual("SELECT 
											p.*,
											kc.*,
											kl.*
											FROM 
											perusahaan p,kecamatan kc, kelurahan kl
											WHERE 
											p.kelurahan_id = kl.kelurahan_id AND
											kl.kecamatan_id = kc.kecamatan_id AND
											perusahaan_id = '".$perusahaan_id."'")->row_array();
		$data =array('perusahaan_id' => $r['perusahaan_id'],
					 'nama' => $r['nama'],
					 'status' => $r['status'],
					 'alamat' => $r['alamat'],
					 'kel' => $r['kelurahan_id'],
					 'kec' => $r['kecamatan_id'],
					 'no_telp' => $r['no_telp'],
					 'jenis_usaha' => $r['jenis_usaha'],
					 'kapasitas_produksi' => $r['kapasitas_produksi'],
					 'luas_lahan' => $r['luas_lahan'],
					 'luas_bangunan' => $r['luas_bangunan'],
					 'kondisi' => $r['kondisi'],
					 'lat' => $r['lat'],
					 'lng' => $r['lng']
					 );
		$data['konten'] = "izin_lingkungan/edit_perusahaan";
		$this->load->view('izin_lingkungan/template',$data);
	}

	function update(){
			$perusahaan_id = $this->input->post('perusahaan_id');
			$nama = $this->input->post('nama');
			$status = $this->input->post('status');
			$alamat = $this->input->post('alamat');
			$kelurahan = $this->input->post('kelurahan');
			$lat = $this->input->post('lat');
			$lng = $this->input->post('lng');
			$no_telp = $this->input->post('no_telp');
			$jenis_usaha = $this->input->post('jenis_usaha');
			$kapasitas_produksi = $this->input->post('kapasitas_produksi');
			$luas_lahan = $this->input->post('luas_lahan');
			$luas_bangunan = $this->input->post('luas_bangunan');
			$kondisi = $this->input->post('kondisi');
			$member_id = $this->session->userdata('member_id');

			if (isset($_POST['update'])){
				$data =array('nama' => $nama,
							 'status' => $status,
							 'alamat' => $alamat,
							 'kelurahan_id' => $kelurahan,
							 'lat' => $lat,
							 'lng' => $lng,
							 'no_telp' => $no_telp,
							 'jenis_usaha' => $jenis_usaha,
							 'kapasitas_produksi' => $kapasitas_produksi,
							 'luas_lahan' => $luas_lahan,
							 'luas_bangunan' => $luas_bangunan,
							 'kondisi' => $kondisi
							 );
				$where = "perusahaan_id = '$perusahaan_id'";
				$jalan = $this->supermodel->updateData('perusahaan',$data,$where,$field="");
				if ($jalan){
					echo"<script>alert('Berhasil merubah data');document.location.href='index'</script>";
				}else{
					echo"<script>alert('Gagal Menyimpan Data');</script>";
				}	
			}
	}

	function kel($id=null){
		$daerah = $this->db->get_where('kelurahan', array('kecamatan_id'=>$id));
		foreach ($daerah->result() as $r) {
			echo '<option value="'.$r->kelurahan_id.'">'.$r->kelurahan_nama.'</option>';
		}
	}

		
 }
?>
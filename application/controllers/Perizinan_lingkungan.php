<?php
/**
* Author M.Febriansyah
*/
class Perizinan_lingkungan extends CI_Controller
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
			$jenisizin_id = $this->input->post('jenisizin_id');

			if($jenisizin_id == "1" || $jenisizin_id == "2" || $jenisizin_id == "3"){
				$tabel = "sppl";
				$izin = "SPPL";
			}elseif ($jenisizin_id == "4"){
				$tabel = "ukl_upl";
				$izin = "UKL-UPL";
			}elseif ($jenisizin_id == "5"){
				$tabel = "amdal";
				$izin = "AMDAL";
			}

			$r = $this->supermodel->querymanual("SELECT max(permohonan_id) as permohonan_id FROM $tabel LIMIT 1")->row_array();
			$cek = $r['permohonan_id'];
			$str = substr($cek, -4);
			$num = $str+1;
			if ($num < 10) {
				$num = "000".$num;
			}elseif ($num < 100) {
				$num = "00".$num;
			}elseif ($num < 1000) {
				$num = "0".$num;
			}

			$data = array('jenisizin_id' => $jenisizin_id,
						  'permohonan_id' => $izin."-".date('Y')."-".$num,
						  'tabel' => $tabel
						  );

			$data['konten'] = "izin_lingkungan/perizinan_lingkungan";
			$this->load->view('izin_lingkungan/template',$data);
			
	}

	function simpan(){
		$tabel = $this->input->post('tabel');
		$permohonan_id = $this->input->post('permohonan_id');
		$jenisizin_id = $this->input->post('jenisizin_id');
		$perusahaan = $this->input->post('perusahaan');
		$pemohon = $this->input->post('pemohon');
		$nama_kegiatan = $this->input->post('nama_kegiatan');
		$rencana_lokasi = $this->input->post('rencana_lokasi');
		$member_id = $this->session->userdata('member_id');

		if (isset($_POST['simpan'])){
			$data =array('permohonan_id' => $permohonan_id,
						 'jenisizin_id' => $jenisizin_id,
						 'member_id' => $this->session->userdata('member_id'),
						 'perusahaan_id' => $perusahaan,
						 'nama_kegiatan' => $nama_kegiatan,
						 'rencana_lokasi' => $rencana_lokasi,
						 'pemohon_id' => $pemohon
						);

			$jalan = $this->supermodel->insertData($tabel,$data);

			if ($jalan){
				echo"<script>alert('Selesai');document.location.href='".site_url()."/upload_syarat/index/".$pemohon."/".$perusahaan."/".$jenisizin_id."/".$permohonan_id."'</script>";
			}
		}
	}

	function edit($permohonan_id,$jenisizin_id){
			if($jenisizin_id == "1" || $jenisizin_id == "2" || $jenisizin_id == "3"){
				$tabel = "sppl";
				$izin = "SPPL";
			}elseif ($jenisizin_id == "4"){
				$tabel = "ukl_upl";
				$izin = "UKL-UPL";
			}elseif ($jenisizin_id == "5"){
				$tabel = "amdal";
				$izin = "AMDAL";
			}
			$r = $this->supermodel->querymanual("SELECT * FROM $tabel WHERE permohonan_id = '$permohonan_id'")->row_array();
			$data = array('permohonan_id' => $r['permohonan_id'],
						'jenisizin_id' => $r['jenisizin_id'],
						'pemohon_id' => $r['pemohon_id'],
						'perusahaan_id' => $r['perusahaan_id'],
						'nama_kegiatan' => $r['nama_kegiatan'],
						'rencana_lokasi' => $r['rencana_lokasi'],
						'tabel' => $tabel,
						);

			$data['konten'] = "izin_lingkungan/perizinan_lingkungan_edit";
			$this->load->view('izin_lingkungan/template',$data);
	}

	function update(){
		$tabel = $this->input->post('tabel');
		$permohonan_id = $this->input->post('permohonan_id');
		$jenisizin_id = $this->input->post('jenisizin_id');
		$perusahaan = $this->input->post('perusahaan');
		$pemohon = $this->input->post('pemohon');
		$nama_kegiatan = $this->input->post('nama_kegiatan');
		$rencana_lokasi = $this->input->post('rencana_lokasi');
		$member_id = $this->session->userdata('member_id');

		if (isset($_POST['simpan'])){
			$data =array('jenisizin_id' => $jenisizin_id,
						 'perusahaan_id' => $perusahaan,
						 'nama_kegiatan' => $nama_kegiatan,
						 'rencana_lokasi' => $rencana_lokasi,
						 'pemohon_id' => $pemohon
						);
			$where = "permohonan_id = '$permohonan_id'";

			$jalan = $this->supermodel->updateData($tabel,$data,$where,$field="");

			if ($jalan){
				echo"<script>alert('Selesai');document.location.href='".site_url()."/upload_syarat/index/".$pemohon."/".$perusahaan."/".$jenisizin_id."/".$permohonan_id."'</script>";
			}
		}
	}

	function detailPemohon(){
		$pemohon_id = $this->input->post('pemohon_id');
		$query = $this->supermodel->querymanual("SELECT a.*,b.*,c.* 
												FROM pemohon a,kecamatan b,kelurahan c 
												WHERE a.kelurahan_id = c.kelurahan_id AND
												c.kecamatan_id = b.kecamatan_id AND
												pemohon_id = '".$pemohon_id."'");
		foreach ($query->result() as $r) {
			echo"
					<table class='table table-bordered'>
						<tr>
							<td><label>Nama Lengkap</label></td>
							<td>:</td>
							<td>".$r->nama."</td>
						</tr>
						<tr>
							<td><label>Jabatan</label></td>
							<td>:</td>
							<td>".$r->jabatan."</td>
						</tr>
						<tr>
							<td><label>Alamat</label></td>
							<td>:</td>
							<td>".$r->alamat."</td>
						</tr>
						<tr>
							<td><label>Kecamatan</label></td>
							<td>:</td>
							<td>".$r->kecamatan_nama."</td>
						</tr>
						<tr>
							<td><label>Kelurahan</label></td>
							<td>:</td>
							<td>".$r->kelurahan_nama."</td>
						</tr>
						<tr>
							<td><label>NIK</label></td>
							<td>:</td>
							<td>".$r->nik."</td>
						</tr>
						<tr>
							<td><label>No. Telp</label></td>
							<td>:</td>
							<td>".$r->no_telp."</td>
						</tr>
					</table>";
			}
	}

	function detailPerusahaan(){
		$perusahaan_id = $this->input->post('perusahaan_id');
		$query = $this->supermodel->querymanual("SELECT a.*,b.*,c.* 
												FROM perusahaan a,kecamatan b,kelurahan c 
												WHERE a.kelurahan_id = c.kelurahan_id AND
												c.kecamatan_id = b.kecamatan_id AND
												perusahaan_id = '".$perusahaan_id."'");
			foreach ($query->result() as $r) {
		echo"
			<table class='table table-bordered'>
				<tr>
					<td><label>Nama Perusahaan</label></td>
					<td>:</td>
					<td>".$r->nama."</td>
				</tr>
				<tr>
					<td><label>Status Perusahaan</label></td>
					<td>:</td>
					<td>".$r->status."</td>
				</tr>
				<tr>
					<td><label>Alamat Perusahaan</label></td>
					<td>:</td>
					<td>".$r->alamat."</td>
				</tr>
				<tr>
					<td><label>Kecamatan</label></td>
					<td>:</td>
					<td>".$r->kecamatan_nama."</td>
				</tr>
				<tr>
					<td><label>Kelurahan</label></td>
					<td>:</td>
					<td>".$r->kelurahan_nama."</td>
				</tr>
				<tr>
					<td><label>No. Telp</label></td>
					<td>:</td>
					<td>".$r->no_telp."</td>
				</tr>
				<tr>
					<td><label>Jenis usaha</label></td>
					<td>:</td>
					<td>".$r->jenis_usaha."</td>
				</tr>
				<tr>
					<td><label>Kapasitas Produksi</label></td>
					<td>:</td>
					<td>".$r->kapasitas_produksi."</td>
				</tr>
				<tr>
					<td><label>Luas Lahan</label></td>
					<td>:</td>
					<td>".$r->luas_lahan."</td>
				</tr>
				<tr>
					<td><label>Luas Bangunan</label></td>
					<td>:</td>
					<td>".$r->luas_bangunan."</td>
				</tr>
				<tr>
					<td><label>Kondisi Lahan Saat Ini</label></td>
					<td>:</td>
					<td>".$r->kondisi."</td>
				</tr>
			</table>";
		}
	}

	function getPemohon(){
		$id = $this->session->userdata('member_id');
		$sql = $this->supermodel->queryManual("SELECT * FROM pemohon WHERE member_id = '".$id."' ORDER BY pemohon_id DESC");
		echo "<option></option>";
		if($sql->num_rows()>0) {
			foreach ($sql->result() as $r) {
				echo "<option value={$r->pemohon_id}>{$r->nama}</option>";
		}}
	}

	function getPerusahaan(){
		$id = $this->session->userdata('member_id');
		$sql = $this->supermodel->queryManual("SELECT * FROM perusahaan WHERE member_id = '".$id."' ORDER BY perusahaan_id DESC");
		echo "<option></option>";
		if($sql->num_rows()>0) {
			foreach ($sql->result() as $r) {
				echo "<option value={$r->perusahaan_id}>{$r->nama}</option>";
		}}
	}

	function kel($id=null){
		$daerah = $this->db->get_where('kelurahan', array('kecamatan_id'=>$id));
		foreach ($daerah->result() as $r) {
			echo '<option value="'.$r->kelurahan_id.'">'.$r->kelurahan_nama.'</option>';
		}
	}

	function tambahPemohon() {
		$nik = $this->input->post('nik');
		$nama = $this->input->post('nama');
		$jabatan = $this->input->post('jabatan');
		$alamat = $this->input->post('alamat');
		$kel = $this->input->post('kel');
		$no_telp = $this->input->post('no_telp');
		$member_id = $this->session->userdata('member_id');

			$data=array(
				'nik' => $nik,
				'nama' => $nama,
				'jabatan' => $jabatan,
				'alamat' => $alamat,
				'kelurahan_id' => $kel,
				'no_telp' => $no_telp,
				'member_id' => $member_id
				);

			$jalan = $this->supermodel->insertData('pemohon',$data);
			echo $jalan;

			// if ($jalan){
			// 	echo"<script>alert('Berhasil menyimpan data');document.location.href='index'</script>";
			// }	
	}

	function tambahPerusahaan(){
			$nama = $this->input->post('nama');
			$status = $this->input->post('status');
			$alamat = $this->input->post('alamat');
			$kel2 = $this->input->post('kel2');
			$lat = $this->input->post('lat');
			$lng = $this->input->post('lng');
			$no_telp = $this->input->post('no_telp');
			$jenis_usaha = $this->input->post('jenis_usaha');
			$kapasitas_produksi = $this->input->post('kapasitas_produksi');
			$luas_lahan = $this->input->post('luas_lahan');
			$luas_bangunan = $this->input->post('luas_bangunan');
			$kondisi = $this->input->post('kondisi');
			$member_id = $this->session->userdata('member_id');

				$data =array('nama' => $nama,
							 'status' => $status,
							 'alamat' => $alamat,
							 'kelurahan_id' => $kel2,
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
				echo($jalan);
			
	}

}
?>
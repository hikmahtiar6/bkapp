<?php
/**
* Author M.Febriansyah
*/
class Upload_syarat extends CI_Controller
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

	function index($pemohon_id,$perusahaan_id,$jenisizin_id,$permohonan_id){
		
		if($jenisizin_id == "1" || $jenisizin_id == "2" || $jenisizin_id == "3"){
				$tabel = "sppl";
			}elseif ($jenisizin_id == "4"){
				$tabel = "ukl_upl";
			}elseif ($jenisizin_id == "5"){
				$tabel = "amdal";
			}
		$data['permohonan_id'] = $permohonan_id;
		$data['tabel'] = $tabel;
		$data['jenisizin_id'] = $jenisizin_id;
		$data['pemohon_id'] = $pemohon_id;
		$data['perusahaan_id'] = $perusahaan_id;
		$data['member_id'] = $this->session->userdata('member_id');
		$data['konten'] = "izin_lingkungan/upload_syarat";
		$this->load->view('izin_lingkungan/template',$data);
	}


	function dokumen(){
		$perusahaan_id = $this->input->post('perusahaan_id');
		$sql = $this->supermodel->queryManual("SELECT * FROM direktori_member WHERE perusahaan_id = '".$perusahaan_id."' ORDER BY dokumen_id DESC");
	echo"<table class='table table-striped table-bordered'>
			<tr>
        		<td>No</td>
        		<td>Nama</td>
        		<td></td>
        	</tr>";
        		if($sql->num_rows()>0) {
					$no=0;
					foreach ($sql->result() as $r){
						$no++;
				$a = "get_file('$r->dokumen_id','$r->file_name')";

        echo'<tr>
        		<td>'.$no.'</td>
        		<td>'.$r->file_name.'</td>
        		<td>
        			<a href='.site_url('dokumen_member/view_dok/'.$r->file).' target="_blank" class="btn btn-info btn-xs"><i class="fa fa-search"></i></a>
        			<a onclick="'.$a.'" data-dismiss="modal" class="btn btn-success btn-xs"><i class="fa fa-check"></i></a>
        		</td>
        	</tr>';
        	}}	  	    			
	echo "</table>
		";
	}



	/**
	 * Simpan Perizinan
	 * 
	 * @author Hikmahtiar <hikmahtiar.cool@gmail.com>
	 */
	public function simpan() {

		$post = $this->input->post();
		$dokumen_id = $post['dokumen_id'];
		$persyaratan_id = $post['syarat_id'];

		//var_dump($persyaratan_id);
		//var_dump($dokumen_id);

		$key = 0;
		foreach($dokumen_id as $row) {
			var_dump($row['value'] . 'dan' . $persyaratan_id[$key]['value']);
			$key++;
		}

		/*
		$permohonan_id = $this->input->post('permohonan_id');
		$pemohon_id = $this->input->post('pemohon_id');
		$perusahaan_id = $this->input->post('perusahaan_id');
		$jenisizin_id = $this->input->post('jenisizin_id');
		    $result = array();
		    foreach($persyaratan_id AS $key => $val){
		     $result[] = array(
		      "permohonan_id"  => $_POST['permohonan_id'],
		      "persyaratan_id"  => $_POST['persyaratan_id'][$key],
		      "dokumen_id"  => $_POST['dok_id'][$key]
		     );
		    }            
		    
		    $jalan= $this->db->update_batch('uplad_syarat', $result,'permohonan_id'); // fungsi dari codeigniter untuk menyimpan multi array
		    
			if ($jalan){
				echo"<script>alert('Data Berhasil di Simpan');document.location.href='".site_url('upload_syarat/index/'.$pemohon_id.'/'.$perusahaan_id.'/'.$jenisizin_id.'/'.$permohonan_id)."'</script>";
			}

		*/


	}
 }
?>
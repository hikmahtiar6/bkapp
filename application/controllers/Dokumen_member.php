<?php
/**
* Author M.Febriansyah
*/
class dokumen_member extends CI_Controller
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

	function index($id = null){
			$data = array('perusahaan_id' => $id);
			$data['konten'] = "izin_lingkungan/dokumen_member";
			$this->load->view('izin_lingkungan/template',$data);
	}
		
	function tampil(){
			$perusahaan_id = $this->input->post('perusahaan_id');
			$member_id = $this->session->userdata('member_id');
			$query = $this->supermodel->queryManual("SELECT 
															*
															FROM 
															direktori_member
															WHERE
															member_id = '".$member_id."' AND
															perusahaan_id = '".$perusahaan_id."' ORDER BY perusahaan_id DESC");
			
			if ($perusahaan_id == ""){
				echo "";
			}else{
				echo "
				<form method='POST' action='".site_url('dokumen_member/upload')."' enctype='multipart/form-data'> 
									    	<input type='hidden' value='{$perusahaan_id}' name='perusahaan' required>
								    		<div>
								    			<table class='table' id='action'>
									    			<tr>
									    				<th>File</th>
									    				<td>:</td>
									    				<td><input type='file' name='file' class='form-control' required></td>
									    			</tr>
									    			<tr>
									    				<td></td>
									    				<td></td>
									    				<td align='right'><input type='submit' name='upload' class='btn btn-success' value='Upload'></td>
									    			</tr>
									    			<tr>
												    	<td colspan='3'>
												    		<table class='table table-bordered table-striped' id='example1'>
													    		<thead>
													    			<tr>
													    				<th>No</th>
													    				<th>Nama File</th>
													    				<th>Aksi</th>
													    			</tr>
													    		</thead>";
																		$no=0;
																		if($query->num_rows()>0) {
																		foreach ($query->result() as $r){
																			$no++;
													    		
													    		echo "<tr>
													    				<td>{$no}</td>
													    				<td>{$r->file_name}</td>
													    				<td>
																			<a href='".site_url().'/dokumen_member/view_dok/'.$r->file."' target='_blank' class='btn btn-info btn-xs'><i class='fa fa-search'></i></a>
													    					<a href='".site_url().'/dokumen_member/hapus/'.$r->dokumen_id."/".md5($r->perusahaan_id)."' onclick='return confirm('Yakin ingin menghapus data ?')' class='btn btn-xs btn-danger'><i class='fa fa-trash-o'></i></a></i></a>
													    				</td>
													    			</tr>";
													    				}};
												    		echo "</table>
												    	</td>
												    </tr>
									    		</table>
								    		</div>	<!-- END -->	
								    	</form>";
			}
	}


	function upload()
	{
		$member_id = $this->session->userdata('member_id');
		$perusahaan_id = $this->input->post('perusahaan');
		$rand = rand(00000,99999);
		$dokumen = $this->input->post('file');
		$file = $rand;

		$dok = $_FILES['file']['name'];

		$id = md5($perusahaan_id);

		if (isset($_POST['upload'])){
			$data =array('file' => $file,
						 'member_id' => $member_id,
						 'perusahaan_id' => $perusahaan_id,
						 'file_name' => $dok
						 );
			if($dok) {
				$explode	= explode('.',$dok);
				$ext	= $explode[count($explode)-1];
				$rand = rand(000,999);
				$name = date("Ymd").$rand.'.'.$ext;
				$unggah = $this->supermodel->unggah_dokumen('perizinan/direktori/dokumenmember','file',$name);
				if($unggah===false) {
					echo "<script>alert('Upload gagal!');document.location.href='index'</script>";
				}else{
					$data['file'] = $name;
					$jalan = $this->supermodel->insertData('direktori_member',$data);
					if ($jalan){
						echo"<script>alert('Data Berhasil di Upload');document.location.href='".site_url('dokumen_member/index/'.$id)."'</script>";
					}
				}
			}
		}
	}

	function hapus($dokumen_id,$id){
		$where = array('dokumen_id' => $dokumen_id);
		$jalan = $this->supermodel->deleteData('direktori_member',$where,$field="");
		$perusahaan_id = $this->input->post('perusahaan');
		if ($jalan){
			echo"<script>alert('Berhasil menghapus data...');document.location.href='".site_url('dokumen_member/index/'.$id)."'</script>";

		}
	}

	function refresh($id){
			$data = array('perusahaan_id' => $id);
			$data['konten'] = "izin_lingkungan/dokumen_member";
			$this->load->view('izin_lingkungan/template',$data);
	}

	function view_dok($file) {
		$data['alamat_file'] = "dokumenmember/".$file;
		$data['query'] = $this->supermodel->queryManual("SELECT * FROM direktori_member WHERE file = '".$file."'");
		$this->load->view('izin_lingkungan/vdokumen',$data);
	}



 }
?>
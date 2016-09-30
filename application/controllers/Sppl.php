<?php
/**
* Author Imam Teguh
*/
class Sppl extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_global');
		$this->load->model('supermodel');
	}

	function index()
	{
		$konfig = $this->m_global->get_konfig();

		$data['banner'] = $this->supermodel->getData('banner',array('status'=>1));
		$data['unduh'] = $this->m_global->getPostAll(array('p.status'=>1,'c.type'=>2),'p.date_publish','desc',6);
		$data['galeri'] = $this->supermodel->getData('galeri',$field='', $order='', $dasc='DESC', $limit='8');

		$data['populer'] = $this->m_global->getPostAll(array('p.status'=>1,'c.type'=>1),'p.view','desc',3);

		$data['konten'] = 'form_sppl';
		$data['category'] = array('category_id'=>'');
		$data['breadcrumb'] = "Perizinan SPPL";

		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|email');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('no_telp', 'No Telp', 'required');
		$this->form_validation->set_rules('nama_perusahaan', 'Nama Perusahaan', 'required');
		$this->form_validation->set_rules('alamat_perusahaan', 'Alamat Perusahaan', 'required');
		$this->form_validation->set_rules('syarat', 'Syarat', 'required');
		if($this->form_validation->run()===TRUE) {
			$pendaftar_id = "DP".rand(00000000,99999999);
			$in['nama'] = $this->input->post('nama');
			$in['email'] = $this->input->post('email');
			$in['alamat'] = $this->input->post('alamat');
			$in['jabatan'] = $this->input->post('jabatan');
			$in['no_telp'] = $this->input->post('no_telp');
			$in['nama_perusahaan'] = $this->input->post('nama_perusahaan');
			$in['alamat_perusahaan'] = $this->input->post('alamat_perusahaan');
			$in['no_telp_perusahaan'] = $this->input->post('telp_perusahaan');
			$in['jenis_sifat'] = $this->input->post('jenis_usaha');
			$in['kapasitas_produksi'] = $this->input->post('kapasitas');
			$in['luas_lahan'] = $this->input->post('luas');
			$in['kondisi_lahan'] = $this->input->post('kondisi');
			$in['syarat'] = $this->input->post('syarat');
			$in['id_pendaftaran'] = $pendaftar_id;
			$in['tanggal'] = date('Y-m-d');
			$sace = $this->supermodel->insertData('sppl_lama',$in);
			if($sace) {
				$this->load->library('email');
				$config['mailtype'] = 'html';
				$config['protocol'] = 'sendmail';
				$config['mailpath'] = '/usr/sbin/sendmail';
				$config['charset'] = 'utf-8';
				$this->email->initialize($config);

				// $this->email->from('bplh@kotabogor.go.id', 'BPLH Kota Bogor');
				$this->email->from('triwwanda@gmail.com', 'BPLH Kota Bogor');
				// $this->email->to($in['email']);
				$this->email->to('imam.teguh33@gmail.com');
				$this->email->subject('ID Pendaftaran Izin Online BPLH');
				$this->email->message('Permohonan anda berhasil terkirim, ini adalah ID PENDAFTARAN anda : '.$pendaftar_id.' . Anda dapat mengecek status permohonan anda dengan ID ini di website BPLH kota Bogor');
				$kirim = $this->email->send();
				if($kirim) {
					$this->session->set_flashdata('info', 'Permohonan anda berhasil terkirim, silahkan cek email anda untuk mendapatkan nomer pendaftaran dari kami.');
				} else {
					$this->session->set_flashdata('info', 'Pengiriman nomer pendaftaran gagal. Cek email anda apa sudah benar.');
				}
				redirect('sppl');
			}
		}

		$vrs = array_merge($konfig,$data);
		$this->load->vars($vrs);
		$this->load->view('template');
	}

	function cari()
	{
		$konfig = $this->m_global->get_konfig();

		$this->form_validation->set_rules('pendaftaranID', 'Id Pendaftaran','required');
		if($this->form_validation->run()===TRUE) {
			$id = $this->input->post('pendaftaranID');
			$cek = $this->supermodel->getData('sppl_lama',array('id_pendaftaran'=>$id));
			if($cek->num_rows()>0) {
				$data['unduh'] = $this->m_global->getPostAll(array('p.status'=>1,'c.type'=>2),'p.date_publish','desc',6);
				$data['galeri'] = $this->supermodel->getData('galeri',$field='', $order='', $dasc='DESC', $limit='8');

				$data['konten'] = 'sppl';
				$data['category'] = array('category_id'=>'');
				$data['breadcrumb'] = "Perizinan SPPL";
				$data['row'] = $cek->row_array();
				$data['status'] = array('Belum Di Konfirmasi','Sudah Di Konfirmasi');

				$vrs = array_merge($konfig,$data);
				$this->load->vars($vrs);
				$this->load->view('template');
			} else {
				?>
				<script>
				alert('Maaf tidak ada pendaftaran dengan id '+<?php echo $id ?>);
				window.history.go(-1);
				//document.location.href = "<?php echo site_url('sppl') ?>";
				</script>
				<?php
			}
		} else {
			redirect('sppl');
		}

	}
}
?>
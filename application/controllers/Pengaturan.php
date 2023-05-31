<?php
class Pengaturan extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('m_pegawai');
		$this->load->model('m_mesin');
	}  

	//pajak
	function pajak(){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'Setting Pajak';
		    $data['pengaturan_open'] = 'menu-open';
		    $data['pengaturan_block'] = 'style="display: block;"';
		    $data['pajak_active'] = 'class="active"';
		    $data['data'] = $this->query_builder->view("SELECT * FROM t_pajak");

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('pengaturan/pajak');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	} 
	function pajak_update($id){
		$set = array(
						'pajak_persen' => strip_tags($_POST['persen']),  
					);
		$where = ['pajak_id' => $id];
		$db = $this->query_builder->update('t_pajak',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di rubah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di rubah');
		}
		
		redirect(base_url('pengaturan/pajak'));
	}

	//backup
	function backup(){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'Backup';
		    $data['pengaturan_open'] = 'menu-open';
		    $data['pengaturan_block'] = 'style="display: block;"';
		    $data['backup_active'] = 'class="active"';

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('pengaturan/backup');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	} 
	function backup_download(){

		//load helpers
		$this->load->helper('file');
		$this->load->helper('download');
		$this->load->library('zip');

		//load database
		$this->load->dbutil();

		//create format
		$db_format=array('format'=>'zip','filename'=>'backup.sql');

		$backup=& $this->dbutil->backup($db_format);

		// file name
		$dbname = 'backup-on-'.date('d-m-y H:i').'.zip';

		// and force download
		force_download($dbname,$backup);
	}

	//logo & perusahaan
	function logo(){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'Logo';
		    $data['pengaturan_open'] = 'menu-open';
		    $data['pengaturan_block'] = 'style="display: block;"';
		    $data['logo_active'] = 'class="active"';
		    $data['data'] = $this->query_builder->view_row("SELECT * FROM t_logo");

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('pengaturan/logo');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	} 
	function logo_update($id){
		if (@$_FILES['foto']['name']) {

			//type file
			$typefile = explode('/', $_FILES['foto']['type']);

			//replace Karakter name foto
			$filename = $_FILES['foto']['name'];

			//replace name foto
			$type = explode(".", $filename);
	    	$no = count($type) - 1;
	    	$new_name = md5(time()).'.'.$type[$no];
	    	/////////////////////

		 	//config uplod foto
			  $config = array(
			  'upload_path' 	=> './assets/logo',
			  'allowed_types' 	=> "gif|jpg|png|jpeg",
			  'overwrite' 		=> TRUE,
			  'max_size' 		=> "2000",
			  'file_name'		=> $new_name,
			  );

	          	//Load upload library
	          	$this->load->library('upload',$config);
				$this->upload->do_upload('foto');

				$set = array(
								'logo_foto' => $new_name,
								'logo_nama' => strip_tags($_POST['name']),
								'logo_telp' => strip_tags($_POST['telp']),
								'logo_kota' => strip_tags($_POST['kota']),
								'logo_alamat' => strip_tags($_POST['alamat']),
							);

				$where = ['logo_id' => $id];
				$db = $this->query_builder->update('t_logo',$set,$where);

		}else{
			
			$set = array(
							'logo_nama' => strip_tags($_POST['name']),
							'logo_telp' => strip_tags($_POST['telp']),
							'logo_kota' => strip_tags($_POST['kota']),
							'logo_alamat' => strip_tags($_POST['alamat']),
						);
			$where = ['logo_id' => $id];
			$db = $this->query_builder->update('t_logo',$set,$where);	
		}

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di rubah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di rubah');
		}
		
		redirect(base_url('pengaturan/logo'));
	}

	

	//master mesin
	function mesin(){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'Mesin';
		    $data['pengaturan_open'] = 'menu-open';
		    $data['pengaturan_block'] = 'style="display: block;"';
		    $data['mesin_active'] = 'class="active"';

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('pengaturan/mesin');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	} 
	function mesin_get_data(){

		$where = array('mesin_hapus' => 0);

	    $data = $this->m_mesin->get_datatables($where);
		$total = $this->m_mesin->count_all($where);
		$filter = $this->m_mesin->count_filtered($where);

		$output = array(
			"draw" => $_GET['draw'],
			"recordsTotal" => $total,
			"recordsFiltered" => $filter,
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}
	function mesin_add(){ 

		$data['title'] = 'Mesin';
	    $data['pengaturan_open'] = 'menu-open';
	    $data['pengaturan_block'] = 'style="display: block;"';
	    $data['mesin_active'] = 'class="active"';

		$this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('pengaturan/mesin_add');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function mesin_save(){
		$set = array(
						'mesin_kode' => strip_tags($_POST['kode']),
						'mesin_nama' => strip_tags($_POST['nama']),
					);

		$db = $this->query_builder->add('t_mesin',$set);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di tambah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di tambah');
		}
		
		redirect(base_url('pengaturan/mesin'));


	}
	function mesin_edit($id){
		$data['title'] = 'Mesin';
	    $data['pengaturan_open'] = 'menu-open';
	    $data['pengaturan_block'] = 'style="display: block;"';
	    $data['mesin_active'] = 'class="active"';

	    $data['data'] = $this->query_builder->view_row("SELECT * FROM t_mesin WHERE mesin_id = '$id'");

		$this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('pengaturan/mesin_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function mesin_update($id){

		$set = array(
						'mesin_kode' => strip_tags($_POST['kode']),
						'mesin_nama' => strip_tags($_POST['nama']),
					);

		$where = ['mesin_id' => $id];
		$db = $this->query_builder->update('t_mesin',$set,$where);
		
		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di rubah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di rubah');
		}
		
		redirect(base_url('pengaturan/mesin'));
	}
	function mesin_delete($id){

		$set = ['mesin_hapus' => 1];
		$where = ['mesin_id' => $id];
		$db = $this->query_builder->update('t_mesin',$set,$where);
		
		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}
		
		redirect(base_url('pengaturan/mesin'));
	}
}
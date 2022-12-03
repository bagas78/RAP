<?php
class Logo extends CI_Controller{

	function __construct(){
		parent::__construct();
	}  
	function index(){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'Logo';
		    $data['pengaturan_open'] = 'menu-open';
		    $data['pengaturan_block'] = 'style="display: block;"';
		    $data['logo_active'] = 'class="active"';
		    $data['data'] = $this->query_builder->view_row("SELECT * FROM t_logo");

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('logo/index');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	} 
	function update($id){
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
							);

				$where = ['logo_id' => $id];
				$db = $this->query_builder->update('t_logo',$set,$where);

		}else{
			
			$set = array(
							'logo_nama' => strip_tags($_POST['name']),
						);
			$where = ['logo_id' => $id];
			$db = $this->query_builder->update('t_logo',$set,$where);	
		}

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di rubah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di rubah');
		}
		
		redirect(base_url('logo'));
	}
}
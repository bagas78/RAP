<?php
class Akun extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('m_user');
		$this->load->model('m_level');
	}    
	function admin(){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'admin';

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('akun/admin');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}
	function admin_get_data(){
		$where = array('user_hapus' => 0, 'user_level' => 0);

	    $data = $this->m_user->get_datatables($where);
		$total = $this->m_user->count_all($where);
		$filter = $this->m_user->count_filtered($where);

		$output = array(
			"draw" => $_GET['draw'],
			"recordsTotal" => $total,
			"recordsFiltered" => $filter,
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	} 
	function admin_view($id){
		$data['data'] = $this->query_builder->view_row("SELECT * FROM t_user WHERE user_id = '$id'");

		$data['title'] = 'admin';
	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('akun/admin_view');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function admin_add(){
		$data['title'] = 'admin';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('akun/admin_add');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function admin_save(){ 
		$email = strip_tags($_POST['email']);
		$cek = $this->query_builder->count("SELECT * FROM t_user WHERE user_email = '$email'");

		if (@$cek) {
			$this->session->set_flashdata('gagal','Email sudah di gunakan !!');
			redirect(base_url('akun/admin'));
		}else{
			
			$set = array(
							'user_name' => strip_tags($_POST['name']), 
							'user_email' => $email, 
							'user_password' => md5(strip_tags($_POST['password'])),
							'user_level'	=> 0, 
						);
			$db = $this->query_builder->add('t_user',$set);

			if ($db == 1) {
				$this->session->set_flashdata('success','Data berhasil di tambah');
			} else {
				$this->session->set_flashdata('gagal','Data gagal di tambah');
			}
			
			redirect(base_url('akun/admin'));
		}
	}
	function admin_edit($id){
		$data['title'] = 'admin';
	   
	    $data['data'] = $this->query_builder->view_row("SELECT * FROM t_user WHERE user_id = '$id'");

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('akun/admin_add');
	    $this->load->view('akun/admin_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function admin_update($id){
		$email = strip_tags($_POST['email']);
		$pass = strip_tags($_POST['password']);

		if ($pass == '') {
			$set = array(
						'user_name' => strip_tags($_POST['name']), 
						'user_email' => $email, 
					);
		} else {
			$set = array(
						'user_name' => strip_tags($_POST['name']), 
						'user_email' => $email,
						'user_password' => md5($password), 
					);	
		}
		
		$where = ['user_id' => $id];
		$db = $this->query_builder->update('t_user',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di rubah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di rubah');
		}
		
		redirect(base_url('akun/admin'));
	}
	function admin_delete($id){

		$user = $this->session->userdata('id');

		if ($id == $user) {
			$this->session->set_flashdata('gagal','Tidak bisa menghapus akun sendiri');
		} else {

			$set = ['user_hapus' => 1];
			$where = ['user_id' => $id];
			$db = $this->query_builder->update('t_user',$set,$where);
			
			if ($db == 1) {
				$this->session->set_flashdata('success','Data berhasil di hapus');
			} else {
				$this->session->set_flashdata('gagal','Data gagal di hapus');
			}
		}
		
		redirect(base_url('akun/admin'));
	}

	//hak akses
	function akses(){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'hak akses';

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('akun/akses');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}
	function akses_get_data(){
		$where = array('level_hapus' => 0);

	    $data = $this->m_level->get_datatables($where);
		$total = $this->m_level->count_all($where);
		$filter = $this->m_level->count_filtered($where);

		$output = array(
			"draw" => $_GET['draw'],
			"recordsTotal" => $total,
			"recordsFiltered" => $filter,
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	} 
	function akses_add(){

		$data['title'] = 'akses';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('akun/akses_add');
	    $this->load->view('v_template_admin/admin_footer');	
	}
	function akses_save(){

		$set = array(
						'level_nama' => strip_tags(@$_POST['nama']),
						'level_akses' => json_encode(@$_POST),
					);

		$db = $this->query_builder->add('t_level', $set);
		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}

		redirect(base_url('akun/akses'));
	}
	function akses_delete($id){
		$set = ['level_hapus' => 1];
		$where = ['level_id' => $id];
		$db = $this->query_builder->update('t_level',$set,$where);
		
		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}

		redirect(base_url('akun/akses'));
	}
	function akses_edit($id){

		$data['title'] = 'akses';

		$db = $this->query_builder->view_row("SELECT * FROM t_level WHERE level_id = '$id'");

		$data['data'] = json_decode($db['level_akses'], true);
		$data['id'] = $id;

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('akun/akses_add');
	    $this->load->view('akun/akses_edit');
	    $this->load->view('v_template_admin/admin_footer');	
	}
	function akses_update($id){

		$set = array(
						'level_nama' => strip_tags(@$_POST['nama']),
						'level_akses' => json_encode(@$_POST),
					);
		$where = ['level_id' => $id];

		$db = $this->query_builder->update('t_level',$set,$where);
		
		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di simpan');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di simpan');
		}

		redirect(base_url('akun/akses'));
	}

	// user akun

	function user(){

		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'hak akses';

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('akun/user');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}
	function user_get_data(){
		$where = array('user_hapus' => 0, 'user_level !=' => 0);

	    $data = $this->m_user->get_datatables($where);
		$total = $this->m_user->count_all($where);
		$filter = $this->m_user->count_filtered($where);

		$output = array(
			"draw" => $_GET['draw'],
			"recordsTotal" => $total,
			"recordsFiltered" => $filter,
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	} 
	function user_view($id){
		$data['data'] = $this->query_builder->view_row("SELECT * FROM t_user as a JOIN t_level as b ON a.user_level = b.level_id WHERE a.user_id = '$id'");

		$data['title'] = 'user';
	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('akun/user_view');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function user_add(){
		$data['title'] = 'user';

		$data['level_data'] = $this->query_builder->view("SELECT * FROM t_level WHERE level_hapus = 0");

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('akun/user_add');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function user_save(){ 
		$email = strip_tags($_POST['email']);
		$cek = $this->query_builder->count("SELECT * FROM t_user WHERE user_email = '$email'");

		if (@$cek) {
			$this->session->set_flashdata('gagal','Email sudah di gunakan !!');
			redirect(base_url('akun/admin'));
		}else{
			
			$set = array(
							'user_name' => strip_tags($_POST['name']), 
							'user_email' => $email, 
							'user_password' => md5(strip_tags($_POST['password'])),
							'user_level'	=>  strip_tags($_POST['level']), 
						);
			$db = $this->query_builder->add('t_user',$set);

			if ($db == 1) {
				$this->session->set_flashdata('success','Data berhasil di tambah');
			} else {
				$this->session->set_flashdata('gagal','Data gagal di tambah');
			}
			
			redirect(base_url('akun/user'));
		}
	}
	function user_edit($id){
		$data['title'] = 'admin';
	   
	    $data['data'] = $this->query_builder->view_row("SELECT * FROM t_user WHERE user_id = '$id'");
	    $data['level_data'] = $this->query_builder->view("SELECT * FROM t_level WHERE level_hapus = 0");

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('akun/user_add');
	    $this->load->view('akun/user_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function user_update($id){
		$email = strip_tags($_POST['email']);
		$pass = strip_tags($_POST['password']);
		$level = strip_tags($_POST['level']);

		if ($pass == '') {
			$set = array(
						'user_name' => strip_tags($_POST['name']), 
						'user_email' => $email, 
						'user_level' => $level, 
					);
		} else {
			$set = array(
						'user_name' => strip_tags($_POST['name']), 
						'user_email' => $email,
						'user_password' => md5($password), 
						'user_level' => $level, 
					);	
		}
		
		$where = ['user_id' => $id];
		$db = $this->query_builder->update('t_user',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di rubah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di rubah');
		}
		
		redirect(base_url('akun/user'));
	}
	function user_delete($id){

		$user = $this->session->userdata('id');

		if ($id == $user) {
			$this->session->set_flashdata('gagal','Tidak bisa menghapus akun sendiri');
		} else {

			$set = ['user_hapus' => 1];
			$where = ['user_id' => $id];
			$db = $this->query_builder->update('t_user',$set,$where);
			
			if ($db == 1) {
				$this->session->set_flashdata('success','Data berhasil di hapus');
			} else {
				$this->session->set_flashdata('gagal','Data gagal di hapus');
			}
		}
		
		redirect(base_url('akun/user'));
	}
}
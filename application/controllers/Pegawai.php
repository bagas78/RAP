<?php
class Pegawai extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('m_pegawai');
	}  
	function index(){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'Pegawai';
		    $data['pengaturan_open'] = 'menu-open';
		    $data['pengaturan_block'] = 'style="display: block;"';
		    $data['pegawai_active'] = 'class="active"';

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('pegawai/index');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	} 
	function view($id){
		$data['title'] = 'Pegawai';
	    $data['pengaturan_open'] = 'menu-open';
	    $data['pengaturan_block'] = 'style="display: block;"';
	    $data['pegawai_active'] = 'class="active"';

	    $data['data'] = $this->query_builder->view_row("SELECT * FROM t_user WHERE user_id = '$id'");

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('pegawai/view');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function get_data(){
		$where = array('user_hapus' => 0);

	    $data = $this->m_pegawai->get_datatables($where);
		$total = $this->m_pegawai->count_all($where);
		$filter = $this->m_pegawai->count_filtered($where);

		$output = array(
			"draw" => $_GET['draw'],
			"recordsTotal" => $total,
			"recordsFiltered" => $filter,
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}
	function add(){
		$data['title'] = 'Pegawai';
	    $data['pengaturan_open'] = 'menu-open';
	    $data['pengaturan_block'] = 'style="display: block;"';
	    $data['pegawai_active'] = 'class="active"';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('pegawai/add');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function save(){ 
		$email = strip_tags($_POST['email']);
		$cek = $this->query_builder->count("SELECT * FROM t_user WHERE user_email = '$email'");

		if (@$cek) {
			$this->session->set_flashdata('gagal','Email sudah di gunakan !!');
			redirect(base_url('pegawai'));
		}else{
			
			$set = array(
							'user_name' => strip_tags($_POST['name']), 
							'user_email' => $email, 
							'user_password' => md5(strip_tags($_POST['password'])),
							'user_level'	=> 1, 
						);
			$db = $this->query_builder->add('t_user',$set);

			if ($db == 1) {
				$this->session->set_flashdata('success','Data berhasil di tambah');
			} else {
				$this->session->set_flashdata('gagal','Data gagal di tambah');
			}
			
			redirect(base_url('pegawai'));
		}
	}
	function edit($id){
		$data['title'] = 'Pegawai';
	    $data['pengaturan_open'] = 'menu-open';
	    $data['pengaturan_block'] = 'style="display: block;"';
	    $data['pegawai_active'] = 'class="active"';

	    $data['data'] = $this->query_builder->view_row("SELECT * FROM t_user WHERE user_id = '$id'");

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('pegawai/edit');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function update($id){
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
		
		redirect(base_url('pegawai'));
	}
	function delete($id){

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
		
		redirect(base_url('pegawai'));
	}
}
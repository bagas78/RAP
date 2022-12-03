<?php
class Dashboard extends CI_Controller{

	function __construct(){
		parent::__construct(); 
	} 
	function index(){
		if ( $this->session->userdata('login') == 1) { 
			
			$data['dashboard'] = 'class="active"';
		    $data['title'] = 'Dashboard';
		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('dashboard/dashboard');
 
		}
		else{
			redirect(base_url('login'));
		}
	} 
	function edit(){
		$set = array(
						'informasi_user' => $this->session->userdata('id'),
						'informasi_mata_kuliah' => $_POST['informasi_mata_kuliah'],
						'informasi_sks' => $_POST['informasi_sks'],
						'informasi_deskripsi' => $_POST['informasi_deskripsi'],
						'informasi_relevansi' => $_POST['informasi_relevansi'], 
					);

		$where = ['informasi_id' => 1];
		$db = $this->query_builder->update('t_informasi',$set,$where);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berujian_pilihan_hasil di edit');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di edit');
		}

		redirect(base_url('dashboard'));
	}
}
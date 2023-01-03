<?php
class Dashboard extends CI_Controller{

	function __construct(){
		parent::__construct(); 
	} 
	function index(){
		if ( $this->session->userdata('login') == 1) { 
			
			$data['title'] = 'Dashboard';
		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('dashboard/dashboard');
 			$this->load->view('v_template_admin/admin_footer');
		}
		else{
			redirect(base_url('login'));
		}
	} 
}
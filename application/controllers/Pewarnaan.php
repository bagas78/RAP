<?php
class Pewarnaan extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('m_kontak');
	}  
	function index(){
		$data['title'] = 'Supplier';
		$data['jenis'] = 's';
	    $data['supplier_active'] = 'class="active"';
	    $data['kontak_open'] = 'menu-open';
	    $data['kontak_block'] = 'style="display: block;"';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('kontak/index');
	    $this->load->view('v_template_admin/admin_footer');
	}
}
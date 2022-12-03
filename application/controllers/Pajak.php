<?php
class Pajak extends CI_Controller{

	function __construct(){
		parent::__construct();
	}  
	function index(){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'Setting Pajak';
		    $data['pengaturan_open'] = 'menu-open';
		    $data['pengaturan_block'] = 'style="display: block;"';
		    $data['pajak_active'] = 'class="active"';
		    $data['data'] = $this->query_builder->view("SELECT * FROM t_pajak");

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('pajak/index');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	} 
	function update($id){
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
		
		redirect(base_url('pajak'));
	}
}
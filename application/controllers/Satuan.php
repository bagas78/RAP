<?php
class Satuan extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('m_satuan');
	}  
	function index(){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'Satuan';

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('satuan/index');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	} 
	function get_data(){

		$where = array('satuan_hapus' => 0);

	    $data = $this->m_satuan->get_datatables($where);
		$total = $this->m_satuan->count_all($where);
		$filter = $this->m_satuan->count_filtered($where);

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

		$data['title'] = 'Satuan';

		$this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('satuan/add');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function save(){
		$set = array(
						'satuan_kepanjangan' => strip_tags($_POST['kepanjangan']),
						'satuan_singkatan' => strip_tags($_POST['singkatan']),
					);

		$db = $this->query_builder->add('t_satuan',$set);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di tambah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di tambah');
		}
		
		redirect(base_url('satuan'));


	}
	function edit($id){
		$data['title'] = 'Satuan';

	    $data['data'] = $this->query_builder->view_row("SELECT * FROM t_satuan WHERE satuan_id = '$id'");

		$this->load->view('v_template_admin/admin_header',$data);
		$this->load->view('satuan/add');
	    $this->load->view('satuan/edit');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function update($id){

		$set = array(
						'satuan_kepanjangan' => strip_tags($_POST['kepanjangan']),
						'satuan_singkatan' => strip_tags($_POST['singkatan']),
					);

		$where = ['satuan_id' => $id];
		$db = $this->query_builder->update('t_satuan',$set,$where);
		
		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di rubah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di rubah');
		}
		
		redirect(base_url('satuan'));
	}
	function delete($id){

		$set = ['satuan_hapus' => 1];
		$where = ['satuan_id' => $id];
		$db = $this->query_builder->update('t_satuan',$set,$where);
		
		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}
		
		redirect(base_url('satuan'));
	}
}
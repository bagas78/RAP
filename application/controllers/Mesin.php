<?php
class Mesin extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('m_mesin');
	}  
	function index(){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'Mesin';
		    $data['pengaturan_open'] = 'menu-open';
		    $data['pengaturan_block'] = 'style="display: block;"';
		    $data['mesin_active'] = 'class="active"';

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('mesin/index');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	} 
	function get_data(){

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
	function add(){ 

		$data['title'] = 'Mesin';
	    $data['pengaturan_open'] = 'menu-open';
	    $data['pengaturan_block'] = 'style="display: block;"';
	    $data['mesin_active'] = 'class="active"';

		$this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('mesin/add');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function save(){
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
		
		redirect(base_url('mesin'));


	}
	function edit($id){
		$data['title'] = 'Mesin';
	    $data['pengaturan_open'] = 'menu-open';
	    $data['pengaturan_block'] = 'style="display: block;"';
	    $data['mesin_active'] = 'class="active"';

	    $data['data'] = $this->query_builder->view_row("SELECT * FROM t_mesin WHERE mesin_id = '$id'");

		$this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('mesin/edit');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function update($id){

		$set = array(
						'mesin_kode' => strip_tags($_POST['kode']),
						'mesin_nama' => strip_tags($_POST['nama']),
					);

		$where = ['mesin_id' => $id];
		$db = $this->query_builder->update('t_mesin',$set,$where);
		
		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}
		
		redirect(base_url('mesin'));
	}
	function delete($id){

		$set = ['mesin_hapus' => 1];
		$where = ['mesin_id' => $id];
		$db = $this->query_builder->update('t_mesin',$set,$where);
		
		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}
		
		redirect(base_url('mesin'));
	}
}
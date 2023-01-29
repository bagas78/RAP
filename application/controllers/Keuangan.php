<?php
class Keuangan extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('m_jurnal');
	}  
	function coa(){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'coa';
		    $data['data'] = $this->query_builder->view("SELECT * FROM t_coa as a JOIN t_coa_sub as b ON a.coa_sub = b.coa_sub_id");

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('keuangan/coa');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	} 
	function buku_besar($akun = ''){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'buku besar';
		    $data['data'] = $this->query_builder->view("SELECT * FROM t_jurnal as a JOIN t_coa as b ON a.jurnal_akun = b.coa_id");
		    $data['coa_data'] = $this->query_builder->view("SELECT * FROM t_coa");

		    //get first akun
		    $coa = $this->query_builder->view_row("SELECT * FROM t_coa ORDER BY coa_id ASC LIMIT 1");

		    if ($akun == '') {
		    	$data['akun'] = $coa['coa_id'];
		    } else {
		    	$data['akun'] = $akun;	
		    }

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('keuangan/jurnal');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}
	function buku_besar_get_data($akun){
		$where = array('jurnal_akun' => $akun);

	    $data = $this->m_jurnal->get_datatables($where);
		$total = $this->m_jurnal->count_all($where);
		$filter = $this->m_jurnal->count_filtered($where);

		$output = array(
			"draw" => $_GET['draw'],
			"recordsTotal" => $total,
			"recordsFiltered" => $filter,
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}
}
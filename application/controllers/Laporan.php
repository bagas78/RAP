<?php
class Laporan extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('m_bahan');
		$this->load->model('m_produk');
	}  
	function serverside($where,$model){
	    $data = $this->$model->get_datatables($where);
		$total = $this->$model->count_all($where);
		$filter = $this->$model->count_filtered($where);

		$output = array(
			"draw" => $_GET["draw"],
			"recordsTotal" => $total,
			"recordsFiltered" => $filter,
			"data" => $data,
		);

		return $output;
	}
	/////////////////////////////////////////////////////////////

	function stok_bahan(){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'laporan';

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('laporan/bahan');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}
	function get_bahan_data(){

		$model = 'm_bahan';
		$where = array('bahan_hapus' => 0);
		$output = $this->serverside($where, $model);
		echo json_encode($output);
	}
	function stok_produk(){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'laporan';

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('laporan/produk');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}
	function get_produk_data(){

		$model = 'm_produk';
		$where = array('master_produk_hapus' => 0);
		$output = $this->serverside($where, $model);
		echo json_encode($output);
	}
	function produksi(){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'laporan';

		    $filter = @$_POST['filter'];

		    if ($filter) {
		    	$data['data'] = $this->query_builder->view("SELECT * FROM t_produksi as a JOIN t_user as b ON a.produksi_shift = b.user_id WHERE a.produksi_hapus = 0 AND a.produksi_tanggal = '$filter'");
		    }else{
		    	$dt = date('Y-m-d');
		    	$data['data'] = $this->query_builder->view("SELECT * FROM t_produksi as a JOIN t_user as b ON a.produksi_shift = b.user_id WHERE a.produksi_hapus = 0 AND a.produksi_tanggal = '$dt'");
		    }

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('laporan/produksi');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}
}
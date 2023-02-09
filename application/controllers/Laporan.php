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
		    	$data['data'] = $this->query_builder->view("SELECT * FROM t_produksi as a JOIN t_user as b ON a.produksi_shift = b.user_id WHERE a.produksi_hapus = 0 AND a.produksi_status = 3 AND a.produksi_tanggal = '$filter'");
		    }else{
		    	$dt = date('Y-m-d');
		    	$data['data'] = $this->query_builder->view("SELECT * FROM t_produksi as a JOIN t_user as b ON a.produksi_shift = b.user_id WHERE a.produksi_hapus = 0 AND a.produksi_status = 3 AND a.produksi_tanggal = '$dt'");
		    }

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('laporan/produksi');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}
	function po_pembelian(){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'laporan';

		    $filter = @$_POST['filter'];
		    $status = @$_POST['status'];

		    if ($filter) {
		    	$data['data'] = $this->query_builder->view("SELECT * FROM t_pembelian WHERE pembelian_hapus = 0 AND pembelian_po_tanggal = '$filter' AND pembelian_status = '$status'");
		    }else{
		    	$dt = date('Y-m-d');
		    	$data['data'] = $this->query_builder->view("SELECT * FROM t_pembelian WHERE pembelian_hapus = 0 AND pembelian_po_tanggal = '$dt'");
		    }

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('laporan/po_pembelian');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}
	function pembelian(){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'laporan';

		    $filter = @$_POST['filter'];
		    $status = @$_POST['status'];
		    $kategori = @$_POST['kategori'];

		    if ($filter) {
		    	$data['data'] = $this->query_builder->view("SELECT * FROM t_pembelian WHERE pembelian_hapus = 0 AND pembelian_po = 0 AND pembelian_tanggal = '$filter' AND pembelian_status = '$status' AND pembelian_kategori = '$kategori'");
		    }else{
		    	$dt = date('Y-m-d');
		    	$data['data'] = $this->query_builder->view("SELECT * FROM t_pembelian WHERE pembelian_hapus = 0 AND pembelian_po = 0 AND pembelian_tanggal = '$dt'");
		    }

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('laporan/pembelian');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}
	function pelunasan_hutang(){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'laporan';

		    $filter = @$_POST['filter'];
		    $kategori = @$_POST['kategori'];

		    if ($filter) {
		    	$data['data'] = $this->query_builder->view("SELECT * FROM t_pembelian WHERE pembelian_hapus = 0 AND pembelian_pelunasan = '$filter' AND pembelian_kategori = '$kategori'");
		    }else{
		    	$dt = date('Y-m-d');
		    	$data['data'] = $this->query_builder->view("SELECT * FROM t_pembelian WHERE pembelian_hapus = 0 AND pembelian_pelunasan = '$dt'");
		    }

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('laporan/pelunasan_hutang');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}
	function hutang_jatuh_tempo(){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'laporan';

		    $dt = date('Y-m-d');
		    $kategori = @$_POST['kategori'];

		    if ($kategori) {
		    	$data['data'] = $this->query_builder->view("SELECT * FROM t_pembelian WHERE pembelian_hapus = 0 AND pembelian_po = 0 AND pembelian_status = 'b' AND pembelian_jatuh_tempo < '$dt' AND pembelian_kategori = '$kategori'");
		    }else{
		    	$data['data'] = $this->query_builder->view("SELECT * FROM t_pembelian WHERE pembelian_hapus = 0 AND pembelian_po = 0 AND pembelian_status = 'b' AND pembelian_jatuh_tempo < '$dt'");
		    }

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('laporan/hutang_jatuh_tempo');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}
	function po_penjualan(){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'laporan';

		    $filter = @$_POST['filter'];
		    $status = @$_POST['status'];

		    if ($filter) {
		    	$data['data'] = $this->query_builder->view("SELECT * FROM t_penjualan WHERE penjualan_hapus = 0 AND penjualan_po_tanggal = '$filter' AND penjualan_status = '$status'");
		    }else{
		    	$dt = date('Y-m-d');
		    	$data['data'] = $this->query_builder->view("SELECT * FROM t_penjualan WHERE penjualan_hapus = 0 AND penjualan_po_tanggal = '$dt'");
		    }

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('laporan/penjualan');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}
	function penjualan(){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'laporan';

		    $filter = @$_POST['filter'];
		    $status = @$_POST['status'];

		    if ($filter) {
		    	$data['data'] = $this->query_builder->view("SELECT * FROM t_penjualan WHERE penjualan_hapus = 0 AND penjualan_po = 0 AND penjualan_tanggal = '$filter' AND penjualan_status = '$status'");
		    }else{
		    	$dt = date('Y-m-d');
		    	$data['data'] = $this->query_builder->view("SELECT * FROM t_penjualan WHERE penjualan_hapus = 0 AND penjualan_po = 0 AND penjualan_tanggal = '$dt'");
		    }

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('laporan/penjualan');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}
	function pelunasan_piutang(){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'laporan';

		    $filter = @$_POST['filter'];

		    if ($filter) {
		    	$data['data'] = $this->query_builder->view("SELECT * FROM t_penjualan WHERE penjualan_hapus = 0 AND penjualan_po = 0 AND penjualan_pelunasan = '$filter'");
		    }else{
		    	$dt = date('Y-m-d');
		    	$data['data'] = $this->query_builder->view("SELECT * FROM t_penjualan WHERE penjualan_hapus = 0 AND penjualan_po = 0 AND penjualan_pelunasan = '$dt'");
		    }

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('laporan/pelunasan_piutang');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}
	function piutang_jatuh_tempo(){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'laporan';

		    $dt = date('Y-m-d');
		    $data['data'] = $this->query_builder->view("SELECT * FROM t_penjualan WHERE penjualan_hapus = 0 AND penjualan_po = 0 AND penjualan_status = 'b' AND penjualan_jatuh_tempo < '$dt'");

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('laporan/piutang_jatuh_tempo');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}
	function packing(){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'laporan';

		    $filter = @$_POST['filter'];
		    $status = @$_POST['status'];

		    if ($filter) {
		    	$data['data'] = $this->query_builder->view("SELECT * FROM t_penjualan WHERE penjualan_hapus = 0 AND penjualan_packing = '$filter' AND penjualan_status = '$status'");
		    }else{
		    	$dt = date('Y-m-d');
		    	$data['data'] = $this->query_builder->view("SELECT * FROM t_penjualan WHERE penjualan_hapus = 0 AND penjualan_packing = '$dt'");
		    }

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('laporan/packing');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}
	function kirim(){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'laporan';

		    $filter = @$_POST['filter'];
		    $status = @$_POST['status'];

		    if ($filter) {
		    	$data['data'] = $this->query_builder->view("SELECT * FROM t_penjualan WHERE penjualan_hapus = 0 AND penjualan_pengiriman = '$filter' AND penjualan_status = '$status'");
		    }else{
		    	$dt = date('Y-m-d');
		    	$data['data'] = $this->query_builder->view("SELECT * FROM t_penjualan WHERE penjualan_hapus = 0 AND penjualan_pengiriman = '$dt'");
		    }

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('laporan/kirim');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('kirim'));
		}
	}
}
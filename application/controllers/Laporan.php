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
		    $this->load->view('laporan/stok_produk');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}
	function get_produk_data(){

		$model = 'm_produk';
		$where = array('produk_hapus' => 0);
		$output = $this->serverside($where, $model);
		echo json_encode($output);
	}
	function produksi(){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'laporan';

		    if (@$_POST['filter']) {
		    	
		    	$filter = @$_POST['filter'];
		    }else{

		    	$filter = date('Y-m-d');
		    }

		    $data['data'] = $this->query_builder->view("SELECT * FROM t_produksi as a JOIN t_user as b ON a.produksi_shift = b.user_id WHERE a.produksi_hapus = 0 AND a.produksi_tanggal = '$filter'");

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

		    if (@$_POST['filter']) {
		    	
		    	$filter = @$_POST['filter'];
		    }else{

		    	$filter = date('Y-m-d');
		    }
		     $data['data'] = $this->query_builder->view("SELECT pembelian_po_tanggal AS tanggal ,pembelian_nomor AS nomor, pembelian_total AS total, pembelian_status AS status, 'Pembelian Bahan' AS kategori FROM t_pembelian WHERE pembelian_po_tanggal = '$filter' AND pembelian_hapus = 0");

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

		    if (@$_POST['filter']) {
		    	
		    	$filter = @$_POST['filter'];
		    }else{

		    	$filter = date('Y-m-d');
		    }

		    $data['data'] = $this->query_builder->view("SELECT pembelian_tanggal AS tanggal ,pembelian_nomor AS nomor, pembelian_total AS total, pembelian_status AS status, 'Pembelian Bahan' AS kategori FROM t_pembelian WHERE pembelian_tanggal = '$filter' AND pembelian_hapus = 0 UNION ALL SELECT pembelian_umum_tanggal AS tanggal ,pembelian_umum_nomor AS nomor, pembelian_umum_total AS total, pembelian_umum_status AS status, 'Pembelian Umum' AS kategori FROM t_pembelian_umum WHERE pembelian_umum_tanggal = '$filter' AND pembelian_umum_hapus = 0");

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

		    if (@$_POST['filter']) {
		    	
		    	$filter = @$_POST['filter'];
		    }else{

		    	$filter = date('Y-m-d');
		    }

		    $data['data'] = $this->query_builder->view("SELECT pembelian_tanggal AS tanggal ,pembelian_nomor AS nomor, pembelian_total AS total, pembelian_status AS status, 'Pembelian Bahan' AS kategori FROM t_pembelian WHERE pembelian_pelunasan = '$filter' AND pembelian_hapus = 0 UNION ALL SELECT pembelian_umum_tanggal AS tanggal ,pembelian_umum_nomor AS nomor, pembelian_umum_total AS total, pembelian_umum_status AS status, 'Pembelian Umum' AS kategori FROM t_pembelian_umum WHERE pembelian_umum_pelunasan = '$filter' AND pembelian_umum_hapus = 0");

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

		    $filter = date('Y-m-d');

		    $data['data'] = $this->query_builder->view("SELECT pembelian_jatuh_tempo AS tanggal ,pembelian_nomor AS nomor, pembelian_total AS total, pembelian_status AS status, 'Pembelian Bahan' AS kategori FROM t_pembelian WHERE pembelian_hapus = 0 AND pembelian_po = 0 AND pembelian_status = 'belum' AND pembelian_jatuh_tempo < '$filter' UNION ALL SELECT pembelian_umum_jatuh_tempo AS tanggal ,pembelian_umum_nomor AS nomor, pembelian_umum_total AS total, pembelian_umum_status AS status, 'Pembelian Umum' AS kategori FROM t_pembelian_umum WHERE pembelian_umum_hapus = 0 AND pembelian_umum_status = 'belum' AND pembelian_umum_jatuh_tempo < '$filter'");

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('laporan/hutang_jatuh_tempo');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}
	function penjualan(){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'laporan';

		    if (@$_POST['filter']) {
		    	
		    	$filter = @$_POST['filter'];
		    }else{

		    	$filter = date('Y-m-d');
		    }

		    $data['data'] = $this->query_builder->view("SELECT * FROM t_penjualan WHERE penjualan_hapus = 0 AND penjualan_po = 0 AND penjualan_tanggal = '$filter'");

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

		    if (@$_POST['filter']) {
		    	
		    	$filter = @$_POST['filter'];
		    }else{

		    	$filter = date('Y-m-d');
		    }

		    $data['data'] = $this->query_builder->view("SELECT * FROM t_penjualan WHERE penjualan_hapus = 0 AND penjualan_po = 0 AND penjualan_pelunasan = '$filter'");

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

		    $filter = date('Y-m-d');
		    $data['data'] = $this->query_builder->view("SELECT * FROM t_penjualan WHERE penjualan_hapus = 0 AND penjualan_po = 0 AND penjualan_status = 'belum' AND penjualan_jatuh_tempo < '$filter'");

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

		    if (@$_POST['filter']) {
		    	
		    	$filter = @$_POST['filter'];
		    }else{

		    	$filter = date('Y-m-d');
		    }

		    $data['data'] = $this->query_builder->view("SELECT * FROM t_packing as a JOIN t_packing_barang as b ON a.packing_nomor = b.packing_barang_nomor JOIN t_produk as c ON b.packing_barang_barang = c.produk_id WHERE a.packing_hapus = 0 AND a.packing_tanggal = '$filter'");

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('laporan/packing');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}
}
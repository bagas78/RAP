<?php
class Laporan extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('m_bahan');
		$this->load->model('m_produk');
		$this->load->model('m_produk_barang');
		$this->load->model('m_produk_packing');
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
	function get_produk_data($filter){

		if ($filter == 'mf') {
			$v = 'produk_barang_warna =';
			$f = 0;
		}else{
			$v = 'produk_barang_warna !=';
			$f = 0;
		}

		$model = 'm_produk_barang';
		$where = array('produk_hapus' => 0, $v => $f);
		$output = $this->serverside($where, $model);
		echo json_encode($output);
	}
	function get_produk_packing(){

		$model = 'm_produk_packing';
		$where = array('packing_hapus' => 0);
		$output = $this->serverside($where, $model);
		echo json_encode($output);
	}
	function produksi(){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'laporan';
		    $filter1 = @$_POST['filter1'];
		    $filter2 = @$_POST['filter2'];

		    if (@$filter1) {
		    	
		    	$date1 = $filter1;
		    	$date2 = $filter2;

		    }else{

		    	$date1 = date('Y-m-d');
		    	$date2 = date('Y-m-d');
		    }

		    $data['data'] = $this->query_builder->view("SELECT * FROM t_produksi as a JOIN t_user as b ON a.produksi_shift = b.user_id JOIN t_produksi_barang AS c ON a.produksi_nomor = c.produksi_barang_nomor JOIN t_produk AS d ON c.produksi_barang_barang = d.produk_id LEFT JOIN t_satuan AS e ON d.produk_satuan = e.satuan_id WHERE a.produksi_hapus = 0 AND a.produksi_tanggal BETWEEN '$date1' AND '$date2'");

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
	function pembelian($jenis = ''){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'laporan';
		    $filter1 = @$_POST['filter1'];
		    $filter2 = @$_POST['filter2'];

		    if ($filter1) {
		    	
		    	$date1 = $filter1;
		    	$date2 = $filter2;

		    }else{

		    	$date1 = date('Y-m-d');
		    	$date2 = date('Y-m-d');
		    }

		    if (@$jenis) {
		    	
		    	$data['active'] = $jenis;
		    	$j = $jenis;

		    }else{

		    	$data['active'] = 'bahan';
		    	$j = 'bahan';
		    }

		    if ($j == 'bahan') {
		    	
		    	$data['data'] = $this->query_builder->view("SELECT a.pembelian_tanggal AS tanggal, c.kontak_nama AS supplier, d.bahan_nama AS barang, b.pembelian_barang_qty AS qty, b.pembelian_barang_potongan AS potongan, b.pembelian_barang_harga AS harga, b.pembelian_barang_subtotal AS subtotal FROM t_pembelian AS a JOIN t_pembelian_barang AS b ON a.pembelian_nomor = b.pembelian_barang_nomor LEFT JOIN t_kontak AS c ON a.pembelian_supplier = c.kontak_id LEFT JOIN t_bahan AS d ON b.pembelian_barang_barang = d.bahan_id WHERE pembelian_hapus = 0 AND a.pembelian_status = 'lunas' AND pembelian_tanggal BETWEEN '$date1' AND '$date2'");		
		    }else{

		    	$data['data'] = $this->query_builder->view("SELECT a.pembelian_umum_tanggal AS tanggal, '-' AS supplier, b.pembelian_umum_barang_barang AS barang, b.pembelian_umum_barang_qty AS qty, b.pembelian_umum_barang_potongan AS potongan, b.pembelian_umum_barang_harga AS harga, b.pembelian_umum_barang_subtotal AS subtotal FROM t_pembelian_umum AS a JOIN t_pembelian_umum_barang AS b ON a.pembelian_umum_nomor = b.pembelian_umum_barang_nomor WHERE a.pembelian_umum_hapus = 0 AND a.pembelian_umum_status = 'lunas' AND pembelian_umum_tanggal BETWEEN '$date1' AND '$date2'");
		    }

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('laporan/pembelian');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}
	function pelunasan_hutang($jenis = ''){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'laporan';

		    if (@$_POST['filter']) {
		    	
		    	$filter = @$_POST['filter'];
		    }else{

		    	$filter = date('Y-m-d');
		    }

		    //jenis
		    if (@$jenis) {
		    	
		    	$data['active'] = $jenis;
		    	$j = $jenis;

		    }else{

		    	$data['active'] = 'bahan';
		    	$j = 'bahan';
		    }

		    if ($j == 'bahan') {
		    
		    	$data['data'] = $this->query_builder->view("SELECT b.kontak_nama as supplier, a.pembelian_tanggal AS tanggal ,a.pembelian_nomor AS nomor, a.pembelian_total AS total, a.pembelian_status AS status FROM t_pembelian as a JOIN t_kontak as b ON a.pembelian_supplier = b.kontak_id WHERE a.pembelian_pelunasan = '$filter' AND a.pembelian_hapus = 0");

		    }else{

		    	$data['data'] = $this->query_builder->view("SELECT '-' as supplier ,pembelian_umum_tanggal AS tanggal ,pembelian_umum_nomor AS nomor, pembelian_umum_total AS total, pembelian_umum_status AS status FROM t_pembelian_umum WHERE pembelian_umum_pelunasan = '$filter' AND pembelian_umum_hapus = 0");

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
		    $filter1 = @$_POST['filter1'];
		    $filter2 = @$_POST['filter2'];

		    if ($filter1) {
		    	
		    	$date1 = $filter1;
		    	$date2 = $filter2;

		    }else{

		    	$date1 = date('Y-m-d');
		    	$date2 = date('Y-m-d');
		    }

		    $data['data'] = $this->query_builder->view("SELECT * FROM t_penjualan AS a JOIN t_penjualan_barang AS b ON a.penjualan_nomor = b.penjualan_barang_nomor LEFT JOIN t_kontak AS c ON a.penjualan_pelanggan = c.kontak_id LEFT JOIN t_produk AS d ON b.penjualan_barang_barang = d.produk_id WHERE a.penjualan_hapus = 0 AND a.penjualan_po = 0 AND a.penjualan_status = 'lunas' AND a.penjualan_tanggal BETWEEN '$date1' AND '$date2'");

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
		    $filter1 = @$_POST['filter1'];
		    $filter2 = @$_POST['filter2'];

		    if ($filter1) {
		    	
		    	$date1 = $filter1;
		    	$date2 = $filter2;

		    }else{

		    	$date1 = date('Y-m-d');
		    	$date2 = date('Y-m-d');
		    }

		    $data['data'] = $this->query_builder->view("SELECT * FROM t_packing as a JOIN t_packing_barang as b ON a.packing_nomor = b.packing_barang_nomor JOIN t_produk as c ON b.packing_barang_barang = c.produk_id JOIN t_warna_jenis AS d ON b.packing_barang_jenis = d.warna_jenis_id JOIN t_warna AS e ON b.packing_barang_warna = e.warna_id WHERE a.packing_hapus = 0 AND a.packing_tanggal BETWEEN '$date1' AND '$date2'");

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('laporan/packing');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}
	function pewarnaan(){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'laporan';
		    $filter1 = @$_POST['filter1'];
		    $filter2 = @$_POST['filter2'];

		    if ($filter1) {
		    	
		    	$date1 = $filter1;
		    	$date2 = $filter2;

		    }else{

		    	$date1 = date('Y-m-d');
		    	$date2 = date('Y-m-d');
		    }

		    $data['data'] = $this->query_builder->view("SELECT * FROM t_pewarnaan AS a JOIN t_pewarnaan_barang AS b ON a.pewarnaan_nomor = b.pewarnaan_barang_nomor LEFT JOIN t_produk AS c ON b.pewarnaan_barang_barang = c.produk_id LEFT JOIN t_warna AS d ON b.pewarnaan_barang_warna = d.warna_id WHERE a.pewarnaan_hapus = 0 AND a.pewarnaan_tanggal BETWEEN '$date1' AND '$date2'");

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('laporan/pewarnaan');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}
}
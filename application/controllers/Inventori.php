<?php
class Inventori extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('m_penyesuaian');
	}  
	function opname_penjualan(){
		$data['title'] = 'Opname Penjualan';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('inventori/opname_penjualan');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function opname_get_penjualan(){
		$tanggal = strip_tags($_POST['tanggal']);
 
		//penjualan
		$data = $this->query_builder->view("SELECT d.produk_kode AS kode, d.produk_nama AS nama, e.satuan_singkatan AS satuan, a.penjualan_barang_harga AS harga, a.penjualan_barang_hps AS hps ,a.penjualan_barang_stok AS stok, a.penjualan_barang_qty AS qty FROM t_penjualan_barang AS a JOIN t_penjualan AS b ON a.penjualan_barang_nomor = b.penjualan_nomor JOIN t_produk_barang AS c ON c.produk_barang_barang = a.penjualan_barang_barang AND c.produk_barang_jenis = a.penjualan_barang_jenis AND c.produk_barang_warna = a.penjualan_barang_warna JOIN t_produk AS d ON c.produk_barang_barang = d.produk_id JOIN t_satuan AS e ON d.produk_satuan = e.satuan_id WHERE b.penjualan_tanggal = '$tanggal'");

		echo json_encode($data);
	}
	function opname_pembelian(){
		$data['title'] = 'Opname Pembelian';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('inventori/opname_pembelian');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function opname_get_pembelian(){
		$tanggal = strip_tags($_POST['tanggal']);
 
		//penjualan
		$data = $this->query_builder->view("SELECT c.bahan_kode AS kode, c.bahan_nama AS nama, d.satuan_singkatan AS satuan, a.pembelian_barang_harga AS harga ,a.pembelian_barang_stok AS stok, a.pembelian_barang_qty AS qty FROM t_pembelian_barang AS a JOIN t_pembelian AS b ON a.pembelian_barang_nomor = b.pembelian_nomor JOIN t_bahan AS c ON c.bahan_id = a.pembelian_barang_barang JOIN t_satuan AS d ON c.bahan_satuan = d.satuan_id WHERE b.pembelian_tanggal = '$tanggal'");

		echo json_encode($data);
	}
	function penyesuaian(){

		$data['title'] = 'Penyesuaian Stok';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('inventori/penyesuaian');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function penyesuaian_get_data(){
		$where = array('penyesuaian_hapus' => 0);

	    $data = $this->m_penyesuaian->get_datatables($where);
		$total = $this->m_penyesuaian->count_all($where);
		$filter = $this->m_penyesuaian->count_filtered($where);

		$output = array(
			"draw" => $_GET['draw'],
			"recordsTotal" => $total,
			"recordsFiltered" => $filter,
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}
	function penyesuaian_add(){

		//generate nomor
	    $nomor = $this->query_builder->count("SELECT * FROM t_penyesuaian");
	    $data['nomor'] = 'PN00'.($nomor+1);

	    //atribut
	    $jenis = @$_POST['jenis'];
	    $data['jenis'] = $jenis;
	    $data['transaksi'] = @$_POST['transaksi'];
	    $data['kategori'] = @$_POST['kategori'];
	    $data['tanggal'] = @$_POST['tanggal'];

	    //barang
	    if ($jenis == 'pembelian') {
	    	
	    	$data['barang_data'] = $this->query_builder->view("SELECT bahan_id AS id, bahan_nama AS nama FROM t_bahan WHERE bahan_hapus = 0");	
	    }else{


	    }

		$data['title'] = 'Penyesuaian Stok';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('inventori/penyesuaian_'.$jenis);
	    $this->load->view('v_template_admin/admin_footer');		
	}
	function penyesuaian_get($jenis, $id){

		//barang
	    if ($jenis == 'pembelian') {
	    	
	    	$data = $this->query_builder->view("SELECT bahan_id AS id, bahan_nama AS nama, bahan_stok as stok, satuan_singkatan as satuan FROM t_bahan as a JOIN t_satuan as b ON a.bahan_satuan = b.satuan_id WHERE a.bahan_id = '$id'");	
	    }else{


	    }

	    echo json_encode($data);
	}
	function penyesuaian_save(){
		
	}
}
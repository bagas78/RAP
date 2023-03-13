<?php
class Inventori extends CI_Controller{

	function __construct(){
		parent::__construct();
	}  
	function opname_penjualan(){
		$data['title'] = 'Supplier';

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
		$data['title'] = 'Supplier';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('inventori/opname_pembelian');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function opname_get_pembelian(){
		$tanggal = strip_tags($_POST['tanggal']);
 
		//penjualan
		$data = $this->query_builder->view("SELECT d.produk_kode AS kode, d.produk_nama AS nama, e.satuan_singkatan AS satuan, a.penjualan_barang_harga AS harga, a.penjualan_barang_hps AS hps ,a.penjualan_barang_stok AS stok, a.penjualan_barang_qty AS qty FROM t_penjualan_barang AS a JOIN t_penjualan AS b ON a.penjualan_barang_nomor = b.penjualan_nomor JOIN t_produk_barang AS c ON c.produk_barang_barang = a.penjualan_barang_barang AND c.produk_barang_jenis = a.penjualan_barang_jenis AND c.produk_barang_warna = a.penjualan_barang_warna JOIN t_produk AS d ON c.produk_barang_barang = d.produk_id JOIN t_satuan AS e ON d.produk_satuan = e.satuan_id WHERE b.penjualan_tanggal = '$tanggal'");

		echo json_encode($data);
	}
}
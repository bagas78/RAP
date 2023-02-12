<?php
class Inventori extends CI_Controller{

	function __construct(){
		parent::__construct();
	}  
	function opname(){
		$data['title'] = 'Supplier';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('inventori/opname');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function opname_get(){
		$jenis = strip_tags($_POST['jenis']);
		$tanggal = strip_tags($_POST['tanggal']);

		if ($jenis == 'penjualan') {
			
			//penjualan
			$data = $this->query_builder->view("SELECT * FROM t_penjualan AS a JOIN t_penjualan_barang AS b ON a.penjualan_nomor = b.penjualan_barang_nomor JOIN t_master_produk AS c ON b.penjualan_barang_barang = c.master_produk_id JOIN t_satuan as d ON d.satuan_id = c.master_produk_satuan WHERE a.penjualan_hapus = 0");

		}else{

		}

		echo json_encode($data);
	}
}
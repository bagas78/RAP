<?php
class Dashboard extends CI_Controller{

	function __construct(){
		parent::__construct(); 
	} 
	function index(){
		if ( $this->session->userdata('login') == 1) { 

			$tahun = date('Y');

			if (@$_POST['filter'] == 2) {
				//filter
				$data['filter'] = 2;

				//bulanan
				$data['pembelian_data'] = $this->query_builder->view("SELECT SUM(pembelian_total) AS total, DATE_FORMAT(pembelian_tanggal, '%Y') AS tahun, REPLACE(DATE_FORMAT(pembelian_tanggal, '%d'), '0','') AS tanggal, REPLACE(DATE_FORMAT(pembelian_tanggal, '%m'), '0','') AS bulan FROM t_pembelian WHERE pembelian_hapus = 0 AND DATE_FORMAT(pembelian_tanggal, '%Y') = '$tahun' GROUP BY DATE_FORMAT(pembelian_tanggal, '%m')");

				//produksi
				$data['produksi_data'] = $this->query_builder->view("SELECT SUM(peleburan_biaya) AS total, DATE_FORMAT(peleburan_tanggal, '%Y') AS tahun, REPLACE(DATE_FORMAT(peleburan_tanggal, '%d'), '0','') AS tanggal, REPLACE(DATE_FORMAT(peleburan_tanggal, '%m'), '0','') AS bulan FROM t_peleburan WHERE peleburan_hapus = 0 AND DATE_FORMAT(peleburan_tanggal, '%Y') = '$tahun' GROUP BY DATE_FORMAT(peleburan_tanggal, '%m')");

				//penjualan
				$data['penjualan_data'] = $this->query_builder->view("SELECT SUM(penjualan_total) AS total, DATE_FORMAT(penjualan_tanggal, '%Y') AS tahun, REPLACE(DATE_FORMAT(penjualan_tanggal, '%d'), '0','') AS tanggal, REPLACE(DATE_FORMAT(penjualan_tanggal, '%m'), '0','') AS bulan FROM t_penjualan WHERE penjualan_hapus = 0 AND DATE_FORMAT(penjualan_tanggal, '%Y') = '$tahun' GROUP BY DATE_FORMAT(penjualan_tanggal, '%m')");				

			}else{
				$data['filter'] = 1;

				//harian
				$data['pembelian_data'] = $this->query_builder->view("SELECT SUM(pembelian_total) AS total, DATE_FORMAT(pembelian_tanggal, '%Y') AS tahun, REPLACE(DATE_FORMAT(pembelian_tanggal, '%d'), '0','') AS tanggal, REPLACE(DATE_FORMAT(pembelian_tanggal, '%m'), '0','') AS bulan FROM t_pembelian WHERE pembelian_hapus = 0 AND DATE_FORMAT(pembelian_tanggal, '%Y') = '$tahun' GROUP BY pembelian_tanggal");

				//produksi
				$data['produksi_data'] = $this->query_builder->view("SELECT SUM(peleburan_biaya) AS total, DATE_FORMAT(peleburan_tanggal, '%Y') AS tahun, REPLACE(DATE_FORMAT(peleburan_tanggal, '%d'), '0','') AS tanggal, REPLACE(DATE_FORMAT(peleburan_tanggal, '%m'), '0','') AS bulan FROM t_peleburan WHERE peleburan_hapus = 0 AND DATE_FORMAT(peleburan_tanggal, '%Y') = '$tahun' GROUP BY peleburan_tanggal");

				//penjualan
				$data['penjualan_data'] = $this->query_builder->view("SELECT SUM(penjualan_total) AS total, DATE_FORMAT(penjualan_tanggal, '%Y') AS tahun, REPLACE(DATE_FORMAT(penjualan_tanggal, '%d'), '0','') AS tanggal, REPLACE(DATE_FORMAT(penjualan_tanggal, '%m'), '0','') AS bulan FROM t_penjualan WHERE penjualan_hapus = 0 AND DATE_FORMAT(penjualan_tanggal, '%Y') = '$tahun' GROUP BY penjualan_tanggal");
			}
			
			$data['title'] = 'Dashboard';
		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('dashboard/dashboard');
 			$this->load->view('v_template_admin/admin_footer');
		}
		else{
			redirect(base_url('login'));
		}
	} 
}
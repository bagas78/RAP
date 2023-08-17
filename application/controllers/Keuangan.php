<?php
class Keuangan extends CI_Controller{

	function __construct(){
		parent::__construct();
	}  
	function coa(){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'coa';
		    $data['normal_data'] = $this->query_builder->view("SELECT * FROM t_akun_normal");
		    $data['akun_data'] = $this->query_builder->view("SELECT * FROM t_akun as a JOIn t_akun_normal as b ON a.akun_normal = b.akun_normal_id"); 

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('keuangan/coa');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	} 
	function buku_besar($akun = '', $d = ''){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'buku besar';

		    $data['coa_data'] = $this->query_builder->view("SELECT * FROM t_coa");

		    //get first akun
		    $coa = $this->query_builder->view_row("SELECT * FROM t_coa ORDER BY coa_id ASC LIMIT 1");

		    //akun
		    if (@$akun) {
		    	$ak = $akun;
		    } else {
		    	$ak = $coa['coa_id'];	
		    }

		    //filter tahun & tanggal
		    if (@$d) {
		    	$date = $d;
		    } else {
		    	$date = date('Y-m');	
		    }

		    $data['akun'] = $ak;

		    $data['data'] = $this->query_builder->view("SELECT * FROM t_jurnal as a JOIN t_coa as b ON a.jurnal_akun = b.coa_id WHERE a.jurnal_hapus = 0 AND a.jurnal_akun = '$ak' AND DATE_FORMAT(a.jurnal_tanggal, '%Y-%m') = '$date' ORDER BY a.jurnal_tanggal ASC");

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('keuangan/buku_besar');
		    $this->load->view('v_template_admin/admin_footer');
		}
		else{
			redirect(base_url('login'));
		}
	}
	function kas($d = ''){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'Kas Keluar';

		    //filter tahun & tanggal
		    if (@$d) {
		    	$date = $d;
		    } else {
		    	$date = date('Y-m');	
		    } 

		    $data['data'] = $this->query_builder->view("SELECT * FROM t_jurnal as a JOIN t_akun as b ON a.jurnal_akun = b.akun_id WHERE a.jurnal_hapus = 0 AND a.jurnal_akun = 1 AND a.jurnal_type = 'kredit' AND DATE_FORMAT(a.jurnal_tanggal, '%Y-%m') = '$date' ORDER BY a.jurnal_tanggal ASC");

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('keuangan/kas');
		    $this->load->view('v_template_admin/admin_footer');
		}
		else{
			redirect(base_url('login'));
		}
	}
	function kas_get($nomor, $tanggal){
		$db = $this->db->query("SELECT * FROM t_jurnal WHERE jurnal_barang != '' AND jurnal_nomor = '$nomor' AND jurnal_tanggal = '$tanggal'")->row_array();
		echo json_encode($db);
	}
	function jurnal($d = ''){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'jurnal umum';

		    //filter tahun & tanggal
		    if (@$d) {
		    	$date = $d;
		    } else {
		    	$date = date('Y-m');	
		    }

		    $data['data'] = $this->query_builder->view("SELECT * FROM t_jurnal as a JOIN t_akun_normal as b ON a.jurnal_akun = b.akun_normal_id WHERE a.jurnal_hapus = 0 AND DATE_FORMAT(a.jurnal_tanggal, '%Y-%m') = '$date' ORDER BY a.jurnal_tanggal ASC");

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('keuangan/jurnal');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}
	function saldo($d = ''){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'Penyesuaian Saldo';

		    //filter tahun & tanggal
		    if (@$d) {
		    	$date = $d;
		    } else {
		    	$date = date('Y-m');	
		    }

		    $data['data'] = $this->query_builder->view("SELECT * FROM t_jurnal as a JOIN t_coa as b ON a.jurnal_akun = b.coa_id WHERE a.jurnal_hapus = 0 AND a.jurnal_akun = 7 AND DATE_FORMAT(a.jurnal_tanggal, '%Y-%m') = '$date' ORDER BY a.jurnal_tanggal ASC");

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('keuangan/saldo');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}
	function saldo_add(){

		$nominal = strip_tags($_POST['nominal']);
		$keterangan = strip_tags($_POST['keterangan']);
		$nomor = 'SAL-'.date(time());

		//kredit
		$this->stok->jurnal($nomor, 7 ,'kredit' , $keterangan, $nominal);

		//debit
		$this->stok->jurnal($nomor, 1 ,'debit', 'kas ( penyesuaian saldo )', $nominal);

		$this->session->set_flashdata('success','Data berhasil di tambah');
		
		redirect(base_url('keuangan/saldo'));
	}
}
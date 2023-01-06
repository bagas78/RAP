<?php
class Produk extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('m_produk');
	}  
	function index(){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'Master Produk';
		    
		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('produk/index');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	} 
	function get_data(){

		$where = array('master_produk_hapus' => 0);

	    $data = $this->m_produk->get_datatables($where);
		$total = $this->m_produk->count_all($where);
		$filter = $this->m_produk->count_filtered($where);

		$output = array(
			"draw" => $_GET['draw'],
			"recordsTotal" => $total,
			"recordsFiltered" => $filter,
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}
	function add(){ 

		$data['title'] = 'Master Produk';

		//satuan
		$data['satuan_data'] = $this->query_builder->view("SELECT * FROM t_satuan WHERE satuan_hapus = 0");

		//pewarnaan
		$data['pewarnaan_data'] = $this->query_builder->view("SELECT * FROM t_pewarnaan_jenis");

		//generate nomor
	    $get = $this->query_builder->count("SELECT * FROM t_master_produk");
	    $data['nomor'] = 'MP-'.date('dmY').'-'.($get+1);

		$this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('produk/form');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function save(){
		$set = array(
						'master_produk_nomor' => strip_tags($_POST['nomor']),
						'master_produk_nama' => strip_tags($_POST['nama']),
						'master_produk_pewarnaan' => strip_tags($_POST['pewarnaan']),
						'master_produk_harga' => strip_tags(str_replace(',', '', $_POST['harga'])),
						'master_produk_satuan' => strip_tags($_POST['satuan']),
						'master_produk_merk' => strip_tags($_POST['merk']),
						'master_produk_ketebalan' => strip_tags($_POST['ketebalan']),
						'master_produk_panjang' => strip_tags($_POST['panjang']),
						'master_produk_lebar' => strip_tags($_POST['lebar']),
						'master_produk_berat' => strip_tags($_POST['berat']),
						'master_produk_keterangan' => strip_tags($_POST['keterangan']),
					);

		$db = $this->query_builder->add('t_master_produk',$set);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di tambah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di tambah');
		}
		
		redirect(base_url('produk'));


	}
	function edit($id){
		$data['title'] = 'Master Produk';

		//satuan
		$data['satuan_data'] = $this->query_builder->view("SELECT * FROM t_satuan WHERE satuan_hapus = 0");

		//pewarnaan
		$data['pewarnaan_data'] = $this->query_builder->view("SELECT * FROM t_pewarnaan_jenis");

		//data
	    $data['data'] = $this->query_builder->view_row("SELECT * FROM t_master_produk WHERE master_produk_id = '$id'");

		$this->load->view('v_template_admin/admin_header',$data);
		$this->load->view('produk/form');
	    $this->load->view('produk/edit');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function update($id){

		$set = array(
						'master_produk_nama' => strip_tags($_POST['nama']),
						'master_produk_pewarnaan' => strip_tags($_POST['pewarnaan']),
						'master_produk_harga' => strip_tags(str_replace(',', '', $_POST['harga'])),
						'master_produk_satuan' => strip_tags($_POST['satuan']),
						'master_produk_merk' => strip_tags($_POST['merk']),
						'master_produk_ketebalan' => strip_tags($_POST['ketebalan']),
						'master_produk_panjang' => strip_tags($_POST['panjang']),
						'master_produk_lebar' => strip_tags($_POST['lebar']),
						'master_produk_berat' => strip_tags($_POST['berat']),
						'master_produk_keterangan' => strip_tags($_POST['keterangan']),
					);

		$where = ['master_produk_id' => $id];
		$db = $this->query_builder->update('t_master_produk',$set,$where);
		
		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di rubah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di rubah');
		}
		
		redirect(base_url('produk'));
	}
	function delete($id){

		$set = ['master_produk_hapus' => 1];
		$where = ['master_produk_id' => $id];
		$db = $this->query_builder->update('t_master_produk',$set,$where);
		
		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}
		
		redirect(base_url('produk'));
	}
}
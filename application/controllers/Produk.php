<?php
class Produk extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('m_produk');
	}  
	function master(){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'Master Produk';
		    
		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('produk/master');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	} 
	function master_get_data(){

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
	function master_add(){ 

		$data['title'] = 'Master Produk';

		//satuan
		$data['satuan_data'] = $this->query_builder->view("SELECT * FROM t_satuan WHERE satuan_hapus = 0");

		//generate kode
	    $get = $this->query_builder->count("SELECT * FROM t_master_produk");
	    $data['kode'] = 'MP00'.($get+1);

		$this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('produk/master_form');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function master_save(){
		$set = array(
						'master_produk_kode' => strip_tags($_POST['kode']),
						'master_produk_nama' => strip_tags($_POST['nama']),
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
		
		redirect(base_url('produk/master'));


	}
	function master_edit($id){
		$data['title'] = 'Master Produk';

		//satuan
		$data['satuan_data'] = $this->query_builder->view("SELECT * FROM t_satuan WHERE satuan_hapus = 0");

		//data
	    $data['data'] = $this->query_builder->view_row("SELECT * FROM t_master_produk WHERE master_produk_id = '$id'");

		$this->load->view('v_template_admin/admin_header',$data);
		$this->load->view('produk/master_form');
	    $this->load->view('produk/master_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function master_update($id){

		$set = array(
						'master_produk_nama' => strip_tags($_POST['nama']),
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
		
		redirect(base_url('produk/master'));
	}
	function master_delete($id){

		$set = ['master_produk_hapus' => 1];
		$where = ['master_produk_id' => $id];
		$db = $this->query_builder->update('t_master_produk',$set,$where);
		
		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}
		
		redirect(base_url('produk/master'));
	}
}
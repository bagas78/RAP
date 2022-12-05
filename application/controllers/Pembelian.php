<?php
class Pembelian extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('m_pembelian');
	}  
	function bahan(){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'Pembelian';
		    $data['pembelian_open'] = 'menu-open';
		    $data['pembelian_block'] = 'style="display: block;"';
		    $data['pembelian_bahan_active'] = 'class="active"';

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('pembelian/bahan');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}
	function get_bahan(){
		$where = array('bahan_hapus' => 0);

	    $data = $this->m_pembelian->get_datatables($where);
		$total = $this->m_pembelian->count_all($where);
		$filter = $this->m_pembelian->count_filtered($where);

		$output = array(
			"draw" => $_GET['draw'],
			"recordsTotal" => $total,
			"recordsFiltered" => $filter,
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	} 
	function add_bahan(){
		$data['title'] = 'Pembelian';
	    $data['pembelian_open'] = 'menu-open';
	    $data['pembelian_block'] = 'style="display: block;"';
	    $data['pembelian_bahan_active'] = 'class="active"';

	    $data['satuan_data'] = $this->query_builder->view("SELECT * FROM t_satuan WHERE satuan_hapus = 0");

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('pembelian/bahan_add');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function save_bahan(){
		$set = array(
						'bahan_nama' => strip_tags($_POST['nama']),
						'bahan_kategori' => strip_tags($_POST['kategori']),
						'bahan_satuan' => strip_tags($_POST['satuan']),
						'bahan_harga' => strip_tags($_POST['harga']),
					);

		$db = $this->query_builder->add('t_bahan',$set);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di tambah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di tambah');
		}
		
		redirect(base_url('pembelian/bahan'));
	}
	function edit_bahan($id){
		$data['title'] = 'Pembelian';
	    $data['pembelian_open'] = 'menu-open';
	    $data['pembelian_block'] = 'style="display: block;"';
	    $data['pembelian_bahan_active'] = 'class="active"';

	    $data['satuan_data'] = $this->query_builder->view("SELECT * FROM t_satuan WHERE satuan_hapus = 0");
	    $data['data'] = $this->query_builder->view_row("SELECT * FROM t_bahan as a JOIN t_satuan as b ON a.bahan_satuan = b.satuan_id WHERE a.bahan_id = '$id'");

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('pembelian/bahan_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function update_bahan($id){
		$set = array(
						'bahan_nama' => strip_tags($_POST['nama']),
						'bahan_kategori' => strip_tags($_POST['kategori']),
						'bahan_satuan' => strip_tags($_POST['satuan']),
						'bahan_harga' => strip_tags($_POST['harga']),
					);

		$where = ['bahan_id' => $id];
		$db = $this->query_builder->update('t_bahan',$set,$where);
		
		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}

		redirect(base_url('pembelian/bahan'));
	}
	function delete_bahan($id){
		$set = ['bahan_hapus' => 1];
		$where = ['bahan_id' => $id];
		$db = $this->query_builder->update('t_bahan',$set,$where);
		
		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}
		
		redirect(base_url('pembelian/bahan'));
	}
}
<?php
class Produksi extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('m_peleburan');
	}  
	function atribut($title){
		$data["title"] = $title;
	    $data["{$title}_active"] = "class='active'";
	    $data["produksi_open"] = "menu-open";
	    $data["produksi_block"] = "style='display: block;'";

	    return $data;
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
	function peleburan(){
		$title = 'peleburan';
		$data = $this->atribut($title);

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('produksi/peleburan');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function peleburan_get_data(){

		$model = 'm_peleburan';
		$where = array('peleburan_hapus' => 0);
		$output = $this->serverside($where, $model);
		echo json_encode($output);
	}
	function peleburan_add(){ 

		$title = 'peleburan';
		$data = $this->atribut($title);

		$data['bahan_data'] = $this->query_builder->view("SELECT * FROM t_bahan WHERE bahan_hapus = 0 AND bahan_kategori = 'avalan'");

		//generate nomor transaksi
	    $pb = $this->query_builder->count("SELECT * FROM t_peleburan WHERE peleburan_hapus = 0");
	    $data['nomor'] = 'PLB-'.date('dmY').'-'.($pb+1);

		$this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('produksi/peleburan_add');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function save(){
		$set = array(
						'kontak_jenis' => strip_tags($_POST['jenis']),
						'kontak_kode' => strip_tags($_POST['kode']),
						'kontak_nama' => strip_tags($_POST['nama']),
						'kontak_alamat' => strip_tags($_POST['alamat']),
						'kontak_tlp' => strip_tags($_POST['tlp']),
						'kontak_email' => strip_tags($_POST['email']),
						'kontak_rek' => strip_tags($_POST['rek']),
						'kontak_bank' => strip_tags($_POST['bank']),
						'kontak_npwp' => strip_tags($_POST['npwp']),
					);

		$db = $this->query_builder->add('t_kontak',$set);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di tambah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di tambah');
		}
		
		if ($_POST['jenis'] == 's') {
			redirect(base_url('kontak/supplier'));	
		} else {
			redirect(base_url('kontak/pelanggan'));
		}


	}
	function delete($id,$jenis){

		$set = ['kontak_hapus' => 1];
		$where = ['kontak_id' => $id];
		$db = $this->query_builder->update('t_kontak',$set,$where);
		
		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}
		
		if ($jenis == 's') {
			redirect(base_url('kontak/supplier'));	
		} else {
			redirect(base_url('kontak/pelanggan'));
		}
	}
	function edit($id,$jenis){
		$data['data'] = $this->query_builder->view_row("SELECT * FROM t_kontak where kontak_id = '$id'");
		$data['bank'] = $this->query_builder->view("SELECT * FROM t_bank");

		$data['title'] = 'Supplier';
		$data['jenis'] = @$jenis;
	    $data['supplier_active'] = 'class="active"';
	    $data['kontak_open'] = 'menu-open';
	    $data['kontak_block'] = 'style="display: block;"';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('kontak/edit');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function update($id){

		$set = array(
						'kontak_jenis' => strip_tags($_POST['jenis']),
						'kontak_nama' => strip_tags($_POST['nama']),
						'kontak_alamat' => strip_tags($_POST['alamat']),
						'kontak_tlp' => strip_tags($_POST['tlp']),
						'kontak_email' => strip_tags($_POST['email']),
						'kontak_rek' => strip_tags($_POST['rek']),
						'kontak_bank' => strip_tags($_POST['bank']),
						'kontak_npwp' => strip_tags($_POST['npwp']),
					);

		$where = ['kontak_id' => $id];
		$db = $this->query_builder->update('t_kontak',$set,$where);
		
		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}
		
		if ($_POST['jenis'] == 's') {
			redirect(base_url('kontak/supplier'));	
		} else {
			redirect(base_url('kontak/pelanggan'));
		}
	}
	function view($id,$jenis){

		$data['data'] = $this->query_builder->view_row("SELECT * FROM t_kontak as a JOIN t_bank as b ON a.kontak_bank = b.bank_id where kontak_id = '$id'");

		$data['title'] = 'Supplier';
		$data['jenis'] = @$jenis;
	    $data['supplier_active'] = 'class="active"';
	    $data['kontak_open'] = 'menu-open';
	    $data['kontak_block'] = 'style="display: block;"';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('kontak/view');
	    $this->load->view('v_template_admin/admin_footer');
	}
}
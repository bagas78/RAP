<?php
class Kontak extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('m_kontak');
	}  
	function supplier(){
		$data['title'] = 'Supplier';
		$data['jenis'] = 's';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('kontak/index');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function pelanggan(){
		$data['title'] = 'Pelanggan';
		$data['jenis'] = 'p';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('kontak/index');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function get_data($jenis){

		$where = array('kontak_jenis' => $jenis, 'kontak_hapus' => 0);

	    $data = $this->m_kontak->get_datatables($where);
		$total = $this->m_kontak->count_all($where);
		$filter = $this->m_kontak->count_filtered($where);

		$output = array(
			"draw" => $_GET['draw'],
			"recordsTotal" => $total,
			"recordsFiltered" => $filter,
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}
	function add($jenis){ 

		if ($jenis == 'supplier') {
			//supplier
			$data['jenis'] = 's';
			$data['title'] = 'Supplier';

		    //generate kode
		    $num = $this->query_builder->count("SELECT * FROM t_kontak WHERE kontak_jenis = 's'") + 1;
		    $data['kode'] = 'SP00'.$num;

		} else {
			//pelanggan
			$data['jenis'] = 'p';
			$data['title'] = 'Pelanggan';

		    //generate kode
		    $num = $this->query_builder->count("SELECT * FROM t_kontak WHERE kontak_jenis = 'p'") + 1;
		    $data['kode'] = 'PL00'.$num;
		}

		$data['bank'] = $this->query_builder->view("SELECT * FROM t_bank");

		$this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('kontak/add');
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
	function edit($id){
		$data['data'] = $this->query_builder->view_row("SELECT * FROM t_kontak where kontak_id = '$id'");
		$data['bank'] = $this->query_builder->view("SELECT * FROM t_bank");

		$data['title'] = 'Supplier';

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
			$this->session->set_flashdata('success','Data berhasil di rubah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di rubah');
		}
		
		if ($_POST['jenis'] == 's') {
			redirect(base_url('kontak/supplier'));	
		} else {
			redirect(base_url('kontak/pelanggan'));
		}
	}
	function view($id){

		$data['data'] = $this->query_builder->view_row("SELECT * FROM t_kontak as a JOIN t_bank as b ON a.kontak_bank = b.bank_id where kontak_id = '$id'");

		$data['title'] = 'Supplier';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('kontak/view');
	    $this->load->view('v_template_admin/admin_footer');
	}
}
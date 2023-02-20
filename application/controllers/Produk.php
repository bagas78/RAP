<?php
class Produk extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('m_produk');
		$this->load->model('m_warna');
		$this->load->model('m_jenis');
		$this->load->model('m_produk_barang');
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

		$where = array('produk_hapus' => 0);

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
	    $get = $this->query_builder->count("SELECT * FROM t_produk");
	    $data['kode'] = 'MP00'.($get+1);

		$this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('produk/master_form');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function master_save(){
		$set = array(
						'produk_kode' => strip_tags($_POST['kode']),
						'produk_nama' => strip_tags($_POST['nama']),
						'produk_satuan' => strip_tags($_POST['satuan']),
						'produk_merk' => strip_tags($_POST['merk']),
						'produk_ketebalan' => strip_tags($_POST['ketebalan']),
						'produk_panjang' => strip_tags($_POST['panjang']),
						'produk_lebar' => strip_tags($_POST['lebar']),
						'produk_berat' => strip_tags($_POST['berat']),
						'produk_keterangan' => strip_tags($_POST['keterangan']),
					);

		$db = $this->query_builder->add('t_produk',$set);

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
	    $data['data'] = $this->query_builder->view_row("SELECT * FROM t_produk WHERE produk_id = '$id'");

		$this->load->view('v_template_admin/admin_header',$data);
		$this->load->view('produk/master_form');
	    $this->load->view('produk/master_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function master_update($id){

		$set = array(
						'produk_nama' => strip_tags($_POST['nama']),
						'produk_satuan' => strip_tags($_POST['satuan']),
						'produk_merk' => strip_tags($_POST['merk']),
						'produk_ketebalan' => strip_tags($_POST['ketebalan']),
						'produk_panjang' => strip_tags($_POST['panjang']),
						'produk_lebar' => strip_tags($_POST['lebar']),
						'produk_berat' => strip_tags($_POST['berat']),
						'produk_keterangan' => strip_tags($_POST['keterangan']),
					);

		$where = ['produk_id' => $id];
		$db = $this->query_builder->update('t_produk',$set,$where);
		
		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di rubah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di rubah');
		}
		
		redirect(base_url('produk/master'));
	}
	function master_delete($id){

		$set = ['produk_hapus' => 1];
		$where = ['produk_id' => $id];
		$db = $this->query_builder->update('t_produk',$set,$where);
		
		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}
		
		redirect(base_url('produk/master'));
	}
	function master_view($id){
		if ( $this->session->userdata('login') == 1) {

		    $data['title'] = 'Master Produk';
		    $data['id'] = $id;
		    
		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('produk/master_view');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}
	function master_view_get($id){

		$where = array('produk_barang_barang' => $id);

	    $data = $this->m_produk_barang->get_datatables($where);
		$total = $this->m_produk_barang->count_all($where);
		$filter = $this->m_produk_barang->count_filtered($where);

		$output = array(
			"draw" => $_GET['draw'],
			"recordsTotal" => $total,
			"recordsFiltered" => $filter,
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}

	///////////////// warna /////////////////

	function warna(){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'Warna Produk';
		    
		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('produk/warna');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}
	function warna_get_data(){
		$where = array('warna_hapus' => 0, 'warna_id >' => '0');

	    $data = $this->m_warna->get_datatables($where);
		$total = $this->m_warna->count_all($where);
		$filter = $this->m_warna->count_filtered($where);

		$output = array(
			"draw" => $_GET['draw'],
			"recordsTotal" => $total,
			"recordsFiltered" => $filter,
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}
	function warna_add(){
		$data['title'] = 'Warna Produk';

		//generate kode
	    $get = $this->query_builder->count("SELECT * FROM t_warna");
	    $data['kode'] = 'WR00'.($get+1);

		$this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('produk/warna_form');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function warna_save(){
		$set = array(
						'warna_kode' => strip_tags($_POST['kode']),
						'warna_nama' => strip_tags($_POST['nama']),
						'warna_keterangan' => strip_tags($_POST['keterangan']),
					);

		$db = $this->query_builder->add('t_warna',$set);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di tambah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di tambah');
		}
		
		redirect(base_url('produk/warna'));
	}
	function warna_edit($id){
		$data['title'] = 'Warna Produk';

		//data
	    $data['data'] = $this->query_builder->view_row("SELECT * FROM t_warna WHERE warna_id = '$id'");

		$this->load->view('v_template_admin/admin_header',$data);
		$this->load->view('produk/warna_form');
	    $this->load->view('produk/warna_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function warna_update($id){
		$set = array(
						'warna_nama' => strip_tags($_POST['nama']),
						'warna_keterangan' => strip_tags($_POST['keterangan']),
					);

		$where = ['warna_id' => $id];
		$db = $this->query_builder->update('t_warna',$set,$where);
		
		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di rubah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di rubah');
		}
		
		redirect(base_url('produk/warna'));
	}
	function warna_delete($id){

		$set = ['warna_hapus' => 1];
		$where = ['warna_id' => $id];
		$db = $this->query_builder->update('t_warna',$set,$where);
		
		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}
		
		redirect(base_url('produk/warna'));
	}

	///////////////// jenis /////////////////

	function jenis(){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'Pewarnaan_jenis';
		    
		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('produk/jenis');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}
	function jenis_get_data(){
		$where = array('warna_jenis_hapus' => 0);

	    $data = $this->m_jenis->get_datatables($where);
		$total = $this->m_jenis->count_all($where);
		$filter = $this->m_jenis->count_filtered($where);

		$output = array(
			"draw" => $_GET['draw'],
			"recordsTotal" => $total,
			"recordsFiltered" => $filter,
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}
	function jenis_add(){
		$data['title'] = 'pewarnaan jenis';

		//generate kode
	    $get = $this->query_builder->count("SELECT * FROM t_warna");
	    $data['kode'] = 'JN00'.($get+1);

		$this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('produk/jenis_form');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function jenis_save(){
		$set = array(
						'warna_jenis_kode' => strip_tags($_POST['kode']),
						'warna_jenis_type' => strip_tags($_POST['type']),
						'warna_jenis_keterangan' => strip_tags($_POST['keterangan']),
					);

		$db = $this->query_builder->add('t_warna_jenis',$set);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di tambah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di tambah');
		}
		
		redirect(base_url('produk/jenis'));
	}
	function jenis_edit($id){
		$data['title'] = 'pewarnaan jenis';

		//data
	    $data['data'] = $this->query_builder->view_row("SELECT * FROM t_warna_jenis WHERE warna_jenis_id = '$id'");

		$this->load->view('v_template_admin/admin_header',$data);
		$this->load->view('produk/jenis_form');
	    $this->load->view('produk/jenis_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function jenis_update($id){
		$set = array(
						'warna_jenis_type' => strip_tags($_POST['type']),
						'warna_jenis_keterangan' => strip_tags($_POST['keterangan']),
					);

		$where = ['warna_jenis_id' => $id];
		$db = $this->query_builder->update('t_warna_jenis',$set,$where);
		
		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di rubah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di rubah');
		}
		
		redirect(base_url('produk/jenis'));
	}
	function jenis_delete($id){

		$set = ['warna_jenis_hapus' => 1];
		$where = ['warna_jenis_id' => $id];
		$db = $this->query_builder->update('t_warna_jenis',$set,$where);
		
		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}
		
		redirect(base_url('produk/jenis'));
	}
}
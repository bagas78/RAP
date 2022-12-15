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

		$data['total'] = $this->query_builder->view_row("SELECT * FROM t_billet");

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

		//stok > 0
		$data['bahan_data'] = $this->query_builder->view("SELECT * FROM t_bahan WHERE bahan_hapus = 0 AND bahan_kategori = 'avalan' AND bahan_stok > 0");

		//generate nomor transaksi
	    $pb = $this->query_builder->count("SELECT * FROM t_peleburan WHERE peleburan_hapus = 0");
	    $data['nomor'] = 'PLB-'.date('dmY').'-'.($pb+1);

	    //url
	    $data['url'] = 'peleburan_save';

		$this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('produksi/peleburan_form');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function peleburan_save(){

		$nomor = strip_tags($_POST['nomor']);

		//table peleburan
		$set = array(
						'peleburan_nomor' => $nomor,
						'peleburan_tanggal' => strip_tags($_POST['tanggal']),
						'peleburan_qty_akhir' => strip_tags($_POST['qty_akhir']),
						'peleburan_magnesium' => strip_tags($_POST['magnesium']),
						'peleburan_pembantu' => strip_tags($_POST['pembantu']),
						'peleburan_billet' => strip_tags($_POST['billet']),
						'peleburan_biaya' => strip_tags($_POST['total']),
					);

		$db = $this->query_builder->add('t_peleburan',$set);

		//table peleburan barang
		$barang = $_POST['barang'];
		$jum = count($barang);
		
		for ($i = 0; $i < $jum; ++$i) {
			$set2 = array(
						'peleburan_barang_nomor' => $nomor,
						'peleburan_barang_barang' => strip_tags($_POST['barang'][$i]),
						'peleburan_barang_qty' => strip_tags($_POST['qty'][$i]),
						'peleburan_barang_harga' => strip_tags($_POST['harga'][$i]),
						'peleburan_barang_subtotal' => strip_tags($_POST['subtotal'][$i]),
					);	

			$this->query_builder->add('t_peleburan_barang',$set2);
		}

		//update billet
		$this->stok->update_billet();

		//update stok bahan
		$this->stok->update_bahan();

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di tambah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di tambah');
		}
		
		redirect(base_url('produksi/peleburan'));
	}
	function peleburan_delete($id){

		$set = ['peleburan_hapus' => 1];
		$where = ['peleburan_id' => $id];
		$db = $this->query_builder->update('t_peleburan',$set,$where);
		
		if ($db == 1) {

			//update billet
			$this->stok->update_billet();

			//update stok bahan
			$this->stok->update_bahan();

			$this->session->set_flashdata('success','Data berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}
		
		redirect(base_url('produksi/peleburan'));	
	}
	function peleburan_edit($id){
		$title = 'peleburan';
		$data = $this->atribut($title);

		//data
	    $data['data'] = $this->query_builder->view_row("SELECT * FROM t_peleburan WHERE peleburan_id = '$id'");

		//stok > 0
		$data['bahan_data'] = $this->query_builder->view("SELECT * FROM t_bahan WHERE bahan_hapus = 0 AND bahan_kategori = 'avalan' AND bahan_stok > 0");

	    //url
	    $data['url'] = 'peleburan_update/'.$id;

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('produksi/peleburan_form');
	    $this->load->view('produksi/peleburan_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function get_peleburan($nomor){
		//pembelian barang
		$db = $this->query_builder->view("SELECT * FROM t_peleburan_barang WHERE peleburan_barang_nomor = '$nomor'");
		echo json_encode($db);
	}
	function peleburan_update($id){

		$nomor = strip_tags($_POST['nomor']);

		//table peleburan
		$set = array(
						'peleburan_tanggal' => strip_tags($_POST['tanggal']),
						'peleburan_qty_akhir' => strip_tags($_POST['qty_akhir']),
						'peleburan_magnesium' => strip_tags($_POST['magnesium']),
						'peleburan_pembantu' => strip_tags($_POST['pembantu']),
						'peleburan_billet' => strip_tags($_POST['billet']),
						'peleburan_biaya' => strip_tags($_POST['total']),
					);

		$where = ['peleburan_id' => $id];
		$db = $this->query_builder->update('t_peleburan',$set,$where);

		//table peleburan barang
		$barang = $_POST['barang'];
		$jum = count($barang);

		//hapus barang
		$this->query_builder->delete('t_peleburan_barang',['peleburan_barang_nomor' => $nomor]);
		
		for ($i = 0; $i < $jum; ++$i) {
			$set2 = array(
						'peleburan_barang_nomor' => $nomor,
						'peleburan_barang_barang' => strip_tags($_POST['barang'][$i]),
						'peleburan_barang_qty' => strip_tags($_POST['qty'][$i]),
						'peleburan_barang_harga' => strip_tags($_POST['harga'][$i]),
						'peleburan_barang_subtotal' => strip_tags($_POST['subtotal'][$i]),
					);	

			$this->query_builder->add('t_peleburan_barang',$set2);
		}

		//update billet
		$this->stok->update_billet();

		//update stok bahan
		$this->stok->update_bahan();

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di rubah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di rubah');
		}
		
		redirect(base_url('produksi/peleburan'));
	}
}
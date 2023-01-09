<?php
class Penjualan extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('m_penjualan');
	} 

///////////////////////// penjualan //////////////////////////////////////////////////

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
	function add($active){

		//kontak
	    $data['kontak_data'] = $this->query_builder->view("SELECT * FROM t_kontak WHERE kontak_jenis = 'p' AND kontak_hapus = 0");

	    //barang
	    $data['produk_data'] = $this->query_builder->view("SELECT * FROM t_master_produk WHERE master_produk_hapus = 0 AND master_produk_stok > 0");

	    //ppn
	    $data['ppn'] = $this->query_builder->view_row("SELECT * FROM t_pajak WHERE pajak_jenis = 'penjualan'");

	    return $data;
	}
	function delete($table, $id, $redirect){
		$set = ["{$table}_hapus" => 1];
		$where = ["{$table}_id" => $id];
		$db = $this->query_builder->update("t_{$table}",$set,$where);

		if ($db == 1) {
			
			//update stok bahan
			$this->stok->update_bahan();

			$this->session->set_flashdata('success','Data berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}

		redirect(base_url('penjualan/'.$redirect));
	}
	function get_produk($id){
		//barang
		$db = $this->query_builder->view_row("SELECT * FROM t_master_produk as a JOIN t_satuan as b ON a.master_produk_satuan = b.satuan_id WHERE a.master_produk_id = '$id'");
		echo json_encode($db);
	}
	function save($po, $redirect){

		//penjualan
		$nomor = strip_tags($_POST['nomor']);
		$set1 = array(
						'penjualan_po' => $po,
						'penjualan_nomor' => $nomor,
						'penjualan_tanggal' => strip_tags($_POST['tanggal']),
						'penjualan_pelanggan' => strip_tags($_POST['pelanggan']),
						'penjualan_jatuh_tempo' => strip_tags($_POST['jatuh_tempo']),
						'penjualan_status' => strip_tags($_POST['status']),
						'penjualan_keterangan' => strip_tags($_POST['keterangan']),
						'penjualan_qty_akhir' => strip_tags(str_replace(',', '', $_POST['qty_akhir'])),
						'penjualan_ppn' => strip_tags(str_replace(',', '', $_POST['ppn'])),
						'penjualan_total' => strip_tags(str_replace(',', '', $_POST['total'])), 
					);

		//upload lampiran
		$lampiran = @$_FILES['lampiran'];
		if ($lampiran['name']) {

			$file = $lampiran;
			$path = './assets/gambar/penjualan';
			$name = 'lampiran';
			$upload = $this->upload_builder->single($file,$path,$name);	

      		if ($upload != 0) {
      			$push = array('penjualan_lampiran' => $upload);
	          	$result = array_merge($set1,$push);
     		}	

		}else{
			$result = $set1;
		}

		$db = $this->query_builder->add('t_penjualan',$result);

		//barang
		$barang = $_POST['barang'];
		$jum = count($barang);
		
		for ($i = 0; $i < $jum; ++$i) {
			$set2 = array(
						'penjualan_barang_nomor' => $nomor,
						'penjualan_barang_barang' => strip_tags($_POST['barang'][$i]),
						'penjualan_barang_qty' => strip_tags(str_replace(',', '', $_POST['qty'][$i])),
						'penjualan_barang_potongan' => strip_tags(str_replace(',', '', $_POST['potongan'][$i])),
						'penjualan_barang_harga' => strip_tags(str_replace(',', '', $_POST['harga'][$i])),
						'penjualan_barang_subtotal' => strip_tags(str_replace(',', '', $_POST['subtotal'][$i])),
					);	

			$this->query_builder->add('t_penjualan_barang',$set2);
		}

		if ($db == 1) {
			
			//update stok bahan
			//$this->stok->update_bahan();

			$this->session->set_flashdata('success','Data berhasil di tambah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di tambah');
		}

		redirect(base_url('penjualan/'.$redirect));
	}
	function edit($id, $active, $kategori){

	    //data
	    $data['data'] = $this->query_builder->view_row("SELECT * FROM t_penjualan WHERE penjualan_id = '$id'");

	    //kontak
	    $data['kontak_data'] = $this->query_builder->view("SELECT * FROM t_kontak WHERE kontak_jenis = 's' AND kontak_hapus = 0");

	    //barang

	    if ($kategori == 'all') {
	    	$data['bahan_data'] = $this->query_builder->view("SELECT * FROM t_bahan WHERE bahan_hapus = 0");	
	    } else {
	    	$data['bahan_data'] = $this->query_builder->view("SELECT * FROM t_bahan WHERE bahan_hapus = 0 AND bahan_kategori = '$kategori'");
	    }

	    //ppn
	    $data['ppn'] = $this->query_builder->view_row("SELECT * FROM t_pajak WHERE pajak_jenis = 'penjualan'");

	    $data['url'] = $active;

	    return $data;
	}
	function get_penjualan($nomor){
		//penjualan barang
		$db = $this->query_builder->view("SELECT * FROM t_penjualan_barang WHERE penjualan_barang_nomor = '$nomor'");
		echo json_encode($db);
	}
	function update($po, $redirect){
		$nomor = strip_tags($_POST['nomor']);
		$set1 = array(
						'penjualan_po' => $po,
						'penjualan_tanggal' => strip_tags($_POST['tanggal']),
						'penjualan_pelanggan' => strip_tags($_POST['pelanggan']),
						'penjualan_jatuh_tempo' => strip_tags($_POST['jatuh_tempo']),
						'penjualan_status' => strip_tags($_POST['status']),
						'penjualan_keterangan' => strip_tags($_POST['keterangan']),
						'penjualan_qty_akhir' => strip_tags($_POST['qty_akhir']),
						'penjualan_ppn' => strip_tags($_POST['ppn']),
						'penjualan_total' => strip_tags($_POST['total']), 
					);

		//upload lampiran
		$lampiran = @$_FILES['lampiran'];
		if ($lampiran['name']) {

			$file = $lampiran;
			$path = './assets/gambar/penjualan';
			$name = 'lampiran';
			$upload = $this->upload_builder->single($file,$path,$name);	

      		if ($upload != 0) {
      			$push = array('penjualan_lampiran' => $upload);
	          	$result = array_merge($set1,$push);
     		}	

		}else{
			$result = $set1;
		}

		$where1 = ['penjualan_nomor' => $nomor];
		$db = $this->query_builder->update('t_penjualan',$result,$where1);

		//delete barang
		$where2 = ['penjualan_barang_nomor' => $nomor];
		$this->query_builder->delete('t_penjualan_barang',$where2);

		//save barang
		$barang = $_POST['barang'];
		$jum = count($barang);
		
		for ($i = 0; $i < $jum; ++$i) {
			$set2 = array(
						'penjualan_barang_nomor' => $nomor,
						'penjualan_barang_barang' => strip_tags($_POST['barang'][$i]),
						'penjualan_barang_qty' => strip_tags($_POST['qty'][$i]),
						'penjualan_barang_potongan' => strip_tags($_POST['potongan'][$i]),
						'penjualan_barang_harga' => strip_tags($_POST['harga'][$i]),
						'penjualan_barang_subtotal' => strip_tags($_POST['subtotal'][$i]),
					);	

			$this->query_builder->add('t_penjualan_barang',$set2);
		}

		if ($db == 1) {
			
			//update stok
			$this->stok->update_bahan();

			$this->session->set_flashdata('success','Data berhasil di rubah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di rubah');
		}

		redirect(base_url('penjualan/'.$redirect));
	}
	function search(){
		$output = $this->query_builder->view("SELECT penjualan_nomor as nomor FROM t_penjualan WHERE penjualan_hapus = 0 AND penjualan_kategori = 'avalan' AND penjualan_po = 1");
		echo json_encode($output);
	}
	function search_data($nomor){
		$output = $this->query_builder->view("SELECT * FROM t_penjualan AS a JOIN t_penjualan_barang AS b ON a.penjualan_nomor = b.penjualan_barang_nomor WHERE a.penjualan_nomor = '$nomor'");
		echo json_encode($output);
	}

////////////////////////////////////////////////////////////////////////////////////////////

	
////////////////// Purchase Order///////////////////////////////

	function po(){
		if ( $this->session->userdata('login') == 1) {

			$active = 'po';
			$data["title"] = $active;
			$data['url'] = $active;
		    
		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('penjualan/table');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}

	function po_get_data(){
		
		$model = 'm_penjualan';
		$where = array('penjualan_po' => 1,'penjualan_hapus' => 0);
		$output = $this->serverside($where, $model);
		echo json_encode($output);
	}
	function po_delete($id){

		$table = 'penjualan';
		$redirect = 'po';
		$this->delete('penjualan', $id, $redirect);
	}
	function po_add(){

		$redirect = 'po';
		$data = $this->add($redirect);
		$data['url'] = $redirect;

		//generate nomor transaksi
	    $pb = $this->query_builder->count("SELECT * FROM t_penjualan");
	    $data['nomor'] = 'PJ-'.date('dmY').'-'.($pb+1);

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('penjualan/form');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function po_save(){
		
		$po = 1;
		$redirect = 'po';
		$this->save($po, $redirect);
	}
	function po_edit($id){
		
		$active = 'po';
		$kategori = 'avalan';
		$data = $this->edit($id, $active, $kategori);

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('penjualan/form');
	    $this->load->view('penjualan/form_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}	
	function po_update(){

		$po = 1;
		$redirect = 'po';
		$this->update($po, $redirect);
	}

///////// penjualan avalan //////////////////////////////////////////////

	function avalan(){
		
		if ( $this->session->userdata('login') == 1) {

		    $active = 'avalan';
			$data["title"] = $active;
			$data['url'] = $active;
		    
		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('penjualan/table');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}
	function avalan_get_data(){

		$model = 'm_penjualan';
		$where = array('penjualan_po' => 0,'penjualan_hapus' => 0);
		$output = $this->serverside($where, $model);
		echo json_encode($output);
	}
	function avalan_add(){

		$kategori = 'avalan';
		$redirect = 'avalan';
		$data = $this->add($kategori, $redirect);
		$data['url'] = $redirect;

		//generate nomor transaksi
	    $pb = $this->query_builder->count("SELECT * FROM t_penjualan WHERE penjualan_kategori = 'avalan'");
	    $data['nomor'] = 'PA-'.date('dmY').'-'.($pb+1);

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('penjualan/form');
	    $this->load->view('penjualan/search');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function avalan_save(){
		
		//penjualan
		$po = 0;
		$redirect = 'avalan';
		$nomor = strip_tags($_POST['nomor']);
		
		$cek = $this->query_builder->count("SELECT * FROM t_penjualan WHERE penjualan_nomor = '$nomor'");
		if ($cek > 0) {
			//update
			$this->update($po, $redirect);

		}else{
			//new
			$kategori = 'avalan';
			$this->save($po, $redirect, $kategori);
		}
	}
	function avalan_edit($id){
		$active = 'avalan';
		$kategori = 'avalan';
		$data = $this->edit($id, $active, $kategori);

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('penjualan/form');
	    $this->load->view('penjualan/form_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function avalan_update($nomor){
		
		$po = 0;
		$redirect = 'avalan';
		$this->update($po, $redirect);
	}
	function avalan_delete($id){
		
		$table = 'penjualan';
		$redirect = 'avalan';
		$this->delete('penjualan', $id, $redirect);
	}

////////// penjualan bahan utama ///////////////////////////////////

	function utama(){
		if ( $this->session->userdata('login') == 1) {

		    $active = 'utama';
			$data["title"] = $active;
			$data['url'] = $active;
		    
		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('penjualan/table');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}
	function utama_get_data(){
		
		$model = 'm_penjualan';
		$where = array('penjualan_kategori' => 'utama','penjualan_po' => 0,'penjualan_hapus' => 0);
		$output = $this->serverside($where, $model);
		echo json_encode($output);
	}
	function utama_add(){
		
		$kategori = 'utama';
		$redirect = 'utama';
		$data = $this->add($kategori, $redirect);
		$data['url'] = $redirect;

		//generate nomor transaksi
	    $pb = $this->query_builder->count("SELECT * FROM t_penjualan WHERE penjualan_kategori = 'utama'");
	    $data['nomor'] = 'PB-'.date('dmY').'-'.($pb+1);

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('penjualan/form');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function utama_save(){
		
		$po = 0;
		$redirect = 'utama';
		$kategori = 'utama';
		$this->save($po, $redirect, $kategori);
	}
	function utama_edit($id){
		
		$active = 'utama';
		$kategori = 'utama';
		$data = $this->edit($id, $active, $kategori);

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('penjualan/form');
	    $this->load->view('penjualan/form_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}	
	function utama_update(){

		$po = 0;
		$redirect = 'utama';
		$this->update($po, $redirect);
	}
	function utama_delete($id){
		
		$table = 'penjualan';
		$redirect = 'utama';
		$this->delete('penjualan', $id, $redirect);
	}

//////// umum /////////////////////////////////////////////////

	function umum(){
		if ( $this->session->userdata('login') == 1) {

		    $active = 'umum';
			$data["title"] = $active;
			$data['url'] = $active;
		    
		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('penjualan/table');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}
	function umum_get_data(){
		
		$model = 'm_penjualan';
		$where = array('penjualan_kategori' => 'umum','penjualan_po' => 0,'penjualan_hapus' => 0);
		$output = $this->serverside($where, $model);
		echo json_encode($output);
	}
	function umum_add(){
		
		$kategori = 'all';
		$redirect = 'umum';
		$data = $this->add($kategori, $redirect);
		$data['url'] = $redirect;

		//generate nomor transaksi
	    $pb = $this->query_builder->count("SELECT * FROM t_penjualan WHERE penjualan_kategori = 'umum'");
	    $data['nomor'] = 'PU-'.date('dmY').'-'.($pb+1);

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('penjualan/form');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function umum_save(){
		
		$po = 0;
		$redirect = 'umum';
		$kategori = 'umum';
		$this->save($po, $redirect, $kategori);
	}
	function umum_edit($id){
		
		$active = 'umum';
		$kategori = 'all';
		$data = $this->edit($id, $active, $kategori);

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('penjualan/form');
	    $this->load->view('penjualan/form_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}	
	function umum_update(){

		$po = 0;
		$redirect = 'umum';
		$this->update($po, $redirect);
	}
	function umum_delete($id){
		
		$table = 'penjualan';
		$redirect = 'umum';
		$this->delete('penjualan', $id, $redirect);
	}

//////// bayar hutang /////////////////////////////////////////////////

	function bayar(){
		$data["title"] = 'bayar';

		$this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('penjualan/bayar');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function bayar_get_data(){
		$model = 'm_penjualan';
		$where = array('penjualan_status' => 'b','penjualan_po' => 0,'penjualan_hapus' => 0);
		$output = $this->serverside($where, $model);
		echo json_encode($output);
	}
	function bayar_rotate($id){
		$set = ['penjualan_status' => 'l'];
		$where = ['penjualan_id' => $id];
		$db = $this->query_builder->update('t_penjualan',$set,$where);

		if ($db == 1) {
			
			//update stok bahan
			$this->stok->update_bahan();

			$this->session->set_flashdata('success','Berhasil di bayar');
		} else {
			$this->session->set_flashdata('gagal','Gagal di bayar');
		}

		redirect(base_url('penjualan/bayar'));
	}
	function bayar_edit($id){

		//ambil kategori
		$db = $this->query_builder->view_row("SELECT * FROM t_penjualan WHERE penjualan_id = '$id'");

		$active = 'bayar';
		$kategori = $db['penjualan_kategori'];
		$data = $this->edit($id, $active, $kategori);

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('penjualan/form');
	    $this->load->view('penjualan/form_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function bayar_update(){

		$po = 0;
		$redirect = 'bayar';
		$this->update($po, $redirect);
	}
}
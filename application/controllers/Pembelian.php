<?php
class Pembelian extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('m_pembelian');
		$this->load->model('m_bahan');
	} 

///////////////////////// pembelian //////////////////////////////////////////////////

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
	function add($kategori,$active){

		//kontak
	    $data['kontak_data'] = $this->query_builder->view("SELECT * FROM t_kontak WHERE kontak_jenis = 's' AND kontak_hapus = 0");

	    //barang
	    if ($kategori == 'all') {
	    	 $data['bahan_data'] = $this->query_builder->view("SELECT * FROM t_bahan WHERE bahan_hapus = 0");	
	    }else{
	    	 $data['bahan_data'] = $this->query_builder->view("SELECT * FROM t_bahan WHERE bahan_hapus = 0 AND bahan_kategori = '$kategori'");
	    }

	    //ppn
	    $data['ppn'] = $this->query_builder->view_row("SELECT * FROM t_pajak WHERE pajak_jenis = 'pembelian'");

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

		redirect(base_url('pembelian/'.$redirect));
	}
	function get_barang($id){
		//barang
		$db = $this->query_builder->view_row("SELECT * FROM t_bahan as a JOIN t_satuan as b ON a.bahan_satuan = b.satuan_id WHERE a.bahan_id = '$id'");
		echo json_encode($db);
	}
	function save($po, $redirect, $kategori){

		//pembelian
		$nomor = strip_tags($_POST['nomor']);
		$set1 = array(
						'pembelian_kategori' => $kategori,
						'pembelian_po' => $po,
						'pembelian_nomor' => $nomor,
						'pembelian_tanggal' => strip_tags($_POST['tanggal']),
						'pembelian_supplier' => strip_tags($_POST['supplier']),
						'pembelian_jatuh_tempo' => strip_tags($_POST['jatuh_tempo']),
						'pembelian_status' => strip_tags($_POST['status']),
						'pembelian_keterangan' => strip_tags($_POST['keterangan']),
						'pembelian_qty_akhir' => strip_tags(str_replace(',', '', $_POST['qty_akhir'])),
						'pembelian_ppn' => strip_tags(str_replace(',', '', $_POST['ppn'])),
						'pembelian_total' => strip_tags(str_replace(',', '', $_POST['total'])), 
					);

		//upload lampiran
		$lampiran = @$_FILES['lampiran'];
		if ($lampiran['name']) {

			$file = $lampiran;
			$path = './assets/gambar/pembelian';
			$name = 'lampiran';
			$upload = $this->upload_builder->single($file,$path,$name);	

      		if ($upload != 0) {
      			$push = array('pembelian_lampiran' => $upload);
	          	$result = array_merge($set1,$push);
     		}	

		}else{
			$result = $set1;
		}

		$db = $this->query_builder->add('t_pembelian',$result);

		//barang
		$barang = $_POST['barang'];
		$jum = count($barang);
		
		for ($i = 0; $i < $jum; ++$i) {
			$set2 = array(
						'pembelian_barang_nomor' => $nomor,
						'pembelian_barang_barang' => strip_tags($_POST['barang'][$i]),
						'pembelian_barang_qty' => strip_tags(str_replace(',', '', $_POST['qty'][$i])),
						'pembelian_barang_potongan' => strip_tags(str_replace(',', '', $_POST['potongan'][$i])),
						'pembelian_barang_harga' => strip_tags(str_replace(',', '', $_POST['harga'][$i])),
						'pembelian_barang_subtotal' => strip_tags(str_replace(',', '', $_POST['subtotal'][$i])),
					);	

			$this->query_builder->add('t_pembelian_barang',$set2);
		}

		if ($db == 1) {
			
			//update stok bahan
			$this->stok->update_bahan();

			$this->session->set_flashdata('success','Data berhasil di tambah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di tambah');
		}

		redirect(base_url('pembelian/'.$redirect));
	}
	function edit($id, $active, $kategori){

	    //data
	    $data['data'] = $this->query_builder->view_row("SELECT * FROM t_pembelian WHERE pembelian_id = '$id'");

	    //kontak
	    $data['kontak_data'] = $this->query_builder->view("SELECT * FROM t_kontak WHERE kontak_jenis = 's' AND kontak_hapus = 0");

	    //barang

	    if ($kategori == 'all') {
	    	$data['bahan_data'] = $this->query_builder->view("SELECT * FROM t_bahan WHERE bahan_hapus = 0");	
	    } else {
	    	$data['bahan_data'] = $this->query_builder->view("SELECT * FROM t_bahan WHERE bahan_hapus = 0 AND bahan_kategori = '$kategori'");
	    }

	    //ppn
	    $data['ppn'] = $this->query_builder->view_row("SELECT * FROM t_pajak WHERE pajak_jenis = 'pembelian'");

	    $data['url'] = $active;

	    return $data;
	}
	function get_pembelian($nomor){
		//pembelian barang
		$db = $this->query_builder->view("SELECT * FROM t_pembelian_barang WHERE pembelian_barang_nomor = '$nomor'");
		echo json_encode($db);
	}
	function update($po, $redirect){
		$nomor = strip_tags($_POST['nomor']);
		$set1 = array(
						'pembelian_po' => $po,
						'pembelian_tanggal' => strip_tags($_POST['tanggal']),
						'pembelian_supplier' => strip_tags($_POST['supplier']),
						'pembelian_jatuh_tempo' => strip_tags($_POST['jatuh_tempo']),
						'pembelian_status' => strip_tags($_POST['status']),
						'pembelian_keterangan' => strip_tags($_POST['keterangan']),
						'pembelian_qty_akhir' => strip_tags($_POST['qty_akhir']),
						'pembelian_ppn' => strip_tags($_POST['ppn']),
						'pembelian_total' => strip_tags($_POST['total']), 
					);

		//upload lampiran
		$lampiran = @$_FILES['lampiran'];
		if ($lampiran['name']) {

			$file = $lampiran;
			$path = './assets/gambar/pembelian';
			$name = 'lampiran';
			$upload = $this->upload_builder->single($file,$path,$name);	

      		if ($upload != 0) {
      			$push = array('pembelian_lampiran' => $upload);
	          	$result = array_merge($set1,$push);
     		}	

		}else{
			$result = $set1;
		}

		$where1 = ['pembelian_nomor' => $nomor];
		$db = $this->query_builder->update('t_pembelian',$result,$where1);

		//delete barang
		$where2 = ['pembelian_barang_nomor' => $nomor];
		$this->query_builder->delete('t_pembelian_barang',$where2);

		//save barang
		$barang = $_POST['barang'];
		$jum = count($barang);
		
		for ($i = 0; $i < $jum; ++$i) {
			$set2 = array(
						'pembelian_barang_nomor' => $nomor,
						'pembelian_barang_barang' => strip_tags($_POST['barang'][$i]),
						'pembelian_barang_qty' => strip_tags($_POST['qty'][$i]),
						'pembelian_barang_potongan' => strip_tags($_POST['potongan'][$i]),
						'pembelian_barang_harga' => strip_tags($_POST['harga'][$i]),
						'pembelian_barang_subtotal' => strip_tags($_POST['subtotal'][$i]),
					);	

			$this->query_builder->add('t_pembelian_barang',$set2);
		}

		if ($db == 1) {
			
			//update stok
			$this->stok->update_bahan();

			$this->session->set_flashdata('success','Data berhasil di rubah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di rubah');
		}

		redirect(base_url('pembelian/'.$redirect));
	}
	function search(){
		$output = $this->query_builder->view("SELECT pembelian_nomor as nomor FROM t_pembelian WHERE pembelian_hapus = 0 AND pembelian_kategori = 'avalan' AND pembelian_po = 1");
		echo json_encode($output);
	}
	function search_data($nomor){
		$output = $this->query_builder->view("SELECT * FROM t_pembelian AS a JOIN t_pembelian_barang AS b ON a.pembelian_nomor = b.pembelian_barang_nomor WHERE a.pembelian_nomor = '$nomor'");
		echo json_encode($output);
	}

////////////////////////////////////////////////////////////////////////////////////////////


///////////////// Master Bahan //////////////////////////////////

	function bahan(){
		if ( $this->session->userdata('login') == 1) {
		    $data["title"] = 'bahan';

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('pembelian/bahan');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}
	function bahan_get_data(){
		
		$model = 'm_bahan';
		$where = array('bahan_hapus' => 0);
		$output = $this->serverside($where, $model);
		echo json_encode($output);
	} 
	function bahan_add(){

		$data["title"] = 'bahan';

	    $data['satuan_data'] = $this->query_builder->view("SELECT * FROM t_satuan WHERE satuan_hapus = 0");

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('pembelian/bahan_add');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function bahan_save(){
		
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
	function bahan_edit($id){
		
		$data["title"] = 'bahan';

	    $data['satuan_data'] = $this->query_builder->view("SELECT * FROM t_satuan WHERE satuan_hapus = 0");
	    $data['data'] = $this->query_builder->view_row("SELECT * FROM t_bahan as a JOIN t_satuan as b ON a.bahan_satuan = b.satuan_id WHERE a.bahan_id = '$id'");

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('pembelian/bahan_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function bahan_update($id){
		
		$set = array(
						'bahan_nama' => strip_tags($_POST['nama']),
						'bahan_kategori' => strip_tags($_POST['kategori']),
						'bahan_satuan' => strip_tags($_POST['satuan']),
						'bahan_harga' => strip_tags($_POST['harga']),
					);

		$where = ['bahan_id' => $id];
		$db = $this->query_builder->update('t_bahan',$set,$where);
		
		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di rubah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di rubah');
		}

		redirect(base_url('pembelian/bahan'));
	}
	function bahan_delete($id){

		$table = 'bahan';
		$redirect = 'bahan';
		$this->delete($table, $id, $redirect);
	}	

	
////////////////// Purchase Order///////////////////////////////

	function po(){
		if ( $this->session->userdata('login') == 1) {

			$active = 'po';
			$data["title"] = $active;
			$data['url'] = $active;
		    
		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('pembelian/table');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}

	function po_get_data(){
		
		$model = 'm_pembelian';
		$where = array('pembelian_kategori' => 'avalan','pembelian_po' => 1,'pembelian_hapus' => 0);
		$output = $this->serverside($where, $model);
		echo json_encode($output);
	}
	function po_delete($id){

		$table = 'pembelian';
		$redirect = 'po';
		$this->delete('pembelian', $id, $redirect);
	}
	function po_add(){

		$kategori = 'avalan';
		$redirect = 'po';
		$data = $this->add($kategori, $redirect);
		$data['url'] = $redirect;

		//generate nomor transaksi
	    $pb = $this->query_builder->count("SELECT * FROM t_pembelian WHERE pembelian_hapus = 0 AND pembelian_kategori = 'avalan'");
	    $data['nomor'] = 'PA-'.date('dmY').'-'.($pb+1);

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('pembelian/form');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function po_save(){
		
		$po = 1;
		$redirect = 'po';
		$kategori = 'avalan';
		$this->save($po, $redirect, $kategori);
	}
	function po_edit($id){
		
		$active = 'po';
		$kategori = 'avalan';
		$data = $this->edit($id, $active, $kategori);

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('pembelian/form');
	    $this->load->view('pembelian/form_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}	
	function po_update(){

		$po = 1;
		$redirect = 'po';
		$this->update($po, $redirect);
	}

///////// pembelian avalan //////////////////////////////////////////////

	function avalan(){
		
		if ( $this->session->userdata('login') == 1) {

		    $active = 'avalan';
			$data["title"] = $active;
			$data['url'] = $active;
		    
		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('pembelian/table');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}
	function avalan_get_data(){

		$model = 'm_pembelian';
		$where = array('pembelian_kategori' => 'avalan','pembelian_po' => 0,'pembelian_hapus' => 0);
		$output = $this->serverside($where, $model);
		echo json_encode($output);
	}
	function avalan_add(){

		$kategori = 'avalan';
		$redirect = 'avalan';
		$data = $this->add($kategori, $redirect);
		$data['url'] = $redirect;

		//generate nomor transaksi
	    $pb = $this->query_builder->count("SELECT * FROM t_pembelian WHERE pembelian_hapus = 0 AND pembelian_kategori = 'avalan'");
	    $data['nomor'] = 'PA-'.date('dmY').'-'.($pb+1);

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('pembelian/form');
	    $this->load->view('pembelian/search');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function avalan_save(){
		
		//pembelian
		$po = 0;
		$redirect = 'avalan';
		$nomor = strip_tags($_POST['nomor']);
		
		$cek = $this->query_builder->count("SELECT * FROM t_pembelian WHERE pembelian_nomor = '$nomor'");
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
	    $this->load->view('pembelian/form');
	    $this->load->view('pembelian/form_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function avalan_update($nomor){
		
		$po = 0;
		$redirect = 'avalan';
		$this->update($po, $redirect);
	}
	function avalan_delete($id){
		
		$table = 'pembelian';
		$redirect = 'avalan';
		$this->delete('pembelian', $id, $redirect);
	}

////////// pembelian bahan utama ///////////////////////////////////

	function utama(){
		if ( $this->session->userdata('login') == 1) {

		    $active = 'utama';
			$data["title"] = $active;
			$data['url'] = $active;
		    
		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('pembelian/table');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}
	function utama_get_data(){
		
		$model = 'm_pembelian';
		$where = array('pembelian_kategori' => 'utama','pembelian_po' => 0,'pembelian_hapus' => 0);
		$output = $this->serverside($where, $model);
		echo json_encode($output);
	}
	function utama_add(){
		
		$kategori = 'utama';
		$redirect = 'utama';
		$data = $this->add($kategori, $redirect);
		$data['url'] = $redirect;

		//generate nomor transaksi
	    $pb = $this->query_builder->count("SELECT * FROM t_pembelian WHERE pembelian_hapus = 0 AND pembelian_kategori = 'utama'");
	    $data['nomor'] = 'PB-'.date('dmY').'-'.($pb+1);

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('pembelian/form');
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
	    $this->load->view('pembelian/form');
	    $this->load->view('pembelian/form_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}	
	function utama_update(){

		$po = 0;
		$redirect = 'utama';
		$this->update($po, $redirect);
	}
	function utama_delete($id){
		
		$table = 'pembelian';
		$redirect = 'utama';
		$this->delete('pembelian', $id, $redirect);
	}

//////// umum /////////////////////////////////////////////////

	function umum(){
		if ( $this->session->userdata('login') == 1) {

		    $active = 'umum';
			$data["title"] = $active;
			$data['url'] = $active;
		    
		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('pembelian/table');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}
	function umum_get_data(){
		
		$model = 'm_pembelian';
		$where = array('pembelian_kategori' => 'umum','pembelian_po' => 0,'pembelian_hapus' => 0);
		$output = $this->serverside($where, $model);
		echo json_encode($output);
	}
	function umum_add(){
		
		$kategori = 'all';
		$redirect = 'umum';
		$data = $this->add($kategori, $redirect);
		$data['url'] = $redirect;

		//generate nomor transaksi
	    $pb = $this->query_builder->count("SELECT * FROM t_pembelian WHERE pembelian_hapus = 0 AND pembelian_kategori = 'umum'");
	    $data['nomor'] = 'PU-'.date('dmY').'-'.($pb+1);

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('pembelian/form');
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
	    $this->load->view('pembelian/form');
	    $this->load->view('pembelian/form_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}	
	function umum_update(){

		$po = 0;
		$redirect = 'umum';
		$this->update($po, $redirect);
	}
	function umum_delete($id){
		
		$table = 'pembelian';
		$redirect = 'umum';
		$this->delete('pembelian', $id, $redirect);
	}

//////// bayar hutang /////////////////////////////////////////////////

	function bayar(){
		$data["title"] = 'bayar';

		$this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('pembelian/bayar');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function bayar_get_data(){
		$model = 'm_pembelian';
		$where = array('pembelian_status' => 'b','pembelian_po' => 0,'pembelian_hapus' => 0);
		$output = $this->serverside($where, $model);
		echo json_encode($output);
	}
	function bayar_rotate($id){
		$set = ['pembelian_status' => 'l'];
		$where = ['pembelian_id' => $id];
		$db = $this->query_builder->update('t_pembelian',$set,$where);

		if ($db == 1) {
			
			//update stok bahan
			$this->stok->update_bahan();

			$this->session->set_flashdata('success','Berhasil di bayar');
		} else {
			$this->session->set_flashdata('gagal','Gagal di bayar');
		}

		redirect(base_url('pembelian/bayar'));
	}
	function bayar_edit($id){

		//ambil kategori
		$db = $this->query_builder->view_row("SELECT * FROM t_pembelian WHERE pembelian_id = '$id'");

		$active = 'bayar';
		$kategori = $db['pembelian_kategori'];
		$data = $this->edit($id, $active, $kategori);

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('pembelian/form');
	    $this->load->view('pembelian/form_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function bayar_update(){

		$po = 0;
		$redirect = 'bayar';
		$this->update($po, $redirect);
	}
}
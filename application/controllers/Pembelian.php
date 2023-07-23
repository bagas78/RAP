<?php
class Pembelian extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('m_pembelian');
		$this->load->model('m_pembelian_umum');
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
	function add(){

		//kontak
	    $data['kontak_data'] = $this->query_builder->view("SELECT * FROM t_kontak WHERE kontak_jenis = 's' AND kontak_hapus = 0");

	    //rekening
	    $data['rekening_data'] = $this->query_builder->view("SELECT * FROM t_rekening WHERE rekening_hapus = 0");

	    //barang
	    $data['bahan_data'] = $this->query_builder->view("SELECT * FROM t_bahan WHERE bahan_kode != 'BH000' AND bahan_hapus = 0");

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

			//jurnal
			// if ($table == 'pembelian') {
			// 	$pem = $this->query_builder->view_row("SELECT * FROM t_pembelian WHERE pembelian_id = '$id'");
			// 	$nomor = $pem['pembelian_nomor'];
			// 	$this->stok->jurnal_delete($nomor, 1);	
			// }

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
	function save($po, $redirect, $po_tanggal = ''){

		//pembelian
		$user = $this->session->userdata('id');
		$nomor = strip_tags($_POST['nomor']);
		$status = strip_tags($_POST['status']);
		$total = strip_tags(str_replace(',', '', $_POST['total']));

		//piutang status
		if ($status == 'belum') { $hutang = '1'; }else{ $hutang = '0'; }

		$set1 = array( 
						'pembelian_hutang' => $hutang,
						'pembelian_user' => $user,
						'pembelian_po' => $po,
						'pembelian_po_tanggal' => $po_tanggal,
						'pembelian_nomor' => $nomor,
						'pembelian_tanggal' => strip_tags($_POST['tanggal']),
						'pembelian_pembayaran' => strip_tags($_POST['pembayaran']),
						'pembelian_supplier' => strip_tags($_POST['supplier']),
						'pembelian_jatuh_tempo' => strip_tags($_POST['jatuh_tempo']),
						'pembelian_status' => $status,
						'pembelian_keterangan' => strip_tags($_POST['keterangan']),
						'pembelian_qty_akhir' => strip_tags(str_replace(',', '', $_POST['qty_akhir'])),
						'pembelian_ppn' => strip_tags(str_replace(',', '', $_POST['ppn'])),
						'pembelian_total' => $total, 
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
						'pembelian_barang_stok' => strip_tags(str_replace(',', '', $_POST['stok'][$i])),
						'pembelian_barang_potongan' => strip_tags(str_replace(',', '', $_POST['potongan'][$i])),
						'pembelian_barang_harga' => strip_tags(str_replace(',', '', $_POST['harga'][$i])),
						'pembelian_barang_subtotal' => strip_tags(str_replace(',', '', $_POST['subtotal'][$i])),
					);	

			$this->query_builder->add('t_pembelian_barang',$set2);
		}

		if ($db == 1) {
			
			//update stok bahan
			$this->stok->update_bahan();

			//jurnal
			//if ($po == 0) {
				
				// if ($status == 'l') {
				// 	//lunas
				// 	$this->stok->jurnal($nomor, 4, 'debit', 'stok bahan baku'.$kategori, $total);
				// 	$this->stok->jurnal($nomor, 1, 'kredit', 'kas ( pembelian bahan '.$kategori.' )', $total);	
				// } else {
				// 	//belum
				// 	$this->stok->jurnal($nomor, 4, 'debit', 'stok bahan baku'.$kategori, $total);
				// 	$this->stok->jurnal($nomor, 6, 'kredit', 'utang ( pembelian bahan '.$kategori.' )', $total);
				// }	
			//}

			$this->session->set_flashdata('success','Data berhasil di tambah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di tambah');
		}

		redirect(base_url('pembelian/'.$redirect));
	}
	function edit($id, $active){

	    //data
	    $data['data'] = $this->query_builder->view_row("SELECT * FROM t_pembelian WHERE pembelian_id = '$id'");

	    //rekening
	    $data['rekening_data'] = $this->query_builder->view("SELECT * FROM t_rekening WHERE rekening_hapus = 0");

	    //kontak
	    $data['kontak_data'] = $this->query_builder->view("SELECT * FROM t_kontak WHERE kontak_jenis = 's' AND kontak_hapus = 0");

	    //barang
		$data['bahan_data'] = $this->query_builder->view("SELECT * FROM t_bahan WHERE bahan_hapus = 0");	

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
		$total = strip_tags(str_replace(',', '', $_POST['total']));
		$status = strip_tags($_POST['status']);

		$set1 = array(
						'pembelian_po' => $po,
						'pembelian_tanggal' => strip_tags($_POST['tanggal']),
						'pembelian_pembayaran' => strip_tags($_POST['pembayaran']),
						'pembelian_supplier' => strip_tags($_POST['supplier']),
						'pembelian_jatuh_tempo' => strip_tags($_POST['jatuh_tempo']),
						'pembelian_status' => $status,
						'pembelian_keterangan' => strip_tags($_POST['keterangan']),
						'pembelian_qty_akhir' => strip_tags(str_replace(',', '', $_POST['qty_akhir'])),
						'pembelian_ppn' => strip_tags(str_replace(',', '', $_POST['ppn'])),
						'pembelian_total' => $total, 
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
						'pembelian_barang_qty' => strip_tags(str_replace(',', '', $_POST['qty'][$i])),
						'pembelian_barang_stok' => strip_tags(str_replace(',', '', $_POST['stok'][$i])),
						'pembelian_barang_potongan' => strip_tags(str_replace(',', '', $_POST['potongan'][$i])),
						'pembelian_barang_harga' => strip_tags(str_replace(',', '', $_POST['harga'][$i])),
						'pembelian_barang_subtotal' => strip_tags(str_replace(',', '', $_POST['subtotal'][$i])),
					);	

			$this->query_builder->add('t_pembelian_barang',$set2);
		}

		if ($db == 1) {
			
			//update stok
			$this->stok->update_bahan();

			//jurnal
			// if ($po == 0) {

			// 	//get kategori
			// 	$pem = $this->query_builder->view_row("SELECT * FROM t_pembelian WHERE pembelian_nomor = '$nomor'");
			// 	$kategori = $pem['pembelian_kategori'];
			// 	$tanggal = $pem['pembelian_tanggal'];

			// 	//delete jurnal
			// 	$this->stok->jurnal_delete($nomor);
				
			// 	if ($status == 'l') {
			// 		//lunas
			// 		$this->stok->jurnal($nomor, 4, 'debit', 'stok bahan baku'.$kategori, $total, $tanggal);
			// 		$this->stok->jurnal($nomor, 1, 'kredit', 'kas ( pembelian bahan '.$kategori.' )', $total, $tanggal);	
			// 	} else {
			// 		//belum
			// 		$this->stok->jurnal($nomor, 4, 'debit', 'stok bahan baku'.$kategori, $total, $tanggal);
			// 		$this->stok->jurnal($nomor, 6, 'kredit', 'utang ( pembelian bahan '.$kategori.' )', $total, $tanggal);
			// 	}	
			// }

			$this->session->set_flashdata('success','Data berhasil di rubah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di rubah');
		}

		redirect(base_url('pembelian/'.$redirect));
	}
	function search(){
		$output = $this->query_builder->view("SELECT pembelian_nomor as nomor FROM t_pembelian WHERE pembelian_hapus = 0 AND pembelian_po = 1");
		echo json_encode($output);
	}
	function search_data($nomor){
		$output = $this->query_builder->view("SELECT * FROM t_pembelian AS a JOIN t_pembelian_barang AS b ON a.pembelian_nomor = b.pembelian_barang_nomor WHERE a.pembelian_nomor = '$nomor'");
		echo json_encode($output);
	}
	function laporan($id){

		$data['title'] = 'laporan';

		$data['data'] = $this->query_builder->view("SELECT * FROM t_pembelian as a JOIN t_pembelian_barang as b ON a.pembelian_nomor = b.pembelian_barang_nomor JOIN t_kontak as c ON a.pembelian_supplier = c.kontak_id JOIN t_bahan as d ON b.pembelian_barang_barang = d.bahan_id JOIN t_user as e ON a.pembelian_user = e.user_id JOIN t_satuan as f ON d.bahan_satuan = f.satuan_id WHERE a.pembelian_hapus = 0 AND a.pembelian_id = '$id'");

		$this->load->view('pembelian/laporan', $data);
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
	    
	    //generate kde
	    $bh = $this->query_builder->count("SELECT * FROM t_bahan WHERE bahan_kode != 'BH000'");
	    $data['kode'] = 'BH00'.($bh+1);


	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('pembelian/bahan_add');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function bahan_save(){
		
		$set = array(
						'bahan_kode' => strip_tags($_POST['kode']),
						'bahan_nama' => strip_tags($_POST['nama']),
						'bahan_kategori' => strip_tags($_POST['kategori']),
						'bahan_satuan' => strip_tags($_POST['satuan']),
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
		    $this->load->view('pembelian/po');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}

	function po_get_data(){
		
		$model = 'm_pembelian';
		$where = array('pembelian_po' => 1,'pembelian_hapus' => 0);
		$output = $this->serverside($where, $model);
		echo json_encode($output);
	}
	function po_delete($id){

		$table = 'pembelian';
		$redirect = 'po';
		$this->delete('pembelian', $id, $redirect);
	}
	function po_add(){

		$data = $this->add();

		$redirect = 'po';
		$data['url'] = $redirect;

		//generate nomor transaksi
	    $pb = $this->query_builder->count("SELECT * FROM t_pembelian");
	    $data['nomor'] = 'PB-'.date('dmY').'-'.($pb+1);

	    $data["title"] = $redirect;

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('pembelian/form');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function po_save(){
		
		$po = 1;
		$redirect = 'po';
		$po_tanggal = date('Y-m-d');
		$this->save($po, $redirect, $po_tanggal);
	}
	function po_edit($id){
		
		$active = 'po';
		$data = $this->edit($id, $active);

		$data["title"] = $active;

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('pembelian/form');
	    $this->load->view('pembelian/form_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}	
	function po_view($id){
		
		$active = 'po';
		$data = $this->edit($id, $active);

		$data["title"] = $active;
		$data["view"] = 1;

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

////////// pembelian bahan ///////////////////////////////////

	function utama(){
		if ( $this->session->userdata('login') == 1) {

		    $active = 'utama';
			$data["title"] = $active; 
			$data['url'] = $active;
		    
		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('pembelian/utama');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}
	function utama_get_data(){
		
		$model = 'm_pembelian';
		$where = array('pembelian_po' => 0,'pembelian_hapus' => 0);
		$output = $this->serverside($where, $model);
		echo json_encode($output);
	}
	function utama_add(){
		
		$kategori = 'utama';
		$redirect = 'utama';
		$data = $this->add($kategori, $redirect);
		$data['url'] = $redirect;

		//generate nomor transaksi
	    $pb = $this->query_builder->count("SELECT * FROM t_pembelian");
	    $data['nomor'] = 'PB-'.date('dmY').'-'.($pb+1);

	    $data["title"] = $redirect;

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('pembelian/form');
	    $this->load->view('pembelian/search');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function utama_save(){
		
		$po = 0;
		$redirect = 'utama';
		$where = strip_tags($_POST['nomor']);

		$cek = $this->query_builder->count("SELECT * FROM t_pembelian WHERE pembelian_nomor = '$where'");
		if ($cek > 0) {
			//update
			$this->update($po, $redirect);

		}else{
			//new
			$this->save($po, $redirect);
		}

	}
	function utama_edit($id){
		
		$active = 'utama';
		$data = $this->edit($id, $active);

		$data["title"] = $active;

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('pembelian/form');
	    $this->load->view('pembelian/form_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}	
	function utama_view($id){
		
		$active = 'utama';
		$data = $this->edit($id, $active);

		$data["title"] = $active;
		$data["view"] = 1;

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

		    $data["title"] = 'pembelian umum';
		    
		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('pembelian/umum');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}
	function umum_get_data(){
		
		$model = 'm_pembelian_umum';
		$where = array('pembelian_umum_hapus' => 0);
		$output = $this->serverside($where, $model);
		echo json_encode($output);
	}
	function umum_add(){

		//rekening
	    $data['rekening_data'] = $this->query_builder->view("SELECT * FROM t_rekening WHERE rekening_hapus = 0");

	    //ppn
	    $data['ppn'] = $this->query_builder->view_row("SELECT * FROM t_pajak WHERE pajak_jenis = 'pembelian'");
		
		//generate nomor transaksi
	    $pb = $this->query_builder->count("SELECT * FROM t_pembelian_umum");
	    $data['nomor'] = 'PU-'.date('dmY').'-'.($pb+1);

	    $data["title"] = 'pembelian umum';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('pembelian/umum_add');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function umum_save(){
		
		//pembelian umum
		$user = $this->session->userdata('id');
		$nomor = strip_tags($_POST['nomor']);
		$total = strip_tags(str_replace(',', '', $_POST['total']));
		$set1 = array(
						'pembelian_umum_user' => $user,
						'pembelian_umum_nomor' => $nomor,
						'pembelian_umum_tanggal' => strip_tags($_POST['tanggal']),
						'pembelian_umum_pembayaran' => strip_tags($_POST['pembayaran']),
						'pembelian_umum_jatuh_tempo' => strip_tags($_POST['jatuh_tempo']),
						'pembelian_umum_status' => strip_tags($_POST['status']),
						'pembelian_umum_keterangan' => strip_tags($_POST['keterangan']),
						'pembelian_umum_qty_akhir' => strip_tags(str_replace(',', '', $_POST['qty_akhir'])),
						'pembelian_umum_ppn' => strip_tags(str_replace(',', '', $_POST['ppn'])),
						'pembelian_umum_total' => $total, 
					);

		//upload lampiran
		$lampiran = @$_FILES['lampiran'];
		if ($lampiran['name']) {

			$file = $lampiran;
			$path = './assets/gambar/pembelian_umum';
			$name = 'lampiran';
			$upload = $this->upload_builder->single($file,$path,$name);	

      		if ($upload != 0) {
      			$push = array('pembelian_umum_lampiran' => $upload);
	          	$result = array_merge($set1,$push);
     		}	

		}else{
			$result = $set1;
		}

		$db = $this->query_builder->add('t_pembelian_umum',$result);

		//barang
		$barang = $_POST['barang'];
		$jum = count($barang);

		print_r($jum);
		
		for ($i = 0; $i < $jum; ++$i) {
			$set2 = array(
						'pembelian_umum_barang_nomor' => $nomor,
						'pembelian_umum_barang_barang' => strip_tags($_POST['barang'][$i]),
						'pembelian_umum_barang_qty' => strip_tags(str_replace(',', '', $_POST['qty'][$i])),
						'pembelian_umum_barang_potongan' => strip_tags(str_replace(',', '', $_POST['potongan'][$i])),
						'pembelian_umum_barang_harga' => strip_tags(str_replace(',', '', $_POST['harga'][$i])),
						'pembelian_umum_barang_subtotal' => strip_tags(str_replace(',', '', $_POST['subtotal'][$i])),
					);	

			$this->query_builder->add('t_pembelian_umum_barang',$set2);
		}

		if ($db == 1) {
			
			$this->session->set_flashdata('success','Data berhasil di tambah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di tambah');
		}

		redirect(base_url('pembelian/umum'));
	}
	function umum_edit($id){

		//data
	    $data['data'] = $this->query_builder->view_row("SELECT * FROM t_pembelian_umum WHERE pembelian_umum_id = '$id'");

	    //rekening
	    $data['rekening_data'] = $this->query_builder->view("SELECT * FROM t_rekening WHERE rekening_hapus = 0");

	    //ppn
	    $data['ppn'] = $this->query_builder->view_row("SELECT * FROM t_pajak WHERE pajak_jenis = 'pembelian'");
		
		$data["title"] = 'pembelian umum';
		    
		$this->load->view('v_template_admin/admin_header',$data);
		$this->load->view('pembelian/umum_add');
		$this->load->view('pembelian/umum_edit');
		$this->load->view('v_template_admin/admin_footer');
	}
	function umum_view($id){

		//data
	    $data['data'] = $this->query_builder->view_row("SELECT * FROM t_pembelian_umum WHERE pembelian_umum_id = '$id'");

	    //rekening
	    $data['rekening_data'] = $this->query_builder->view("SELECT * FROM t_rekening WHERE rekening_hapus = 0");

	    //ppn
	    $data['ppn'] = $this->query_builder->view_row("SELECT * FROM t_pajak WHERE pajak_jenis = 'pembelian'");
		
		$data["title"] = 'pembelian umum';
		$data["view"] = 1;
		    
		$this->load->view('v_template_admin/admin_header',$data);
		$this->load->view('pembelian/umum_add');
		$this->load->view('pembelian/umum_edit');
		$this->load->view('v_template_admin/admin_footer');
	}
	function get_pembelian_umum($nomor){
		//pembelian barang
		$db = $this->query_builder->view("SELECT * FROM t_pembelian_umum_barang WHERE pembelian_umum_barang_nomor = '$nomor'");
		echo json_encode($db);
	}	
	function umum_update($nomor){

		$total = strip_tags(str_replace(',', '', $_POST['total']));
		$set1 = array(
						'pembelian_umum_tanggal' => strip_tags($_POST['tanggal']),
						'pembelian_umum_pembayaran' => strip_tags($_POST['pembayaran']),
						'pembelian_umum_jatuh_tempo' => strip_tags($_POST['jatuh_tempo']),
						'pembelian_umum_status' => strip_tags($_POST['status']),
						'pembelian_umum_keterangan' => strip_tags($_POST['keterangan']),
						'pembelian_umum_qty_akhir' => strip_tags(str_replace(',', '', $_POST['qty_akhir'])),
						'pembelian_umum_ppn' => strip_tags(str_replace(',', '', $_POST['ppn'])),
						'pembelian_umum_total' => $total, 
					);

		//upload lampiran
		$lampiran = @$_FILES['lampiran'];
		if ($lampiran['name']) {

			$file = $lampiran;
			$path = './assets/gambar/pembelian_umum';
			$name = 'lampiran';
			$upload = $this->upload_builder->single($file,$path,$name);	

      		if ($upload != 0) {
      			$push = array('pembelian_umum_lampiran' => $upload);
	          	$result = array_merge($set1,$push);
     		}	

		}else{
			$result = $set1;
		}

		$where1 = ['pembelian_umum_nomor' => $nomor];
		$db = $this->query_builder->update('t_pembelian_umum',$result,$where1);

		//delete barang
		$where2 = ['pembelian_umum_barang_nomor' => $nomor];
		$this->query_builder->delete('t_pembelian_umum_barang',$where2);

		//save barang
		$barang = $_POST['barang'];
		$jum = count($barang);
		
		for ($i = 0; $i < $jum; ++$i) {
			$set2 = array(
						'pembelian_umum_barang_nomor' => $nomor,
						'pembelian_umum_barang_barang' => strip_tags($_POST['barang'][$i]),
						'pembelian_umum_barang_qty' => strip_tags(str_replace(',', '', $_POST['qty'][$i])),
						'pembelian_umum_barang_potongan' => strip_tags(str_replace(',', '', $_POST['potongan'][$i])),
						'pembelian_umum_barang_harga' => strip_tags(str_replace(',', '', $_POST['harga'][$i])),
						'pembelian_umum_barang_subtotal' => strip_tags(str_replace(',', '', $_POST['subtotal'][$i])),
					);	

			$this->query_builder->add('t_pembelian_umum_barang',$set2);
		}

		if ($db == 1) {

			$this->session->set_flashdata('success','Data berhasil di rubah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di rubah');
		}

		redirect(base_url('pembelian/umum'));
	}
	function umum_delete($id){
		
		$db = $this->query_builder->update("t_pembelian_umum",['pembelian_umum_hapus' => 1],['pembelian_umum_id' => $id]);

		if ($db == 1) {

			$this->session->set_flashdata('success','Data berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}

		redirect(base_url('pembelian/umum'));
	}
	function laporan_umum($id){
		$data['title'] = 'laporan';

		$data['data'] = $this->query_builder->view("SELECT * FROM t_pembelian_umum as a JOIN t_pembelian_umum_barang as b ON a.pembelian_umum_nomor = b.pembelian_umum_barang_nomor JOIN t_user as c ON a.pembelian_umum_user = c.user_id WHERE a.pembelian_umum_hapus = 0 AND a.pembelian_umum_id = '$id'");

		$this->load->view('pembelian/umum_laporan', $data);
	}

//////// bayar hutang /////////////////////////////////////////////////

	function bayar($jenis = ''){
		$data["title"] = 'bayar';

		if ($jenis == 'umum') {
			$data['bayar_active'] = 'umum';
			$this->load->view('v_template_admin/admin_header',$data);
	    	$this->load->view('pembelian/bayar_umum');
	    	$this->load->view('pembelian/bayar_modal');
	    	$this->load->view('v_template_admin/admin_footer');
		}else{
			$data['bayar_active'] = 'bahan';
			$this->load->view('v_template_admin/admin_header',$data);
	    	$this->load->view('pembelian/bayar');
	    	$this->load->view('pembelian/bayar_modal');
	    	$this->load->view('v_template_admin/admin_footer');
		}
	}
	function bayar_get_data($jenis = ''){
		
		if ($jenis == 'umum') {
			$model = 'm_pembelian_umum';
			$where = array('pembelian_umum_hutang' => '1','pembelian_umum_hapus' => 0);
		}else{
			$model = 'm_pembelian';
			$where = array('pembelian_hutang' => '1','pembelian_po' => 0,'pembelian_hapus' => 0);
		}
	
		$output = $this->serverside($where, $model);
		echo json_encode($output);
	}
	function bayar_rotate($jenis, $id){
		$tanggal = strip_tags($_POST['tanggal']);
		$keterangan = strip_tags($_POST['keterangan']);

		if ($jenis == 'bahan') {

			//pembelian bahan

			$set = ['pembelian_status' => 'lunas', 'pembelian_pelunasan' => $tanggal, 'pembelian_pelunasan_keterangan' => $keterangan];
			$where = ['pembelian_id' => $id];

			$db = $this->query_builder->update('t_pembelian',$set,$where);

			if ($db == 1) {
				
				//update stok bahan
				$this->stok->update_bahan();

				$this->session->set_flashdata('success','Berhasil di bayar');
			} else {
				$this->session->set_flashdata('gagal','Gagal di bayar');
			}	
		}else{

			//pembelian umum

			$set = ['pembelian_umum_status' => 'lunas', 'pembelian_umum_pelunasan' => $tanggal, 'pembelian_umum_pelunasan_keterangan' => $keterangan];
			$where = ['pembelian_umum_id' => $id];

			$db = $this->query_builder->update('t_pembelian_umum',$set,$where);

			if ($db == 1) {
				
				//update stok bahan
				$this->stok->update_bahan();

				$this->session->set_flashdata('success','Berhasil di bayar');
			} else {
				$this->session->set_flashdata('gagal','Gagal di bayar');
			}	
		}

		redirect(base_url('pembelian/bayar/'.$jenis));
	}
	function bayar_batal($jenis, $id){
		
		if ($jenis == 'bahan') {

			//pembelian bahan

			$set = ['pembelian_status' => 'belum', 'pembelian_pelunasan' => NULL, 'pembelian_pelunasan_keterangan' => ''];
			$where = ['pembelian_id' => $id];

			$db = $this->query_builder->update('t_pembelian',$set,$where);

			if ($db == 1) {
				
				//update stok bahan
				$this->stok->update_bahan();

				$this->session->set_flashdata('success','Berhasil di batalkan');
			} else {
				$this->session->set_flashdata('gagal','Gagal di batalkan');
			}	
		}else{

			//pembelian umum

			$set = ['pembelian_umum_status' => 'belum', 'pembelian_umum_pelunasan' => NULL, 'pembelian_umum_pelunasan_keterangan' => ''];
			$where = ['pembelian_umum_id' => $id];

			$db = $this->query_builder->update('t_pembelian_umum',$set,$where);

			if ($db == 1) {
				
				//update stok bahan
				$this->stok->update_bahan();

				$this->session->set_flashdata('success','Berhasil di batalkan');
			} else {
				$this->session->set_flashdata('gagal','Gagal di batalkan');
			}	
		}

		redirect(base_url('pembelian/bayar/'.$jenis));
	}
}
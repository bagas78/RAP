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

	    //rekening
	    $data['rekening_data'] = $this->query_builder->view("SELECT * FROM t_rekening WHERE rekening_hapus = 0");

	    //produk
	    $data['produk_data'] = $this->query_builder->view("SELECT * FROM t_produk WHERE produk_hapus = 0");

	    //jenis
	    $data['jenis_data'] = $this->query_builder->view("SELECT * FROM t_warna_jenis WHERE warna_jenis_hapus = 0");

	    //warna
	    $data['warna_data'] = $this->query_builder->view("SELECT * FROM t_warna WHERE warna_hapus = 0");

	    //ppn
	    $data['ppn'] = $this->query_builder->view_row("SELECT * FROM t_pajak WHERE pajak_jenis = 'penjualan'");

	    return $data;
	}
	function delete($table, $id, $redirect){
		$set = ["{$table}_hapus" => 1];
		$where = ["{$table}_id" => $id];
		$db = $this->query_builder->update("t_{$table}",$set,$where);

		if ($db == 1) {
			
			//update produk
			$this->stok->update_produk();

			//jurnal
			if ($table == 'penjualan') {

				$pen = $this->query_builder->view_row("SELECT * FROM t_penjualan WHERE penjualan_id = '$id'");
				$nomor = $pen['penjualan_nomor'];
				$this->stok->jurnal_delete($nomor, 1);	
			}

			$this->session->set_flashdata('success','Data berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}

		redirect(base_url('penjualan/'.$redirect));
	}
	function get_produk($id = '',$jenis = '',$warna = ''){
		//barang
		$db = $this->query_builder->view_row("SELECT * FROM t_produk as a JOIN t_satuan as b ON a.produk_satuan = b.satuan_id JOIN t_produk_barang as c ON a.produk_id = c.produk_barang_barang WHERE a.produk_id = '$id' AND c.produk_barang_jenis = '$jenis' AND c.produk_barang_warna = '$warna'");
		echo json_encode($db);
	}
	function save($po, $redirect){

		//penjualan
		$nomor = strip_tags($_POST['nomor']);
		$status = strip_tags($_POST['status']);
		$total = strip_tags(str_replace(',', '', $_POST['total']));

		//piutang status
		if ($status == 'belum') { $piutang = '1'; }else{ $piutang = '0'; }

		$set1 = array(
						'penjualan_piutang' => $piutang,
						'penjualan_po' => $po,
						'penjualan_nomor' => $nomor,
						'penjualan_tanggal' => strip_tags($_POST['tanggal']),
						'penjualan_pelanggan' => strip_tags($_POST['pelanggan']),
						'penjualan_jatuh_tempo' => strip_tags($_POST['jatuh_tempo']),
						'penjualan_pembayaran' => strip_tags($_POST['pembayaran']),
						'penjualan_status' => $status,
						'penjualan_keterangan' => strip_tags($_POST['keterangan']),
						'penjualan_qty_akhir' => strip_tags(str_replace(',', '', $_POST['qty_akhir'])),
						'penjualan_ppn' => strip_tags(str_replace(',', '', $_POST['ppn'])),
						'penjualan_total' => $total, 
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
						'penjualan_barang_jenis' => strip_tags($_POST['jenis'][$i]),
						'penjualan_barang_warna' => strip_tags($_POST['warna'][$i]),
						'penjualan_barang_qty' => strip_tags(str_replace(',', '', $_POST['qty'][$i])),
						'penjualan_barang_stok' => strip_tags(str_replace(',', '', $_POST['stok'][$i])),
						'penjualan_barang_potongan' => strip_tags(str_replace(',', '', $_POST['potongan'][$i])),
						'penjualan_barang_harga' => strip_tags(str_replace(',', '', $_POST['harga'][$i])),
						'penjualan_barang_hps' => strip_tags(str_replace(',', '', $_POST['hps'][$i])),
						'penjualan_barang_subtotal' => strip_tags(str_replace(',', '', $_POST['subtotal'][$i])),
					);	

			$this->query_builder->add('t_penjualan_barang',$set2);
		}

		if ($db == 1) {

			//update produksi status
			$pesanan = @$_POST['pesanan'];
			if ($pesanan != '0') {
				$x = $this->query_builder->update('t_produksi',['produksi_penjualan' => '1'],['produksi_nomor' => $pesanan]);
			}

			//update produk
			$this->stok->update_produk();

			//jurnal
			// if ($po != 1) {

			// 	if ($status == 'l') {

			// 		$this->stok->jurnal($nomor, 7, 'debit', 'saldo (penjualan produk)', $total);
			// 		$this->stok->jurnal($nomor, 3, 'kredit', 'stok produk', $total);
				
			// 	} else {
					
			// 		$this->stok->jurnal($nomor, 2, 'debit', 'piutang (penjualan produk)', $total);
			// 		$this->stok->jurnal($nomor, 3, 'kredit', 'stok produk', $total);
					
			// 	}
				
			// }

			$this->session->set_flashdata('success','Data berhasil di tambah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di tambah');
		}

		redirect(base_url('penjualan/'.$redirect));
	}
	function edit($id, $active){

	    //data
	    $data['data'] = $this->query_builder->view_row("SELECT * FROM t_penjualan WHERE penjualan_id = '$id'");

	    //rekening
	    $data['rekening_data'] = $this->query_builder->view("SELECT * FROM t_rekening WHERE rekening_hapus = 0");

	    //kontak
	    $data['kontak_data'] = $this->query_builder->view("SELECT * FROM t_kontak WHERE kontak_jenis = 'p' AND kontak_hapus = 0");

	    //produk
	    $data['produk_data'] = $this->query_builder->view("SELECT * FROM t_produk WHERE produk_hapus = 0");

	    //jenis
	    $data['jenis_data'] = $this->query_builder->view("SELECT * FROM t_warna_jenis WHERE warna_jenis_hapus = 0");

	    //warna
	    $data['warna_data'] = $this->query_builder->view("SELECT * FROM t_warna WHERE warna_hapus = 0");

	    //ppn
	    $data['ppn'] = $this->query_builder->view_row("SELECT * FROM t_pajak WHERE pajak_jenis = 'penjualan'");

	    $data['url'] = $active;

	    return $data;
	}
	function get_penjualan($nomor){ 

		//penjualan barang
		$db = $this->query_builder->view("SELECT * FROM t_penjualan AS a JOIN t_penjualan_barang AS b ON a.penjualan_nomor = b.penjualan_barang_nomor JOIN t_produk_barang AS c ON b.penjualan_barang_barang = c.produk_barang_barang AND b.penjualan_barang_jenis = c.produk_barang_jenis AND b.penjualan_barang_warna = c.produk_barang_warna JOIN t_produk AS d ON c.produk_barang_barang = d.produk_id JOIN t_satuan AS e ON d.produk_satuan = e.satuan_id WHERE b.penjualan_barang_nomor = '$nomor'");
		echo json_encode($db);
	}
	function update($po, $redirect, $where){
		$nomor = strip_tags($_POST['nomor']);
		$total = strip_tags(str_replace(',', '', $_POST['total']));
		$set1 = array(
						'penjualan_nomor' => $nomor,
						'penjualan_po' => $po,
						'penjualan_tanggal' => strip_tags($_POST['tanggal']),
						'penjualan_pelanggan' => strip_tags($_POST['pelanggan']),
						'penjualan_jatuh_tempo' => strip_tags($_POST['jatuh_tempo']),
						'penjualan_pembayaran' => strip_tags($_POST['pembayaran']),
						'penjualan_status' => strip_tags($_POST['status']),
						'penjualan_keterangan' => strip_tags($_POST['keterangan']),
						'penjualan_qty_akhir' => strip_tags(str_replace(',', '', $_POST['qty_akhir'])),
						'penjualan_ppn' => strip_tags(str_replace(',', '', $_POST['ppn'])),
						'penjualan_total' => $total, 
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

		$where1 = ['penjualan_nomor' => $where];
		$db = $this->query_builder->update('t_penjualan',$result,$where1);

		//delete barang
		$where2 = ['penjualan_barang_nomor' => $where];
		$this->query_builder->delete('t_penjualan_barang',$where2);

		//save barang
		$barang = $_POST['barang'];
		$jum = count($barang);
		
		for ($i = 0; $i < $jum; ++$i) {
			$set2 = array(
						'penjualan_barang_nomor' => $nomor,
						'penjualan_barang_barang' => strip_tags($_POST['barang'][$i]),
						'penjualan_barang_jenis' => strip_tags($_POST['jenis'][$i]),
						'penjualan_barang_warna' => strip_tags($_POST['warna'][$i]),
						'penjualan_barang_qty' => strip_tags(str_replace(',', '', $_POST['qty'][$i])),
						'penjualan_barang_stok' => strip_tags(str_replace(',', '', $_POST['stok'][$i])),
						'penjualan_barang_potongan' => strip_tags(str_replace(',', '', $_POST['potongan'][$i])),
						'penjualan_barang_harga' => strip_tags(str_replace(',', '', $_POST['harga'][$i])),
						'penjualan_barang_hps' => strip_tags(str_replace(',', '', $_POST['hps'][$i])),
						'penjualan_barang_subtotal' => strip_tags(str_replace(',', '', $_POST['subtotal'][$i])),
					);	

			$this->query_builder->add('t_penjualan_barang',$set2);
		}

		if ($db == 1) {
			
			//update stok
			$this->stok->update_produk();

			//jurnal
			// if ($po != 1) {

			// 	$pen = $this->query_builder->view_row("SELECT * FROM t_penjualan WHERE penjualan_id = '$id'");
			// 	$tanggal = $pen['penjualan_tanggal'];

			// 	$this->stok->jurnal_delete($nomor);

			// 	if ($status == 'l') {

			// 		$this->stok->jurnal($nomor, 7, 'debit', 'saldo (penjualan produk)', $total, $tanggal);
			// 		$this->stok->jurnal($nomor, 3, 'kredit', 'stok produk', $total, $tanggal);
				
			// 	} else {
					
			// 		$this->stok->jurnal($nomor, 2, 'debit', 'piutang (penjualan produk)', $total, $tanggal);
			// 		$this->stok->jurnal($nomor, 3, 'kredit', 'stok produk', $total, $tanggal);
					
			// 	}
				
			// }

			$this->session->set_flashdata('success','Data berhasil di rubah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di rubah');
		}

		redirect(base_url('penjualan/'.$redirect));

	}
	function search($nomor){
		$output = $this->query_builder->view("SELECT * FROM t_penjualan WHERE penjualan_po = 1 AND penjualan_hapus = 0 AND penjualan_nomor LIKE '%$nomor%'");
		echo json_encode($output);
	}
	function search_data($nomor){
		$output = $this->query_builder->view("SELECT * FROM t_penjualan AS a JOIN t_penjualan_barang AS b ON a.penjualan_nomor = b.penjualan_barang_nomor LEFT JOIN t_produk AS c ON b.penjualan_barang_barang = c.produk_id LEFT JOIN t_satuan AS d ON c.produk_satuan = d.satuan_id WHERE a.penjualan_po = 1 AND a.penjualan_hapus = 0 AND a.penjualan_nomor = '$nomor'");
		echo json_encode($output);
	}
	function faktur($id){
		$data["title"] = 'faktur';
		$data['data'] = $this->query_builder->view("SELECT * FROM t_penjualan AS a JOIN t_penjualan_barang AS b ON a.penjualan_nomor = b.penjualan_barang_nomor JOIN t_produk AS c ON b.penjualan_barang_barang = c.produk_id JOIN t_kontak as d ON a.penjualan_pelanggan = d.kontak_id JOIN t_warna_jenis as e ON b.penjualan_barang_jenis = e.warna_jenis_id JOIN t_warna as f ON b.penjualan_barang_warna = f.warna_id WHERE a.penjualan_id = '$id'");

		
		$this->load->view('penjualan/faktur',$data);
	}
	function surat($id){

		$data["title"] = 'surat jalan';
		$data['data'] = $this->query_builder->view("SELECT * FROM t_penjualan AS a JOIN t_penjualan_barang AS b ON a.penjualan_nomor = b.penjualan_barang_nomor JOIN t_produk AS c ON b.penjualan_barang_barang = c.produk_id JOIN t_kontak as d ON a.penjualan_pelanggan = d.kontak_id JOIN t_satuan as e ON c.produk_satuan = e.satuan_id WHERE a.penjualan_id = '$id'");

		
		$this->load->view('penjualan/surat',$data);
	}

////////////////////////////////////////////////////////////////////////////////////////////

	
////////////////// Purchase Order///////////////////////////////

	function po(){
		if ( $this->session->userdata('login') == 1) {

			$active = 'po';
			$data["title"] = $active;
			$data['url'] = $active;

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('penjualan/po');
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
		$data["title"] = $redirect;

		//generate nomor transaksi
	    $pb = $this->query_builder->count("SELECT * FROM t_penjualan");
	    $data['nomor'] = 'PO-'.date('dmY').'-'.($pb+1);

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
		$data = $this->edit($id, $active);

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('penjualan/form');
	    $this->load->view('penjualan/form_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}	
	function po_update(){

		$po = 1;
		$redirect = 'po';
		$where = strip_tags($_POST['nomor']);
		$this->update($po, $redirect, $where);
	}

////////////////// Produk ///////////////////////////////

	function produk(){
		if ( $this->session->userdata('login') == 1) {

			$active = 'produk';
			$data["title"] = 'penjualan';
			$data['url'] = $active;
		    
		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('penjualan/produk');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}

	function produk_get_data(){
		
		$model = 'm_penjualan';
		$where = array('penjualan_po' => 0,'penjualan_hapus' => 0);
		$output = $this->serverside($where, $model);
		echo json_encode($output);
	}
	function produk_delete($id){

		$table = 'penjualan';
		$redirect = 'produk';
		$this->delete('penjualan', $id, $redirect);
	}
	function produk_add(){

		$redirect = 'produk';
		$data = $this->add($redirect);
		$data['url'] = $redirect;
		$data['search'] = 1;
		$data["title"] = 'penjualan';

		//generate nomor transaksi
	    $pb = $this->query_builder->count("SELECT * FROM t_penjualan");
	    $data['nomor'] = 'PJ-'.date('dmY').'-'.($pb+1);

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('penjualan/form');
	    $this->load->view('penjualan/search');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function produk_save(){
		
		//penjualan
		$po = 0;
		$redirect = 'produk';
		$where = str_replace('PJ', 'PO', strip_tags($_POST['nomor']));
		
		$cek = $this->query_builder->count("SELECT * FROM t_penjualan WHERE penjualan_nomor = '$where'");
		if ($cek > 0) {
			//update
			$this->update($po, $redirect, $where);

		}else{
			//new
			$this->save($po, $redirect);
		}
	}
	function produk_edit($id){
		
		$active = 'produk';
		$data = $this->edit($id, $active);

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('penjualan/form');
	    $this->load->view('penjualan/form_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}	
	function produk_view($id){
		
		$active = 'produk';
		$data = $this->edit($id, $active);

		$data['view'] = 1;

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('penjualan/form');
	    $this->load->view('penjualan/form_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}	
	function produk_update(){

		$po = 0;
		$redirect = 'produk';
		$where = strip_tags($_POST['nomor']);
		$this->update($po, $redirect, $where);
	}

	//////// bayar piutang /////////////////////////////////////////////////

	function bayar(){
		$data["title"] = 'bayar';

		$this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('penjualan/bayar');
	    $this->load->view('penjualan/bayar_modal');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function bayar_get_data(){
		$model = 'm_penjualan';
		$where = array('penjualan_piutang' => '1','penjualan_po' => '!= 0','penjualan_hapus' => 0);
		$output = $this->serverside($where, $model);
		echo json_encode($output);
	}
	function bayar_rotate($id){
		$tanggal = strip_tags($_POST['tanggal']);
		$keterangan = strip_tags($_POST['keterangan']);
		$jumlah = strip_tags($_POST['jumlah']);
		$kurang = strip_tags($_POST['kurang']);

		//status
		if ($kurang == 0) {
			
			$status = 'lunas';
		}else{

			$status = 'belum';
		}

		$set = array(
						'penjualan_status' => $status,
						'penjualan_pelunasan' => $tanggal,
						'penjualan_pelunasan_jumlah' => $jumlah,
						'penjualan_pelunasan_keterangan' => $keterangan
					); 
		
		$where = ['penjualan_id' => $id];
		$db = $this->query_builder->update('t_penjualan',$set,$where);

		if ($db == 1) {
			
			//update produk
			$this->stok->update_produk();

			//jurnal
			// $pen = $this->query_builder->view_row("SELECT * FROM t_penjualan WHERE penjualan_id = '$id'");
			// $nomor = $pen['penjualan_nomor'];
			// $total = $pen['penjualan_total']; 

			// $this->stok->jurnal_delete($nomor);
			// $this->stok->jurnal($nomor, 2, 'debit', 'piutang (penjualan produk)', $total);
			// $this->stok->jurnal($nomor, 3, 'kredit', 'stok produk', $total);
			//

			$this->session->set_flashdata('success','Berhasil di bayar');
		} else {
			$this->session->set_flashdata('gagal','Gagal di bayar');
		}

		redirect(base_url('penjualan/bayar'));
	}
	function get_nominal($id){

		$db = $this->query_builder->view_row("SELECT penjualan_total - penjualan_pelunasan_jumlah AS total FROM t_penjualan WHERE penjualan_id = '$id'");

		echo json_encode($db);

	}
}
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
	    $data['produk_data'] = $this->query_builder->view("SELECT * FROM t_master_produk WHERE master_produk_hapus = 0");

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
	function get_produk($id){
		//barang
		$db = $this->query_builder->view_row("SELECT * FROM t_master_produk as a JOIN t_satuan as b ON a.master_produk_satuan = b.satuan_id WHERE a.master_produk_id = '$id'");
		echo json_encode($db);
	}
	function save($po, $redirect){

		//penjualan
		$nomor = strip_tags($_POST['nomor']);
		$status = strip_tags($_POST['status']);
		$total = strip_tags(str_replace(',', '', $_POST['total']));
		$set1 = array(
						'penjualan_po' => $po,
						'penjualan_po_tanggal' => strip_tags(@$_POST['po_tanggal']),
						'penjualan_packing' => strip_tags(@$_POST['packing']),
						'penjualan_pengiriman' => strip_tags(@$_POST['pengiriman']),
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
						'penjualan_barang_qty' => strip_tags(str_replace(',', '', $_POST['qty'][$i])),
						'penjualan_barang_potongan' => strip_tags(str_replace(',', '', $_POST['potongan'][$i])),
						'penjualan_barang_harga' => strip_tags(str_replace(',', '', $_POST['harga'][$i])),
						'penjualan_barang_subtotal' => strip_tags(str_replace(',', '', $_POST['subtotal'][$i])),
					);	

			$this->query_builder->add('t_penjualan_barang',$set2);
		}

		if ($db == 1) {
			
			//update produk
			$this->stok->update_produk();

			//jurnal
			if ($po != 1) {

				if ($status == 'l') {

					$this->stok->jurnal($nomor, 7, 'debit', 'saldo (penjualan produk)', $total);
					$this->stok->jurnal($nomor, 3, 'kredit', 'stok produk', $total);
				
				} else {
					
					$this->stok->jurnal($nomor, 2, 'debit', 'piutang (penjualan produk)', $total);
					$this->stok->jurnal($nomor, 3, 'kredit', 'stok produk', $total);
					
				}
				
			}

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
	    $data['produk_data'] = $this->query_builder->view("SELECT * FROM t_master_produk WHERE master_produk_hapus = 0");

	    //ppn
	    $data['ppn'] = $this->query_builder->view_row("SELECT * FROM t_pajak WHERE pajak_jenis = 'penjualan'");

	    $data['url'] = $active;

	    return $data;
	}
	function get_penjualan($nomor){ 
		//penjualan barang
		$db = $this->query_builder->view("SELECT * FROM t_penjualan_barang AS a JOIN t_master_produk AS b ON a.penjualan_barang_barang = b.master_produk_id JOIN t_satuan as c ON b.master_produk_satuan = c.satuan_id WHERE a.penjualan_barang_nomor = '$nomor'");
		echo json_encode($db);
	}
	function update($po, $redirect, $where){
		$nomor = strip_tags($_POST['nomor']);
		$total = strip_tags(str_replace(',', '', $_POST['total']));
		$set1 = array(
						'penjualan_nomor' => $nomor,
						'penjualan_po' => $po,
						'penjualan_po_tanggal' => strip_tags(@$_POST['po_tanggal']),
						'penjualan_packing' => strip_tags(@$_POST['packing']),
						'penjualan_pengiriman' => strip_tags(@$_POST['pengiriman']),
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
						'penjualan_barang_qty' => strip_tags(str_replace(',', '', $_POST['qty'][$i])),
						'penjualan_barang_potongan' => strip_tags(str_replace(',', '', $_POST['potongan'][$i])),
						'penjualan_barang_harga' => strip_tags(str_replace(',', '', $_POST['harga'][$i])),
						'penjualan_barang_subtotal' => strip_tags(str_replace(',', '', $_POST['subtotal'][$i])),
					);	

			$this->query_builder->add('t_penjualan_barang',$set2);
		}

		if ($db == 1) {
			
			//update stok
			$this->stok->update_produk();

			//jurnal
			if ($po != 1) {

				$pen = $this->query_builder->view_row("SELECT * FROM t_penjualan WHERE penjualan_id = '$id'");
				$tanggal = $pen['penjualan_tanggal'];

				$this->stok->jurnal_delete($nomor);

				if ($status == 'l') {

					$this->stok->jurnal($nomor, 7, 'debit', 'saldo (penjualan produk)', $total, $tanggal);
					$this->stok->jurnal($nomor, 3, 'kredit', 'stok produk', $total, $tanggal);
				
				} else {
					
					$this->stok->jurnal($nomor, 2, 'debit', 'piutang (penjualan produk)', $total, $tanggal);
					$this->stok->jurnal($nomor, 3, 'kredit', 'stok produk', $total, $tanggal);
					
				}
				
			}

			$this->session->set_flashdata('success','Data berhasil di rubah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di rubah');
		}

		redirect(base_url('penjualan/'.$redirect));

	}
	function search($po){
		$output = $this->query_builder->view("SELECT penjualan_nomor as nomor FROM t_penjualan WHERE penjualan_hapus = 0 AND penjualan_po = '$po'");
		echo json_encode($output);
	}
	function search_data($nomor){
		$output = $this->query_builder->view("SELECT * FROM t_penjualan AS a JOIN t_penjualan_barang AS b ON a.penjualan_nomor = b.penjualan_barang_nomor JOIN t_master_produk as c ON b.penjualan_barang_barang = c.master_produk_id JOIN t_satuan as d ON c.master_produk_satuan = d.satuan_id WHERE a.penjualan_nomor = '$nomor'");
		echo json_encode($output);
	}
	function faktur($id){
		$data["title"] = 'faktur';
		$data['data'] = $this->query_builder->view("SELECT * FROM t_penjualan AS a JOIN t_penjualan_barang AS b ON a.penjualan_nomor = b.penjualan_barang_nomor JOIN t_master_produk AS c ON b.penjualan_barang_barang = c.master_produk_id JOIN t_kontak as d ON a.penjualan_pelanggan = d.kontak_id WHERE a.penjualan_id = '$id'");

		
		$this->load->view('penjualan/faktur',$data);
	}
	function surat($id){

		$data["title"] = 'surat jalan';
		$data['data'] = $this->query_builder->view("SELECT * FROM t_penjualan AS a JOIN t_penjualan_barang AS b ON a.penjualan_nomor = b.penjualan_barang_nomor JOIN t_master_produk AS c ON b.penjualan_barang_barang = c.master_produk_id JOIN t_kontak as d ON a.penjualan_pelanggan = d.kontak_id JOIN t_satuan as e ON c.master_produk_satuan = e.satuan_id WHERE a.penjualan_id = '$id'");

		
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
	function produk_update(){

		$po = 0;
		$redirect = 'produk';
		$where = strip_tags($_POST['nomor']);
		$this->update($po, $redirect, $where);
	}

	////////////////// Packing ///////////////////////////////

	function packing(){
		if ( $this->session->userdata('login') == 1) {

			$active = 'packing';
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

	function packing_get_data(){
		
		$model = 'm_penjualan';
		$where = array('penjualan_po' => 2,'penjualan_hapus' => 0);
		$output = $this->serverside($where, $model);
		echo json_encode($output);
	}
	function packing_delete($id){

		$table = 'penjualan';
		$redirect = 'packing';
		$this->delete('penjualan', $id, $redirect);
	}
	function packing_add(){

		$redirect = 'packing';
		$data = $this->add($redirect);
		$data['url'] = $redirect;
		$data['search'] = 0;

		//generate nomor transaksi
	    $pb = $this->query_builder->count("SELECT * FROM t_penjualan");
	    $data['nomor'] = 'PJ-'.date('dmY').'-'.($pb+1);

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('penjualan/form');
	    $this->load->view('penjualan/search');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function packing_save(){
		
		//penjualan
		$po = 2;
		$redirect = 'packing';
		$where = str_replace('PL', 'PJ', strip_tags($_POST['nomor']));
		
		$cek = $this->query_builder->count("SELECT * FROM t_penjualan WHERE penjualan_nomor = '$where'");
		if ($cek > 0) {
			//update
			$this->update($po, $redirect, $where);

		}else{
			//new
			$this->save($po, $redirect);
		}
	}
	function packing_edit($id){
		
		$active = 'packing';
		$data = $this->edit($id, $active);

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('penjualan/form');
	    $this->load->view('penjualan/form_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}	
	function packing_update(){

		$po = 2;
		$redirect = 'packing';
		$where = strip_tags($_POST['nomor']);
		$this->update($po, $redirect, $where);
	}

	//////// bayar piutang /////////////////////////////////////////////////

	function bayar(){
		$data["title"] = 'bayar';

		$this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('penjualan/bayar');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function bayar_get_data(){
		$model = 'm_penjualan';
		$where = array('penjualan_status' => 'b','penjualan_po' => '!= 0','penjualan_hapus' => 0);
		$output = $this->serverside($where, $model);
		echo json_encode($output);
	}
	function bayar_rotate($id){
		$dt = date('Y-m-d');
		$set = ['penjualan_status' => 'l', 'penjualan_pelunasan' => $dt];
		$where = ['penjualan_id' => $id];
		$db = $this->query_builder->update('t_penjualan',$set,$where);

		if ($db == 1) {
			
			//update produk
			$this->stok->update_produk();

			//jurnal
			$pen = $this->query_builder->view_row("SELECT * FROM t_penjualan WHERE penjualan_id = '$id'");
			$nomor = $pen['penjualan_nomor'];
			$total = $pen['penjualan_total']; 

			$this->stok->jurnal_delete($nomor);
			$this->stok->jurnal($nomor, 2, 'debit', 'piutang (penjualan produk)', $total);
			$this->stok->jurnal($nomor, 3, 'kredit', 'stok produk', $total);
			//

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
		$data = $this->edit($id, $active);

		$data["title"] = $active;

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('penjualan/form');
	    $this->load->view('penjualan/form_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function bayar_update(){

		$po = 0;
		$redirect = 'bayar';
		$where = strip_tags($_POST['nomor']);
		$this->update($po, $redirect, $where);
	}
}
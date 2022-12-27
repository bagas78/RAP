<?php
class Produksi extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('m_peleburan');
		$this->load->model('m_produksi');
	}  

///////////////// atribut //////////////////////////////////////////

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
	function add($kategori,$active){

		$data = $this->atribut($active);

		//user
	    $data['user_data'] = $this->query_builder->view("SELECT * FROM t_user WHERE user_level = 2 AND user_hapus = 0");

	    //billet
	    $data['billet'] = $this->query_builder->view_row("SELECT * FROM t_billet");

	    //barang
	    if ($kategori == 'all') {
	    	 $data['bahan_data'] = $this->query_builder->view("SELECT * FROM t_bahan WHERE bahan_hapus = 0 AND bahan_stok > 0");	
	    }else{
	    	 $data['bahan_data'] = $this->query_builder->view("SELECT * FROM t_bahan WHERE bahan_hapus = 0 AND bahan_kategori = '$kategori' AND bahan_stok > 0");
	    }

	    return $data;
	}
	function get_barang($id){
		//barang
		$db = $this->query_builder->view_row("SELECT * FROM t_bahan as a JOIN t_satuan as b ON a.bahan_satuan = b.satuan_id WHERE a.bahan_id = '$id'");
		echo json_encode($db);
	}
	function save($status, $redirect){

		$nomor = strip_tags($_POST['nomor']);
		$set1 = array(
						'produksi_status' => $status,
						'produksi_nomor' => $nomor,
						'produksi_tanggal' => strip_tags($_POST['tanggal']),
						'produksi_shift' => strip_tags($_POST['shift']),
						'produksi_keterangan' => strip_tags($_POST['keterangan']),
						'produksi_barang_qty' => strip_tags(str_replace(',', '', $_POST['qty_barang'])),
						'produksi_billet_qty' => strip_tags(str_replace(',', '', $_POST['qty_billet'])),
						'produksi_billet_hpp' => strip_tags(str_replace(',', '', $_POST['hpp_billet'])),
						'produksi_total_akhir' => strip_tags(str_replace(',', '', $_POST['total_akhir'])), 
						'produksi_hpp' => strip_tags(str_replace(',', '', $_POST['hpp'])), 
					);

		//upload lampiran
		$lampiran = @$_FILES['lampiran'];

		$arr = [];
		if (@$lampiran['name']) {
			//jumlah loop
			$file = $lampiran;
			$path = './assets/gambar/produksi';
			$name = 'produksi_lampiran';
			$upload = $this->upload_builder->multiple($file,$path,$name);	

      		if ($upload != 0) {
      			$arr = array_merge($arr,$upload);
     		}			
		}
		
		$merge = array_merge($set1,$arr);
		$db = $this->query_builder->add('t_produksi',$merge);

		//barang
		$barang = $_POST['barang'];
		$jum = count($barang);
		
		for ($i = 0; $i < $jum; ++$i) {
			$set2 = array(
						'produksi_barang_nomor' => $nomor,
						'produksi_barang_barang' => strip_tags($_POST['barang'][$i]),
						'produksi_barang_qty' => strip_tags(str_replace(',', '', $_POST['qty'][$i])),
						'produksi_barang_harga' => strip_tags(str_replace(',', '', $_POST['harga'][$i])),
						'produksi_barang_subtotal' => strip_tags(str_replace(',', '', $_POST['subtotal'][$i])),
					);	

			$this->query_builder->add('t_produksi_barang',$set2);
		}

		if ($db == 1) {
			
			//update
			$this->stok->update_bahan();
			$this->stok->update_billet();

			$this->session->set_flashdata('success','Data berhasil di tambah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di tambah');
		}

		redirect(base_url('produksi/'.$redirect));
	}
	function delete($table, $id, $redirect){
		$set = ["{$table}_hapus" => 1];
		$where = ["{$table}_id" => $id];
		$db = $this->query_builder->update("t_{$table}",$set,$where);

		if ($db == 1) {
			
			//update
			$this->stok->update_bahan();
			$this->stok->update_billet();

			$this->session->set_flashdata('success','Data berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}

		redirect(base_url('produksi/'.$redirect));
	}
	function edit($id, $active, $kategori){

		$data = $this->atribut($active);

	    //data
	    $data['data'] = $this->query_builder->view_row("SELECT * FROM t_produksi WHERE produksi_id = '$id'");

		//user
	    $data['user_data'] = $this->query_builder->view("SELECT * FROM t_user WHERE user_level = 2 AND user_hapus = 0");

	    //billet
	    $data['billet'] = $this->query_builder->view_row("SELECT * FROM t_billet");

	    //barang
	    if ($kategori == 'all') {
	    	 $data['bahan_data'] = $this->query_builder->view("SELECT * FROM t_bahan WHERE bahan_hapus = 0");	
	    }else{
	    	 $data['bahan_data'] = $this->query_builder->view("SELECT * FROM t_bahan WHERE bahan_hapus = 0 AND bahan_kategori = '$kategori'");
	    }

	    return $data;
	}
	function get_produksi($nomor){
		//pembelian barang
		$db = $this->query_builder->view("SELECT * FROM t_produksi_barang WHERE produksi_barang_nomor = '$nomor'");
		echo json_encode($db);
	}
	function update($nomor, $status, $redirect){

		$set1 = array(						
						'produksi_status' => $status,
						'produksi_tanggal' => strip_tags($_POST['tanggal']),
						'produksi_shift' => strip_tags($_POST['shift']),
						'produksi_keterangan' => strip_tags($_POST['keterangan']),
						'produksi_barang_qty' => strip_tags(str_replace(',', '', $_POST['qty_barang'])),
						'produksi_billet_qty' => strip_tags(str_replace(',', '', $_POST['qty_billet'])),
						'produksi_billet_hpp' => strip_tags(str_replace(',', '', $_POST['hpp_billet'])),
						'produksi_total_akhir' => strip_tags(str_replace(',', '', $_POST['total_akhir'])), 
						'produksi_hpp' => strip_tags(str_replace(',', '', $_POST['hpp'])), 
					);

		//upload lampiran
		$lampiran = @$_FILES['lampiran'];

		$arr = [];
		if (@$lampiran['name']) {
			//jumlah loop
			$file = $lampiran;
			$path = './assets/gambar/produksi';
			$name = 'produksi_lampiran';
			$upload = $this->upload_builder->multiple($file,$path,$name);	

      		if ($upload != 0) {
      			$arr = array_merge($arr,$upload);
     		}			
		}
		
		$merge = array_merge($set1,$arr);
		$db = $this->query_builder->update('t_produksi',$merge, ['produksi_nomor' => $nomor]);


		//delete barang
		$this->query_builder->delete('t_produksi_barang',['produksi_barang_nomor' => $nomor]);

		//barang
		$barang = $_POST['barang'];
		$jum = count($barang);
		
		for ($i = 0; $i < $jum; ++$i) {
			$set2 = array(
						'produksi_barang_nomor' => $nomor,
						'produksi_barang_barang' => strip_tags($_POST['barang'][$i]),
						'produksi_barang_qty' => strip_tags(str_replace(',', '', $_POST['qty'][$i])),
						'produksi_barang_harga' => strip_tags(str_replace(',', '', $_POST['harga'][$i])),
						'produksi_barang_subtotal' => strip_tags(str_replace(',', '', $_POST['subtotal'][$i])),
					);	

			$this->query_builder->add('t_produksi_barang',$set2);
		}

		if ($db == 1) {
			
			//update
			$this->stok->update_bahan();
			$this->stok->update_billet();

			$this->session->set_flashdata('success','Data berhasil di rubah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di rubah');
		}

		redirect(base_url('produksi/'.$redirect));
	}
	function search(){
		$output = $this->query_builder->view("SELECT produksi_nomor as nomor FROM t_produksi WHERE produksi_hapus = 0 AND produksi_status = '1'");
		echo json_encode($output);
	}
	function search_data($nomor){
		$output = $this->query_builder->view("SELECT * FROM t_produksi AS a JOIN t_produksi_barang AS b ON a.produksi_nomor = b.produksi_barang_nomor WHERE a.produksi_nomor = '$nomor'");
		echo json_encode($output);
	}

//////////////////////////////////////////////////////////////////////

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
		$data['bahan_data'] = $this->query_builder->view("SELECT * FROM t_bahan WHERE bahan_hapus = 0 AND bahan_stok > 0");

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
						'peleburan_qty_akhir' => strip_tags(str_replace(',', '', $_POST['qty_akhir'])),
						'peleburan_jasa' => strip_tags(str_replace(',', '', $_POST['jasa'])),
						'peleburan_billet' => strip_tags(str_replace(',', '', $_POST['billet'])),
						'peleburan_biaya' => strip_tags(str_replace(',', '', $_POST['total'])),
						'peleburan_hpp' => strip_tags(str_replace(',', '', $_POST['hpp'])),
					);

		$db = $this->query_builder->add('t_peleburan',$set);

		//table peleburan barang
		$barang = $_POST['barang'];
		$jum = count($barang);
		
		for ($i = 0; $i < $jum; ++$i) {
			$set2 = array(
						'peleburan_barang_nomor' => $nomor,
						'peleburan_barang_barang' => strip_tags($_POST['barang'][$i]),
						'peleburan_barang_qty' => strip_tags(str_replace(',', '', $_POST['qty'][$i])),
						'peleburan_barang_harga' => strip_tags(str_replace(',', '', $_POST['harga'][$i])),
						'peleburan_barang_subtotal' => strip_tags(str_replace(',', '', $_POST['subtotal'][$i])),
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
		$data['bahan_data'] = $this->query_builder->view("SELECT * FROM t_bahan WHERE bahan_hapus = 0 AND bahan_stok > 0");

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
						'peleburan_qty_akhir' => strip_tags(str_replace(',', '', $_POST['qty_akhir'])),
						'peleburan_jasa' => strip_tags(str_replace(',', '', $_POST['jasa'])),
						'peleburan_billet' => strip_tags(str_replace(',', '', $_POST['billet'])),
						'peleburan_biaya' => strip_tags(str_replace(',', '', $_POST['total'])),
						'peleburan_hpp' => strip_tags(str_replace(',', '', $_POST['hpp'])),
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
						'peleburan_barang_qty' => strip_tags(str_replace(',', '', $_POST['qty'][$i])),
						'peleburan_barang_harga' => strip_tags(str_replace(',', '', $_POST['harga'][$i])),
						'peleburan_barang_subtotal' => strip_tags(str_replace(',', '', $_POST['subtotal'][$i])),
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
	function pesanan(){
		$title = 'pesanan';
		$data = $this->atribut($title);
		$data['url'] = 'pesanan';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('produksi/table');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function pesanan_get_data()
	{
		$model = 'm_produksi';
		$where = array('produksi_hapus' => 0, 'produksi_status' => 1);
		$output = $this->serverside($where, $model);
		echo json_encode($output);
	}
	function pesanan_add(){
		
		$kategori = 'all';
		$redirect = 'pesanan';
		$data = $this->add($kategori, $redirect);
		$data['url'] = $redirect;

		//generate nomor transaksi
	    $pb = $this->query_builder->count("SELECT * FROM t_produksi WHERE produksi_hapus = 0");
	    $data['nomor'] = 'PR-'.date('dmY').'-'.($pb+1);

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('produksi/form');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function pesanan_save(){
		$status = 1;
		$redirect = 'pesanan';
		$this->save($status, $redirect);
	}
	function pesanan_delete($id){
		
		$table = 'produksi';
		$redirect = 'pesanan';
		$this->delete($table, $id, $redirect);
	}
	function pesanan_edit($id){

		$kategori = 'all';
		$active = 'pesanan';
		$data = $this->edit($id, $active, $kategori);

		$data['url'] = 'pesanan';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('produksi/form');
	    $this->load->view('produksi/form_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function pesanan_update($nomor){
		$redirect = 'pesanan';
		$status = 1;
		$this->update($nomor, $status, $redirect);
	}

//////////////// transaksi /////////////////////////////

	function transaksi(){
		$title = 'transaksi';
		$data = $this->atribut($title);		
		$data['url'] = 'transaksi';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('produksi/table');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function transaksi_get_data()
	{
		$model = 'm_produksi';
		$where = array('produksi_hapus' => 0, 'produksi_status' => 2);
		$output = $this->serverside($where, $model);
		echo json_encode($output);
	}
	function transaksi_add(){
		
		$kategori = 'all';
		$redirect = 'transaksi';
		$data = $this->add($kategori, $redirect);
		$data['url'] = $redirect;

		//generate nomor transaksi
	    $pb = $this->query_builder->count("SELECT * FROM t_produksi WHERE produksi_hapus = 0");
	    $data['nomor'] = 'PR-'.date('dmY').'-'.($pb+1);

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('produksi/form');
	    $this->load->view('produksi/search');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function transaksi_save(){
		$status = 2;
		$redirect = 'transaksi';
		$nomor = strip_tags($_POST['nomor']);
		
		$cek = $this->query_builder->count("SELECT * FROM t_produksi WHERE produksi_nomor = '$nomor'");
		if ($cek > 0) {
			//update
			$this->update($nomor, $status, $redirect);

		}else{
			//new
			$status = 2;
			$this->save($status, $redirect);
		}
	}
	function transaksi_delete($id){
		
		$table = 'produksi';
		$redirect = 'transaksi';
		$this->delete($table, $id, $redirect);
	}
	function transaksi_edit($id){

		$kategori = 'all';
		$active = 'transaksi';
		$data = $this->edit($id, $active, $kategori);

		$data['url'] = 'transaksi';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('produksi/form');
	    $this->load->view('produksi/form_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function transaksi_update($nomor){
		$redirect = 'transaksi';
		$status = 2;
		$this->update($nomor, $status, $redirect);
	}
}
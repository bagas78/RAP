<?php
class Produksi extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('m_peleburan');
		$this->load->model('m_produksi');
		$this->load->model('m_produk');
		$this->load->model('m_pewarnaan');
		$this->load->model('m_packing');
	}   

///////////////// atribut //////////////////////////////////////////

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

		//user
	    $data['user_data'] = $this->query_builder->view("SELECT * FROM t_user WHERE user_level != 0 AND user_hapus = 0");

	    //billet
	    $data['billet_data'] = $this->query_builder->view_row("SELECT * FROM t_billet");

	    //karyawan
	    $data['pekerja_data'] = $this->query_builder->view("SELECT * FROM t_karyawan WHERE karyawan_hapus = 0");

	    //produk
	    $data['produk_data'] = $this->query_builder->view("SELECT * FROM t_produk WHERE produk_hapus = 0");

	    //jenis
	    $data['jenis_data'] = $this->query_builder->view("SELECT * FROM t_warna_jenis WHERE warna_jenis_hapus = 0");

	    //jenis
	    $data['warna_data'] = $this->query_builder->view("SELECT * FROM t_warna WHERE warna_hapus = 0");

	    //mesin
	    $data['mesin_data'] = $this->query_builder->view("SELECT * FROM t_mesin WHERE mesin_hapus = 0");

	    return $data;
	}
	function save($redirect){

		$nomor = strip_tags(@$_POST['nomor']);
		$total = strip_tags(str_replace(',', '', @$_POST['total_akhir']));
		$set1 = array(
						'produksi_pekerja' => json_encode(@$_POST['pekerja']),
						'produksi_nomor' => $nomor,
						'produksi_tanggal' => strip_tags(@$_POST['tanggal']),
						'produksi_shift' => strip_tags(@$_POST['shift']),
						'produksi_keterangan' => strip_tags(@$_POST['keterangan']),
						'produksi_mesin' => strip_tags(@$_POST['mesin']), 
						'produksi_total_produksi' => strip_tags(str_replace(',', '', @$_POST['total_produksi'])),
						'produksi_barang_qty' => strip_tags(str_replace(',', '', @$_POST['qty_produk'])),
						'produksi_billet_hps' => strip_tags(str_replace(',', '', @$_POST['hps_billet'])),
						'produksi_billet_qty' => strip_tags(str_replace(',', '', @$_POST['qty_billet'])),
						'produksi_total_akhir' => $total, 
						'produksi_jasa' => strip_tags(@$_POST['jasa']),
						'produksi_billet_sisa' => strip_tags(@$_POST['sisa_billet']),
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
		$barang = @$_POST['produk'];
		$jum = count($barang);
		
		for ($i = 0; $i < $jum; ++$i) {

			$warna = @$_POST['warna'][$i];
			$set2 = array(
						'produksi_barang_nomor' => $nomor,
						'produksi_barang_matras' => strip_tags(@$_POST['matras'][$i]),
						'produksi_barang_barang' => strip_tags(@$barang[$i]),
						'produksi_barang_berat' => strip_tags(@$_POST['berat'][$i]),
						'produksi_barang_qty' => strip_tags(str_replace(',', '', @$_POST['qty'][$i])),	
						'produksi_barang_subtotal' => strip_tags(str_replace(',', '', @$_POST['subtotal'][$i])),		
					);	

			$this->query_builder->add('t_produksi_barang',$set2);
		}

		if ($db == 1) {
			
			//update
			$this->stok->update_billet();
			$this->stok->update_produk();

			//jurnal
			// 	$this->stok->jurnal($nomor, 9, 'debit', 'biaya produksi', $total);
			// 	$this->stok->jurnal($nomor, 4, 'kredit', 'stok bahan baku', $total);	

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
			// $this->stok->update_billet();
			// $this->stok->update_produk();	

			// if ($table == 'produksi') {
			// 	$pro = $this->query_builder->view_row("SELECT * FROM t_produksi WHERE produksi_id = '$id'");
			// 	$nomor = $pro['produksi_nomor'];
			// 	$this->stok->jurnal_delete($nomor, 1);	
			// }

			$this->session->set_flashdata('success','Data berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}

		redirect(base_url('produksi/'.$redirect));
	}
	function edit($id){

		//data
		$data['data'] = $this->query_builder->view_row("SELECT * FROM t_produksi WHERE produksi_id = '$id'");

		//user
	    $data['user_data'] = $this->query_builder->view("SELECT * FROM t_user WHERE user_level != 0 AND user_hapus = 0");

	    //billet
	    $data['billet_data'] = $this->query_builder->view_row("SELECT * FROM t_billet");

	    //karyawan
	    $data['pekerja_data'] = $this->query_builder->view("SELECT * FROM t_karyawan WHERE karyawan_hapus = 0");

	    //produk
	    $data['produk_data'] = $this->query_builder->view("SELECT * FROM t_produk WHERE produk_hapus = 0");

	    //jenis
	    $data['jenis_data'] = $this->query_builder->view("SELECT * FROM t_warna_jenis WHERE warna_jenis_hapus = 0");

	    //jenis
	    $data['warna_data'] = $this->query_builder->view("SELECT * FROM t_warna WHERE warna_hapus = 0");

	    //mesin
	    $data['mesin_data'] = $this->query_builder->view("SELECT * FROM t_mesin WHERE mesin_hapus = 0");

	    //data
		$data['pewarnaan_data'] = $this->query_builder->view_row("SELECT * FROM t_pewarnaan WHERE pewarnaan_id = '$id'");

	    return $data;
	}
	function get_produksi($nomor){
		//pembelian barang
		$db = $this->query_builder->view("SELECT * FROM t_produksi_barang as a LEFT JOIN t_produk as b ON a.produksi_barang_barang = b.produk_id LEFT JOIN t_satuan as c ON b.produk_satuan = c.satuan_id WHERE a.produksi_barang_nomor = '$nomor'");
		echo json_encode($db);
	}
	function update($nomor, $redirect){

		$total = strip_tags(str_replace(',', '', @$_POST['total_akhir']));
		$set1 = array(							
						'produksi_pekerja' => json_encode(@$_POST['pekerja']),				
						'produksi_tanggal' => strip_tags(@$_POST['tanggal']),
						'produksi_shift' => strip_tags(@$_POST['shift']),
						'produksi_keterangan' => strip_tags(@$_POST['keterangan']),
						'produksi_mesin' => strip_tags(@$_POST['mesin']),
						'produksi_barang_qty' => strip_tags(str_replace(',', '', @$_POST['qty_produk'])),
						'produksi_billet_hps' => strip_tags(str_replace(',', '', @$_POST['hps_billet'])),
						'produksi_billet_qty' => strip_tags(str_replace(',', '', @$_POST['qty_billet'])),
						'produksi_total_akhir' => $total, 
						'produksi_jasa' => strip_tags(@$_POST['jasa']),
						'produksi_billet_sisa' => strip_tags(@$_POST['sisa_billet']),
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

		//barang
		$barang = @$_POST['produk'];
		$jum = count($barang);
		
		for ($i = 0; $i < $jum; ++$i) {
			$warna = @$_POST['warna'][$i];
			$id = @$_POST['id'][$i];
			$delete = @$_POST['delete'][$i];
			$set2 = array(
						'produksi_barang_nomor' => $nomor,
						'produksi_barang_matras' => strip_tags(@$_POST['matras'][$i]),
						'produksi_barang_barang' => strip_tags(@$barang[$i]),
						'produksi_barang_jenis' => strip_tags(@$_POST['jenis'][$i]),
						'produksi_barang_warna' => strip_tags($warna),
						'produksi_barang_qty' => strip_tags(@$_POST['qty'][$i]),
						'produksi_barang_mf_stok' => strip_tags(str_replace(',', '', @$_POST['mf'][$i])),	
						'produksi_barang_mf' => strip_tags(@$_POST['mf_val'][$i]),
					);	

			if ($id == 0) {
				//insert
				$this->query_builder->add('t_produksi_barang',$set2);
			}else{
				if ($delete == 1) {
					//delete
					$this->query_builder->delete('t_produksi_barang',['produksi_barang_id' => $id]);
				}else{
					//update
					$this->query_builder->update('t_produksi_barang', $set2, ['produksi_barang_id' => $id]);
				}
			}
		}

		if ($db == 1) {
			
			//update
			$this->stok->update_billet();
			$this->stok->update_produk();

			// 	//status
			// 	$this->stok->jurnal_delete($nomor);
			// 	$this->stok->jurnal($nomor, 9, 'debit', 'biaya produksi', $total);
			// 	$this->stok->jurnal($nomor, 4, 'kredit', 'stok bahan baku', $total);

			$this->session->set_flashdata('success','Data berhasil di rubah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di rubah');
		}

		redirect(base_url('produksi/'.$redirect));
	}
	function search(){
		$output = $this->query_builder->view("SELECT produksi_nomor as nomor FROM t_produksi WHERE produksi_hapus = 0");
		echo json_encode($output);
	}
	function search_data($nomor){
		$output = $this->query_builder->view("SELECT * FROM t_produksi AS a JOIN t_produksi_barang AS b ON a.produksi_nomor = b.produksi_barang_nomor WHERE a.produksi_nomor = '$nomor'");
		echo json_encode($output);
	}
	function laporan($id){

		$data['title'] = 'laporan';

		$data['data'] = $this->query_builder->view("SELECT * FROM t_produksi as a JOIN t_produksi_barang as b ON a.produksi_nomor = b.produksi_barang_nomor JOIN t_produk as c ON b.produksi_barang_barang = c.produk_id WHERE a.produksi_id = '$id'");

		$this->load->view('produksi/laporan', $data);
	}

//////////////////////////////////////////////////////////////////////

	function peleburan(){
		$data["title"] = 'peleburan';

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

		$data["title"] = 'peleburan';

		//stok
		$data['bahan_data'] = $this->query_builder->view("SELECT * FROM t_bahan WHERE bahan_hapus = 0");

		//generate nomor transaksi
	    $pb = $this->query_builder->count("SELECT * FROM t_peleburan");
	    $data['nomor'] = 'PLB-'.date('dmY').'-'.($pb+1);

	    //billet sisa
	    $bil = $this->query_builder->view_row("SELECT * FROM t_billet");
	    $data['sisa_data'] = $bil['billet_sisa'];

	    //url
	    $data['url'] = 'peleburan_save';

		$this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('produksi/peleburan_form');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function peleburan_save(){

		$nomor = strip_tags(@$_POST['nomor']);
		$biaya = strip_tags(str_replace(',', '', @$_POST['total']));

		//table peleburan
		$set = array(
						'peleburan_nomor' => $nomor,
						'peleburan_tanggal' => strip_tags(@$_POST['tanggal']),
						'peleburan_qty_akhir' => strip_tags(str_replace(',', '', @$_POST['qty_akhir'])),
						'peleburan_jasa' => strip_tags(str_replace(',', '', @$_POST['jasa'])),
						'peleburan_billet' => strip_tags(str_replace(',', '', @$_POST['billet'])),
						'peleburan_billet_sisa' => strip_tags(str_replace(',', '', @$_POST['sisa'])),
						'peleburan_biaya' => $biaya,
					);

		$db = $this->query_builder->add('t_peleburan',$set);

		//table peleburan barang
		$barang = @$_POST['barang'];
		$jum = count($barang);
		
		for ($i = 0; $i < $jum; ++$i) {
			$set2 = array(
						'peleburan_barang_nomor' => $nomor,
						'peleburan_barang_barang' => strip_tags(@$_POST['barang'][$i]),
						'peleburan_barang_qty' => strip_tags(str_replace(',', '', @$_POST['qty'][$i])),
						'peleburan_barang_harga' => strip_tags(str_replace(',', '', @$_POST['harga'][$i])),
						'peleburan_barang_subtotal' => strip_tags(str_replace(',', '', @$_POST['subtotal'][$i])),
					);	

			$this->query_builder->add('t_peleburan_barang',$set2);
		}

		if ($db == 1) {

			//update billet
			$this->stok->update_billet();

			//update stok bahan
			$this->stok->update_bahan();

			//jurnal
			$this->stok->jurnal($nomor, 9, 'debit', 'biaya peleburan', $biaya);
			$this->stok->jurnal($nomor, 5, 'kredit', 'stok billet', $biaya);	

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

			//jurnal
			$pel = $this->query_builder->view_row("SELECT * FROM t_peleburan WHERE peleburan_id = '$id'");
			$nomor = $pel['peleburan_nomor'];
			$this->stok->jurnal_delete($nomor, 1);

			$this->session->set_flashdata('success','Data berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}
		
		redirect(base_url('produksi/peleburan'));	
	}
	function peleburan_edit($id){
		$data["title"] = 'peleburan';

		//data
	    $data['data'] = $this->query_builder->view_row("SELECT * FROM t_peleburan WHERE peleburan_id = '$id'");

		//stok
		$data['bahan_data'] = $this->query_builder->view("SELECT * FROM t_bahan WHERE bahan_hapus = 0");

		//billet sisa
	    $bil = $this->query_builder->view_row("SELECT * FROM t_billet");
	    $data['sisa_data'] = $bil['billet_sisa'];

	    //url
	    $data['url'] = 'peleburan_update/'.$id;

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('produksi/peleburan_form');
	    $this->load->view('produksi/peleburan_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function peleburan_view($id){
		$data["title"] = 'peleburan';

		//data
	    $data['data'] = $this->query_builder->view_row("SELECT * FROM t_peleburan WHERE peleburan_id = '$id'");

		//stok
		$data['bahan_data'] = $this->query_builder->view("SELECT * FROM t_bahan WHERE bahan_hapus = 0");

		//billet sisa
	    $bil = $this->query_builder->view_row("SELECT * FROM t_billet");
	    $data['sisa_data'] = $bil['billet_sisa'];

	    //url
	    $data['url'] = 'peleburan_update/'.$id;
	    $data['view'] = 1;

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

		$nomor = strip_tags(@$_POST['nomor']);
		$biaya = strip_tags(str_replace(',', '', @$_POST['total']));

		//table peleburan
		$set = array(
						'peleburan_tanggal' => strip_tags(@$_POST['tanggal']),
						'peleburan_qty_akhir' => strip_tags(str_replace(',', '', @$_POST['qty_akhir'])),
						'peleburan_jasa' => strip_tags(str_replace(',', '', @$_POST['jasa'])),
						'peleburan_billet' => strip_tags(str_replace(',', '', @$_POST['billet'])),
						'peleburan_billet_sisa' => strip_tags(str_replace(',', '', @$_POST['sisa'])),
						'peleburan_biaya' => $biaya,
					);

		$where = ['peleburan_id' => $id];
		$db = $this->query_builder->update('t_peleburan',$set,$where);

		//table peleburan barang
		$barang = @$_POST['barang'];
		$jum = count($barang);

		//hapus barang
		$this->query_builder->delete('t_peleburan_barang',['peleburan_barang_nomor' => $nomor]);
		
		for ($i = 0; $i < $jum; ++$i) {
			$set2 = array(
						'peleburan_barang_nomor' => $nomor,
						'peleburan_barang_barang' => strip_tags(@$_POST['barang'][$i]),
						'peleburan_barang_qty' => strip_tags(str_replace(',', '', @$_POST['qty'][$i])),
						'peleburan_barang_harga' => strip_tags(str_replace(',', '', @$_POST['harga'][$i])),
						'peleburan_barang_subtotal' => strip_tags(str_replace(',', '', @$_POST['subtotal'][$i])),
					);	

			$this->query_builder->add('t_peleburan_barang',$set2);
		}

		//update billet
		$this->stok->update_billet();

		//update stok bahan
		$this->stok->update_bahan();

		if ($db == 1) {

			//update billet
			$this->stok->update_billet();

			//update stok bahan
			$this->stok->update_bahan();

			//jurnal
			$pel = $this->query_builder->view_row("SELECT * FROM t_peleburan WHERE peleburan_id = '$id'");
			$tanggal = $pel['peleburan_tanggal'];

			$this->stok->jurnal_delete($nomor);
			$this->stok->jurnal($nomor, 9, 'debit', 'biaya peleburan', $biaya, $tanggal);
			$this->stok->jurnal($nomor, 5, 'kredit', 'stok billet', $biaya, $tanggal);	

			$this->session->set_flashdata('success','Data berhasil di rubah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di rubah');
		}
		
		redirect(base_url('produksi/peleburan'));
	}

//////////////// proses /////////////////////////////

	function proses(){
		$title = 'proses';
		$data["title"] = $title;	
		$data['url'] = $title;

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('produksi/table');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function proses_get_data()
	{
		$model = 'm_produksi';
		$where = array('produksi_hapus' => '0');
		$output = $this->serverside($where, $model);
		echo json_encode($output);
	}
	function proses_add(){
		
		$redirect = 'proses';
		$data = $this->add($redirect);
		$data['url'] = $redirect;

		//generate nomor transaksi
	    $pb = $this->query_builder->count("SELECT * FROM t_produksi");
	    $data['nomor'] = 'PR-'.date('dmY').'-'.($pb+1);

		$data["title"] = $redirect;
	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('produksi/form'); 
	    $this->load->view('produksi/search');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function proses_get_produk($id){

		$data = $this->query_builder->view_row("SELECT * FROM t_produk AS a JOIN t_satuan as b ON a.produk_satuan = b.satuan_id WHERE a.produk_hapus = 0 AND a.produk_id = '$id'");

		echo json_encode($data);
	}
	function proses_save(){
		$redirect = 'proses';
		$nomor = strip_tags(@$_POST['nomor']);
		
		$cek = $this->query_builder->count("SELECT * FROM t_produksi WHERE produksi_nomor = '$nomor'");
		if ($cek > 0) {
			//update
			$this->update($nomor, $redirect);

		}else{
			//new
			$this->save($redirect);
		}
	}
	function proses_delete($id){
		
		$table = 'produksi';
		$redirect = 'proses';
		$this->delete($table, $id, $redirect);
	}
	function proses_edit($id){

		$data = $this->edit($id);

		$data['url'] = 'proses';

		$data["title"] = 'proses';
	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('produksi/form');
	    $this->load->view('produksi/form_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function proses_view($id){

		$data = $this->edit($id);

		$data['url'] = 'proses';
		$data['view'] = 1;

		$data["title"] = 'proses';
	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('produksi/form');
	    $this->load->view('produksi/form_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function proses_update($nomor){
		$redirect = 'proses';
		$this->update($nomor, $redirect);
	}


	//////////////// pewarnaan ////////////

	function pewarnaan(){
		$data['title'] = 'pewarnaan';
		$this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('produksi/pewarnaan');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function pewarnaan_get_data(){
		$where = array('pewarnaan_hapus' => '0');

		$data = $this->m_pewarnaan->get_datatables($where);
		$total = $this->m_pewarnaan->count_all($where);
		$filter = $this->m_pewarnaan->count_filtered($where);

		$output = array( 
			"draw" => $_GET["draw"],
			"recordsTotal" => $total,
			"recordsFiltered" => $filter,
			"data" => $data,
		);

		echo json_encode($output);
	}
	function pewarnaan_add(){
		//generate nomor transaksi
	    $pb = $this->query_builder->count("SELECT * FROM t_pewarnaan");
	    $data['nomor'] = 'PW-'.date('dmY').'-'.($pb+1);

	    //jenis
	    $data['jenis_data'] = $this->query_builder->view("SELECT * FROM t_warna_jenis WHERE warna_jenis_hapus = 0 AND warna_jenis_id != 3");

	    //warna
	    $data['warna_data'] = $this->query_builder->view("SELECT * FROM t_warna WHERE warna_hapus = 0");

		//produk
		$data['produk_data'] = $this->query_builder->view("SELECT * FROM t_produk WHERE produk_hapus = 0");

		$data['title'] = 'pewarnaan';
		$this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('produksi/pewarnaan_add');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function pewarnaan_get_produk($id){

		$data = $this->query_builder->view_row("SELECT produk_barang_stok AS stok FROM t_produk_barang WHERE produk_barang_warna = 0 AND produk_barang_barang = '$id'");

		echo json_encode($data);
	}
	function pewarnaan_save(){
		$user = $this->session->userdata('id');
		$nomor = strip_tags(@$_POST['nomor']);

		$set1 = array(
						'pewarnaan_nomor' => $nomor,
						'pewarnaan_user' => $user,
						'pewarnaan_tanggal' => strip_tags(@$_POST['tanggal']),
					);

		$save = $this->query_builder->add('t_pewarnaan',$set1);
		if ($save == 1) {
			
			$jum = count($_POST['produk']);

			for ($i = 0; $i < $jum; ++$i) {
				
				$set2 = array(
							'pewarnaan_barang_barang' => strip_tags(@$_POST['produk'][$i]),
							'pewarnaan_barang_nomor' => $nomor,
							'pewarnaan_barang_stok' => strip_tags(@$_POST['stok'][$i]),
							'pewarnaan_barang_jenis' => strip_tags(@$_POST['jenis'][$i]),
							'pewarnaan_barang_warna' => strip_tags(@$_POST['warna'][$i]),
							'pewarnaan_barang_qty' => strip_tags(@$_POST['qty'][$i]),
							'pewarnaan_barang_cacat' => strip_tags(@$_POST['cacat'][$i]),
						);
				$this->query_builder->add('t_pewarnaan_barang',$set2);

			}
			
			//update stok
			$this->stok->update_pewarnaan();
			
			$this->session->set_flashdata('success','Data berhasil di simpan');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di simpan');
		}

		redirect(base_url('produksi/pewarnaan'));
	}
	function pewarnaan_delete($id){

		$table = 'pewarnaan';
		$redirect = 'pewarnaan';
		$this->delete($table, $id, $redirect);
	}
	function pewarnaan_view($id){

		//jenis
	    $data['jenis_data'] = $this->query_builder->view("SELECT * FROM t_warna_jenis WHERE warna_jenis_hapus = 0 AND warna_jenis_id != 3");

	    //warna
	    $data['warna_data'] = $this->query_builder->view("SELECT * FROM t_warna WHERE warna_hapus = 0");

		//produk
		$data['produk_data'] = $this->query_builder->view("SELECT * FROM t_produk WHERE produk_hapus = 0");

		//data
		$data['data'] = $this->query_builder->view_row("SELECT * FROM t_pewarnaan WHERE pewarnaan_id = '$id'");

		$data['url'] = 'pewarnaan';
		$data['view'] = 1;

		$data["title"] = 'pewarnaan';
	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('produksi/pewarnaan_add');
	    $this->load->view('produksi/pewarnaan_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function pewarnaan_get($id){
		$data = $this->query_builder->view("SELECT * FROM t_pewarnaan as a JOIN t_pewarnaan_barang as b ON a.pewarnaan_nomor = b.pewarnaan_barang_nomor WHERE a.pewarnaan_id = '$id'");
		echo json_encode($data);
	}
	function pewarnaan_laporan($id){
		$data['data'] = $this->query_builder->view("SELECT * FROM t_pewarnaan_barang AS a LEFT JOIN t_produk AS b ON a.pewarnaan_barang_barang = b.produk_id LEFT JOIN t_produk_barang AS c ON b.produk_id = c.produk_barang_barang LEFT JOIN t_warna AS d ON c.produk_barang_warna = d.warna_id JOIN t_pewarnaan AS e ON e.pewarnaan_nomor = a.pewarnaan_barang_nomor WHERE e.pewarnaan_id = '$id'");

	    $this->load->view('produksi/pewarnaan_laporan',$data);
	}

	//////////////////////// packing //////////////////////////

	function packing(){
		$data['title'] = 'packing';
		$this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('produksi/packing');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function packing_get_data(){
		$model = 'm_packing';
		$where = array('packing_hapus' => '0');
		$output = $this->serverside($where, $model);
		echo json_encode($output);
	}
	function packing_add(){
		//generate nomor transaksi
	    $pb = $this->query_builder->count("SELECT * FROM t_packing");
	    $data['nomor'] = 'PC-'.date('dmY').'-'.($pb+1);

	    //jenis
	    $data['jenis_data'] = $this->query_builder->view("SELECT * FROM t_warna_jenis WHERE warna_jenis_hapus = 0");

	    //warna
	    $data['warna_data'] = $this->query_builder->view("SELECT * FROM t_warna WHERE warna_hapus = 0");

		//produk
		$data['produk_data'] = $this->query_builder->view("SELECT * FROM t_produk WHERE produk_hapus = 0");

		$data['title'] = 'packing';
		$this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('produksi/packing_add');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function packing_get_produk($id, $jenis, $warna){

		$data = $this->query_builder->view_row("SELECT * ,(produk_barang_stok - produk_barang_packing) AS stok FROM t_produk_barang WHERE produk_barang_barang = '$id' AND produk_barang_jenis = '$jenis' AND produk_barang_warna = '$warna'");

		if (@$data) {
			$stok = $data['stok'];	
		}else{
			$stok = 0;
		}

		echo json_encode($stok);
	}
	function packing_save(){
		$user = $this->session->userdata('id');
		$nomor = strip_tags(@$_POST['nomor']);

		$set1 = array(
						'packing_nomor' => $nomor,
						'packing_user' => $user,
						'packing_tanggal' => strip_tags(@$_POST['tanggal']),
					);

		$save = $this->query_builder->add('t_packing',$set1);
		if ($save == 1) {
			
			$jum = count($_POST['produk']);

			for ($i = 0; $i < $jum; ++$i) {
				
				$set2 = array(
							'packing_barang_barang' => strip_tags(@$_POST['produk'][$i]),
							'packing_barang_nomor' => $nomor,
							'packing_barang_stok' => strip_tags(@$_POST['stok'][$i]),
							'packing_barang_jenis' => strip_tags(@$_POST['jenis'][$i]),
							'packing_barang_warna' => strip_tags(@$_POST['warna'][$i]),
							'packing_barang_qty' => strip_tags(@$_POST['qty'][$i]),
						);
				$this->query_builder->add('t_packing_barang',$set2);

			}
			
			//update stok
			$this->stok->update_packing();
			
			$this->session->set_flashdata('success','Data berhasil di simpan');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di simpan');
		}

		redirect(base_url('produksi/packing'));
	}
	function packing_view($id){

	    //jenis
	    $data['jenis_data'] = $this->query_builder->view("SELECT * FROM t_warna_jenis WHERE warna_jenis_hapus = 0");

	    //warna
	    $data['warna_data'] = $this->query_builder->view("SELECT * FROM t_warna WHERE warna_hapus = 0");

		//produk
		$data['produk_data'] = $this->query_builder->view("SELECT * FROM t_produk WHERE produk_hapus = 0");

		//data
		$data['data'] = $this->query_builder->view_row("SELECT * FROM t_packing WHERE packing_id = '$id'");

		$data['view'] = 1;
		$data['title'] = 'packing';
		$this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('produksi/packing_add');
	    $this->load->view('produksi/packing_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function packing_get($id){
		$data = $this->query_builder->view("SELECT * FROM t_packing as a JOIN t_packing_barang as b ON a.packing_nomor = b.packing_barang_nomor WHERE a.packing_id = '$id'");
		echo json_encode($data);
	}	
	function packing_delete($id){

		$table = 'packing';
		$redirect = 'packing';
		$this->delete($table, $id, $redirect);
	}
	function packing_laporan($id){
		$data['data'] = $this->query_builder->view("SELECT * FROM t_packing_barang AS a LEFT JOIN t_produk AS b ON a.packing_barang_barang = b.produk_id LEFT JOIN t_packing_barang AS c ON b.produk_id = c.packing_barang_barang LEFT JOIN t_warna AS d ON c.packing_barang_warna = d.warna_id JOIN t_packing AS e ON e.packing_nomor = a.packing_barang_nomor WHERE e.packing_id = '$id'");

	    $this->load->view('produksi/packing_laporan',$data);
	}

}
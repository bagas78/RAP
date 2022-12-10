<?php
class Pembelian extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('m_pembelian');
		$this->load->model('m_bahan');
	} 

	//Master Bahan

	function bahan(){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'Pembelian';
		    $data['pembelian_open'] = 'menu-open';
		    $data['pembelian_block'] = 'style="display: block;"';
		    $data['pembelian_bahan_active'] = 'class="active"';

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('pembelian/bahan');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}
	function get_bahan(){
		$where = array('bahan_hapus' => 0);

	    $data = $this->m_bahan->get_datatables($where);
		$total = $this->m_bahan->count_all($where);
		$filter = $this->m_bahan->count_filtered($where);

		$output = array(
			"draw" => $_GET['draw'],
			"recordsTotal" => $total,
			"recordsFiltered" => $filter,
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	} 
	function add_bahan(){
		$data['title'] = 'Pembelian';
	    $data['pembelian_open'] = 'menu-open';
	    $data['pembelian_block'] = 'style="display: block;"';
	    $data['pembelian_bahan_active'] = 'class="active"';

	    $data['satuan_data'] = $this->query_builder->view("SELECT * FROM t_satuan WHERE satuan_hapus = 0");

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('pembelian/bahan_add');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function save_bahan(){
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
	function edit_bahan($id){
		$data['title'] = 'Pembelian';
	    $data['pembelian_open'] = 'menu-open';
	    $data['pembelian_block'] = 'style="display: block;"';
	    $data['pembelian_bahan_active'] = 'class="active"';

	    $data['satuan_data'] = $this->query_builder->view("SELECT * FROM t_satuan WHERE satuan_hapus = 0");
	    $data['data'] = $this->query_builder->view_row("SELECT * FROM t_bahan as a JOIN t_satuan as b ON a.bahan_satuan = b.satuan_id WHERE a.bahan_id = '$id'");

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('pembelian/bahan_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function update_bahan($id){
		$set = array(
						'bahan_nama' => strip_tags($_POST['nama']),
						'bahan_kategori' => strip_tags($_POST['kategori']),
						'bahan_satuan' => strip_tags($_POST['satuan']),
						'bahan_harga' => strip_tags($_POST['harga']),
					);

		$where = ['bahan_id' => $id];
		$db = $this->query_builder->update('t_bahan',$set,$where);
		
		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}

		redirect(base_url('pembelian/bahan'));
	}
	function delete_bahan($id){
		$set = ['bahan_hapus' => 1];
		$where = ['bahan_id' => $id];
		$db = $this->query_builder->update('t_bahan',$set,$where);
		
		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}
		
		redirect(base_url('pembelian/bahan'));
	}

	//Purchase Order

	function po(){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'Purchase Order';
		    $data['pembelian_open'] = 'menu-open';
		    $data['pembelian_block'] = 'style="display: block;"';
		    $data['pembelian_po_active'] = 'class="active"';

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('pembelian/po');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}
	function po_get_data(){
		$where = array('pembelian_hapus' => 0);

	    $data = $this->m_pembelian->get_datatables($where);
		$total = $this->m_pembelian->count_all($where);
		$filter = $this->m_pembelian->count_filtered($where);

		$output = array(
			"draw" => $_GET['draw'],
			"recordsTotal" => $total,
			"recordsFiltered" => $filter,
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}
	function po_delete($id){
		$set = ['pembelian_hapus' => 1];
		$where = ['pembelian_id' => $id];
		$db = $this->query_builder->update('t_pembelian',$set,$where);
		
		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}
		
		redirect(base_url('pembelian/po'));
	}
	function po_add(){
		$data['title'] = 'Purchase Order';
	    $data['pembelian_open'] = 'menu-open';
	    $data['pembelian_block'] = 'style="display: block;"';
	    $data['pembelian_po_active'] = 'class="active"';

	    //generate nomor transaksi
	    $pb = $this->query_builder->count("SELECT * FROM t_pembelian WHERE pembelian_hapus = 0");
	    $data['nomor'] = 'PA-'.date('dmY').'-'.($pb+1);

	    //kontak
	    $data['kontak_data'] = $this->query_builder->view("SELECT * FROM t_kontak WHERE kontak_jenis = 's' AND kontak_hapus = 0");

	    //barang
	    $data['bahan_data'] = $this->query_builder->view("SELECT * FROM t_bahan WHERE bahan_hapus = 0");

	    //ppn
	    $data['ppn'] = $this->query_builder->view_row("SELECT * FROM t_pajak WHERE pajak_jenis = 'pembelian'");

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('pembelian/po_add');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function po_get_barang($id){
		//barang
		$db = $this->query_builder->view_row("SELECT * FROM t_bahan as a JOIN t_satuan as b ON a.bahan_satuan = b.satuan_id WHERE a.bahan_id = '$id'");
		echo json_encode($db);
	}
	function po_save(){
		
		//pembelian
		$nomor = strip_tags($_POST['nomor']);
		$set1 = array(
						'pembelian_nomor' => $nomor,
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

			//type file
			$typefile = explode('/', $lampiran['type']);

			//replace Karakter name foto
			$filename = $lampiran['name'];

			//replace name foto
			$type = explode(".", $filename);
	    	$no = count($type) - 1;
	    	$new_name = md5(time()).'.'.$type[$no];

		 	//config
			  $config = array(
			  'upload_path' 	=> './assets/gambar/pembelian/po',
			  'allowed_types' 	=> "gif|jpg|png|jpeg",
			  'overwrite' 		=> TRUE,
			  'max_size' 		=> "2000",
			  'file_name'		=> $new_name,
			  );

	          //Load upload library
	          $this->load->library('upload',$config);
	          
	          if ($this->upload->do_upload('lampiran')) {
	          	$push = array('pembelian_lampiran' => $new_name);
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
						'pembelian_barang_qty' => strip_tags($_POST['qty'][$i]),
						'pembelian_barang_potongan' => strip_tags($_POST['potongan'][$i]),
						'pembelian_barang_harga' => strip_tags($_POST['harga'][$i]),
						'pembelian_barang_subtotal' => strip_tags($_POST['subtotal'][$i]),
					);	

			$this->query_builder->add('t_pembelian_barang',$set2);
		}

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di tambah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di tambah');
		}

		redirect(base_url('pembelian/po'));
	}
	function po_edit($id){
		$data['title'] = 'Purchase Order';
	    $data['pembelian_open'] = 'menu-open';
	    $data['pembelian_block'] = 'style="display: block;"';
	    $data['pembelian_po_active'] = 'class="active"';

	    //generate nomor transaksi
	    $data['data'] = $this->query_builder->view_row("SELECT * FROM t_pembelian WHERE pembelian_id = '$id'");

	    //kontak
	    $data['kontak_data'] = $this->query_builder->view("SELECT * FROM t_kontak WHERE kontak_jenis = 's' AND kontak_hapus = 0");

	    //barang
	    $data['bahan_data'] = $this->query_builder->view("SELECT * FROM t_bahan WHERE bahan_hapus = 0");

	    //ppn
	    $data['ppn'] = $this->query_builder->view_row("SELECT * FROM t_pajak WHERE pajak_jenis = 'pembelian'");

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('pembelian/po_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function po_get_pembelian($nomor){
		//pembelian barang
		$db = $this->query_builder->view("SELECT * FROM t_pembelian_barang WHERE pembelian_barang_nomor = '$nomor'");
		echo json_encode($db);
	}
	function po_update($nomor){
		//pembelian
		$nomor = strip_tags($_POST['nomor']);
		$set1 = array(
						'pembelian_nomor' => $nomor,
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

			//type file
			$typefile = explode('/', $lampiran['type']);

			//replace Karakter name foto
			$filename = $lampiran['name'];

			//replace name foto
			$type = explode(".", $filename);
	    	$no = count($type) - 1;
	    	$new_name = md5(time()).'.'.$type[$no];

		 	//config
			  $config = array(
			  'upload_path' 	=> './assets/gambar/pembelian/po',
			  'allowed_types' 	=> "gif|jpg|png|jpeg",
			  'overwrite' 		=> TRUE,
			  'max_size' 		=> "2000",
			  'file_name'		=> $new_name,
			  );

	          //Load upload library
	          $this->load->library('upload',$config);
	          
	          if ($this->upload->do_upload('lampiran')) {
	          	$push = array('pembelian_lampiran' => $new_name);
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
			$this->session->set_flashdata('success','Data berhasil di tambah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di tambah');
		}

		redirect(base_url('pembelian/po'));
	}
}
<?php
class Inventori extends CI_Controller{

	function __construct(){ 
		parent::__construct();
		$this->load->model('m_penyesuaian');
	}  
	function opname_penjualan(){
		$data['title'] = 'Opname Penjualan';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('inventori/opname_penjualan');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function opname_get_penjualan(){
		$tanggal = strip_tags($_POST['tanggal']);
 
		//penjualan
		$data = $this->query_builder->view("SELECT d.produk_kode AS kode, d.produk_nama AS nama, e.satuan_singkatan AS satuan, a.penjualan_barang_harga AS harga, a.penjualan_barang_hps AS hps ,a.penjualan_barang_stok AS stok, a.penjualan_barang_qty AS qty FROM t_penjualan_barang AS a JOIN t_penjualan AS b ON a.penjualan_barang_nomor = b.penjualan_nomor JOIN t_produk_barang AS c ON c.produk_barang_barang = a.penjualan_barang_barang AND c.produk_barang_jenis = a.penjualan_barang_jenis AND c.produk_barang_warna = a.penjualan_barang_warna JOIN t_produk AS d ON c.produk_barang_barang = d.produk_id JOIN t_satuan AS e ON d.produk_satuan = e.satuan_id WHERE b.penjualan_tanggal = '$tanggal'");

		echo json_encode($data);
	}
	function opname_pembelian(){
		$data['title'] = 'Opname Pembelian';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('inventori/opname_pembelian');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function opname_get_pembelian(){
		$tanggal = strip_tags($_POST['tanggal']);
 
		//penjualan
		$data = $this->query_builder->view("SELECT c.bahan_kode AS kode, c.bahan_nama AS nama, d.satuan_singkatan AS satuan, a.pembelian_barang_harga AS harga ,a.pembelian_barang_stok AS stok, a.pembelian_barang_qty AS qty FROM t_pembelian_barang AS a JOIN t_pembelian AS b ON a.pembelian_barang_nomor = b.pembelian_nomor JOIN t_bahan AS c ON c.bahan_id = a.pembelian_barang_barang JOIN t_satuan AS d ON c.bahan_satuan = d.satuan_id WHERE b.pembelian_tanggal = '$tanggal'");

		echo json_encode($data);
	}
	function penyesuaian(){

		$data['title'] = 'Penyesuaian Stok';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('inventori/penyesuaian');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function penyesuaian_delete($id){

		$set = ['penyesuaian_hapus' => 1];
		$where = ['penyesuaian_id' => $id];
		$db = $this->query_builder->update('t_penyesuaian',$set,$where);
		
		if ($db == 1) {
			//update stok
			$this->stok->update_bahan();
			$this->stok->update_produk();

			$this->session->set_flashdata('success','Data berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}
		
		redirect(base_url('inventori/penyesuaian'));	
	}
	function penyesuaian_get_data(){
		$where = array('penyesuaian_hapus' => 0);

	    $data = $this->m_penyesuaian->get_datatables($where);
		$total = $this->m_penyesuaian->count_all($where);
		$filter = $this->m_penyesuaian->count_filtered($where);

		$output = array(
			"draw" => $_GET['draw'],
			"recordsTotal" => $total,
			"recordsFiltered" => $filter,
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}
	function penyesuaian_add(){

		//generate nomor
	    $nomor = $this->query_builder->count("SELECT * FROM t_penyesuaian");
	    $data['nomor'] = 'PN-'.date('dmY').'-'.($nomor+1);

	    //atribut
	    $jenis = @$_POST['jenis'];
	    $data['jenis'] = $jenis;
	    $data['transaksi'] = @$_POST['transaksi'];
	    $data['kategori'] = @$_POST['kategori'];
	    $data['tanggal'] = @$_POST['tanggal'];

	    //barang
	    if ($jenis == 'pembelian') {
	    	
	    	$data['barang_data'] = $this->query_builder->view("SELECT bahan_id AS id, bahan_nama AS nama FROM t_bahan WHERE bahan_hapus = 0");	
	    }else{

	    	$data['barang_data'] = $this->query_builder->view("SELECT produk_id AS id, produk_nama AS nama FROM t_produk WHERE produk_hapus = 0");

	    	//jenis
		    $data['jenis_data'] = $this->query_builder->view("SELECT * FROM t_warna_jenis WHERE warna_jenis_hapus = 0");

		    //warna
		    $data['warna_data'] = $this->query_builder->view("SELECT * FROM t_warna WHERE warna_hapus = 0");
	    }

		$data['title'] = 'Penyesuaian Stok';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('inventori/penyesuaian_add');
	    $this->load->view('v_template_admin/admin_footer');		
	}
	function penyesuaian_get($jenis, $id){

		if ($jenis == 'pembelian') {
			
			//barang
	    	$data = $this->query_builder->view("SELECT bahan_id AS id, bahan_nama AS nama, bahan_stok as stok, satuan_singkatan as satuan FROM t_bahan as a JOIN t_satuan as b ON a.bahan_satuan = b.satuan_id WHERE a.bahan_id = '$id'");	
		}else{

			//produk
	    	$data = $this->query_builder->view("SELECT satuan_singkatan as satuan FROM t_produk as a JOIN t_satuan as b ON a.produk_satuan = b.satuan_id WHERE a.produk_id = '$id'");	
		}

	    echo json_encode($data);
	}
	function penyesuaian_warna_get($barang, $jenis, $warna){

		$data = $this->query_builder->view_row("SELECT produk_barang_stok AS stok FROM t_produk_barang WHERE produk_barang_barang = '$barang' AND produk_barang_jenis = '$jenis' AND produk_barang_warna = '$warna'");	
		
		echo json_encode($data);
	}
	function penyesuaian_save(){
		
		$nomor = strip_tags(@$_POST['nomor']);

		$set1 = array(
						'penyesuaian_nomor' => $nomor,
						'penyesuaian_jenis' => strip_tags(@$_POST['jenis']),
						'penyesuaian_transaksi' => strip_tags(@$_POST['transaksi']),
						'penyesuaian_kategori' => strip_tags(@$_POST['kategori']),
						'penyesuaian_keterangan' => strip_tags(@$_POST['keterangan']),
						'penyesuaian_tanggal' => strip_tags(@$_POST['tanggal']),
					);

		if ($this->query_builder->add('t_penyesuaian', $set1)) {
			
			$jum = count(@$_POST['barang']);

			for ($i = 0; $i < $jum; ++$i) {
				
				$set2 = array(
								'penyesuaian_barang_nomor' => $nomor,
								'penyesuaian_barang_barang' => strip_tags(@$_POST['barang'][$i]),
								'penyesuaian_barang_jenis' => strip_tags(@$_POST['barang_jenis'][$i]),
								'penyesuaian_barang_warna' => strip_tags(@$_POST['warna'][$i]),
								'penyesuaian_barang_jumlah' => strip_tags(@$_POST['jumlah'][$i]),
								'penyesuaian_barang_stok' => strip_tags(str_replace(',', '', @$_POST['stok'][$i])),
								'penyesuaian_barang_selisih' => strip_tags(str_replace(',', '', @$_POST['selisih'][$i])),
								'penyesuaian_barang_status' => strip_tags(@$_POST['status'][$i]),
							);
				$this->query_builder->add('t_penyesuaian_barang', $set2);
			}
			
			$this->session->set_flashdata('success','Data berhasil di tambah');

			//update stok
			$this->stok->update_bahan();
			$this->stok->update_produk();
			
		} else {

			$this->session->set_flashdata('gagal','Data gagal di tambah');
		}

		redirect(base_url('inventori/penyesuaian'));
	}
	function penyesuaian_view($id){

		$data['data'] = $this->query_builder->view("SELECT * FROM t_penyesuaian as a JOIN t_penyesuaian_barang as b ON a.penyesuaian_nomor = b.penyesuaian_barang_nomor WHERE a.penyesuaian_id = '$id'");

		$jenis = $data['data'][0]['penyesuaian_jenis'];

		//barang
	    if ($jenis == 'pembelian') {
	    	
	    	$data['barang_data'] = $this->query_builder->view("SELECT bahan_id AS id, bahan_nama AS nama FROM t_bahan");	
	    }else{

	    	$data['barang_data'] = $this->query_builder->view("SELECT produk_id AS id, produk_nama AS nama FROM t_produk");

	    	//jenis
		    $data['jenis_data'] = $this->query_builder->view("SELECT * FROM t_warna_jenis");

		    //warna
		    $data['warna_data'] = $this->query_builder->view("SELECT * FROM t_warna");
	    }
	 	
	 	$data['jenis'] = $jenis;
	 	$data['view'] = 1;
		$data['title'] = 'Penyesuaian Stok';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('inventori/penyesuaian_add');
	    $this->load->view('inventori/penyesuaian_view');
	    $this->load->view('v_template_admin/admin_footer');

	    // echo '<pre>';
	    // print_r($data['data']);
	}
}
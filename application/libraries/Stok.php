 <?php
class Stok{ 
  protected $sql;
  function __construct(){
        $this->sql = &get_instance();
  }
  function cek($table, $where){
    $this->sql->db->where($where);
    return $this->sql->db->get($table)->num_rows();
  }

  /////////////////////////////////////////// atribut /////////////////////////////////////////////////
 
  function bahan(){ 
    //sum stok bahan update
      $pembelian = $this->sql->db->query("SELECT b.pembelian_barang_barang AS pembelian_barang ,SUM(b.pembelian_barang_qty) AS pembelian_jumlah FROM t_pembelian AS a JOIN t_pembelian_barang AS b ON a.pembelian_nomor = b.pembelian_barang_nomor WHERE a.pembelian_hapus = 0 AND a.pembelian_po = 0 GROUP BY b.pembelian_barang_barang")->result_array();

      $peleburan = $this->sql->db->query("SELECT b.peleburan_barang_barang AS peleburan_barang, SUM(b.peleburan_barang_qty) AS peleburan_jumlah FROM t_peleburan AS a JOIN t_peleburan_barang AS b ON a.peleburan_nomor = b.peleburan_barang_nomor WHERE peleburan_hapus = 0 GROUP BY b.peleburan_barang_barang")->result_array();

      $produksi = $this->sql->db->query("SELECT b.produksi_barang_barang AS produksi_barang, SUM(b.produksi_barang_qty) AS produksi_jumlah FROM t_produksi AS a JOIN t_produksi_barang AS b ON a.produksi_nomor = b.produksi_barang_nomor WHERE produksi_hapus = 0 GROUP BY b.produksi_barang_barang")->result_array();

      $pewarnaan = $this->sql->db->query("SELECT SUM(b.pewarnaan_barang_cacat) AS cacat FROM t_pewarnaan AS a JOIN t_pewarnaan_barang AS b ON a.pewarnaan_nomor = b.pewarnaan_barang_nomor WHERE a.pewarnaan_hapus = 0")->result_array();

      $penyesuaian = $this->sql->db->query("SELECT b.penyesuaian_barang_barang AS id, a.penyesuaian_jenis AS jenis, SUM(b.penyesuaian_barang_selisih) AS jumlah, b.penyesuaian_barang_status AS status FROM t_penyesuaian AS a JOIN t_penyesuaian_barang AS b ON a.penyesuaian_nomor = b.penyesuaian_barang_nomor WHERE a.penyesuaian_jenis = 'pembelian' AND a.penyesuaian_hapus = 0 GROUP BY b.penyesuaian_barang_barang, b.penyesuaian_barang_status")->result_array();

      //pembelian update stok produk
      foreach ($pembelian as $pb) {
        $id = $pb['pembelian_barang'];
        $jum = $pb['pembelian_jumlah'];

        $set = ['bahan_stok' => $jum];
        $where = ['bahan_id' => $id];

        $this->sql->db->set($set);
        $this->sql->db->where($where);
        $this->sql->db->update('t_bahan');

      }

      //tambah stok bahan cacat BH000
      foreach ($pewarnaan as $pw) {
        $jum = $pw['cacat'];
        if ($jum != '') {
          $this->sql->db->query("UPDATE t_bahan SET bahan_stok = bahan_stok + {$jum} WHERE bahan_id = 0"); 
        }
      }

      //kurangi peleburan
      foreach ($peleburan as $pl) {
        $id = $pl['peleburan_barang'];
        $jum = $pl['peleburan_jumlah'];
        $this->sql->db->query("UPDATE t_bahan SET bahan_stok = bahan_stok - {$jum} WHERE bahan_id = {$id}");
      }

      //kurangi produksi
      foreach ($produksi as $pr) {
        $id = $pr['produksi_barang'];
        $jum = $pr['produksi_jumlah'];
        $this->sql->db->query("UPDATE t_bahan SET bahan_stok = bahan_stok - {$jum} WHERE bahan_id = {$id}");
      }

      //kurangi penyesuain stok
      foreach ($penyesuaian as $pn) {
        $id = $pn['id'];
        $jum = $pn['jumlah'];
        $status = $pn['status'];
        $jenis = $pn['jenis'];

        if ($status == 'bertambah') {
          //bertambah
          $this->sql->db->query("UPDATE t_bahan SET bahan_stok = bahan_stok + {$jum} WHERE bahan_id = {$id}");   

        }else{
          //berkurang
          $this->sql->db->query("UPDATE t_bahan SET bahan_stok = bahan_stok - {$jum} WHERE bahan_id = {$id}");

        }
       
      }

      return;
  }
  function billet(){

    //sum stok billet
    $db1 = $this->sql->db->query("SELECT SUM(peleburan_billet) AS billet, (SUM(peleburan_biaya) / SUM(peleburan_billet)) AS hps, SUM(peleburan_biaya) as hpp, SUM(peleburan_billet_sisa) as billet_sisa FROM t_peleburan WHERE peleburan_hapus = 0")->row_array();
    
    $db2 = $this->sql->db->query("SELECT SUM(produksi_billet_qty) AS qty, SUM(produksi_billet_sisa) as billet_sisa FROM t_produksi WHERE produksi_hapus = 0")->row_array();

    //stok dan hpp dan billet
    $full = $db1['billet'];
    $min = $db2['qty'];
    $stok = $full - $min;
    $hps = $db1['hps'];
    $hpp = $db1['hpp'];
    $billet_sisa = $db2['billet_sisa'] - $db1['billet_sisa'];

    $get = $this->sql->db->query("SELECT * FROM t_billet")->row_array();
    $id = $get['billet_id']; 

    $set = ['billet_full' => $full, 'billet_min' => $min, 'billet_stok' => $stok, 'billet_hps' => $hps, 'billet_hpp' => $hpp,'billet_sisa' => $billet_sisa, 'billet_update' => date('Y-m-d')];
    $where = ['billet_id' => $id];

    $this->sql->db->set($set);
    $this->sql->db->where($where);
    return $this->sql->db->update('t_billet');

  }
  function produk(){

    $db1 = $this->sql->db->query("SELECT a.produksi_barang_barang AS produk, SUM(a.produksi_barang_qty) AS stok, b.produksi_total_akhir AS total FROM t_produksi_barang as a JOIN t_produksi as b ON a.produksi_barang_nomor = b.produksi_nomor  WHERE b.produksi_hapus = 0 GROUP BY a.produksi_barang_barang")->result_array();

    $db2 = $this->sql->db->query("SELECT b.penyesuaian_barang_barang AS id, a.penyesuaian_jenis AS jenis, SUM(b.penyesuaian_barang_selisih) AS jumlah, b.penyesuaian_barang_status AS status FROM t_penyesuaian AS a JOIN t_penyesuaian_barang AS b ON a.penyesuaian_nomor = b.penyesuaian_barang_nomor WHERE a.penyesuaian_jenis = 'penjualan' AND a.penyesuaian_hapus = 0 GROUP BY b.penyesuaian_barang_barang, b.penyesuaian_barang_status")->result_array();

    $table = 't_produk_barang';
    
    foreach ($db1 as $val1) {

      $produk = @$val1['produk'];
      $stok = @$val1['stok'];
      $total = @$val1['total'] / @$stok;

      $this->sql->db->set(['produk_barang_barang' => $produk, 'produk_barang_stok' => $stok, 'produk_barang_jenis' => 3, 'produk_barang_warna' => 0, 'produk_barang_hps' => $total]);
      
      $where = ['produk_barang_barang' => $produk, 'produk_barang_warna' => 0];

      if ($this->cek($table, $where)) {
        //update
        $this->sql->db->where($where);
        $this->sql->db->update($table);
      }else{
        //insert
        $this->sql->db->insert($table);
      }
      
    }

    //kurangi penyesuain stok
    foreach ($db2 as $value) {
      $id = $value['id'];
      $jum = $value['jumlah'];
      $status = $value['status'];
      $jenis = $value['jenis'];

      if ($status == 'bertambah') {
        //bertambah
        $this->sql->db->query("UPDATE t_produk_barang SET produk_barang_stok = produk_barang_stok + {$jum} WHERE produk_barang_barang = {$id}");   

      }else{
        //berkurang
        $this->sql->db->query("UPDATE t_produk_barang SET produk_barang_stok = produk_barang_stok - {$jum} WHERE produk_barang_barang = {$id}");

      }
     
    }

    return;

  }

  function pewarnaan(){
    $db1 = $this->sql->db->query("SELECT b.pewarnaan_barang_barang AS produk, b.pewarnaan_barang_jenis AS jenis, b.pewarnaan_barang_warna AS warna, SUM(b.pewarnaan_barang_qty) AS jumlah FROM t_pewarnaan AS a JOIN t_pewarnaan_barang AS b ON a.pewarnaan_nomor = b.pewarnaan_barang_nomor WHERE a.pewarnaan_hapus = 0 GROUP BY b.pewarnaan_barang_barang, b.pewarnaan_barang_jenis, b.pewarnaan_barang_warna")->result_array();

     foreach ($db1 as $value) {
       
      $produk = $value['produk'];
      $jenis = $value['jenis'];
      $warna = $value['warna'];
      $jumlah = $value['jumlah'];

      //tambah
      $cek = $this->sql->db->query("SELECT * FROM t_produk_barang WHERE produk_barang_barang = {$produk} AND produk_barang_jenis = {$jenis} AND produk_barang_warna = {$warna}")->num_rows();

      if (@$cek > 0) {

        //update
        $this->sql->db->query("UPDATE t_produk_barang SET produk_barang_stok = $jumlah WHERE produk_barang_barang = {$produk} AND produk_barang_jenis = {$jenis} AND produk_barang_warna = {$warna}");  

      }else{

        //ambil hps
        $get = $this->sql->db->query("SELECT * FROM t_produk_barang WHERE produk_barang_barang = {$produk} AND produk_barang_warna = 0")->row_array();
        $hps = $get['produk_barang_hps'];

        //add
        $this->sql->db->query("INSERT INTO t_produk_barang (produk_barang_barang, produk_barang_stok, produk_barang_jenis, produk_barang_warna, produk_barang_hps) VALUES ($produk, $jumlah, $jenis, $warna, $hps)");
      }

      //kurangi
      $this->sql->db->query("UPDATE t_produk_barang SET produk_barang_stok = produk_barang_stok - $jumlah WHERE produk_barang_barang = {$produk} AND produk_barang_warna = 0"); 

      ////////////////////////////////////////////////////////////////////////////////////////////////////

     }

     return;
  }

  function packing(){

     $db1 = $this->sql->db->query("SELECT a.packing_barang_barang AS produk, a.packing_barang_jenis AS jenis, a.packing_barang_warna AS warna, SUM(a.packing_barang_qty) AS jumlah FROM t_packing_barang AS a JOIN t_packing AS b ON a.packing_barang_nomor = b.packing_nomor WHERE packing_hapus = 0 GROUP BY a.packing_barang_barang, a.packing_barang_jenis, a.packing_barang_warna")->result_array();

    foreach ($db1 as $value) {
      
      $produk = $value['produk'];
      $jenis = $value['jenis'];
      $warna = $value['warna'];
      $jumlah = $value['jumlah'];

      $this->sql->db->set(['produk_barang_packing' => $jumlah]);
      $this->sql->db->where(['produk_barang_barang' => $produk, 'produk_barang_jenis' => $jenis, 'produk_barang_warna' => $warna]);
      $this->sql->db->update('t_produk_barang');

    }
  }

  ///////////////////////////////////// end tribut ////////////////////////////////////////////////////

  function update_bahan(){
    $this->bahan();
  }
  function update_billet(){
    $this->billet();
  }
  function update_produk(){

    $this->produk();
    $this->pewarnaan();
  }
  function update_pewarnaan(){

    $this->produk();
    $this->pewarnaan();
    $this->bahan();
  }
  function update_packing(){

   $this->packing();
  }
















  function jurnal_delete($nomor, $status = ''){

    if (@$status) {
      //status
      $this->sql->db->where('jurnal_nomor', $nomor);
      $this->sql->db->set('jurnal_hapus', $status);  
      $this->sql->db->update('t_jurnal');  
    } else {
      //permanen
      $this->sql->db->where('jurnal_nomor', $nomor);
      $this->sql->db->delete('t_jurnal');  
    }

  }
  function jurnal($nomor, $akun, $type, $keterangan, $nominal, $tanggal = ''){

    if (@$tanggal) {
      $tgl = $tanggal;
    } else {
      $tgl = date('Y-m-d');
    }

    $set = array(
                  'jurnal_nomor' => $nomor,
                  'jurnal_akun' => $akun,
                  'jurnal_keterangan' => $keterangan,
                  'jurnal_type' => $type,
                  'jurnal_nominal' => $nominal,
                  'jurnal_tanggal' => $tgl,
                );

    $this->sql->db->set($set);
    $this->sql->db->insert('t_jurnal');

    return;
  }
}
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
      $pembelian = $this->sql->db->query("SELECT ROUND(SUM(b.pembelian_barang_subtotal) / SUM(b.pembelian_barang_qty - b.pembelian_barang_potongan)) AS pembelian_harga, a.pembelian_hapus AS pembelian_hapus,b.pembelian_barang_barang AS pembelian_barang ,SUM(b.pembelian_barang_qty - b.pembelian_barang_potongan) AS pembelian_jumlah FROM t_pembelian AS a JOIN t_pembelian_barang AS b ON a.pembelian_nomor = b.pembelian_barang_nomor WHERE a.pembelian_po = 0 GROUP BY b.pembelian_barang_barang, a.pembelian_hapus")->result_array();

      $cacat = $this->sql->db->query("SELECT SUM(cacat_jumlah) AS cacat FROM t_cacat WHERE cacat_hapus = 0")->result_array();

      $peleburan = $this->sql->db->query("SELECT a.peleburan_hapus as peleburan_hapus, b.peleburan_barang_barang AS peleburan_barang, SUM(b.peleburan_barang_qty) AS peleburan_jumlah FROM t_peleburan AS a JOIN t_peleburan_barang AS b ON a.peleburan_nomor = b.peleburan_barang_nomor GROUP BY b.peleburan_barang_barang, a.peleburan_hapus")->result_array();

      $penyesuaian = $this->sql->db->query("SELECT a.penyesuaian_hapus as hapus, b.penyesuaian_barang_barang AS id, a.penyesuaian_jenis AS jenis, SUM(b.penyesuaian_barang_selisih) AS jumlah, b.penyesuaian_barang_status AS status FROM t_penyesuaian AS a JOIN t_penyesuaian_barang AS b ON a.penyesuaian_nomor = b.penyesuaian_barang_nomor WHERE a.penyesuaian_jenis = 'pembelian' GROUP BY b.penyesuaian_barang_barang, b.penyesuaian_barang_status, a.penyesuaian_hapus")->result_array();

      //0 stok
      $this->sql->db->query("UPDATE t_bahan SET bahan_stok = 0, bahan_harga = 0");

      //pembelian update stok produk
      foreach ($pembelian as $pb) {
        $id = $pb['pembelian_barang'];
        $jum = $pb['pembelian_jumlah'];
        $hapus = $pb['pembelian_hapus'];
        $harga = $pb['pembelian_harga'];

        if ($pb['pembelian_hapus'] == 0) {
         
         $this->sql->db->query("UPDATE t_bahan SET bahan_stok = bahan_stok + {$jum}, bahan_harga = '$harga' WHERE bahan_id = '$id'");

        }      

      }

      //tambah stok bahan cacat BH000
      foreach ($cacat as $ct) {
        $jum = $ct['cacat'];
        if ($jum != '') {
          $this->sql->db->query("UPDATE t_bahan SET bahan_stok = bahan_stok + {$jum} WHERE bahan_id = 0"); 
        }
      }

      // //kurangi peleburan
      foreach ($peleburan as $pl) {
        $id = $pl['peleburan_barang'];
        $jum = $pl['peleburan_jumlah'];
        if ($pl['peleburan_hapus'] == 0) {
          
          $this->sql->db->query("UPDATE t_bahan SET bahan_stok = bahan_stok - {$jum} WHERE bahan_id = {$id}"); 
        }
      }

      //kurangi penyesuain stok
      foreach ($penyesuaian as $pn) {
        $id = $pn['id'];
        $jum = $pn['jumlah'];
        $status = $pn['status'];
        $jenis = $pn['jenis'];

        if ($pn['hapus'] == 0) {
            
          if ($status == 'bertambah') {
            //bertambah
            $this->sql->db->query("UPDATE t_bahan SET bahan_stok = bahan_stok + {$jum} WHERE bahan_id = {$id}");   

          }else{
            //berkurang
            $this->sql->db->query("UPDATE t_bahan SET bahan_stok = bahan_stok - {$jum} WHERE bahan_id = {$id}");

          }

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

    $db1 = $this->sql->db->query("SELECT b.produksi_hapus as hapus, a.produksi_barang_barang AS produk, SUM(a.produksi_barang_qty) AS stok, b.produksi_total_akhir AS total FROM t_produksi_barang as a JOIN t_produksi as b ON a.produksi_barang_nomor = b.produksi_nomor GROUP BY a.produksi_barang_barang, b.produksi_hapus")->result_array();

    $db2 = $this->sql->db->query("SELECT a.penyesuaian_hapus as hapus, b.penyesuaian_barang_barang AS id, a.penyesuaian_jenis AS jenis, SUM(b.penyesuaian_barang_selisih) AS jumlah, b.penyesuaian_barang_status AS status FROM t_penyesuaian AS a JOIN t_penyesuaian_barang AS b ON a.penyesuaian_nomor = b.penyesuaian_barang_nomor WHERE a.penyesuaian_jenis = 'penjualan' GROUP BY b.penyesuaian_barang_barang, b.penyesuaian_barang_status, a.penyesuaian_hapus")->result_array();

    $table = 't_produk_barang';
    
    //0 stok
    $this->sql->db->query("UPDATE t_produk_barang SET produk_barang_stok = 0");

    foreach ($db1 as $val1) {

      $produk = @$val1['produk'];
      $stok = @$val1['stok'];
      $total = round(@$val1['total'] / @$stok);
      $hapus = @$val1['hapus'];

      if ($hapus == 0) {

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
      
    }

    //kurangi penyesuain stok
    foreach ($db2 as $value) {
      $id = $value['id'];
      $jum = $value['jumlah'];
      $status = $value['status'];
      $jenis = $value['jenis'];
      $hapus = $value['hapus'];

      if ($hapus == 0) {
       
       if ($status == 'bertambah') {
          //bertambah
          $this->sql->db->query("UPDATE t_produk_barang SET produk_barang_stok = produk_barang_stok + {$jum} WHERE produk_barang_barang = {$id}");   

        }else{
          //berkurang
          $this->sql->db->query("UPDATE t_produk_barang SET produk_barang_stok = produk_barang_stok - {$jum} WHERE produk_barang_barang = {$id}");

        }

      }
     
    }

    return;

  }

  function pewarnaan(){
    $db1 = $this->sql->db->query("SELECT a.pewarnaan_hapus as hapus, b.pewarnaan_barang_barang AS produk, b.pewarnaan_barang_jenis AS jenis, b.pewarnaan_barang_warna AS warna, SUM(b.pewarnaan_barang_qty) AS jumlah FROM t_pewarnaan AS a JOIN t_pewarnaan_barang AS b ON a.pewarnaan_nomor = b.pewarnaan_barang_nomor GROUP BY b.pewarnaan_barang_barang, b.pewarnaan_barang_jenis, b.pewarnaan_barang_warna, a.pewarnaan_hapus")->result_array();

     foreach ($db1 as $value) {
       
      $produk = $value['produk'];
      $jenis = $value['jenis'];
      $warna = $value['warna'];
      $jumlah = $value['jumlah'];
      $hapus = $value['hapus'];

      if ($hapus == 0) {
       
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

      }

      ////////////////////////////////////////////////////////////////////////////////////////////////////

     }

     return;
  }

  function packing(){

     $db1 = $this->sql->db->query("SELECT b.packing_hapus as hapus, a.packing_barang_barang AS produk, a.packing_barang_jenis AS jenis, a.packing_barang_warna AS warna, SUM(a.packing_barang_qty) AS jumlah FROM t_packing_barang AS a JOIN t_packing AS b ON a.packing_barang_nomor = b.packing_nomor GROUP BY a.packing_barang_barang, a.packing_barang_jenis, a.packing_barang_warna, b.packing_hapus")->result_array();

    foreach ($db1 as $value) {
      
      $produk = $value['produk'];
      $jenis = $value['jenis'];
      $warna = $value['warna'];
      $jumlah = $value['jumlah'];
      $hapus = $value['hapus'];

      if ($hapus == 0) {
       
        $this->sql->db->set(['produk_barang_packing' => $jumlah]);
        $this->sql->db->where(['produk_barang_barang' => $produk, 'produk_barang_jenis' => $jenis, 'produk_barang_warna' => $warna]);
        $this->sql->db->update('t_produk_barang');

      }

    }
  } 

  ///////////////////////////////////// end tribut ////////////////////////////////////////////////////

  function update_bahan(){
    $this->bahan();
  }
  function update_billet(){
    $this->bahan();
    $this->billet();
  }
  function update_produk(){
    $this->bahan();
    $this->produk();
    $this->pewarnaan();
    $this->packing();
  }
  function update_pewarnaan(){
    $this->produk();
    $this->pewarnaan();
    $this->packing();
  }
  function update_packing(){
    $this->produk();
    $this->pewarnaan();
    $this->packing();
  }
  function all(){
    $this->bahan();
    $this->billet();
    $this->produk();
    $this->pewarnaan();
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
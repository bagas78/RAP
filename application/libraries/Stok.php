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
  function update_bahan(){
    //sum stok bahan update
      $pembelian = $this->sql->db->query("SELECT b.pembelian_barang_barang AS pembelian_barang ,SUM(b.pembelian_barang_qty) AS pembelian_jumlah FROM t_pembelian AS a JOIN t_pembelian_barang AS b ON a.pembelian_nomor = b.pembelian_barang_nomor WHERE a.pembelian_hapus = 0 AND a.pembelian_po = 0 GROUP BY b.pembelian_barang_barang")->result_array();

      $peleburan = $this->sql->db->query("SELECT b.peleburan_barang_barang AS peleburan_barang, SUM(b.peleburan_barang_qty) AS peleburan_jumlah FROM t_peleburan AS a JOIN t_peleburan_barang AS b ON a.peleburan_nomor = b.peleburan_barang_nomor WHERE peleburan_hapus = 0 GROUP BY b.peleburan_barang_barang")->result_array();

      $produksi = $this->sql->db->query("SELECT b.produksi_barang_barang AS produksi_barang, SUM(b.produksi_barang_qty) AS produksi_jumlah FROM t_produksi AS a JOIN t_produksi_barang AS b ON a.produksi_nomor = b.produksi_barang_nomor WHERE produksi_hapus = 0 GROUP BY b.produksi_barang_barang")->result_array();

      $penyesuaian = $this->sql->db->query("SELECT b.penyesuaian_barang_barang AS id, SUM(b.penyesuaian_barang_selisih) AS jumlah, b.penyesuaian_barang_status AS status FROM t_penyesuaian AS a JOIN t_penyesuaian_barang AS b ON a.penyesuaian_nomor = b.penyesuaian_barang_nomor WHERE a.penyesuaian_jenis = 'pembelian' AND a.penyesuaian_hapus = 0 GROUP BY b.penyesuaian_barang_barang, b.penyesuaian_barang_status")->result_array();

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

        if ($status == 'bertambah') {
          
          $this->sql->db->query("UPDATE t_bahan SET bahan_stok = bahan_stok + {$jum} WHERE bahan_id = {$id}");   

        }else{

           $this->sql->db->query("UPDATE t_bahan SET bahan_stok = bahan_stok - {$jum} WHERE bahan_id = {$id}");

        }
       
      }

      return;
  }
  function update_billet(){

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
  function update_produk(){

    $db1 = $this->sql->db->query("SELECT a.produksi_barang_barang AS produk, SUM(a.produksi_barang_qty) AS stok, b.produksi_total_akhir AS total FROM t_produksi_barang as a JOIN t_produksi as b ON a.produksi_barang_nomor = b.produksi_nomor  WHERE b.produksi_hapus = 0 GROUP BY a.produksi_barang_barang")->result_array();

    // $db2 = $this->sql->db->query("SELECT b.penjualan_barang_barang AS produk, b.penjualan_barang_jenis AS jenis, b.penjualan_barang_warna AS warna ,SUM(b.penjualan_barang_qty) AS total FROM t_penjualan AS a JOIN t_penjualan_barang AS b ON a.penjualan_nomor = b.penjualan_barang_nomor WHERE a.penjualan_PO != '1' AND a.penjualan_hapus = 0 GROUP BY b.penjualan_barang_barang, b.penjualan_barang_jenis, b.penjualan_barang_warna")->result_array();

    // $penyesuaian = $this->sql->db->query("SELECT b.penyesuaian_barang_barang AS produk, b.penyesuaian_barang_jenis AS jenis, b.penyesuaian_barang_warna AS warna, SUM(b.penyesuaian_barang_selisih) AS total, b.penyesuaian_barang_status AS status FROM t_penyesuaian AS a JOIN t_penyesuaian_barang AS b ON a.penyesuaian_nomor = b.penyesuaian_barang_nomor WHERE a.penyesuaian_jenis = 'penjualan' AND a.penyesuaian_hapus = 0 GROUP BY b.penyesuaian_barang_barang, b.penyesuaian_barang_status, b.penyesuaian_barang_jenis, b.penyesuaian_barang_warna")->result_array();

    $table = 't_produk_barang';
    
    foreach ($db1 as $val1) {

      $produk = @$val1['produk'];
      $stok = @$val1['stok'];
      $total = @$val1['total'] / @$stok;

      $this->sql->db->set(['produk_barang_barang' => $produk, 'produk_barang_stok' => $stok, 'produk_barang_jenis' => 3, 'produk_barang_warna' => 0, 'produk_barang_hps' => $total]);
      
      $where = ['produk_barang_barang' => $produk];

      if ($this->cek($table, $where)) {
        //update
        $this->sql->db->where($where);
        $this->sql->db->update($table);
      }else{
        //insert
        $this->sql->db->insert($table);
      }
      
    }

    //subtract penjualan - produk_barang
    // foreach ($db2 as $val2) {
    //   $produk = $val2['produk'];
    //   $jenis = $val2['jenis'];
    //   $warna = $val2['warna'];
    //   $total = $val2['total'];
    //   $this->sql->db->query("UPDATE {$table} SET produk_barang_stok = produk_barang_stok - {$total} WHERE produk_barang_barang = {$produk} AND produk_barang_jenis = {$jenis} AND produk_barang_warna = {$warna}");
    // }

    //kurangi penyesuain stok
    // foreach ($penyesuaian as $pn) {
    //   $produk = $pn['produk'];
    //   $jenis = $pn['jenis'];
    //   $warna = $pn['warna'];
    //   $total = $pn['total'];
    //   $status = $pn['status'];

    //   if ($status == 'bertambah') {
        
    //     $this->sql->db->query("UPDATE {$table} SET produk_barang_stok = produk_barang_stok + {$total} WHERE produk_barang_barang = {$produk} AND produk_barang_jenis = {$jenis} AND produk_barang_warna = {$warna}");  

    //   }else{

    //      $this->sql->db->query("UPDATE {$table} SET produk_barang_stok = produk_barang_stok - {$total} WHERE produk_barang_barang = {$produk} AND produk_barang_jenis = {$jenis} AND produk_barang_warna = {$warna}");  

    //   }
     
    // }

    return;
  }
  function update_pewarnaan(){

     $db = $this->sql->db->query("SELECT a.pewarnaan_barang_barang AS produk, SUM(a.pewarnaan_barang_qty) AS jumlah FROM t_pewarnaan_barang AS a JOIN t_pewarnaan AS b ON a.pewarnaan_barang_nomor = b.pewarnaan_nomor JOIN t_produk_barang AS c ON a.pewarnaan_barang_barang = c.produk_barang_barang WHERE b.pewarnaan_hapus = 0 AND c.produk_barang_warna = 0 GROUP BY a.pewarnaan_barang_barang")->result_array();

     foreach ($db as $value) {
      
      $produk = $value['produk'];
      $jumlah = $value['jumlah'];

      $this->sql->db->set(['produk_barang_pewarnaan' => $jumlah]);
      $this->sql->db->where(['produk_barang_barang' => $produk]);
      $this->sql->db->update('t_produk_barang');

     }

     return;

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
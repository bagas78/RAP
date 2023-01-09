 <?php
class Stok{ 
  protected $sql;
  function __construct(){
        $this->sql = &get_instance();
  }
  function update_bahan(){
    //sum stok bahan update
      $pembelian = $this->sql->db->query("SELECT b.pembelian_barang_barang AS pembelian_barang ,SUM(b.pembelian_barang_qty) AS pembelian_jumlah FROM t_pembelian AS a JOIN t_pembelian_barang AS b ON a.pembelian_nomor = b.pembelian_barang_nomor WHERE a.pembelian_hapus = 0 AND a.pembelian_status = 'l' GROUP BY b.pembelian_barang_barang")->result_array();
      $peleburan = $this->sql->db->query("SELECT b.peleburan_barang_barang AS peleburan_barang, SUM(b.peleburan_barang_qty) AS peleburan_jumlah FROM t_peleburan AS a JOIN t_peleburan_barang AS b ON a.peleburan_nomor = b.peleburan_barang_nomor WHERE peleburan_hapus = 0 GROUP BY b.peleburan_barang_barang")->result_array();
      $produksi = $this->sql->db->query("SELECT b.produksi_barang_barang AS produksi_barang, SUM(b.produksi_barang_qty) AS produksi_jumlah FROM t_produksi AS a JOIN t_produksi_barang AS b ON a.produksi_nomor = b.produksi_barang_nomor WHERE produksi_hapus = 0 GROUP BY b.produksi_barang_barang")->result_array();

      //0 value
      $this->sql->db->query("UPDATE t_bahan SET bahan_stok = 0");

      foreach ($pembelian as $pb) {

        foreach ($peleburan as $pl) {
 
          $pem = $pb['pembelian_barang'];
          $pel = $pl['peleburan_barang'];

          $a = array($pem, $pel);
          
          if(count(array_unique($a)) == 1) {

              //sudah di lebur
              
              //kurang stok dengan produksi
              $id = $pl['peleburan_barang'];
              $jumlah = $pb['pembelian_jumlah'] - $pl['peleburan_jumlah'];

              //update stok
              $set = ['bahan_stok' => $jumlah];
              $where = ['bahan_id' => $id];

              $this->sql->db->set($set);
              $this->sql->db->where($where);
              $this->sql->db->update('t_bahan');

          }else{

            //belum di lebur

            //kurang stok dengan produksi
            $id = $pb['pembelian_barang'];
            $jumlah = $pb['pembelian_jumlah'];

            //update stok
            $set = ['bahan_stok' => $jumlah];
            $where = ['bahan_id' => $id];

            $this->sql->db->set($set);
            $this->sql->db->where($where);
            $this->sql->db->update('t_bahan');
          }

        }

      }

      //subtract produksi
      foreach ($produksi as $pr) {
        $id = $pr['produksi_barang'];
        $jum = $pr['produksi_jumlah'];
        $this->sql->db->query("UPDATE t_bahan SET bahan_stok = bahan_stok - {$jum} WHERE bahan_id = {$id}");
      }

      return;
  }
  function update_billet(){

    //sum stok billet
    $db1 = $this->sql->db->query("SELECT SUM(peleburan_billet) AS jumlah, ROUND(SUM(peleburan_hpp)) AS hpp FROM t_peleburan WHERE peleburan_hapus = 0")->row_array();
    $db2 = $this->sql->db->query("SELECT SUM(produksi_billet_qty) AS qty FROM t_produksi WHERE produksi_hapus = 0")->row_array();

    $jumlah = $db1['jumlah'] - $db2['qty'];
    $hpp = $db1['hpp'] / $jumlah;

    $get = $this->sql->db->query("SELECT * FROM t_billet")->row_array();
    $id = $get['billet_id']; 

    $set = ['billet_stok' => $jumlah, 'billet_hpp' => $hpp, 'billet_update' => date('Y-m-d')];
    $where = ['billet_id' => $id];

    $this->sql->db->set($set);
    $this->sql->db->where($where);
    return $this->sql->db->update('t_billet');
  }
  function update_setengah_jadi(){
    $db1 = $this->sql->db->query("SELECT SUM(produksi_setengah_jadi) AS total, ROUND(SUM(produksi_hpp) / SUM(produksi_setengah_jadi)) AS hpp_item, ROUND(SUM(produksi_hpp)) AS hpp_asli FROM t_produksi WHERE produksi_hapus = 0 AND produksi_setengah_jadi != ''")->row_array();
    $db2 = $this->sql->db->query("SELECT SUM(pewarnaan_jumlah) AS total FROM t_pewarnaan WHERE pewarnaan_hapus = 0")->row_array();

    $total = $db1['total'] - $db2['total'];
    $current = date('Y-m-d');
    $hpp = ROUND(($db1['hpp_asli'] - ($db1['hpp_item'] * $db2['total'])) / $total);

    $get = $this->sql->db->query("SELECT * FROM t_setengah_jadi")->row_array();
    $id = $get['setengah_jadi_id']; 

    $set = ['setengah_jadi_stok' => $total, 'setengah_jadi_hpp' => $hpp, 'setengah_jadi_update' => $current];
    $where = ['setengah_jadi_id' => $id];

    $this->sql->db->set($set);
    $this->sql->db->where($where);
    return $this->sql->db->update('t_setengah_jadi');

  }
  function update_produk(){

    $db1 = $this->sql->db->query("SELECT SUM(pewarnaan_jumlah) AS total, pewarnaan_produk AS produk, pewarnaan_hpp AS hpp, pewarnaan_hpp_total AS hpp_total FROM t_pewarnaan WHERE pewarnaan_hapus = 0 GROUP BY pewarnaan_produk")->result_array();
    $db2 = $this->sql->db->query("SELECT b.penjualan_barang_barang AS produk ,SUM(b.penjualan_barang_qty) AS total FROM t_penjualan AS a JOIN t_penjualan_barang AS b ON a.penjualan_nomor = b.penjualan_barang_nomor WHERE a.penjualan_hapus = 0 AND a.penjualan_status = 'l' GROUP BY b.penjualan_barang_barang")->result_array();

    //0 value
    $this->sql->db->query("UPDATE t_master_produk SET master_produk_stok = 0");
    
    foreach ($db1 as $val1) {

      $produk = $val1['produk'];
      $total = $val1['total'];
      $hpp = $val1['hpp'];
      $hpp_total = $val1['hpp_total'];

      $this->sql->db->set(['master_produk_stok' => $total, 'master_produk_hpp' => $hpp, 'master_produk_hpp_total' => $hpp_total ]);
      $this->sql->db->where(['master_produk_id'=> $produk]);
      $this->sql->db->update('t_master_produk');
      
    }

    //subtract penjualan
    foreach ($db2 as $val2) {
      $id = $val2['produk'];
      $total = $val2['total'];
      $this->sql->db->query("UPDATE t_master_produk SET master_produk_stok = master_produk_stok - {$total} WHERE master_produk_id = {$id}");
    }

    return;
  }
}
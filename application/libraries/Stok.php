 <?php
class Stok{ 
  protected $sql;
  function __construct(){
        $this->sql = &get_instance();
  }
  function update_bahan(){
    //sum stok bahan update
      $pembelian = $this->sql->db->query("SELECT b.pembelian_barang_barang AS pembelian_barang ,SUM(b.pembelian_barang_qty) AS pembelian_jumlah FROM t_pembelian AS a JOIN t_pembelian_barang AS b ON a.pembelian_nomor = b.pembelian_barang_nomor WHERE a.pembelian_hapus = 0 AND a.pembelian_status = 'lunas' GROUP BY b.pembelian_barang_barang")->result_array();

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
  function update_setengah_jadi(){
    $db1 = $this->sql->db->query("SELECT SUM(produksi_setengah_jadi) AS total, ROUND(SUM(produksi_hpp) / SUM(produksi_setengah_jadi)) AS hpp_item, ROUND(SUM(produksi_hpp)) AS hpp_asli FROM t_produksi WHERE produksi_hapus = 0 AND produksi_setengah_jadi != ''")->row_array();
    
    $db2 = $this->sql->db->query("SELECT SUM(pewarnaan_jumlah) AS total FROM t_pewarnaan WHERE pewarnaan_hapus = 0")->row_array();

    $total = $db1['total'] - $db2['total'];
    $current = date('Y-m-d');

    if ($total == 0) {
      //0
      $hps = ROUND(($db1['hpp_asli'] - ($db1['hpp_item'] * $db2['total'])));
    }else{
      $hps = ROUND(($db1['hpp_asli'] - ($db1['hpp_item'] * $db2['total'])) / $total);
    }

    $get = $this->sql->db->query("SELECT * FROM t_setengah_jadi")->row_array();
    $id = $get['setengah_jadi_id']; 

    $set = ['setengah_jadi_stok' => $total, 'setengah_jadi_hps' => $hps, 'setengah_jadi_update' => $current];
    $where = ['setengah_jadi_id' => $id];

    $this->sql->db->set($set);
    $this->sql->db->where($where);
    return $this->sql->db->update('t_setengah_jadi');

  }
  function update_produk(){

    $db1 = $this->sql->db->query("SELECT SUM(pewarnaan_jumlah) AS total, pewarnaan_produk AS produk, pewarnaan_hps AS hps, pewarnaan_hpp AS hpp FROM t_pewarnaan WHERE pewarnaan_hapus = 0 GROUP BY pewarnaan_produk")->result_array();

    $db2 = $this->sql->db->query("SELECT b.penjualan_barang_barang AS produk ,SUM(b.penjualan_barang_qty) AS total FROM t_penjualan AS a JOIN t_penjualan_barang AS b ON a.penjualan_nomor = b.penjualan_barang_nomor WHERE a.penjualan_hapus = 0 AND a.penjualan_status = 'l' AND a.penjualan_PO != '1' GROUP BY b.penjualan_barang_barang")->result_array();

    //0 value
    $this->sql->db->query("UPDATE t_master_produk SET master_produk_stok = 0");
    
    foreach ($db1 as $val1) {

      $produk = $val1['produk'];
      $total = $val1['total'];
      $hpp = $val1['hps'];
      $hpp_total = $val1['hpp'];

      $this->sql->db->set(['master_produk_stok' => $total, 'master_produk_hps' => $hps, 'master_produk_hpp' => $hpp ]);
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
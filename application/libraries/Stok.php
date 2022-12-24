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
}
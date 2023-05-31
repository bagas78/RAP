<style type="text/css">
  .tit{
    background: black;
    color: white;
    padding: 0.5%; 
    font-weight: 800;
  }
  .bg-w{
    background: whitesmoke;
  }
</style>

    <!-- Main content --> 
    <section class="content">

      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border">

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
         
          <form action="<?=base_url('akun/akses_save')?>" method="POST" accept-charset="utf-8">
          
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Nama Level</label>
                  <input required="" type="text" name="nama" class="form-control" id="nama">
                </div>
              </div>
            </div>

            <table class="table table-responsive table-bordered">
              <thead>
                <tr>
                  <td>MENU</td>
                  <td width="1"><i class="fa fa-eye"></i></td>
                  <td width="1"><i class="fa fa-plus"></i></td>
                  <td width="1"><i class="fa fa-trash"></i></td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="bg-w">DASHBOARD</td>
                  <td><input type="checkbox" name="dashboard" value="0"></td>
                  <td>-</td>
                  <td>-</td>
                </tr>

                <tr>
                  <td class="bg-w">KONTAK</td>
                  <td><input type="checkbox" name="kontak" value="0"></td>
                  <td>-</td>
                  <td>-</td>
                </tr>
                <tr>
                  <td>Karyawan</td>
                  <td><input type="checkbox" name="karyawan" value="0"></td>
                  <td><input type="checkbox" name="karyawan_add" value="0"></td>
                  <td><input type="checkbox" name="karyawan_del" value="0"></td>
                </tr>
                <tr>
                  <td>Supplier</td>
                  <td><input type="checkbox" name="supplier" value="0"></td>
                  <td><input type="checkbox" name="supplier_add" value="0"></td>
                  <td><input type="checkbox" name="supplier_del" value="0"></td>
                </tr>
                <tr>
                  <td>Pelanggan</td>
                  <td><input type="checkbox" name="pelanggan" value="0"></td>
                  <td><input type="checkbox" name="pelanggan_add" value="0"></td>
                  <td><input type="checkbox" name="pelanggan_del" value="0"></td>
                </tr>
                <tr>
                  <td>Rekening Bank</td>
                  <td><input type="checkbox" name="rekening" value="0"></td>
                  <td><input type="checkbox" name="rekening_add" value="0"></td>
                  <td><input type="checkbox" name="rekening_del" value="0"></td>
                </tr>

                <tr>
                  <td class="bg-w">PEMBELIAN</td>
                  <td><input type="checkbox" name="pembelian" value="0"></td>
                  <td>-</td>
                  <td>-</td>
                </tr>
                <tr>
                  <td>Master Bahan</td>
                  <td><input type="checkbox" name="bahan" value="0"></td>
                  <td><input type="checkbox" name="bahan_add" value="0"></td>
                  <td><input type="checkbox" name="bahan_del" value="0"></td>
                </tr>
                <tr>
                  <td>Purchaes Order (PO)</td>
                  <td><input type="checkbox" name="bahan_po" value="0"></td>
                  <td><input type="checkbox" name="bahan_po_add" value="0"></td>
                  <td><input type="checkbox" name="bahan_po_del" value="0"></td>
                </tr>
                <tr>
                  <td>Pembelian Bahan</td>
                  <td><input type="checkbox" name="pembelian_bahan" value="0"></td>
                  <td><input type="checkbox" name="pembelian_bahan_add" value="0"></td>
                  <td><input type="checkbox" name="pembelian_bahan_del" value="0"></td>
                </tr>
                <tr>
                  <td>Pembelian Umum</td>
                  <td><input type="checkbox" name="pembelian_umum" value="0"></td>
                  <td><input type="checkbox" name="pembelian_umum_add" value="0"></td>
                  <td><input type="checkbox" name="pembelian_umum_del" value="0"></td>
                </tr>
                <tr>
                  <td>Pembayaran Hutang</td>
                  <td><input type="checkbox" name="hutang" value="0"></td>
                  <td><input type="checkbox" name="hutang_add" value="0"></td>
                  <td><input type="checkbox" name="hutang_del" value="0"></td>
                </tr>

                <tr>
                  <td class="bg-w">PRODUKSI</td>
                  <td><input type="checkbox" name="produksi" value="0"></td>
                  <td>-</td>
                  <td>-</td>
                </tr>
                <tr>
                  <td>Master Mesin</td>
                  <td><input type="checkbox" name="mesin" value="0"></td>
                  <td><input type="checkbox" name="mesin_add" value="0"></td>
                  <td><input type="checkbox" name="mesin_del" value="0"></td>
                </tr>
                <tr>
                  <td>Peleburan</td>
                  <td><input type="checkbox" name="peleburan" value="0"></td>
                  <td><input type="checkbox" name="peleburan_add" value="0"></td>
                  <td><input type="checkbox" name="peleburan_del" value="0"></td>
                </tr>
                <tr>
                  <td>Proses Produksi</td>
                  <td><input type="checkbox" name="produksi" value="0"></td>
                  <td><input type="checkbox" name="produksi_add" value="0"></td>
                  <td><input type="checkbox" name="produksi_del" value="0"></td>
                </tr>
                <tr>
                  <td>Pewarnaan</td>
                  <td><input type="checkbox" name="pewarnaan" value="0"></td>
                  <td><input type="checkbox" name="pewarnaan_add" value="0"></td>
                  <td><input type="checkbox" name="pewarnaan_del" value="0"></td>
                </tr>
                <tr>
                  <td>Packing</td>
                  <td><input type="checkbox" name="packing" value="0"></td>
                  <td><input type="checkbox" name="packing_add" value="0"></td>
                  <td><input type="checkbox" name="packing_del" value="0"></td>
                </tr>

                <tr>
                  <td class="bg-w">MASTER PRODUK</td>
                  <td><input type="checkbox" name="produk" value="0"></td>
                  <td>-</td>
                  <td>-</td>
                </tr>
                <tr>
                  <td>Jenis Pewarnaan</td>
                  <td><input type="checkbox" name="jenis_pewarnaan" value="0"></td>
                  <td><input type="checkbox" name="jenis_pewarnaan_add" value="0"></td>
                  <td><input type="checkbox" name="jenis_pewarnaan_del" value="0"></td>
                </tr>
                <tr>
                  <td>Warna Produk</td>
                  <td><input type="checkbox" name="warna_produk" value="0"></td>
                  <td><input type="checkbox" name="warna_produk_add" value="0"></td>
                  <td><input type="checkbox" name="warna_produk_del" value="0"></td>
                </tr>
                <tr>
                  <td>Master Produk</td>
                  <td><input type="checkbox" name="master_produk" value="0"></td>
                  <td><input type="checkbox" name="master_produk_add" value="0"></td>
                  <td><input type="checkbox" name="master_produk_del" value="0"></td>
                </tr>

                <tr>
                  <td class="bg-w">PENJUALAN</td>
                  <td><input type="checkbox" name="penjualan" value="0"></td>
                  <td>-</td>
                  <td>-</td>
                </tr>
                <tr>
                  <td>Purchase Order (PO)</td>
                  <td><input type="checkbox" name="penjualan_po" value="0"></td>
                  <td><input type="checkbox" name="penjualan_po_add" value="0"></td>
                  <td><input type="checkbox" name="penjualan_po_del" value="0"></td>
                </tr>
                <tr>
                  <td>Penjualan Produk</td>
                  <td><input type="checkbox" name="penjualan_produk" value="0"></td>
                  <td><input type="checkbox" name="penjualan_produk_add" value="0"></td>
                  <td><input type="checkbox" name="penjualan_produk_del" value="0"></td>
                </tr>
                <tr>
                  <td>Pembayaran Piutang</td>
                  <td><input type="checkbox" name="piutang" value="0"></td>
                  <td><input type="checkbox" name="piutang_add" value="0"></td>
                  <td><input type="checkbox" name="piutang_del" value="0"></td>
                </tr>

                <tr>
                  <td class="bg-w">KEUANGAN</td>
                  <td><input type="checkbox" name="keuangan" value="0"></td>
                  <td>-</td>
                  <td>-</td>
                </tr>
                <tr>
                  <td>COA</td>
                  <td><input type="checkbox" name="coa" value="0"></td>
                  <td><input type="checkbox" name="coa_add" value="0"></td>
                  <td><input type="checkbox" name="coa_del" value="0"></td>
                </tr>
                <tr>
                  <td>Kas Keluar</td>
                  <td><input type="checkbox" name="kas" value="0"></td>
                  <td><input type="checkbox" name="kas_add" value="0"></td>
                  <td><input type="checkbox" name="kas_del" value="0"></td>
                </tr>
                <tr>
                  <td>Jurnal Umum</td>
                  <td><input type="checkbox" name="jurnal" value="0"></td>
                  <td><input type="checkbox" name="jurnal_add" value="0"></td>
                  <td><input type="checkbox" name="jurnal_del" value="0"></td>
                </tr>
                <tr>
                  <td>Buku Besar</td>
                  <td><input type="checkbox" name="buku_besar" value="0"></td>
                  <td><input type="checkbox" name="buku_besar_add" value="0"></td>
                  <td><input type="checkbox" name="buku_besar_del" value="0"></td>
                </tr>
                <tr>
                  <td>Penyesuaian Saldo</td>
                  <td><input type="checkbox" name="penyesuaian" value="0"></td>
                  <td><input type="checkbox" name="penyesuaian_add" value="0"></td>
                  <td><input type="checkbox" name="penyesuaian_del" value="0"></td>
                </tr>

                <tr>
                  <td class="bg-w">LAPORAN</td>
                  <td><input type="checkbox" name="laporan" value="0"></td>
                  <td>-</td>
                  <td>-</td>
                </tr>
                <tr>
                  <td>Stok Bahan Baku</td>
                  <td><input type="checkbox" name="laporan_bahan" value="0"></td>
                  <td><input type="checkbox" name="laporan_bahan_add" value="0"></td>
                  <td><input type="checkbox" name="laporan_bahan_del" value="0"></td>
                </tr>
                <tr>
                  <td>Stok Produk Jadi</td>
                  <td><input type="checkbox" name="laporan_produk" value="0"></td>
                  <td><input type="checkbox" name="laporan_produk_add" value="0"></td>
                  <td><input type="checkbox" name="laporan_produk_del" value="0"></td>
                </tr>
                <tr>
                  <td>Produksi</td>
                  <td><input type="checkbox" name="laporan_produksi" value="0"></td>
                  <td><input type="checkbox" name="laporan_produksi_add" value="0"></td>
                  <td><input type="checkbox" name="laporan_produksi_del" value="0"></td>
                </tr>
                <tr>
                  <td>PO Pembelian</td>
                  <td><input type="checkbox" name="laporan_pembelian_po" value="0"></td>
                  <td><input type="checkbox" name="laporan_pembelian_po_add" value="0"></td>
                  <td><input type="checkbox" name="laporan_pembelian_po_del" value="0"></td>
                </tr>
                <tr>
                  <td>Pembelian</td>
                  <td><input type="checkbox" name="laporan_pembelian" value="0"></td>
                  <td><input type="checkbox" name="laporan_pembelian_add" value="0"></td>
                  <td><input type="checkbox" name="laporan_pembelian_del" value="0"></td>
                </tr>
                <tr>
                  <td>Pelunasan Hutang</td>
                  <td><input type="checkbox" name="laporan_hutang" value="0"></td>
                  <td><input type="checkbox" name="laporan_hutang_add" value="0"></td>
                  <td><input type="checkbox" name="laporan_hutang_del" value="0"></td>
                </tr>
                <tr>
                  <td>Hutang Jatuh Tempo</td>
                  <td><input type="checkbox" name="laporan_hutang_jatuh_tampo" value="0"></td>
                  <td><input type="checkbox" name="laporan_hutang_jatuh_tampo_add" value="0"></td>
                  <td><input type="checkbox" name="laporan_hutang_jatuh_tampo_del" value="0"></td>
                </tr>
                <tr>
                  <td>Penjualan</td>
                  <td><input type="checkbox" name="laporan_penjualan" value="0"></td>
                  <td><input type="checkbox" name="laporan_penjualan_add" value="0"></td>
                  <td><input type="checkbox" name="laporan_penjualan_del" value="0"></td>
                </tr>
                <tr>
                  <td>Pelunasan Piutang</td>
                  <td><input type="checkbox" name="laporan_piutang" value="0"></td>
                  <td><input type="checkbox" name="laporan_piutang_add" value="0"></td>
                  <td><input type="checkbox" name="laporan_piutang_del" value="0"></td>
                </tr>
                <tr>
                  <td>Piutang Jatuh Tempo</td>
                  <td><input type="checkbox" name="laporan_piutang_jatuh_tampo" value="0"></td>
                  <td><input type="checkbox" name="laporan_piutang_jatuh_tampo_add" value="0"></td>
                  <td><input type="checkbox" name="laporan_piutang_jatuh_tampo_del" value="0"></td>
                </tr>
                <tr>
                  <td>Packing</td>
                  <td><input type="checkbox" name="laporan_packing" value="0"></td>
                  <td><input type="checkbox" name="laporan_packing_add" value="0"></td>
                  <td><input type="checkbox" name="laporan_packing_del" value="0"></td>
                </tr>

                <tr>
                  <td class="bg-w">INVENTORI</td>
                  <td><input type="checkbox" name="inventori" value="0"></td>
                  <td>-</td>
                  <td>-</td>
                </tr>
                <tr>
                  <td>Stok Opname Pembelian</td>
                  <td><input type="checkbox" name="opname_pembelian" value="0"></td>
                  <td><input type="checkbox" name="opname_pembelian_add" value="0"></td>
                  <td><input type="checkbox" name="opname_pembelian_del" value="0"></td>
                </tr>
                <tr>
                  <td>Stok Opname Penjualan</td>
                  <td><input type="checkbox" name="opname_penjualan" value="0"></td>
                  <td><input type="checkbox" name="opname_penjualan_add" value="0"></td>
                  <td><input type="checkbox" name="opname_penjualan_del" value="0"></td>
                </tr>
                <tr>
                  <td>Penyesuaian Stok</td>
                  <td><input type="checkbox" name="penyesuaian_stok" value="0"></td>
                  <td><input type="checkbox" name="penyesuaian_stok_add" value="0"></td>
                  <td><input type="checkbox" name="penyesuaian_stok_del" value="0"></td>
                </tr>

                <tr>
                  <td class="bg-w">AKUN</td>
                  <td><input type="checkbox" name="akun" value="0"></td>
                  <td>-</td>
                  <td>-</td>
                </tr>
                <tr>
                  <td>Hak Akses</td>
                  <td><input type="checkbox" name="akses" value="0"></td>
                  <td><input type="checkbox" name="akses_add" value="0"></td>
                  <td><input type="checkbox" name="akses_del" value="0"></td>
                </tr>
                <tr>
                  <td>User Akun</td>
                  <td><input type="checkbox" name="user_akun" value="0"></td>
                  <td><input type="checkbox" name="user_akun_add" value="0"></td>
                  <td><input type="checkbox" name="user_akun_del" value="0"></td>
                </tr>
                <tr>
                  <td>Admin Akun</td>
                  <td><input type="checkbox" name="admin_akun" value="0"></td>
                  <td><input type="checkbox" name="admin_akun_add" value="0"></td>
                  <td><input type="checkbox" name="admin_akun_del" value="0"></td>
                </tr>

                <tr>
                  <td class="bg-w">PENGATURAN</td>
                  <td><input type="checkbox" name="pengaturan" value="0"></td>
                  <td>-</td>
                  <td>-</td>
                </tr>
                <tr>
                  <td>Pajak</td>
                  <td><input type="checkbox" name="pajak" value="0"></td>
                  <td><input type="checkbox" name="pajak_add" value="0"></td>
                  <td><input type="checkbox" name="pajak_del" value="0"></td>
                </tr>
                <tr>
                  <td>Backup Database</td>
                  <td><input type="checkbox" name="backup" value="0"></td>
                  <td><input type="checkbox" name="backup_add" value="0"></td>
                  <td><input type="checkbox" name="backup_del" value="0"></td>
                </tr>
                <tr>
                  <td>Informasi</td>
                  <td><input type="checkbox" name="informasi" value="0"></td>
                  <td><input type="checkbox" name="informasi_add" value="0"></td>
                  <td><input type="checkbox" name="informasi_del" value="0"></td>
                </tr>

              </tbody>
            </table>

            <button type="submit" class="btn btn-success">Simpan <i class="fa fa-check"></i></button>
            <a href="<?= $_SERVER['HTTP_REFERER'] ?>"><button type="button" class="btn btn-danger">Batal <i class="fa fa-times"></i></button></a>

          </form>

        </div>
      </div>
      <!-- /.box -->

<script type="text/javascript">
  $(document).on('click', 'input[type="checkbox"]', function() {

    var target = $(this);

    if (target.val() == 1) {
      target.val(0);
    }else{
      target.val(1);
    }

  });
</script>
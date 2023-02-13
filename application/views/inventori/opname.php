<style type="text/css">
  #title{
    background: dimgray;
    padding: 1%;
    text-align: center;
    color: white;
    font-weight: lighter;
    font-size: medium;
  }
  th, td {
    border: 1px solid black;
    padding: 5px;
    font-size: small; 
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

      <form method="POST" action="#">
        <div class="form-group">
          <select id="jenis" required name="jenis" class="p03">
            <option value="" hidden>-- Pilih --</option>
            <option value="penjualan">Penjualan</option>
            <option value="pembelian">Pembelian</option>
          </select>
          <input id="tgl" name="tanggal" required id="date" type="date" class="p03">
          <button type="submit" class="p03 filter">Filter <i class="fa fa-search"></i></button>
        </div>
      </form>

      <h4 id="title">Laporan Stock Opname <span id="tit"></span></h4>
      
      <table id="table" class="table table-bordered table-hover" style="width: 100%;">
            <thead>
            <tr>
              <th rowspan="2">Kode Barang</th>
              <th rowspan="2">Rincian</th>
              <th rowspan="2">Satuan</th>
              <th rowspan="2">Harga Pokok Satuan</th>
              <th rowspan="2">Harga Jual Satuan</th>
              <th colspan="2">Persedian Awal</th>
              <th colspan="2">Penjual</th>
              <th colspan="2">Persedian Akhir</th>
              <th rowspan="2">% Stok</th>
              <th rowspan="2">Harga Pokok Penjualan</th>
              <th colspan="2">Profit</th>
              <th rowspan="2">Keterangan</th>
            </tr>
            <tr>
              <td>JML</td>
              <td>NIlai</td>
              <td>JML</td>
              <td>Nilai</td>
              <td>JML</td>
              <td>Nilai</td>
              <td>Nilai</td>
              <td>%</td>
            </tr>
            </thead>
            <tbody>
            
            </tbody>
          </table>

    </div>
  </div>
  <!-- /.box -->

<script type="text/javascript">

//data table
var table;
$(document).ready(function() {

    //datatables
    table = $('#table').DataTable({ 

        "bPaginate" : false,
        "bFilter"   : false,
        "scrollX"   : true,
        "bInfo"     : false,
        "responsive": true
    });

});

//search
$("form").submit(function(e) {
    e.preventDefault();
    var form = $(this);

    $.ajax({
      url: '<?=base_url('inventori/opname_get');?>',
      type: 'POST',
      dataType: 'json',
      data: form.serialize(),
    })
    .done(function(data) {
      
      //push info
      var info = '"'+$('#jenis').val().toUpperCase()+'" ( '+moment($('#tgl').val()).format("DD/MM/YYYY")+' )';
      $('#tit').text(info);

      //remove
      $('.odd').remove();

      var html = '';
      $.each(data, function(index, val) {
        
        var persedian_awal_nilai = (val.penjualan_barang_stok * val.penjualan_barang_hps);
        var penjualan_nilai = (val.penjualan_barang_qty * val.penjualan_barang_harga);
        var persediaan_jum = (val.penjualan_barang_stok - val.penjualan_barang_qty);
        var persediaan_nilai = (persediaan_jum * val.penjualan_barang_hps);
        var stok = Math.round((persediaan_jum / val.penjualan_barang_stok) * 100);
        var harga_pokok_penjualan = val.penjualan_barang_qty * val.penjualan_barang_hps;
        var profit_nilai = penjualan_nilai - harga_pokok_penjualan;
        var profit_persen = Math.round((profit_nilai / harga_pokok_penjualan) * 100);

        html+= '<tr>';
        html+= '<td>'+val.master_produk_kode+'</td>';
        html+= '<td>'+val.master_produk_nama+'</td>';
        html+= '<td>'+val.satuan_singkatan+'</td>';
        html+= '<td class="satuan">'+val.penjualan_barang_hps+'</td>';
        html+= '<td class="jual">'+val.penjualan_barang_harga+'</td>';
        html+= '<td class="persedian_awal_jum">'+val.penjualan_barang_stok+'</td>';
        html+= '<td class="persedian_awal_nilai">'+persedian_awal_nilai+'</td>';
        html+= '<td class="penjualan_jum">'+val.penjualan_barang_qty+'</td>';
        html+= '<td class="penjualan_nilai">'+penjualan_nilai+'</td>';
        html+= '<td class="persediaan_jum">'+persediaan_jum+'</td>';
        html+= '<td class="persediaan_nilai">'+persediaan_nilai+'</td>';
        html+= '<td class="stok">'+stok+'</td>';
        html+= '<td class="harga_pokok_penjualan">'+harga_pokok_penjualan+'</td>';
        html+= '<td class="profit_nilai">'+profit_nilai+'</td>';
        html+= '<td class="profit_persen">'+profit_persen+'</td>';
        html+= '<td class="keterangan">KURANG LAKU</td>';
        html+= '</tr>';

      });

      $('tbody').append(html);

    });
  
});

function dataTable_w100(){

  // 1% - 30% = barang tidak laku
  // 30% - 50% barang cukup laku
  // 60% - 100% = barang laku

  //keterangan
  $.each($('.profit_persen'), function(index, val) {
     
     var persen = parseInt($(this).text());
     
     switch (true) {
        case (persen <= 30):
          r = 'Barang Tidak Laku';
          break;
        case (persen >= 30 && persen <= 50):
          r = 'Barang Cukup Laku';
          break;
        case (persen >= 60):
          r = 'Barang Laku';
          break;
      }

      $(this).next('td').text(r);

  });
  
  setTimeout(function() {
      dataTable_w100();
  }, 100);
}

dataTable_w100();

</script>
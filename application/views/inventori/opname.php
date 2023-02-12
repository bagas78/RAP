<style type="text/css">
  #title{
    background: #00a65a;
    padding: 1%;
    text-align: center;
    color: white;
    font-weight: lighter;
    font-size: medium;
  }
  thead {
      background: wheat;
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
          <select required name="jenis" class="p03">
            <option value="" hidden>-- Pilih --</option>
            <option value="penjualan">Penjualan</option>
            <option value="pembelian">Pembelian</option>
          </select>
          <input name="tanggal" required id="date" type="date" class="p03">
          <button type="submit" class="p03 filter">Filter <i class="fa fa-search"></i></button>
        </div>
      </form>

      <h4 id="title">Laporan Stock Opname "Penjualan" ( 31 Januari 2022 )</h4>
      
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
      
      $('.odd').remove();

      var html = '';
      $.each(data, function(index, val) {
         
        html+= '<tr>';
        html+= '<td>'+val.master_produk_kode+'</td>';
        html+= '<td>'+val.master_produk_nama+'</td>';
        html+= '<td>'+val.satuan_singkatan+'</td>';
        html+= '<td>'+val.master_produk_hpp+'</td>';
        html+= '<td>'+val.master_produk_harga+'</td>';
        html+= '<td>'+val.penjualan_barang_stok_akhir+'</td>';
        html+= '<td>'+(val.penjualan_barang_stok_akhir * val.master_produk_hpp)+'</td>';
        html+= '<td>'+val.penjualan_barang_qty+'</td>';
        html+= '<td>'+(val.penjualan_barang_qty * val.master_produk_harga)+'</td>';
        html+= '<td>'+(val.penjualan_barang_stok_akhir - val.penjualan_barang_qty)+'</td>';
        html+= '<td>'+(val.penjualan_barang_stok_akhir - val.penjualan_barang_qty) * val.master_produk_hpp+'</td>';
        html+= '<td>'+((val.penjualan_barang_stok_akhir - val.penjualan_barang_qty) / val.penjualan_barang_stok_akhir) * 100+'</td>';
        html+= '<td>'+(val.penjualan_barang_qty * val.master_produk_hpp)+'</td>';
        html+= '<td>'+(val.penjualan_barang_qty * val.master_produk_harga) - (val.penjualan_barang_qty * val.master_produk_hpp)+'</td>';
        html+= '<td>'+((val.penjualan_barang_qty * val.master_produk_harga) - (val.penjualan_barang_qty * val.master_produk_hpp) / (val.penjualan_barang_qty * val.master_produk_hpp)) * 100+'</td>';
        html+= '<td></td>';
        html+= '<td>KURANG LAKU</td>';
        html+= '</tr>';

      });

      $('tbody').append(html);

    });
  
});

function auto(){

  //reload
  $("thead").load(location.href+" thead>*","" ,function(){
    $('.dataTables_scrollHead').remove();
  });
  
  setTimeout(function() {
      auto();
  }, 100);
}

auto();

</script>
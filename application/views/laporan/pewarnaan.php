
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

          <div class="col-md-4 row">
            <table class="table table-bordered table-hover" style="margin-bottom: 0;">
              <tr>
                <td style="background: lightgreen;">Total Pewarnaan ( Btg )</td>
                <td id="tot_pewarnaan"></td>
              </tr>
            </table>
          </div>

          <div class="clearfix"></div> 

          <div class="form-group sx-right" align="right">
            <form action="" method="POST" class="sc">              
              <input name="filter1" type="date" class="p03">
              <span>-</span>
              <input name="filter2" type="date" class="p03">
              <button class="p03 filter">Filter <i class="fa fa-search"></i></button>
            </form>
          </div>
          
          <table id="table" class="table table-bordered table-hover" style="width: 100%;">
            <thead>
            <tr>
              <th>Tanggal</th>
              <th>Nama Barang</th>
              <th>Warna</th>
              <th>Qty ( Btg )</th>
              <th>Cacat ( Btg )</th>
              <th>Subtotal ( Btg )</th>
            </tr>
            </thead>
            <tbody>
              <?php foreach ($data as $val): ?>
                <tr>
                  <td><?php $dt = date_create($val['pewarnaan_tanggal']); echo date_format($dt, 'd/m/Y'); ?></td>
                  <td><?=$val['produk_nama'] ?></td>
                  <td><?=$val['warna_nama'] ?></td>
                  <td><?=$val['pewarnaan_barang_qty']?></td>
                  <td><?=$val['pewarnaan_barang_cacat']?></td>
                  <td class="total"><?=$val['pewarnaan_barang_qty'] - $val['pewarnaan_barang_cacat'] ?></td>
                </tr>
              <?php endforeach ?>
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

        "bPaginate": false,
        "bFilter": false,
        "scrollX": true, 
        "dom": "Bfrtip",
        "buttons": [
            "excel", "pdf", "print",
        ]
    });

});

 //total
 var p = 0;
 $.each($('.total'), function(index, val) {
    var parse = parseInt($(this).text());
    p += parse;

    $(this).text(number_format(parse));
 });

 $('#tot_pewarnaan').text(number_format(p));

</script>
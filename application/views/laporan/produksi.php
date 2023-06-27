
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
                <td style="background: lightgreen;">Total Produksi</td>
                <td id="tot_produksi"></td>
              </tr>
              <tr>
                <td style="background: pink;">Total Biaya Jasa</td>
                <td id="tot_jasa"></td>
              </tr>
            </table>
          </div>

          <div class="clearfix"></div>

          <div class="sx-right" align="right">
            <form action="" method="POST" class="sc">
              <input name="filter" type="date" class="p03">
              <button class="p03 filter">Filter <i class="fa fa-search"></i></button>
            </form>
          </div>
          
          <table id="table" class="table table-bordered table-hover" style="width: 100%;">
            <thead>
            <tr>
              <th>Nomor</th>
              <th>Shift</th>
              <th>Produksi</th>
              <th>Biaya Jasa</th>
              <th>Tanggal</th>
            </tr>
            </thead>
            <tbody>
              <?php foreach ($data as $val): ?>
                <tr>
                  <td><?=$val['produksi_nomor'] ?></td>
                  <td><?=$val['user_name'] ?></td>
                  <td class="produksi_qty"><?=$val['produksi_barang_qty'] ?></td>
                  <td class="jasa"><?=$val['produksi_jasa'] ?></td>
                  <td><?php $dt = date_create($val['produksi_tanggal']); echo date_format($dt, 'd/m/Y'); ?></td>
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

 //produksi
 var p = 0;
 $.each($('.produksi_qty'), function(index, val) {
    var parse = parseInt($(this).text());
    p += parse;

    $(this).text(number_format(parse));
 });

 $('#tot_produksi').text(number_format(p));

 //jasa
 var j = 0;
 $.each($('.jasa'), function(index, val) {
    var parse = parseInt($(this).text());
    j += parseInt($(this).text());

    $(this).text(number_format(parse));
 });

 $('#tot_jasa').text(number_format(j));

</script>

    <!-- Main content --> 
    <section class="content">
 
      <!-- Default box -->
      <div class="box">  
        <div class="box-header with-border">

          <div align="left" class="hutang_add">
            <a href="<?=base_url('laporan/pembelian/bahan')?>"><button class="b-bahan btn btn-default"><i class="fa fa-filter"></i> Pembelian Bahan</button></a>
            <a href="<?=base_url('laporan/pembelian/umum')?>"><button class="b-umum btn btn-default"><i class="fa fa-filter"></i> Pembelian Umum</button></a>
          </div>

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
                <td style="background: pink;">Total Pembelian</td>
                <td id="tot_pembelian"></td>
              </tr>
            </table>
          </div>

          <div class="clearfix"></div>

          <div class="sx-right" align="right">
            <form action="" method="POST" class="sc">
              <input required name="filter1" type="date" class="p03">
              <span> - </span> 
              <input required name="filter2" type="date" class="p03"> 
              <button class="p03 filter">Filter <i class="fa fa-search"></i></button>
            </form>
          </div>
          
          <table id="table" class="table table-bordered table-hover" style="width: 100%;">
            <thead>
            <tr>
              <th>Tanggal</th>
              <th>Supplier</th>
              <th>Barang</th>
              <th>Qty</th>
              <th>Potongan</th>
              <th>Qty Akhir</th>
              <th>Harga</th>
              <th>Subtotal</th>
            </tr>
            </thead>
            <tbody>
              <?php foreach ($data as $val): ?>
                <tr>
                  <td><?php $dt = date_create(@$val['tanggal']); echo date_format($dt, 'd/m/Y'); ?></td>
                  <td><?=@$val['supplier']?></td>
                  <td><?=@$val['barang']?></td>
                  <td><?=@$val['qty']?></td>
                  <td><?=@$val['potongan']?></td>
                  <td><?=@$val['qty'] - @$val['potongan']?></td>
                  <td><?=number_format(@$val['harga'])?></td>
                  <td class="total"><?=@$val['subtotal']?></td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>

        </div>

        
      </div>
      <!-- /.box -->

<script type="text/javascript">
//active btn
if ('<?=@$active?>' == 'bahan') {
  $('.b-bahan').addClass('active').css('background', 'powderblue');
}else{
  $('.b-umum').addClass('active').css('background', 'powderblue');
}

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

 //pmebelian
 var p = 0;
 $.each($('.total'), function(index, val) {
    var parse = parseInt($(this).text());
    p += parse;

    $(this).text(number_format(parse));
 });

 $('#tot_pembelian').text(number_format(p));

</script>
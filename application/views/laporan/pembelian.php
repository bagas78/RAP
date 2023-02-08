<style type="text/css">
  #title{
    background: darkgray;
    padding: 1%;
    margin-bottom: 2%;
    text-align: center;
    color: white;
  }
  .p03{
    padding: 0.3%;
  }
  .sx-right{
    margin-top: 1vh;
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

          <div class="col-md-4 col-xs-4 row" style="margin-bottom: 0;">
            <table class="table table-bordered table-hover" style="width: 100%;">
              <tr>
                <td style="background: pink;">Total Pembelian</td>
                <td id="tot_pembelian"></td>
              </tr>
            </table>
          </div>

          <div class="form-group sx-right" align="right">
            <form action="" method="POST">
              <select class="p03" name="kategori" required>
                <option value="" hidden>-- Kategori --</option>
                <option value="utama">Pembelian Utama</option>
                <option value="avalan">Pembelian Avalan</option>
                <option value="umum">Pembelian Umum</option>
              </select>
              <select class="p03" name="status" required>
                <option value="" hidden>-- Status --</option>
                <option value="l">Lunas</option>
                <option value="b">Belum Lunas</option>
              </select>
              <input name="filter" type="date" class="p03">
              <button class="p03 filter">Filter <i class="fa fa-search"></i></button>
            </form>
          </div>
          
          <table class="table table-bordered table-hover" style="width: 100%;">
            <thead>
            <tr>
              <th>Nomor</th>
              <th>Total</th>
              <th>Kategori</th>
              <th>Status</th>
              <th>Tanggal</th>
            </tr>
            </thead>
            <tbody>
              <?php foreach ($data as $val): ?>
                <tr>
                  <td><?=$val['pembelian_nomor'] ?></td>
                  <td class="total"><?=$val['pembelian_total'] ?></td>
                  <td><?=$val['pembelian_kategori'] ?></td>
                  <td><?=($val['pembelian_status'] == 'l')?'Lunas':'Belum Lunas'?></td>
                  <td><?php $dt = date_create($val['pembelian_tanggal']); echo date_format($dt, 'd/m/Y'); ?></td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>

        </div>

        
      </div>
      <!-- /.box -->

<script type="text/javascript">

 //pmebelian
 var p = 0;
 $.each($('.total'), function(index, val) {
    var parse = parseInt($(this).text());
    p += parse;

    $(this).text(number_format(parse));
 });

 $('#tot_pembelian').text(number_format(p));

</script>
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
</style>


    <!-- Main content --> 
    <section class="content">

      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border">

          <div align="left">
              <button data-toggle="modal" data-target="#modal" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Kas</button>
          </div>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">

          <div class="form-group">
            <input id="date" type="month" class="p03">
            <button class="p03 filter">Filter <i class="fa fa-search"></i></button>
          </div>

          <table class="table table-bordered table-hover" style="width: 100%;">
                <thead>
                <tr>
                  <th>Tanggal</th>
                  <th>Keterangan</th>
                  <th>Nominal</th>
                </tr>
                </thead>
                <tbody>
                  <?php foreach ($data as $val): ?>
                    <tr>
                      <td><?=date_format(date_create(@$val['jurnal_tanggal']), 'd/m/Y')?></td>
                      <td><?=@$val['jurnal_keterangan']?></td>
                      <td class="nominal"><?=@$val['jurnal_nominal']?></td>
                    </tr>
                  <?php endforeach ?>

                  <tr>
                    <td colspan="2" style="background: moccasin;">Total</td>
                    <td class="total" style="background: antiquewhite;"></td>
                  </tr>

                </tbody>
              </table>

        </div>

        
      </div>
      <!-- /.box -->

<div class="modal fade" id="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">TAMBAH SALDO KAS</h4>
      </div>
      <div class="modal-body">
        <form role="form" method="post" action="<?php echo base_url('keuangan/saldo_add') ?>" enctype="multipart/form-data">
          <div class="box-body">

            <div class="form-group">
              <label>Nominal</label>
              <input required="" type="number" name="nominal" class="form-control">
            </div>
            <div class="form-group">
              <label>Keterangan</label>
              <textarea class="form-control" required name="keterangan"></textarea>
            </div>
          </div>

          <div class="box-footer" style="background: lavender;">
            <button type="submit" class="btn btn-primary">Submit</button>
             <button type="reset" class="btn btn-danger">Reset</button>
          </div>
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

  <script type="text/javascript">
    $(document).on('click', '.filter', function() {

      var date = $('#date').val();
      <?php $segmen = $this->uri->segment(3); ?>
      
      if (date == '') {
        var url = '<?=@base_url('keuangan/saldo/');?><?=($segmen)? '' : $segmen?>';
      }else{
        var url = '<?=@base_url('keuangan/saldo/');?><?=($segmen)? '': $segmen?>'+date;
      }
      
      window.location.replace(url);

    });

    //total
    var tot = 0;
    $.each($('.nominal'), function(index, val) {
      //format
      var t = parseInt($(this).text());
      $(this).text(number_format(t));

      //sum
      tot += t;
    });

    $('.total').text(number_format(tot));


  </script>
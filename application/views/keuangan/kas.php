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
                  <th>Barang</th>
                  <th>Nominal</th>
                </tr>
                </thead>
                <tbody>
                  <?php foreach ($data as $val): ?>
                    <tr>
                      <td hidden class="nomor"><?=@$val['jurnal_nomor']?></td>
                      <td class="tanggal"><?=@$val['jurnal_tanggal']?></td>
                      <td class="keterangan"></td>
                      <td class="barang"></td>
                      <td class="nominal"><?=@$val['jurnal_nominal']?></td>
                    </tr>
                  <?php endforeach ?>

                  <tr>
                    <td colspan="3" style="background: moccasin;">Total</td>
                    <td class="total" style="background: antiquewhite;"></td>
                  </tr>

                </tbody>
              </table>

        </div>

        
      </div>
      <!-- /.box -->

  <script type="text/javascript">
    $(document).on('click', '.filter', function() {

      var date = $('#date').val();
      <?php $segmen = $this->uri->segment(3); ?>
      
      if (date == '') {
        var url = '<?=@base_url('keuangan/kas/');?><?=($segmen)? '' : $segmen?>';
      }else{
        var url = '<?=@base_url('keuangan/kas/');?><?=($segmen)? '': $segmen?>'+date;
      }
      
      window.location.replace(url);

    });

    //get
    $.each($('.tanggal'), function() {
      
      var nomor = $(this).closest('tr').find('.nomor').text(); 
      var date_old = $(this).text();
      var target = $(this).closest('tr');

      $.get('<?=base_url('keuangan/kas_get/')?>'+nomor+'/'+date_old, function(data) {
        
        var val = $.parseJSON(data);
        target.find('.keterangan').text(val['jurnal_keterangan']);

        var barang = JSON.parse(val['jurnal_barang']).toString().replace(',',', ');
        target.find('.barang').text(barang);

      });

      var date_new = moment($(this).text()).format('MM/DD/YYYY');
      $(this).text(date_new);

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
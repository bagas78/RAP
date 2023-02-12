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
              <?php foreach ($coa_data as $val): ?>
                <button class="btn btn-sm btn-primary <?=(@$val['coa_id'] == @$akun)?'active':''?>"> <?=@$val['coa_akun']?><span hidden><?=@$val['coa_id']?></span></button>
              <?php endforeach ?>
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

          <h4 id="title"></h4>

          <table class="table table-bordered table-hover" style="width: 100%;">
                <thead>
                <tr>
                  <th>Tanggal</th>
                  <th>Keterangan</th>
                  <th>Ref</th>
                  <th>Debit</th>
                  <th>Kredit</th>
                  <th>Saldo</th>
                  <th hidden>Type</th>
                </tr>
                </thead>
                <tbody>
                  <?php foreach ($data as $val): ?>
                    <tr>
                      <td><?=date_format(date_create(@$val['jurnal_tanggal']), 'd/m/Y')?></td>
                      <td><?=@$val['jurnal_keterangan']?></td>
                      <td>JU</td>
                      <td class="debit"><?=(@$val['jurnal_type'] == 'debit')? @$val['jurnal_nominal']:'-'?></td>
                      <td class="kredit"><?=(@$val['jurnal_type'] == 'kredit')? @$val['jurnal_nominal']:'-'?></td>
                      <td class="saldo"></td>
                      <td hidden class="type"><?=@$val['jurnal_type']?></td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>

        </div>

        
      </div>
      <!-- /.box -->

  <script type="text/javascript">

    //title
    $('#title').text($('.btn-sm.active').first().contents().eq(0).text().toUpperCase());

    function akun(target){
      $('.btn-sm').removeClass('active');
      $(target).addClass('active');
    }


   $(document).on('click', '.btn-sm', function() {

      var akun = $(this).find('span').text();

      window.location.replace('<?=base_url('keuangan/buku_besar/')?>'+akun);

    });

   $(document).on('click', '.filter', function() {

      var date = $('#date').val();
      <?php $segmen = $this->uri->segment(3); ?>
      
      if (date == '') {
        var url = '<?=@base_url('keuangan/buku_besar/');?><?=($segmen)? $akun: $segmen.$akun?>'
      }else{
        var url = '<?=@base_url('keuangan/buku_besar/');?><?=($segmen)? $akun.'/': $akun.'/'.$segmen?>'+date
      }
      
      window.location.replace(url);

    });

    //debit
    var debit = [];
    var i = $(".debit");
    debit = $.map(i,function(data){
            if($(data).text() != '-'){var num = parseInt($(data).text())}else{var num = 0}
            return num;
    });

    //kredit
    var kredit = [];
    var i = $(".kredit");
    kredit = $.map(i,function(data){
            if($(data).text() != '-'){var num = parseInt($(data).text())}else{var num = 0}
            return num;
    });

    //type
    var type = [];
    var i = $(".type");
    type = $.map(i,function(data){
            return $(data).text();
    });

    //penjumlahan [ debit (+) | kredit (-) ]
    $.each($('.saldo'), function(index, val) {
       var jum = debit[index] + kredit[index];

      //saldo awal
      if (type[index] == 'debit') {
        $(this).text(jum);
      }else{
        $(this).text('-'+jum);
      }

       //saldo jumlah
       var be = index - 1;
       if (index != 0) {

        var saldo = $(".saldo").toArray().map(function(i){ return parseInt(i.innerText) })
        $(this).text(saldo[be] + saldo[index]);
       }
       
    });

    //format number
    var format = ['.kredit','.debit','.saldo'];

    $.each(format, function(index, val) {
       
       $.each($(val), function(index, val) {
         var t = $(this).text();
         if (t != '-') {
          $(this).text(number_format(t));
         }
      });
    
    });

  </script>
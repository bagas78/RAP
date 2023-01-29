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

          <form action="" method="get">
            <div class="form-group">
              <input type="date" name="" class="p03">
              <button class="p03">Filter <i class="fa fa-search"></i></button>
            </div>
          </form>

          <h4 id="title"></h4>
          <table id="example" class="table table-bordered table-hover" style="width: 100%;">
                <thead>
                <tr>
                  <th>Tanggal</th>
                  <th>Keterangan</th>
                  <th>Ref</th>
                  <th>Debit</th>
                  <th>Kredit</th>
                  <th>Saldo</th>
                </tr>
                </thead>
                <tbody>
                  
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


    $(document).ready(function() {

      //datatables
      var table;
      table = $('#example').DataTable({ 

          "processing": true, 
          "serverSide": true,
          "order":[], 
          "scrollX": true, 
          
          "ajax": {
              "url": "<?=site_url('keuangan/buku_besar_get_data/')?>"+<?=@$akun?>,
              "type": "GET"
          },
          "columns": [  
                      { "data": "jurnal_tanggal",
                      "render": 
                      function( data ) {
                          return "<span>"+moment(data).format("DD/MM/YYYY")+"</span>";
                        }
                      },                             
                      { "data": "jurnal_keterangan" },
                      { "data": "coa_nomor" },
                      { "data": "jurnal_nominal",
                      "render":
                      function( data, type, row ) {
                          if (row.jurnal_type == 'debit') {var s = data;} else {var s = '-';}
                            return "<span>"+s+"</span>";
                        }
                      },
                      { "data": "jurnal_nominal",
                      "render":
                      function( data, type, row ) {
                          if (row.jurnal_type == 'kredit') {var s = data;} else {var s = '-';}
                            return "<span>"+s+"</span>";
                        }
                      },
                      { "data": "coa_nomor" },
                      
                  ],
      });

    });

  </script>
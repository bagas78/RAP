
    <!-- Main content --> 
    <section class="content">
 
      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border">
  
            <div align="left" class="hutang_add">
              <a href="<?=base_url('pembelian/bayar/bahan')?>"><button class="b-bahan btn btn-default"><i class="fa fa-filter"></i> Pembelian Bahan</button></a>
              <a href="<?=base_url('pembelian/bayar/umum')?>"><button class="b-umum btn btn-default"><i class="fa fa-filter"></i> Pembelian Umum</button></a>
            </div>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          
          <table id="example" class="table table-bordered table-hover" style="width: 100%;">
                <thead>
                <tr>
                  <th>Nomor</th>
                  <th>Jatuh Tempo</th>
                  <th>Pelunasan</th>
                  <th>Keterangan</th>
                  <th width="1">Action</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
              </table>

        </div>

        
      </div>
      <!-- /.box -->

<script type="text/javascript">

  //active btn
  if ('<?=@$bayar_active?>' == 'bahan') {
    $('.b-bahan').addClass('active').css('background', 'powderblue');
  }else{
    $('.b-umum').addClass('active').css('background', 'powderblue');
  }

    var table;
    $(document).ready(function() {
        //datatables
        table = $('#example').DataTable({ 

            "processing": true, 
            "serverSide": true,
            "order":[], 
            "scrollX": true, 
            
            "ajax": {
                "url": "<?=site_url('pembelian/bayar_get_data/umum')?>",
                "type": "GET"
            },
            "columns": [                               
                        { "data": "pembelian_umum_nomor"},
                        { "data": "pembelian_umum_jatuh_tempo",
                        "render": 
                        function( data ) {
                            return "<span>"+moment(data).format("DD/MM/YYYY")+"</span>";
                          }
                        },
                        { "data": "pembelian_umum_pelunasan",
                        "render": 
                        function( data ) {
                            if (data != null) {var p = moment(data).format("DD/MM/YYYY");}else{var p = '-';}
                            return "<span class='pelunasan'>"+p+"</span>";
                          }
                        },
                        { "data": "pembelian_umum_pelunasan_keterangan",
                        "render": 
                        function( data ) {
                            if (data != null) {var k = data;}else{var k = '-';}
                            return "<span>"+k+"</span>";
                          }
                        },
                        { "data": "pembelian_umum_id",
                        "render": 
                        function( data ) {
                            return "<button onclick='bayar("+data+")' class='btn btn-xs btn-success hutang_add'>Bayar <i class='fa fa-clipboard'></i></button>";
                          }
                        },
                        
                    ],
        });

    });
 
</script>
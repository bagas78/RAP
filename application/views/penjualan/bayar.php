
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
          
          <table id="example" class="table table-bordered table-hover" style="width: 100%;">
                <thead>
                <tr>
                  <th>Nomor</th>
                  <th>Supplier</th>
                  <th>Jatuh Tempo</th>
                  <th>Kekurangan</th>
                  <th>Di Bayar</th>
                  <th>Tanggal</th>
                  <th>Keterangan</th>
                  <th width="50">Action</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
              </table>

        </div>

        
      </div>
      <!-- /.box -->

<script type="text/javascript">
    var table;
    $(document).ready(function() { 
        //datatables
        table = $('#example').DataTable({ 

            "processing"    : true, 
            "serverSide"    : true,
            "order"         : [], 
            "scrollX"       : true, 
            
            "ajax": {
                "url": "<?=site_url('penjualan/bayar_get_data')?>",
                "type": "GET"
            },
            "columns": [                               
                        { "data": "penjualan_nomor"},
                        { "data": "kontak_nama"},
                        { "data": "penjualan_jatuh_tempo",
                        "render": 
                        function( data ) {
                            return "<span>"+moment(data).format("DD/MM/YYYY")+"</span>";
                          }
                        },
                        
                        { "data": "kekurangan",
                        "render": 
                        function( data ) {
                            return '<span class="kekurangan">'+number_format(data)+'</span>';
                          }
                        },
                        { "data": "penjualan_pelunasan_jumlah",
                        "render": 
                        function( data ) {
                            return number_format(data);
                          }
                        },

                        { "data": "penjualan_pelunasan",
                        "render": 
                        function( data ) {
                            if (data != null) {var p = moment(data).format("DD/MM/YYYY");}else{var p = '-';}
                            return "<span>"+p+"</span>";
                          }
                        },
                        { "data": "penjualan_pelunasan_keterangan",
                        "render": 
                        function( data ) {
                            if (data != null) {var k = data;}else{var k = '-';}
                            return "<span>"+k+"</span>";
                          }
                        },
                        { "data": "penjualan_id",
                        "render": 
                        function( data ) {
                            return "<button onclick='bayar("+data+")' class='btn btn-xs btn-success piutang_add'>Bayar <i class='fa fa-clipboard'></i></button>";
                          }
                        },
                        
                    ],
        });

    });

function auto(){

    $.each($('.kekurangan'), function(index, val) {
       var val = $(this).text();
       if (val == '0') {
        $(this).closest('tr').find('.btn').attr('disabled', 'true');
       }
    });

    setTimeout(function() {
        auto();
    }, 100);
}

auto();

 
</script>

    <!-- Main content --> 
    <section class="content">

      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border">

          <div align="left">
            <a href="<?= @$_SERVER['HTTP_REFERER'] ?>"><button class="btn bg-black"><i class="fa fa-arrow-left"></i> Kembali</button></a>
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
                  <th>Nama</th>
                  <th>Stok</th>
                  <th>jenis</th>
                  <th>Warna</th>
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

            "processing": true, 
            "serverSide": true,
            "scrollX": true, 
            "order":[],  
            
            "ajax": {
                "url": "<?=site_url('produk/master_view_get/'.@$id) ?>",
                "type": "GET"
            },
            "columns": [                               
                        { "data": "produk_nama"},
                        { "data": "produk_barang_stok",
                        "render": 
                        function( data ) {
                            return number_format(data);
                          }
                        },
                        { "data": "warna_jenis_type"},
                        { "data": "warna_nama"},
                        
                    ],
        });

    });
</script>

    <!-- Main content --> 
    <section class="content">

      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border">

          <div align="left">
            <a href="<?= base_url('produk/master') ?>"><button class="btn btn-danger"><i class="fa fa-arrow-left"></i> Kembali</button></a>
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
                  <th>Harga Produksi Satuan</th>
                  <th>Harga Jual</th>
                  <th width="60">Action</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
              </table>

        </div>

        
      </div>
      <!-- /.box -->


<div class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Set Harga Jual</h4>
      </div>
      <div class="modal-body">
        <form role="form" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="form-group">
              <label>Harga Jual Produk</label>
              <input placeholder="Harga Produk" type="number" name="harga" class="form-control" required value="">
              <input type="hidden" name="url" class="url form-control" required value="">
            </div>
          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <button type="submit" class="btn btn-success">Proses <i class="fa fa-check"></i></button>
             <button type="reset" class="btn btn-danger">Reset <i class="fa fa-times"></i></button>
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
                        { "data": "produk_barang_hps",
                        "render": 
                        function( data ) {
                            return 'Rp. '+number_format(data);
                          }
                        },
                        { "data": "produk_barang_harga",
                        "render": 
                        function( data ) {
                            return 'Rp. '+number_format(data);
                          }
                        },
                        { "data": "produk_barang_id",
                        "render": 
                        function( data ) {
                            return "<button onclick='modal("+data+")' class='btn btn-xs btn-success'>Set Harga <i class='fa fa-cog'></i></button>";
                          }
                        },
                        
                    ],
        });

    });

 function modal(id){

    //id produk
    $('.url').val('<?=$this->uri->segment(3)?>');

    //modal pop up
    $('form').attr('action', '<?=base_url('produk/master_set/')?>'+id);
    $('.modal').modal('toggle');
  }

</script>
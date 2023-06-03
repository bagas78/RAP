
    <!-- Main content --> 
    <section class="content">

      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border">
 
            <div align="left" class="warna_produk_add">
              <a href="<?= base_url('produk/warna_add') ?>"><button class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button></a>
              <button onclick="filter('JN001')" class="btn btn-default"><i class="fa fa-filter"></i> Anodizing</button>
              <button onclick="filter('JN002')" class="btn btn-default"><i class="fa fa-filter"></i> Powder Coating</button>
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
                  <th>Kode</th>
                  <th>Jenis</th>
                  <th>Warna</th>
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

            "processing": true, 
            "serverSide": true,
            "scrollX": true, 
            "order":[],  
            
            "ajax": {
                "url": "<?=site_url('produk/warna_get_data') ?>",
                "type": "GET"
            },
            "columns": [                               
                        { "data": "warna_kode"},
                        { "data": "warna_jenis_type"},
                        { "data": "warna_nama"},
                        { "data": "warna_keterangan"},
                        { "data": "warna_id",
                        "render": 
                        function( data ) {
                            return "<a href='<?php echo base_url('produk/warna_edit/')?>"+data+"'><button class='btn btn-xs btn-primary warna_produk_add'><i class='fa fa-edit'></i></button></a> "+
                            "<button onclick=del('<?php echo base_url('produk/warna_delete/')?>"+data+"') class='btn btn-xs btn-danger warna_produk_del'><i class='fa fa-trash'></i></button>";
                          }
                        },
                        
                    ],
        });

    });

function filter($val){
  var table = $('#example').DataTable();
  table.search($val).draw();
}
</script>
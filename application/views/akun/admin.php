
    <!-- Main content --> 
    <section class="content">

      <!-- Default box --> 
      <div class="box"> 
        <div class="box-header with-border">
 
            <div align="left" class="admin_akun_add">
              <a href="<?= base_url('akun/admin_add') ?>"><button class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button></a>
            </div>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
         
          <table id="example" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Nama</th>
                  <th>Email</th>
                  <th width="70">Action</th>
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
            "order":[],  
            
            "ajax": {
                "url": "<?=site_url('akun/admin_get_data') ?>",
                "type": "GET"
            },
            "columns": [  
                        { "data": "user_name"},
                        { "data": "user_email"},
                        { "data": "user_id",
                        "render": 
                        function( data, type, row, meta ) {
                            return "<a href='<?= base_url('akun/admin_view/')?>"+data+"'><button class='btn btn-xs btn-success admin_akun_add'><i class='fa fa-eye'></i></button></a> "+
                            "<a href='<?= base_url('akun/admin_edit/')?>"+data+"'><button class='btn btn-xs btn-primary admin_akun_add'><i class='fa fa-edit'></i></button></a> "+
                            "<button onclick=del('<?= base_url('akun/admin_delete/')?>"+data+"') class='btn btn-xs btn-danger admin_akun_del'><i class='fa fa-trash'></i></button>";
                          }
                        },
                        
                    ],
        });

    });
</script>
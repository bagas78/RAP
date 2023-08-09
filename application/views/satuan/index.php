
    <!-- Main content --> 
    <section class="content">
 
      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border">
 
            <div align="left" class="satuan_add">
              <a href="<?= base_url('satuan/add') ?>"><button class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button></a>
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
                  <th>Satuan</th>
                  <th>Singkatan</th>
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
            "order":[],  
            
            "ajax": {
                "url": "<?=site_url('satuan/get_data') ?>",
                "type": "GET"
            },
            "columns": [                               
                        { "data": "satuan_kepanjangan"},
                        { "data": "satuan_singkatan"},
                        { "data": "satuan_id",
                        "render": 
                        function( data, type, row, meta ) {
                            return "<a href='<?php echo base_url('satuan/edit/')?>"+data+"'><button class='btn btn-xs btn-primary satuan_add'><i class='fa fa-edit'></i></button></a> "+
                            "<button onclick=del('<?php echo base_url('satuan/delete/')?>"+data+"') class='btn btn-xs btn-danger satuan_del'><i class='fa fa-trash'></i></button>";
                          }
                        },
                        
                    ],
        });

    });
</script>
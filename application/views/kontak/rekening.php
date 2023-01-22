
    <!-- Main content --> 
    <section class="content">

      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border">
 
            <div align="left">
              <a href="<?= base_url('kontak/') ?>rekening_add"><button class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button></a>
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
                  <th>Atas Nama</th>
                  <th>Bank</th>
                  <th>No. Rekening</th>
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
                "url": "<?=site_url('kontak/get_rekening')?>",
                "type": "GET"
            },
            "columns": [                               
                        { "data": "rekening_nama"},
                        { "data": "bank_nama"},
                        { "data": "rekening_no"},
                        { "data": "rekening_id",
                        "render": 
                        function( data, type, row, meta ) {
                            return "<a href='<?php echo base_url('kontak')?>/rekening_edit/"+data+"'><button class='btn btn-xs btn-primary'><i class='fa fa-edit'></i></button></a> "+
                            "<button onclick=del('<?php echo base_url('kontak')?>/rekening_delete/"+data+"') class='btn btn-xs btn-danger'><i class='fa fa-trash'></i></button>";
                          }
                        },
                        
                    ],
        });

    });
</script>

    <!-- Main content --> 
    <section class="content"> 
 
      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border">

          <div align="left" class="pewarnaan_add">
            <a href="<?= base_url('produksi/pewarnaan_add/') ?>"><button class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button></a>
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
                  <th>Tanggal</th>
                  <th width="60">Action</th>
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
            "scrollX": true, 
            
            "ajax": {
                "url": "<?=site_url('produksi/pewarnaan_get_data')?>",
                "type": "GET"
            },
            "columns": [                               
                        { "data": "pewarnaan_nomor"},
                        { "data": "pewarnaan_tanggal",
                        "render": 
                        function( data ) {
                            return "<span>"+moment(data).format("DD/MM/YYYY")+"</span>";
                          }
                        },
                        { "data": "pewarnaan_id",
                        "render": 
                        function( data ) {
                            return "<a href='<?=base_url('produksi/pewarnaan_view/') ?>"+data+"'><button class='btn btn-xs btn-success pewarnaan_add'><i class='fa fa-eye'></i></button></a> "+
                            "<button onclick=del('<?php echo base_url('produksi/pewarnaan_delete/')?>"+data+"') class='btn btn-xs btn-danger pewarnaan_del'><i class='fa fa-trash'></i></button> "+
                            "<a href='<?= base_url('produksi/pewarnaan_laporan/')?>"+data+"'><button class='btn btn-xs btn-warning'><i class='fa fa-file-text'></i></button></a>";
                          }
                        },
                        
                    ],
        });

    });
 
</script>

    <!-- Main content --> 
    <section class="content">
 
      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border"> 
 
            <div align="left" class="pembelian_bahan_add">
              <a href="<?= base_url('pembelian/'.@$url.'_add') ?>"><button class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button></a>
               <button onclick="filter('lunas')" class="btn btn-default"><i class="fa fa-filter"></i> Lunas</button>
              <button onclick="filter('belum')" class="btn btn-default"><i class="fa fa-filter"></i> Belum Lunas</button>
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
                  <th>Supplier</th>
                  <th>Jatuh Tempo</th>
                  <th>Status</th>
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
                "url": "<?=site_url('pembelian/'.@$url.'_get_data')?>",
                "type": "GET"
            },
            "columns": [                               
                        { "data": "pembelian_nomor"},
                        { "data": "kontak_nama"},
                        { "data": "pembelian_jatuh_tempo",
                        "render": 
                        function( data ) {
                            return "<span>"+moment(data).format("DD/MM/YYYY")+"</span>";
                          }
                        },
                        { "data": "pembelian_status",
                        "render": 
                        function( data ) {
                            if (data == 'lunas') {var s = 'Lunas';} else {var s = 'Belum Lunas';}
                            return "<span>"+s+"</span>";
                          }
                        },
                        { "data": "pembelian_id",
                        "render": 
                        function( data ) {
                            return "<a href='<?php echo base_url('pembelian/'.@$url.'_view/')?>"+data+"'><button class='btn btn-xs btn-success'><i class='fa fa-eye'></i></button></a> "+
                            "<a hidden href='<?php echo base_url('pembelian/'.@$url.'_edit/')?>"+data+"'><button class='btn btn-xs btn-primary pembelian_bahan_add'><i class='fa fa-edit'></i></button></a> "+
                            "<button onclick=del('<?php echo base_url('pembelian/'.@$url.'_delete/')?>"+data+"') class='btn btn-xs btn-danger pembelian_bahan_del'><i class='fa fa-trash'></i></button> "+
                            "<a href='<?php echo base_url('pembelian/laporan/')?>"+data+"'><button class='btn btn-xs btn-warning'><i class='fa fa-file-text'></i></button></a> ";
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
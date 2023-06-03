
    <!-- Main content --> 
    <section class="content">
 
      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border">
          
          <div align="left" class="produksi_add">
            <a href="<?= base_url('produksi/'.@$url.'_add/') ?>"><button class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button></a>
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
                  <th>Shift</th>
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
                "url": "<?=site_url('produksi/'.@$url.'_get_data')?>",
                "type": "GET"
            },
            "columns": [                               
                        { "data": "produksi_nomor"},
                        { "data": "user_name",
                        "render": 
                        function( data ) {
                            return "<span>"+data+"</span>";
                          }
                        },
                        { "data": "produksi_tanggal",
                        "render": 
                        function( data ) {
                            return "<span>"+moment(data).format("DD/MM/YYYY")+"</span>";
                          }
                        },
                        { "data": "produksi_id",
                        "render": 
                        function( data ) {
                            return "<a class='view' href='<?php echo base_url('produksi/'.@$url.'_view/')?>"+data+"'><button class='btn btn-xs btn-success'><i class='fa fa-eye'></i></button></a> "+
                            "<a hidden class='edit' href='<?php echo base_url('produksi/'.@$url.'_edit/')?>"+data+"'><button class='btn btn-xs btn-primary produksi_add'><i class='fa fa-edit'></i></button></a> "+
                            "<button onclick=del('<?php echo base_url('produksi/'.@$url.'_delete/')?>"+data+"') class='btn btn-xs btn-danger'><i class='fa fa-trash'></i></button> "+
                            "<a href='<?php echo base_url('produksi/laporan/')?>"+data+"'><button class='laporan btn btn-xs btn-warning produksi_del'><i class='fa fa-file-text'></i></button></a> ";
                          }
                        },
                        
                    ],
        });

    });

function filter($val){
  var table = $('#example').DataTable();
  table.search($val).draw();
}

// function auto(){

//   //pewarnaan : selesai || packing : selesai
//   $.each($('.pewarnaan'), function(index, val) {
//     var pe = $(this).text();
//     var pa = $(this).parent().next('td').find('.packing').text();

//     if (pe == 'Selesai' || pa != '-') {
//       $(this).parent().nextAll('td').find('.view').removeAttr('hidden');  
//       $(this).parent().nextAll('td').find('.edit').remove();
//     }
    
//   });

//   setTimeout(function() {
//       auto();
//   }, 100);
// }

// auto();

</script>
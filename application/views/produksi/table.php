
    <!-- Main content --> 
    <section class="content">
 
      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border">
          
          <div align="left">
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
                  <th>Pewarnaan</th>
                  <th>Packing</th>
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
                        { "data": "user_name"},
                        { "data": "produksi_pewarnaan",
                        "render": 
                        function( data ) {
                            switch (data) {
                              case '0':
                                var s = "Tanpa pewarnaan";
                                break;
                              case '1':
                                var s = "Belum";
                                break;
                              case '2':
                                var s = "Selesai";
                                break;
                            }
                            return "<span class='pewarnaan'>"+s+"</span>";
                          }
                        },
                        { "data": "produksi_packing_tanggal",
                        "render": 
                        function( data ) {
                            if(data == null){var p = '-'}else{var p = moment(data).format("DD/MM/YYYY")}
                            return "<span class='packing'>"+p+"</span>";
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
                            return "<a hidden class='view' href='<?php echo base_url('produksi/'.@$url.'_edit/')?>"+data+"/1'><button class='btn btn-xs btn-success'><i class='fa fa-eye'></i></button></a> "+
                            "<a class='edit' href='<?php echo base_url('produksi/'.@$url.'_edit/')?>"+data+"'><button class='btn btn-xs btn-primary'><i class='fa fa-edit'></i></button></a> "+
                            "<button onclick=del('<?php echo base_url('produksi/'.@$url.'_delete/')?>"+data+"') class='delete btn btn-xs btn-danger'><i class='fa fa-trash'></i></button> "+
                            "<a href='<?php echo base_url('produksi/laporan/')?>"+data+"'><button class='laporan btn btn-xs btn-warning'><i class='fa fa-file-text'></i></button></a> ";
                          }
                        },
                        
                    ],
        });

    });

function filter($val){
  var table = $('#example').DataTable();
  table.search($val).draw();
}

function auto(){

  //pewarnaan : selesai || packing : selesai
  $.each($('.pewarnaan'), function(index, val) {
    var pe = $(this).text();
    var pa = $(this).parent().next('td').find('.packing').text();

    if (pe == 'Selesai' || pa != '-') {
      $(this).parent().nextAll('td').find('.view').removeAttr('hidden');  
      $(this).parent().nextAll('td').find('.edit').remove();
      $(this).parent().nextAll('td').find('.delete').remove();
    }
    
  });

  setTimeout(function() {
      auto();
  }, 100);
}

auto();

</script>
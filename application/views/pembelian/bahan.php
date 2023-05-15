
    <!-- Main content --> 
    <section class="content">

      <!-- Default box --> 
      <div class="box"> 
        <div class="box-header with-border">
 
            <div align="left">
              <a href="<?= base_url('pembelian/bahan_add') ?>"><button class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button></a>             
              <button onclick="filter('utama')" class="btn btn-default"><i class="fa fa-filter"></i> Bahan Baku Utama</button>
              <button onclick="filter('pembantu')" class="btn btn-default"><i class="fa fa-filter"></i> Bahan Pembantu</button>
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
                  <th>Nama</th>
                  <th>Stok</th>
                  <th>Harga</th>
                  <th>Kategori</th>
                  <th>Satuan</th>
                  <th width="30">Action</th>
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

            "processing"  : true, 
            "serverSide"  : true,
            "order"       :[],  
            "scrollX"     : true,
            
            "ajax": {
                "url": "<?=site_url('pembelian/bahan_get_data') ?>",
                "type": "GET"
            },
            "columns": [  
                        { "data": "bahan_kode",
                        "render":
                        function(data) {
                          return "<span class='kode'>"+data+"</span>";
                        }},
                        { "data": "bahan_nama"},
                        { "data": "bahan_stok",
                        "render":
                        function(data) {
                          return "<span>"+number_format(data)+"</span>";
                        }},
                        { "data": "bahan_harga",
                        "render":
                          function(data) {
                            return "<span class='harga'>"+number_format(data)+"</span>"
                          }
                        },
                        { "data": "bahan_kategori"},
                        { "data": "satuan_singkatan"},
                        { "data": "bahan_id",
                        "render": 
                        function(data) {
                            return "<div class='action'><a href='<?= base_url('pembelian/bahan_edit/')?>"+data+"'><button class='btn btn-xs btn-primary'><i class='fa fa-edit'></i></button></a> "+
                            "<button onclick=del('<?= base_url('pembelian/bahan_delete/')?>"+data+"') class='btn btn-xs btn-danger'><i class='fa fa-trash'></i></button></div>";
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

    $.each($('.kode'), function(index, val) {
       
       var kode = $(this).text();

       if (kode == 'BH000') {

          $(this).closest('tr').css('background', '#eee');
          $(this).closest('tr').find('.action').remove();

       }else{ 

          $(this).removeClass('kode');
       }

    });

    setTimeout(function() {
        auto();
    }, 100);
  }

  auto();

</script>
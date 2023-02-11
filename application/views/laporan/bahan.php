    <!-- Main content --> 
    <section class="content">

      <!-- Default box --> 
      <div class="box"> 
        <div class="box-header with-border">
 
            <div align="left">
              <button onclick="filter('avalan')" class="btn btn-default"><i class="fa fa-filter"></i> Bahan Avalan</button>
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
         
          <table id="table" class="table table-bordered table-hover" style="width: 100%;">
                <thead>
                <tr>
                  <th>Nama</th>
                  <th>Stok</th>
                  <th>Kategori</th>
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
        table = $('#table').DataTable({ 
            
            "processing"  : true, 
            "serverSide"  : true,
            "order"       :[],  
            "scrollX"     : true,
            
            "ajax": {
                "url": "<?=site_url('laporan/get_bahan_data') ?>",
                "type": "GET"
            },
            "columns": [  
                        { "data": "bahan_nama"},
                        { "data": "bahan_stok",
                        "render":
                        function(data) {
                          return "<span>"+number_format(data)+"</span>";
                        }},
                        { "data": "bahan_kategori"},                        
                        
                    ],
            "dom": "Bfrtip",
            "buttons": [
                "excel", "pdf", "print"
            ]
        });

    });

function filter($val){
  var table = $('#table').DataTable();
  table.search($val).draw();
}

</script>
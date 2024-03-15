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
            "buttons": [{
               "extend": 'copy',
               "text": '<i class="fa fa-files-o" style="color: green;"></i>',
               "titleAttr": 'Copy',                               
               "action": newexportaction
            },
            {
               "extend": 'excel',
               "text": '<i class="fa fa-file-excel-o" style="color: green;"></i>',
               "titleAttr": 'Excel',                               
               "action": newexportaction
            },
            {
               "extend": 'csv',
               "text": '<i class="fa fa-file-text-o" style="color: green;"></i>',
               "titleAttr": 'CSV',                               
               "action": newexportaction
            },
            {
               "extend": 'pdf',
               "text": '<i class="fa fa-file-pdf-o" style="color: green;"></i>',
               "titleAttr": 'PDF',                               
               "action": newexportaction
            },
            {
               "extend": 'print',
               "text": '<i class="fa fa-print" style="color: green;"></i>',
               "titleAttr": 'Print',                                
               "action": newexportaction
            }],
        });

    });

function newexportaction(e, dt, button, config) {
    var self = this;
    var oldStart = dt.settings()[0]._iDisplayStart;
    dt.one('preXhr', function (e, s, data) {
        // Just this once, load all data from the server...
        data.start = 0;
        data.length = 2147483647;
        dt.one('preDraw', function (e, settings) {
            // Call the original action function
            if (button[0].className.indexOf('buttons-copy') >= 0) {
                $.fn.dataTable.ext.buttons.copyHtml5.action.call(self, e, dt, button, config);
            } else if (button[0].className.indexOf('buttons-excel') >= 0) {
                $.fn.dataTable.ext.buttons.excelHtml5.available(dt, config) ?
                    $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config) :
                    $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
            } else if (button[0].className.indexOf('buttons-csv') >= 0) {
                $.fn.dataTable.ext.buttons.csvHtml5.available(dt, config) ?
                    $.fn.dataTable.ext.buttons.csvHtml5.action.call(self, e, dt, button, config) :
                    $.fn.dataTable.ext.buttons.csvFlash.action.call(self, e, dt, button, config);
            } else if (button[0].className.indexOf('buttons-pdf') >= 0) {
                $.fn.dataTable.ext.buttons.pdfHtml5.available(dt, config) ?
                    $.fn.dataTable.ext.buttons.pdfHtml5.action.call(self, e, dt, button, config) :
                    $.fn.dataTable.ext.buttons.pdfFlash.action.call(self, e, dt, button, config);
            } else if (button[0].className.indexOf('buttons-print') >= 0) {
                $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
            }
            dt.one('preXhr', function (e, s, data) {
                // DataTables thinks the first item displayed is index 0, but we're not drawing that.
                // Set the property to what it was before exporting.
                settings._iDisplayStart = oldStart;
                data.start = oldStart;
            });
            // Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
            setTimeout(dt.ajax.reload, 0);
            // Prevent rendering of the full data to the DOM
            return false;
        });
    });
    // Requery the server with the new one-time export settings
    dt.ajax.reload();
};
//For Export Buttons available inside jquery-datatable "server side processing" - End

function filter($val){
  var table = $('#table').DataTable();
  table.search($val).draw();
}

</script>
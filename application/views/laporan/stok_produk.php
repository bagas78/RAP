<style type="text/css">
  #title {
      background: dimgray;
      padding: 1%;
      text-align: center;
      color: white;
      font-weight: lighter;
      font-size: medium;
  }
</style>

    <!-- Main content --> 
    <section class="content"> 

      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border">

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          
          <h4 id="title">Barang MF <span id="tit"></span></h4>

          <table id="table1" class="table table-bordered table-hover table-responsive" style="width: 100%;">
            <thead>
            <tr> 
              <th>Nama</th>
              <th>Jenis</th>
              <th>Warna</th>
              <th>Stok</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
          </table>

          <h4 id="title">Barang yang sudah melalui proses pewarnaan <span id="tit"></span></h4>

          <table id="table2" class="table table-bordered table-hover table-responsive" style="width: 100%;">
            <thead>
            <tr> 
              <th>Nama</th>
              <th>Jenis</th>
              <th>Warna</th>
              <th>Stok</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
          </table>

          <h4 id="title">Barang yang sudah melalui proses packing <span id="tit"></span></h4>

          <table id="table3" class="table table-bordered table-hover table-responsive" style="width: 100%;">
            <thead>
            <tr> 
              <th>Nama</th>
              <th>Jenis</th>
              <th>Warna</th>
              <th>Stok</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
          </table>

        </div>

        
      </div>
      <!-- /.box -->

<script type="text/javascript">
    var table1;
    $(document).ready(function() {

        //datatables
        table1 = $('#table1').DataTable({ 

            "processing": true, 
            "serverSide": true,
            "scrollX": true, 
            "order":[],  
            
            "ajax": {
                "url": "<?=site_url('laporan/get_produk_data/mf') ?>",
                "type": "GET"
            },
            "columns": [ 
                        { "data": "produk_nama"},
                        { "data": "warna_jenis_type"},
                        { "data": "warna_nama"},
                        { "data": "produk_barang_stok"},
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


    var table2;
    $(document).ready(function() {

        //datatables
        table2 = $('#table2').DataTable({ 

            "processing": true, 
            "serverSide": true,
            "scrollX": true, 
            "order":[],  
            
            "ajax": {
                "url": "<?=site_url('laporan/get_produk_data/pw') ?>",
                "type": "GET"
            },
            "columns": [ 
                        { "data": "produk_nama"},
                        { "data": "warna_jenis_type"},
                        { "data": "warna_nama"},
                        { "data": "produk_barang_stok"},
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

    var table3;
    $(document).ready(function() {

        //datatables
        table3 = $('#table3').DataTable({ 

            "processing": true, 
            "serverSide": true,
            "scrollX": true, 
            "order":[],  
            
            "ajax": {
                "url": "<?=site_url('laporan/get_produk_packing/') ?>",
                "type": "GET"
            },
            "columns": [ 
                        { "data": "produk_nama"},
                        { "data": "warna_jenis_type"},
                        { "data": "warna_nama"},
                        { "data": "produk_barang_packing"},
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

</script>
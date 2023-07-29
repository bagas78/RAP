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
            "buttons": [
                "excel", "pdf", "print",
            ]
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
            "buttons": [
                "excel", "pdf", "print",
            ]
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
                        { "data": "packing_barang_qty"},
                    ],
            "dom": "Bfrtip",
            "buttons": [
                "excel", "pdf", "print",
            ]
        });

    });
</script>
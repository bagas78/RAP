
    <!-- Main content --> 
    <section class="content">

      <!-- Default box --> 
      <div class="box"> 
        <div class="box-header with-border">
 
            <div align="left" class="penyesuaian_stok_add">
              <button data-toggle="modal" data-target=".modal" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button>             
              <button onclick="filter('pembelian')" class="btn btn-default"><i class="fa fa-filter"></i> Pembelian</button>
              <button onclick="filter('penjualan')" class="btn btn-default"><i class="fa fa-filter"></i> Penjualan</button>
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
                  <th>Jenis</th>
                  <th>Penyesuaian</th>
                  <th>Tanggal</th>
                  <th width="30">Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
              </table>

        </div>
      </div>
      <!-- /.box -->

<div class="modal fade" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="box-body">

          <form method="POST" action="<?=base_url('inventori/penyesuaian_add')?>">
            
            <div class="row">
              <div class="col-md-12">

                <div class="form-group">
                  <label>Jenis</label>
                  <select class="form-control" name="jenis" required>
                    <option value="" hidden>-- Pilih --</option>
                    <option value="pembelian">Pembelian</option>
                    <option value="penjualan">Penjualan</option>
                  </select>
                </div>

                <div class="form-group">
                  <label>Transaksi</label>
                  <select class="form-control" name="transaksi" required>
                    <option value="" hidden>-- Pilih --</option>
                    <option value="perhitungan">Perhitungan</option>
                    <option value="masuk">Masuk</option>
                    <option value="keluar">Keluar</option>
                  </select>
                </div>

                <div class="form-group">
                  <label>Kategori</label>
                  <select class="form-control" name="kategori" required>
                    <option value="" hidden>-- Pilih --</option>
                    <option value="umum">Umum</option>
                    <option value="rusak">Rusak</option>
                  </select>
                </div>

                <div class="form-group">
                  <label>Tanggal</label>
                  <input type="date" name="tanggal" required class="form-control" value="<?=date('Y-m-d')?>">
                </div>
              
              </div>
            </div>

          </div>

          <div class="box-footer" style="background: aliceblue;">
            <button type="submit" class="btn-produk btn btn-primary">Submit <i class="fa fa-check"></i></button>
             <button data-dismiss="modal" type="button" class="btn btn-danger">Close <i class="fa fa-times"></i></button>
          </div>

         </form>

       </div>
      </div>
      <!-- /.modal-content -->
   </div>
    <!-- /.modal-dialog -->
  </div>
<!-- /.modal -->

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
                "url": "<?=site_url('inventori/penyesuaian_get_data') ?>",
                "type": "GET"
            },
            "columns": [  
                        { "data": "penyesuaian_nomor"},
                        { "data": "penyesuaian_jenis"},
                        { "data": "penyesuaian_transaksi"},
                        { "data": "penyesuaian_tanggal",
                        "render": 
                        function( data ) {
                            return "<span>"+moment(data).format("DD/MM/YYYY")+"</span>";
                          }
                        },
                        { "data": "penyesuaian_id",
                        "render": 
                        function(data) {
                            return "<a href='<?= base_url('inventori/penyesuaian_view/')?>"+data+"'><button class='btn btn-xs btn-success penyesuaian_stok_add'><i class='fa fa-eye'></i></button></a> "+
                            "<button onclick=del('<?= base_url('inventori/penyesuaian_delete/')?>"+data+"') class='btn btn-xs btn-danger penyesuaian_stok_del'><i class='fa fa-trash'></i></button>";
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
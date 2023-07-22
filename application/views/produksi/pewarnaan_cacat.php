
    <!-- Main content --> 
    <section class="content"> 
 
      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border">

          <div align="left" class="pewarnaan_add">
            <a href="<?=base_url('produksi/pewarnaan')?>"><button class="btn btn-danger"><i class="fa fa-arrow-left"></i> Kembali</button></a>
            <button class="btn btn-primary" onclick="insert()"><i class="fa fa-plus"></i> Tambah</button>
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
                  <th>Jumlah</th>
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

<div class="modal fade" id="modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Tambah Produk Cacat</h4>
        </div>
        <div class="modal-body">
          <form role="form" method="post" enctype="multipart/form-data">
            <div class="box-body">
              <div class="form-group">
                <label>Tanggal</label>
                <input required="" type="date" name="tanggal" class="tanggal form-control">
              </div>
              <div class="form-group">
                <label>Jumlah</label>
                <div class="input-group">
                  <input type="number" name="jumlah" class="jumlah form-control" required step="0.001">
                  <span class="input-group-addon">Kg</span>
                </div>
              </div>

              <!-- hidden -->
              <input type="hidden" name="id" class="id">

            </div>
            <!-- /.box-body -->

            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
               <button type="reset" class="btn btn-danger">Reset</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

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
                "url": "<?=site_url('produksi/pewarnaan_get_cacat')?>",
                "type": "GET"
            },
            "columns": [                               
                        { "data": "cacat_jumlah",
                        "render": 
                        function( data ) {
                            return "<span>"+data+" Kg</span>";
                          }
                        },
                        { "data": "cacat_tanggal",
                        "render": 
                        function( data ) {
                            return "<span>"+moment(data).format("DD/MM/YYYY")+"</span>";
                          }
                        },
                        { "data": "cacat_id",
                        "render": 
                        function( data ) {
                            return "<button onclick='update("+data+")' class='btn btn-xs btn-success pewarnaan_add'><i class='fa fa-edit'></i></button> "+
                            "<button onclick=del('<?php echo base_url('produksi/pewarnaan_cacat_delete/')?>"+data+"') class='btn btn-xs btn-danger pewarnaan_del'><i class='fa fa-trash'></i></button>";
                          }
                        },
                        
                    ],
        });

    });

function insert(){

  //reset
  $('input').val('');

  $('#modal').modal('show');  
}

function update(id){

  $.ajax({
    url: '<?=base_url('produksi/pewarnaan_get_barang')?>',
    type: 'POST',
    dataType: 'json',
    data: {id: id},
  })
  .done(function(data) {
    
    $('.id').val(data['cacat_id']);
    $('.tanggal').val(data['cacat_tanggal']);
    $('.jumlah').val(data['cacat_jumlah']);

    //popup
    $('#modal').modal('show'); 

  });
  
}
 
</script>
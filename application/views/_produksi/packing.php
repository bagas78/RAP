
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
          
          <table id="example" class="table table-bordered table-hover" style="width: 100%;">
                <thead>
                <tr>
                  <th>Nomor</th>
                  <th>Packing</th>
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

<div class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Proses Packing</h4>
      </div>
      <div class="modal-body">
        <form role="form" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Produk</th>
                  <th>Jenis</th>
                  <th>Warna</th>
                  <th>Jumlah</th>
                  <th hidden>Id</th>
                </tr>
              </thead>
              <tbody id="data-modal">
                
              </tbody>
            </table>

            <div class="clearfix"></div><br/>

            <div class="form-group">
              <label>Tanggal Packing</label>
              <input type="date" name="tanggal" class="tanggal form-control" required value="">
            </div>
          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <button type="submit" class="btn btn-success">Proses <i class="fa fa-check"></i></button>
             <button type="reset" class="btn btn-danger">Reset <i class="fa fa-times"></i></button>
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

            "processing": true, 
            "serverSide": true,
            "order":[], 
            "scrollX": true, 
            
            "ajax": {
                "url": "<?=site_url('produksi/packing_get_data')?>",
                "type": "GET"
            },
            "columns": [                               
                        { "data": "produksi_nomor"},
                        { "data": "produksi_packing_tanggal",
                        "render": 
                        function( data ) {
                            if(data == null){var p = '-'}else{var p = moment(data).format("DD/MM/YYYY")}
                            return "<span>"+p+"</span>";
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
                            return "<button onclick='modal("+data+")' class='btn btn-xs btn-success'><i class='fa fa-dropbox'></i></button> "+
                            "<a href='<?php echo base_url('produksi/packing_laporan/')?>"+data+"'><button class='btn btn-xs btn-warning'><i class='fa fa-file-text'></i></button></a>";
                          }
                        },
                        
                    ],
        });

    });

 function modal(id){

    //empty table
    $('#data-modal').empty();

    $.get('<?=base_url('produksi/packing_get/')?>'+id, function(data) {
      var val = $.parseJSON(data);
      var html = '';
      $.each(val, function(index, val) {
          html += '<tr>';
          html += '<td>'+(index+1)+'</td>';
          html += '<td>'+val.produk_nama+'</td>';
          html += '<td>'+val.warna_jenis_type+'</td>';
          html += '<td>'+val.warna_nama+'</td>';
          html += '<td>'+val.produksi_barang_qty+'</td>';
          html += '<td hidden><input name="id[]" value="'+val.produksi_barang_id+'" style="width: 100px;" type="number" class="form-control"></td>';
          html += '</tr>';
      });
      $('#data-modal').append(html);

      //tanggal & keterangan
      $('.tanggal').val(val[0].produksi_packing_tanggal);

      //modal pop up
      $('.modal').modal('toggle');
      $('form').attr('action', '<?=base_url('produksi/packing_proses/')?>'+id);

    });
  }
 
</script>
<div class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Pembayaran Hutang</h4>
      </div>
      <div class="modal-body">
        <form role="form" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="form-group">
              <label>Tanggal Pelunasan</label>
              <input required="" type="date" name="tanggal" class="form-control" value="<?=date('Y-m-d')?>">
            </div>
            <div class="form-group">
              <label>Keterangan</label>
              <textarea required="" type="text" name="keterangan" class="form-control"></textarea>
            </div>
          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit <i class="fa fa-check"></i></button>
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
  function bayar(id){

    $('.modal').modal('toggle');
    $('form').attr('action', '<?=base_url('pembelian/bayar_rotate/'.@$bayar_active).'/'?>'+id);

  }
</script>
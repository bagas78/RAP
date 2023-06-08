<style type="text/css">
.tot{
  font-weight: 600;
  background: #777;
  color: white;
  width: fit-content;
  padding: 1.5%;
  border-radius: 10px;
}  
</style>

<div class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Pembayaran Piutang</h4>
      </div>
      <div class="modal-body">

        <form role="form" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="form-group">
              <h1 class="tot">Rp. <span class="tot_nominal"></span></h1>
            </div>
            <div class="form-group">
              <label>Tanggal Pelunasan</label>
              <input required="" type="date" name="tanggal" class="form-control" value="<?=date('Y-m-d')?>">
            </div>
            <div class="form-group">
              <label>Jumlah Nominal</label>
              <div class="input-group">
                <span class="input-group-addon">Rp</span>
                <input type="number" name="jumlah" class="jumlah form-control" value="0">
              </div>

              <!--hidden-->
              <input type="hidden" name="kurang" class="kurang form-control" value="0">

            </div>
            <div class="form-group">
              <label>Kembalian</label>
              <div class="input-group">
                <span class="input-group-addon">Rp</span>
                <input readonly type="number" name="kembalian" class="kembalian form-control" value="0">
              </div>
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

    $.get('<?= base_url('penjualan/get_nominal/') ?>'+id, function(data) {
      var json = JSON.parse(data);
      $('.tot_nominal').text(number_format(json.total));

      //modal
      $('.modal').modal('toggle');
      $('form').attr('action', '<?=base_url('penjualan/bayar_rotate/')?>'+id);

    });

  }

  function kem(){

    var nominal = Number($('.tot_nominal').text().replaceAll(',',''));
    var jumlah = Number($('.jumlah').val());
    var kembalian = Number($('.kembalian').val());   

    if (jumlah > nominal) {

      $('.kembalian').val(jumlah - nominal);
      $('.kurang').val(0);

    }else{

      $('.kurang').val(nominal - jumlah);
      $('.kembalian').val(0);
    }

    setTimeout(function() {
        kem();
    }, 100);
  }

  kem();

</script>
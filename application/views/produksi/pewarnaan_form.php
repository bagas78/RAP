<style type="text/css">
  .mb-7{
    margin-bottom: 7%;
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

      <div hidden id="search" align="left">
        <div class="col-md-3 col-xs-11 row" style="margin-bottom: 0;">
          <input id="po" type="text" class="form-control" placeholder="-- Tarik transaksi PO --">
        </div>
        <div class="col-md-1 col-xs-1">
          <button id="po_get" type="button" class="btn btn-primary"><i class="fa fa-search"></i></button>
        </div>
      </div>

    </div>
    <div class="box-body">

      <form method="post" enctype="multipart/form-data" class="bg-alice">

        <div class="row" style="margin-left: -8px;">
          <div class="col-md-12">
            <div class="form-group col-md-6">
              <label>Nomor Pewarnaan</label>
              <input readonly="" type="text" name="nomor" class="form-control" required id="nomor" value="">
            </div>
            <div class="form-group col-md-6">
              <label>Hpp</label>
              <input readonly="" type="text" name="hpp" class="form-control" required id="hpp" value="<?=@$hpp ?>">
            </div>
          </div>          
          <div class="col-md-12">
            <div class="form-group col-md-6">
              <label>Jumlah Produk ( 1/2 ) Jadi</label>
              <div class="input-group">
                <input required id="jumlah" type="number" name="jumlah" class="form-control" value="" min="0">
                <span class="input-group-addon" id="stok"><?=@$stok ?></span>
              </div>
            </div>
            <div class="form-group col-md-6">
              <label>Hpp Total</label>
              <input readonly="" type="text" name="hpp_total" class="form-control" required id="hpp_total" value="0">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group col-md-6">
              <label>Produk Jadi</label>
              <select name="produk" class="form-control" required id="produk">
                <option value="" hidden>-- Pilih --</option>
                <?php foreach ($master_data as $value): ?>
                  <option value="<?=$value['master_produk_id'] ?>"><?=$value['master_produk_nama'] ?></option>
                <?php endforeach ?>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label>Jenis Pewarnaan</label>
              <input class="form-control" type="text" name="jenis" readonly="" id="jenis">
              <input class="form-control" type="hidden" name="jenis_id" readonly="" id="jenis_id">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group col-md-6">
              <button type="submit" class="btn btn-success">Packing <i class="fa fa-dropbox"></i></button>
              <a href="<?= @$_SERVER['HTTP_REFERER'] ?>"><button type="button" class="btn btn-danger">Batal <i class="fa fa-times"></i></button></a>
            </div>
          </div>
        </div>

      </form>

    </div>
  </div>
  <!-- /.box -->

<script type="text/javascript">

  //atribut
  $('form').attr('action', '<?=base_url('produksi/'.@$url)?>');
  $('#nomor').val('<?=@$nomor?>');

  $(document).on('change', '#produk', function() {

    var id = $(this).val();
   
    $.get('<?=base_url('produksi/pewarnaan_get_produk/')?>'+id, function(data) {
      
      var json = JSON.parse(data);
      
      $('#jenis').val(json['pewarnaan_jenis_type']);
      $('#jenis_id').val(json['pewarnaan_jenis_id']);

    });

  });
  
  function auto(){
    
    var jumlah = $('#jumlah');
    var stok = $('#stok').text();

    if (parseInt(jumlah.val()) > parseInt(stok)) {
      alert_sweet('Jumlah melebihi stok');
      jumlah.val('');
    }  

    //hpp total
    var hpp_total = parseInt($('#hpp').val()) * parseInt(jumlah.val());
    $('#hpp_total').val(number_format(hpp_total));

    setTimeout(function() {
        auto();
    }, 100);
  }

  auto();

</script>
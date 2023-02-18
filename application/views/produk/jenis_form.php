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

      <form method="post" enctype="multipart/form-data" class="bg-alice" action="<?=base_url('produk/jenis_save')?>">

        <div class="row" style="margin-left: -8px;">
          <div class="col-md-12">
            <div class="form-group col-md-6">
              <label>Kode Warna</label> 
              <input readonly="" type="text" name="kode" class="form-control" required value="<?=@$kode?>" id="kode">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group col-md-6">
              <label>Type</label>
              <input type="text" name="type" class="form-control" required value="" required id="type">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group col-md-6">
              <label>Keterangan</label>
              <textarea class="form-control" required name="keterangan" id="keterangan"></textarea>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group col-md-6">
              <button type="submit" class="btn btn-primary">Simpan <i class="fa fa-check"></i></button>
              <a href="<?= @$_SERVER['HTTP_REFERER'] ?>"><button type="button" class="btn btn-danger">Batal <i class="fa fa-times"></i></button></a>
            </div>
          </div>
        </div>

      </form>

    </div>
  </div>
  <!-- /.box -->
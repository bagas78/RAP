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

      <form method="post" enctype="multipart/form-data" class="bg-alice" action="<?=base_url('produk/save')?>">

        <div class="row" style="margin-left: -8px;">
          <div class="col-md-12">
            <div class="form-group col-md-6">
              <label>Nomor Produk</label>
              <input readonly="" type="text" name="nomor" class="form-control" required value="<?=@$nomor?>" id="nomor">
            </div>
            <div class="form-group col-md-6">
              <label>Merk</label>
              <input type="text" name="merk" class="form-control" required id="merk">
            </div>
          </div>          
          <div class="col-md-12">
            <div class="form-group col-md-6">
              <label>Nama</label>
              <input type="text" name="nama" class="form-control" required value="" required id="nama">
            </div>
            <div class="form-group col-md-6">
              <label>Ketebalan</label>
              <div class="input-group">
                <input required type="number" name="ketebalan" class="form-control" id="ketebalan">
                <span class="input-group-addon">Cm</span>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group col-md-6">
              <label>Pewarnaan</label>
              <select name="pewarnaan" class="form-control" required id="pewarnaan">
                <option value="" hidden>-- Pilih --</option>
                <?php foreach ($pewarnaan_data as $val): ?>
                  <option value="<?=$val['pewarnaan_jenis_id']?>"><?=$val['pewarnaan_jenis_type']?></option>
                <?php endforeach ?>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label>Ukuran</label>
              <div class="row">
                <div class="col-md-6 col-xs-6">
                  <div class="input-group">
                    <input placeholder="panjang" required type="number" name="panjang" class="form-control" id="panjang">
                    <span class="input-group-addon">Cm</span>
                  </div>
                </div>
                <div class="col-md-6 col-xs-6">
                  <div class="input-group">
                    <input placeholder="lebar" required type="number" name="lebar" class="form-control" id="lebar">
                    <span class="input-group-addon">Cm</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group col-md-6">
              <label>Harga</label>
              <input class="form-control" type="number" name="harga" required id="harga">
            </div>
            <div class="form-group col-md-6">
              <label>Berat</label>
              <div class="input-group">
                <input required type="number" name="berat" class="form-control" id="berat">
                <span class="input-group-addon">&#160;Kg&#160;</span>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group col-md-6">
              <label>Satuan</label>
              <select name="satuan" class="form-control" required id="satuan">
                <option value="" hidden>-- Pilih --</option>
                <?php foreach ($satuan_data as $val): ?>
                  <option value="<?=$val['satuan_id']?>"><?=$val['satuan_singkatan']?></option>
                <?php endforeach ?>
              </select>
            </div>
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
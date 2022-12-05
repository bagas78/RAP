
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
         
          <form class="bg-alice" action="<?=base_url('pembelian/save_bahan')?>" method="POST" accept-charset="utf-8">
            
            <div class="form-group">
              <label>Nama Bahan</label>
              <input required="" type="text" name="nama" class="form-control">
            </div>
            <div class="form-group">
              <label>Kategori</label>
              <select name="kategori" class="form-control" required>
                <option value="" hidden>-- Pilih --</option>
                <option value="avalan">Bahan Avalan</option>
                <option value="utama">Bahan Baku Utama</option>
              </select>
            </div>
            <div class="form-group">
              <label>Satuan</label>
              <select name="satuan" class="form-control" required>
               <option value="" hidden>-- Pilih --</option>
                <?php foreach ($satuan_data as $s): ?>
                  <option value="<?= $s['satuan_id']?>"><?= $s['satuan_singkatan']?></option>
                <?php endforeach ?>
              </select>
            </div>
            <div class="form-group">
              <label>Harga</label>
              <input required="" type="number" name="harga" class="form-control">
            </div>            

            <button type="submit" class="btn btn-success">Simpan <i class="fa fa-check"></i></button>
            <a href="<?= $_SERVER['HTTP_REFERER'] ?>"><button type="button" class="btn btn-danger">Batal <i class="fa fa-times"></i></button></a>

          </form>

        </div>
      </div>
      <!-- /.box -->
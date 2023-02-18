
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
          
          <div class="col-md-12">
            <form class="bg-alice" action="<?=base_url('kontak/karyawan_save')?>" method="POST" accept-charset="utf-8">
            
            <!--hidden-->
            <input type="hidden" name="jenis" value="<?=@$jenis?>">

              <div class="row form-group col-md-6">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" required id="nama">
              </div>
              <div class="clearfix"></div>
              <div class="row form-group col-md-6">
                <label>No. Telepon</label>
                <input type="number" name="telp" class="form-control" required id="telp">
              </div>
              <div class="clearfix"></div>
              <div class="row form-group col-md-6">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control" required id="alamat"></textarea>
              </div>
              <div class="clearfix"></div>
              <div class="form-group">
                <button type="submit" class="btn btn-success">Simpan <i class="fa fa-check"></i></button>
                <a href="<?= @$_SERVER['HTTP_REFERER'] ?>"><button type="button" class="btn btn-danger">Batal <i class="fa fa-times"></i></button></a>
              </div>

            </form>
          </div>

        </div>

        
      </div>
      <!-- /.box -->
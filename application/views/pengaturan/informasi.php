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
      
      <div class="row bg-alice">
        <div class="col-md-9">
          <form action="<?=base_url('pengaturan/informasi_update/'.@$data['logo_id']) ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label>Logo Aplikasi</label>
              <input type="file" name="foto" class="form-control">
            </div>
            <div class="form-group">
              <label>Nama Aplikasi</label>
              <input type="text" name="name" class="form-control" value="<?=@$data['logo_nama'] ?>" required>
            </div>
            <div class="form-group">
              <label>No. Telp</label>
              <input type="text" name="telp" class="form-control" value="<?=@$data['logo_telp'] ?>" required>
            </div>
            <div class="form-group">
              <label>Kota / Kabupaten</label>
              <input type="text" name="kota" class="form-control" value="<?=@$data['logo_kota'] ?>" required>
            </div>
            <div class="form-group">
              <label>Alamat</label>
              <textarea class="form-control" required name="alamat"><?=@$data['logo_alamat'] ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan <i class="fa fa-check"></i></button>
            <button type="reset" class="btn btn-danger">Reset <i class="fa fa-times"></i></button>
          </form>
        </div>
        <div class="col-md-3">
          <img style="background: #d2d6de;" src="<?= base_url('assets/logo/'.@$data['logo_foto']) ?>" class="img img-thumbnail w-100">
        </div>
      </div>

    </div>
  </div>
  <!-- /.box -->
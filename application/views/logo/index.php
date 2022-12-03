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
      
      <div class="row" style="background: aliceblue; padding: 2%; margin: 0;">
        <div class="col-md-9">
          <form action="<?=base_url('logo/update/'.@$data['logo_id']) ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label>Logo Aplikasi</label>
              <input type="file" name="foto" class="form-control">
            </div>
            <div class="form-group">
              <label>Nama Aplikasi</label>
              <input type="text" name="name" class="form-control" value="<?=@$data['logo_nama'] ?>" required>
            </div>
            <button class="btn btn-primary">Simpan <i class="fa fa-check"></i></button>
            <button class="btn btn-danger">Reset <i class="fa fa-times"></i></button>
          </form>
        </div>
        <div class="col-md-3">
          <img style="background: #d2d6de;" src="<?= base_url('assets/logo/'.@$data['logo_foto']) ?>" class="img img-thumbnail w-100">
        </div>
      </div>

    </div>
  </div>
  <!-- /.box -->
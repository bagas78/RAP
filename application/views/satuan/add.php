
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
         
          <form action="<?=base_url('satuan/save')?>" method="POST" accept-charset="utf-8">
            
            <div class="row bg-alice">
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Satuan</label>
                  <input type="text" name="kepanjangan" class="kepanjangan form-control" required>
                </div>
                <div class="form-group">
                  <label>Singkatan</label>
                  <input type="text" name="singkatan" class="singkatan form-control" required>
                </div>
              </div>
              <div class="col-md-12">
                <button type="submit" class="btn btn-success">Simpan <i class="fa fa-check"></i></button>
                <a href="<?= $_SERVER['HTTP_REFERER'] ?>"><button type="button" class="btn btn-danger">Batal <i class="fa fa-times"></i></button></a>
              </div>

            </div>

          </form>

        </div>

        
      </div>
      <!-- /.box -->
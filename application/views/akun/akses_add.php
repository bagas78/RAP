<style type="text/css">
  .tit{
    background: black;
    color: white;
    padding: 0.5%; 
    font-weight: 800;
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
        </div>
        <div class="box-body">
         
          <form action="<?=base_url('akun/akses_save')?>" method="POST" accept-charset="utf-8">
          
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Nama Level</label>
                  <input required="" type="text" name="nama" class="form-control" id="nama">
                </div>
              </div>
            </div>

            <table class="table table-responsive table-bordered">
              <thead>
                <tr>
                  <td>MENU</td>
                  <td width="1"><i class="fa fa-eye"></i></td>
                  <td width="1"><i class="fa fa-plus"></i></td>
                  <td width="1"><i class="fa fa-trash"></i></td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Dashboard</td>
                  <td><input type="checkbox" name="dashboard" value="0"></td>
                  <td>-</td>
                  <td>-</td>
                </tr>

                <tr>
                  <td>Kontak</td>
                  <td><input type="checkbox" name="kontak" value="0"></td>
                  <td>-</td>
                  <td>-</td>
                </tr>
                <tr>
                  <td>Karyawan</td>
                  <td><input type="checkbox" name="karyawan" value="0"></td>
                  <td><input type="checkbox" name="karyawan_add" value="0"></td>
                  <td><input type="checkbox" name="karyawan_del" value="0"></td>
                </tr>
                <tr>
                  <td>Supplier</td>
                  <td><input type="checkbox" name="supplier" value="0"></td>
                  <td><input type="checkbox" name="supplier_add" value="0"></td>
                  <td><input type="checkbox" name="supplier_del" value="0"></td>
                </tr>
                <tr>
                  <td>Pelanggan</td>
                  <td><input type="checkbox" name="pelanggan" value="0"></td>
                  <td><input type="checkbox" name="pelanggan_add" value="0"></td>
                  <td><input type="checkbox" name="pelanggan_del" value="0"></td>
                </tr>
                <tr>
                  <td>Rekening Bank</td>
                  <td><input type="checkbox" name="rekening" value="0"></td>
                  <td><input type="checkbox" name="rekening_add" value="0"></td>
                  <td><input type="checkbox" name="rekening_del" value="0"></td>
                </tr>
              </tbody>
            </table>

            <button type="submit" class="btn btn-success">Simpan <i class="fa fa-check"></i></button>
            <a href="<?= $_SERVER['HTTP_REFERER'] ?>"><button type="button" class="btn btn-danger">Batal <i class="fa fa-times"></i></button></a>

          </form>

        </div>
      </div>
      <!-- /.box -->

<script type="text/javascript">
  $(document).on('click', 'input[type="checkbox"]', function() {

    var target = $(this);

    if (target.val() == 1) {
      target.val(0);
    }else{
      target.val(1);
    }

  });
</script>
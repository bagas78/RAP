
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
         
          <form action="<?=base_url('pegawai/save')?>" method="POST" accept-charset="utf-8" style="background: aliceblue;padding: 2%;">
            
            <div class="form-group">
              <label>Nama</label>
              <input required="" type="text" name="name" class="form-control">
            </div>
            <div class="form-group">
              <label>Email</label>
              <input required="" type="admin" name="email" class="form-control">
            </div>
            <div class="form-group">
              <label>Password</label>
              <input id="pass" required="" type="password" name="password" class="form-control">
              <button onclick="show('pass')" type="button" class="btn btn-default btn-xs"><small>Show Password</small></button>
            </div>
            <div class="form-group">
              <label>Ulangi Password</label>
              <input id="re" required="" type="password" class="form-control">
              <button onclick="show('re')" type="button" class="btn btn-default btn-xs"><small>Show Password</small></button>
            </div>

            <button type="submit" class="btn btn-success">Simpan <i class="fa fa-check"></i></button>
            <a href="<?= $_SERVER['HTTP_REFERER'] ?>"><button type="button" class="btn btn-danger">Batal <i class="fa fa-times"></i></button></a>

          </form>

        </div>
      </div>
      <!-- /.box -->

<script type="text/javascript">
  //password show and hide
  function show(target){
    var $type = $('#'+target).attr('type');
    if ($type == 'password') {
      $('#'+target).attr('type','text');
    }else{
      $('#'+target).attr('type','password');
    }
  }

//submit
$('form').submit(function (e) {
    e.preventDefault();
    if ($('#pass').val() != $('#re').val()) {
      
      swal({
        title: "Password tidak sama",
        text: "Periksa kembali password anda.",
        icon: "warning",
        buttons: false,
        dangerMode: true,
      });
    
    }else{
      $('form').submit();
    }
});

</script>

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
         
          <form class="bg-alice" action="<?=base_url('akun/admin_save')?>" method="POST" accept-charset="utf-8">
            
            <div class="form-group">
              <label>Nama</label>
              <input required="" type="text" name="name" class="form-control" id="nama">
            </div>
            <div class="form-group">
              <label>Email</label>
              <input required="" type="email" name="email" class="form-control" id="email">
            </div>
            <div class="form-group">
              <label>Password <small class="edit text-danger"></small></label>
              <input id="pass" type="password" name="password" class="form-control" autocomplete="off">
              <button onclick="show('pass')" type="button" class="btn btn-default btn-xs"><small>Show Password</small></button>
            </div>
            <div class="form-group">
              <label>Ulangi Password <small class="edit text-danger"></small></label>
              <input id="re" type="password" class="form-control" autocomplete="off">
              <button onclick="show('re')" type="button" class="btn btn-default btn-xs"><small>Show Password</small></button>
            </div>

            <button onclick="simpan()" type="button" class="btn btn-success">Simpan <i class="fa fa-check"></i></button>
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
function simpan(){

  if ($('#pass').val() != $('#re').val()) {
      
    swal({
      title: "Password tidak sama",
      text: "Periksa kembali password anda.",
      icon: "warning",
      buttons: false,
      dangerMode: true,
    });
  
  }else{

    $("form").submit();
  }

}

</script>
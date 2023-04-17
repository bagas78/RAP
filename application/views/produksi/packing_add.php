<style type="text/css">
  .small{
    background: grey;
    color: white;
    padding: 5px 10px;
    text-align: center;
  }
</style>

<!-- Main content --> 
<section class="content">
 
  <!-- Default box -->  
  <div class="box"> 
    <div class="box-header with-border">

      <div class="back" align="left" hidden>
        <a href="<?= @$_SERVER['HTTP_REFERER'] ?>"><button class="btn btn-danger"><i class="fa fa-arrow-left"></i> Kembali</button></a>
      </div>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fa fa-times"></i></button>
      </div>

    </div>
    <div class="box-body">

      <form method="post" enctype="multipart/form-data" class="bg-alice">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Nomor Packing</label>
              <input type="text" name="nomor" class="form-control" required id="nomor">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Tanggal Packing</label>
              <input type="date" name="tanggal" class="form-control" required id="tanggal">
            </div>
          </div>
        </div>

        <div class="clearfix"></div>

        <table class="table table-responsive table-borderless">
          <thead>
            <tr>
              <th width="300">Produk</th>
              <th width="300">Jenis</th>
              <th width="300">Warna</th>
              <th width="300">Stok</th>
              <th width="200">Qty</th>
              <th><button type="button" onclick="clone()" class="add btn btn-success btn-sm">+</button></th>
            </tr>
          </thead>
          <tbody id="paste">

             <tr id="copy">
              <td>
                <select required id="produk" class="produk form-control" name="produk[]">
                  <option value="" hidden>-- Pilih --</option>
                  <?php foreach ($produk_data as $p): ?>
                    <option value="<?=@$p['produk_id']?>"><?=@$p['produk_nama']?></option>
                  <?php endforeach ?>
                </select>
              </td>

              <td>
                <select required id="jenis" class="jenis form-control" name="jenis[]">
                  <option value="" hidden>-- Pilih --</option>
                  <?php foreach ($jenis_data as $j): ?>
                    <option value="<?=@$j['warna_jenis_id']?>"><?=@$j['warna_jenis_type']?></option>
                  <?php endforeach ?>
                </select>
              </td>
              <td>
                <select required id="warna" class="warna form-control" name="warna[]">
                  <option value="" hidden>-- Pilih --</option>
                  <?php foreach ($warna_data as $w): ?>
                    <option hidden class="<?='warna_'.@$w['warna_jenis']?>" value="<?=@$w['warna_id']?>"><?=@$w['warna_nama']?></option>
                  <?php endforeach ?>
                </select>
              </td>
               <td><input readonly type="number" name="stok[]" class="stok form-control" required value="0" min="0"></td>
              <td><input type="number" name="qty[]" class="qty form-control" required value="0" min="1"></td>
             
              <td><button type="button" class="remove btn btn-danger btn-sm">-</button></td>
            </tr>

            <tr class="save">
              <td colspan="5" align="right">
                <button type="submit" class="btn btn-primary">Simpan <i class="fa fa-check"></i></button>
                <a href="<?= @$_SERVER['HTTP_REFERER'] ?>"><button type="button" class="btn btn-danger">Batal <i class="fa fa-times"></i></button></a>
              </td>
            </tr>

          </tbody>
        </table>

      </form>

    </div>
  </div>
  <!-- /.box -->

<script type="text/javascript">

//view UI
<?php if(@$view == 1):?>
  $('.back').removeAttr('hidden');
  $('.add').remove();
  $('.remove').remove();
  $('.save').remove();
  $('.form-group, td').css('pointer-events', 'none');
<?php endif?>

//atribut
$('form').attr('action', '<?=base_url('produksi/packing_save')?>');
$('#nomor').val('<?=@$nomor?>');
$('#tanggal').val('<?=date('Y-m-d')?>');

  //get barang
  $(document).on('change', '.produk, .jenis, .warna', function() {

    var produk = $(this).closest('tr').find('.produk').val();
    var jenis = $(this).closest('tr').find('.jenis').val();
    var warna = $(this).closest('tr').find('.warna').val();

    var index = $(this).closest('tr').index();
    var arr = new Array(); 
    var stok = $(this).closest('tr').find('.stok');

   /////// cek exist barang ///////////
    $.each($('.produk'), function(idx, val) {
        
        if (index != idx)
        arr.push($(this).val());

    });

    
    if ($.inArray(produk, arr) != -1) {
      var i = index + 1;

      alert_sweet('Produk sudah ada');
      
      //null input
      $(this).val('').change();
      $(this).closest('tr').find('select').val('').change();
      $(this).closest('tr').find('input').val(0);
      
    }else{

      $.get('<?=base_url('produksi/packing_get_produk/')?>'+produk+'/'+jenis+'/'+warna, function(data) {
    
        var val = JSON.parse(data);

        stok.val(val);

      });

    }
    ////// end exist barang ///////////

  });

  $(document).on('change', '#jenis', function() {
      var id = $(this).val();
      
      //hapus readonly
      $(this).closest('#copy').find('.warna').val('').change().removeAttr('readonly').css('pointer-events', '');
      $(this).closest('#copy').find('.warna > option').attr('hidden',true);
      $(this).closest('#copy').find('.mf_check').css('pointer-events','');

      //class
      var cl = '.warna_'+id;

      switch (id) {
        case '1':
          //Anodizing
          $(this).closest('#copy').find(cl).removeAttr('hidden');
          break;
        case '2':
          //Powder Coating
          $(this).closest('#copy').find(cl).removeAttr('hidden');
          break;
        case '3':
          //MF
          $(this).closest('#copy').find('.warna').val(0).change().attr('readonly',true).css('pointer-events','none');

          break;
         
      }

  });

  //copy paste
  function clone(){
    //paste
    $('#paste').prepend($('#copy').clone());
    

    //blank new input
    $('#copy').find('#warna > option').attr('hidden',true);
    $('#copy').find('select').val('');
    $('#copy').find('.qty').val(0);
    $('#copy').find('.stok').val(0); 
    $('#copy').find('.cacat').val(0);    

  }

  //remove
  $(document).on('click', '.remove', 'tr a.remove', function(e) {
    e.preventDefault();
    $(this).parent().prev().find('.delete').val(1);
    $(this).closest('tr').attr('hidden', true);
  });

  //foto preview
  function clickFile(target){

    if (target == 1) {
      $('#file1').click();
    }else{
      $('#file2').click();
    }
  }
  function previewFile(input,target){

      if (target == 1) {

        var file = $("#file1").get(0).files[0];

        if(file){
            var reader = new FileReader();

            reader.onload = function(){
                $("#previewImg1").attr("src", reader.result);
            }

            reader.readAsDataURL(file);
        }
      }else{

        var file = $("#file2").get(0).files[0];

        if(file){
            var reader = new FileReader();

            reader.onload = function(){
                $("#previewImg2").attr("src", reader.result);
            }

            reader.readAsDataURL(file);
        }
      }
  }

  //set val checked MF
  $(document).on('change', '.mf_check', function() {
    var mf = $(this).closest('#copy').find('.mf_val');
    if (mf.val() == 0) {
      mf.val(1);

    }else{
      mf.val(0);
    }

  });

  function auto(){
    //cek stok
    $.each($('.stok'), function(index, val) {
       var stok = parseInt($(this).val());
       var qty = parseInt($(this).closest('tr').find('.qty').val());
       var cacat = parseInt($(this).closest('tr').find('.cacat').val());
       
       //qty
       if (stok < qty) {
        $(this).closest('tr').find('.qty').val(0);
        alert_sweet('Stok tidak cukup');
       }

       //cacat
       if (qty < cacat) {
        $(this).closest('tr').find('.cacat').val(0);
        alert_sweet('Qty kurang dari produk cacat');
       }
    
    });

    //border none
    $('td').css('border-top', 'none');

    setTimeout(function() {
        auto();
    }, 100);
  }

  auto();

</script>
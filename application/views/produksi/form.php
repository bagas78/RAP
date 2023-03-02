<style type="text/css">
  .small{
    background: darkorange;
    color: white;
    padding: 5px 10px;
    border-radius: 15px;
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
          <input id="po" type="text" class="form-control" placeholder="PR-xxxxx">
        </div>
        <div class="col-md-1 col-xs-1">
          <button id="po_get" type="button" class="btn btn-primary"><i class="fa fa-search"></i></button>
        </div>
      </div>

    </div>
    <div class="box-body">

      <small class="small">Check stok (MF) untuk menggunakan produk setengah jadi</small>
      <div class="clearfix"></div><br/>

      <form method="post" enctype="multipart/form-data" class="bg-alice">
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>Nomor Produksi</label>
              <input type="text" name="nomor" class="form-control" required id="nomor">
            </div>
            <div class="form-group">
              <label>Tanggal Produksi</label>
              <input type="date" name="tanggal" class="form-control" required id="tanggal">
            </div>
            <div class="form-group">
              <label>Shift</label>
              <select name="shift" class="form-control select2" required id="shift">
                <option value="" hidden>-- Pilih --</option>
                <?php foreach ($user_data as $u): ?>
                  <option value="<?= $u['user_id']?>"><?= $u['user_name']?></option>
                <?php endforeach ?>
              </select>
            </div>
          </div>
          <div class="col-md-5">
            <div class="pesanan form-group">
              <label>Pesanan</label>
              <select name="pesanan" class="form-control select2" required id="pesanan">
                <option value="" hidden>-- Pilih --</option>
                <?php foreach ($pesanan_data as $p): ?>
                  <option value="<?= $p['kontak_id']?>"><?= $p['kontak_nama']?></option>
                <?php endforeach ?>
              </select>
            </div>
            <div class="pekerja form-group">
              <label>Pekerja</label>
                <select name="pekerja[]" id="pekerja" class="form-control select2" multiple="multiple" data-placeholder="-- Pilih --"style="width: 100%;">
                  <?php foreach ($pekerja_data as $p): ?>
                    <option value="<?= @$p['karyawan_id']?>"><?= @$p['karyawan_nama']?></option>
                  <?php endforeach ?>
                </select>
            </div>
            <div class="form-group">
              <label>Mesin</label>
              <select name="mesin" class="form-control select2" required id="mesin">
                <option value="" hidden>-- Pilih --</option>
                <?php foreach ($mesin_data as $m): ?>
                  <option value="<?= $m['mesin_id']?>"><?= $m['mesin_nama']?></option>
                <?php endforeach ?>
              </select>
            </div>
            <div class="form-group">
              <label>Keterangan</label>
              <textarea name="keterangan" class="form-control" id="keterangan"></textarea>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">

              <label>Sebelum Produksi</label>
              <img id="previewImg1" onclick="clickFile(1)" style="width: 100%;">
              <input style="visibility: hidden;" id="file1" type="file" name="lampiran[]" onchange="previewFile(this,1)">
          
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">

              <label>Sesudah Produksi</label>
              <img id="previewImg2" onclick="clickFile(2)" style="width: 100%;">
              <input style="visibility: hidden;" id="file2" type="file" name="lampiran[]" onchange="previewFile(this,2)">
          
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
              <th width="200">Stok (MF)</th>
              <th width="200">Qty</th>
              <th hidden width="150">ID</th>
              <th hidden width="150">Delete</th>
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
              <td>
                <div class="input-group">
                  <input readonly min="0" type="number" name="mf[]" class="mf form-control" value="0" required>
                  <span class="satuan input-group-addon">
                    <input type="checkbox" name="mf_check" class="mf_check">
                  </span>
                </div>
              </td>
              <td><input type="number" name="qty[]" class="qty form-control" required value="0" min="0"></td>

              <!--hidden-->
              <td hidden>
                <input type="text" name="id[]" class="id form-control" value="0">
              </td>
              <td hidden>
                <input type="text" name="delete[]" class="delete form-control" value="0">
              </td>
              
              <td><button type="button" class="remove btn btn-danger btn-sm">-</button></td>
            </tr>

            <tr>
              <td colspan="3"></td>
              <td align="right">Qty Produk</td>
              <td><input id="qty_produk" readonly="" type="text" name="qty_produk" class="form-control"></td>
            </tr>

            <tr>
              <td colspan="3"></td>
              <td align="right">HPS Billet</td>
              <td>
                <input value="<?=number_format($billet_data['billet_hps'])?>" id="hps_billet" readonly="" type="text" name="hps_billet" class="form-control">
              </td>
            </tr>

            <tr>
              <td colspan="3"></td>
              <td align="right">Qty Billet</td>
              <td>
                <div class="input-group">
                  <input required id="qty_billet" type="number" name="qty_billet" class="form-control" value="0" min="0">
                  <span class="input-group-addon"><span id="stok_billet" hidden><?=number_format($billet_data['billet_stok'])?></span> Kg &#160;</span>
                </div>
              </td>
            </tr>

            <tr>
              <td colspan="3"></td>
              <td align="right">Biaya Jasa</td>
              <td>
                <div class="input-group">
                  <input id="jasa" type="number" name="jasa" class="form-control" value="0" min="0">
                  <span class="input-group-addon">Rp &#160;</span>
                </div>
              </td>
            </tr>

            <tr>
              <td colspan="3"></td>
              <td align="right">Total Akhir</td>
              <td><input id="total_akhir" readonly="" type="text" name="total_akhir" class="form-control" value="0" min="0"></td>
            </tr>

            <tr>
              <td colspan="3"></td>
              <td align="right">Sisa Billet</td>
              <td>
                <div class="input-group">
                  <input id="sisa_billet" type="number" name="sisa_billet" class="form-control" value="0" min="0">
                  <span class="input-group-addon">Kg &#160;</span>
                </div>
              </td>
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

//pesanan produksi
if ('<?=@$url == 'pesanan'?>') {
  $('.pekerja').remove();
}else{
  $('.pesanan').remove();
}

//view UI
<?php if(@$view == 1):?>
  $('.add').remove();
  $('.remove').remove();
  $('.save').remove();
  $('.form-group, td').css('pointer-events', 'none');
<?php endif?>

//atribut
$('form').attr('action', '<?=base_url('produksi/'.@$url.'_save')?>');
$('#nomor').val('<?=@$nomor?>');
$('#tanggal').val('<?=date('Y-m-d')?>');
$('#previewImg1').attr('src', '<?=base_url('assets/gambar/1.png')?>');
$('#previewImg2').attr('src', '<?=base_url('assets/gambar/2.png')?>');

  //get barang
  $(document).on('change', '#jenis', function() {
      var id = $(this).val();
      
      //hapus readonly
      $(this).parent().next().find('select').val('').change().removeAttr('readonly').css('pointer-events', '');
      $(this).parent().next().find('select > option').attr('hidden',true);

      //class
      var cl = '.warna_'+id;

      switch (id) {
        case '1':
          //Anodizing
          $(this).parent().next().find('select > '+cl).removeAttr('hidden');
          break;
        case '2':
          //Powder Coating
          $(this).parent().next().find('select > '+cl).removeAttr('hidden');
          break;
        case '3':
          //MF
          $(this).parent().next().find('select').val(0).change().attr('readonly',true).css('pointer-events','none');
          break;
         
      }

  });

  $(document).on('change', '.produk', function() {

    var id = $(this).val();
    var index = $(this).closest('tr').index();
    var arr = new Array(); 

   /////// cek exist barang ///////////
    $.each($('.produk'), function(idx, val) {
        
        if (index != idx)
        arr.push($(this).val());

    });

    if (id != '') {

      if ($.inArray(id, arr) != -1) {
        var i = index + 1;

        alert_sweet('Produk sudah ada');
        
        //null input
        $(this).val('').change();
        $(this).parent().next().find('select').val('').change();
        $(this).parent().nextAll().find('input').val(0);
        
      }
      ////// end exist barang ///////////
    }
   

   //stok MF (tanpa warna)
   var target = $(this).parent().nextAll(':lt(3)').find('.mf');
   $.get('<?=base_url('produksi/get_mf/')?>'+id, function(data) {

      if (data != 0) {
        var val = $.parseJSON(data);

        $(target).val(val.stok);
      }else{

        $(target).val(0);
      }

   });
    
  });

  //cek stok MF
  $(document).on('change', '.mf_check , .qty', function() {

    if ($(this).attr('checked') == undefined) {
      $(this).attr('checked', true);

    }else{
      $(this).removeAttr('checked', true);
    }

    if ($(this).closest('table').find('td > div > span > .mf_check').attr('checked') == 'checked') { 
      //cek stok MF
      var stok = $(this).closest('table').find('td > div > .mf');
      var qty = $(this).closest('table').find('td > .qty');

      if ( parseInt(stok.val()) < parseInt(qty.val()) ) {

        alert_sweet('Stok MF kurang dari qty');
        qty.val(0);
      }
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
    $('#copy').find('.id').val(0);
    $('#copy').find('.mf').val(0);
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

  function auto(){

    //border none
    $('td').css('border-top', 'none');
    
    var num_qty = 0;
    $.each($('.qty'), function(index, val) {
       var i = index+1;

       num_qty += parseInt($(this).val());

    });

    var qty_produk = $('#qty_produk');
    qty_produk.val(num_qty);

    //cek stok billet
    var billet = $('#qty_billet');
    var stok_billet = parseInt($('#stok_billet').text());
    if (parseInt(billet.val().replace(/,/g, '')) > stok_billet) {
        
      alert_sweet('Stok billet kurang dari Qty');
      billet.val(0);
    }

    //total akhir
    var hps_billet = parseInt($('#hps_billet').val().replace(/,/g, ''));
    var qty_billet = parseInt(billet.val()) * hps_billet;
    var jasa = parseInt($('#jasa').val());
    var total = qty_billet + jasa;
    $('#total_akhir').val(number_format(total));

    setTimeout(function() {
        auto();
    }, 100);
  }

  auto();

</script>
<style type="text/css">
  .{
    margin-bottom: 7%;
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
          <input id="po" type="text" class="form-control">
        </div>
        <div class="col-md-1 col-xs-1">
          <button id="po_get" type="button" class="btn btn-primary"><i class="fa fa-search"></i></button>
        </div>
      </div>

    </div>
    <div class="box-body">

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
              <label>Pekerja</label>
                <select class="form-control select2" multiple="multiple" data-placeholder="-- Pilih --"style="width: 100%;">
                  <?php foreach ($pekerja_data as $p): ?>
                    <option value="<?= @$p['karyawan_id']?>"><?= @$p['karyawan_nama']?></option>
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
              <th width="200">Qty</th>
              <th><button type="button" onclick="clone()" class="btn btn-success btn-sm">+</button></th>
            </tr>
          </thead>
          <tbody id="paste">

             <tr id="copy">
              <td>
                <select required id="produk" class="barang form-control" name="produk[]">
                  <option value="" hidden>-- Pilih --</option>
                  <?php foreach ($produk_data as $p): ?>
                    <option value="<?=@$p['produk_id']?>"><?=@$p['produk_nama']?></option>
                  <?php endforeach ?>
                </select>
              </td>
              <td>
                <select required id="jenis" class="barang form-control" name="jenis[]">
                  <option value="" hidden>-- Pilih --</option>
                  <?php foreach ($jenis_data as $j): ?>
                    <option value="<?=@$j['warna_jenis_id']?>"><?=@$j['warna_jenis_type']?></option>
                  <?php endforeach ?>
                </select>
              </td>
              <td>
                <select required id="warna" class="barang form-control" name="warna[]">
                  <option value="" hidden>-- Pilih --</option>
                  <?php foreach ($warna_data as $w): ?>
                    <option value="<?=@$w['warna_id']?>"><?=@$w['warna_nama']?></option>
                  <?php endforeach ?>
                </select>
              </td>
              <td><input type="number" name="qty[]" class="qty form-control" required value="0" min="0"></td>
              
              <td><button type="button" onclick="$(this).closest('tr').remove()" class="btn btn-danger btn-sm">-</button></td>
            </tr>

            <tr>
              <td colspan="2"></td>
              <td align="right">Qty Produk</td>
              <td><input id="qty_barang" readonly="" type="text" name="qty_barang" class="form-control"></td>
            </tr>

            <tr>
              <td colspan="2"></td>
              <td align="right">HPP Billet</td>
              <td>
                <input value="0" id="hpp_billet" readonly="" type="text" name="hpp_billet" class="form-control">
              </td>
            </tr>

            <tr>
              <td colspan="2"></td>
              <td align="right">Qty Billet</td>
              <td>
                <div class="input-group">
                  <input required id="qty_billet" type="number" name="qty_billet" class="form-control" value="0" min="0">
                  <span class="input-group-addon"><span id="stok_billet"><?=number_format($billet_data['billet_stok'])?></span> Kg</span>
                </div>
              </td>
            </tr>

            <tr hidden>
              <td colspan="2"></td>
              <td align="right">Biaya Jasa</td>
              <td>
                <div class="input-group">
                  <input id="jasa" type="number" name="jasa" class="form-control" value="0" min="0">
                  <span class="input-group-addon">Rp &#160;</span>
                </div>
              </td>
            </tr>

            <tr>
              <td colspan="2"></td>
              <td align="right">Total Akhir</td>
              <td><input id="total_akhir" readonly="" type="text" name="total_akhir" class="form-control" value="0" min="0"></td>
            </tr>

            <tr>
              <td colspan="4" align="right">
                <button type="submit" class="btn btn-primary">Simpan <i class="fa fa-check"></i></button>
                <a href="<?= $_SERVER['HTTP_REFERER'] ?>"><button type="button" class="btn btn-danger">Batal <i class="fa fa-times"></i></button></a>
              </td>
            </tr>

          </tbody>
        </table>

      </form>

    </div>
  </div>
  <!-- /.box -->

<script type="text/javascript">

<?php if ($url == 'proses'): ?>

  proses();

<?php endif ?>

function proses() {
  
  // hidden menu proses produksi
  $('#jasa').closest('tr').removeAttr('hidden', true);
  $('#produk').closest('tr').removeAttr('hidden', true);
  $('#produk').attr('required',true);
  $('#hpp').closest('tr').removeAttr('hidden', true);

}

//atribut
$('form').attr('action', '<?=base_url('produksi/'.@$url.'_save')?>');
$('#nomor').val('<?=@$nomor?>');
$('#tanggal').val('<?=date('Y-m-d')?>');
$('#previewImg1').attr('src', '<?=base_url('assets/gambar/1.png')?>');
$('#previewImg2').attr('src', '<?=base_url('assets/gambar/2.png')?>');

  //get barang
  $(document).on('change', '#barang', function() {
      var id = $(this).val();
      var index = $(this).closest('tr').index();
      $.get('<?=base_url('produksi/get_barang/')?>'+id, function(data) {
        var val = JSON.parse(data);
        var i = (index + 1);
        
        //qty
        var qty = $('#copy:nth-child('+i+') > td:nth-child(2) > div > input').val(0);

        //stok
        $('#copy:nth-child('+i+') > td:nth-child(3) > div > input').val(number_format(val['bahan_stok']));

        //harga
        $('#copy:nth-child('+i+') > td:nth-child(4) > input').val(number_format(val['bahan_harga']));

        //satuan
        var satuan = $('#copy:nth-child('+i+')').find('.satuan');
        $(satuan).empty().html(val['satuan_singkatan']);

        /////// cek exist barang ///////////
        var arr = new Array(); 
        $.each($('.barang'), function(idx, val) {
            
            if (index != idx)
            arr.push($(this).val());

        });

        //reset input
        function reset(){
          $('#copy:nth-child('+i+') > td:nth-child(1) > select').val('').change();
          $('#copy:nth-child('+i+') > td:nth-child(3) > div > input').val('');
          $('#copy:nth-child('+i+') > td:nth-child(4) > input').val(0);
        }

        if ($.inArray(id, arr) != -1) {
          alert_sweet('Bahan avalan sudah ada');
          reset();
        }
        ////// end exist barang ///////////


        //cek stok
        var qty = $('#copy:nth-child('+i+') > td:nth-child(2) > div > input').val();
        var stok = $('#copy:nth-child('+i+') > td:nth-child(3) > div > input').val(); 
        if (parseInt(qty) > parseInt(stok)) {
            
          alert_sweet('Stok barang kurang dari Qty');
          reset();
        }

      });
  });

  //copy paste
  function clone(){
    //paste
    $('#paste').prepend($('#copy').clone());
    

    //blank new input
    $('#copy').find('select').val('');
    $('#copy').find('.qty').val(0);
    $('#copy').find('.harga').val(0);
    $('#copy').find('.subtotal').val(0);
    $('#copy').find('.satuan').html('');
    $('#copy').find('.stok').val('');
  }

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

       var qty = $('#copy:nth-child('+i+') > td:nth-child(2) > div > input');
       var harga = $('#copy:nth-child('+i+') > td:nth-child(4) > input').val().replace(/,/g, '');
       var stok = $('#copy:nth-child('+i+') > td:nth-child(3) > div > input').val().replace(/,/g, '');

       var sub = '#copy:nth-child('+i+') > td:nth-child(5) > input';  
       var subtotal = parseInt(qty.val()) * parseInt(harga);
       num_qty += parseInt($(this).val());

       //subtotal
       $(sub).val(number_format(subtotal));

       //cek stok billet
       var billet = $('#qty_billet');
       if (parseInt(billet.val().replace(/,/g, '')) > parseInt($('#stok_billet').text())) {
          
          alert_sweet('Stok billet kurang dari Qty');
          billet.val(0);
       }

    });

    //qty barang
    $('#qty_barang').val(number_format(num_qty));

    //hpp billet
    // var hpp_billet = Math.round(<?=@$billet['billet_hpp']?> * parseInt($('#qty_billet').val()));
    // $('#hpp_billet').val(number_format(hpp_billet));

    //total akhir
    var num_total = 0;
    $.each($('.subtotal'), function(index, val) {
        
      num_total += parseInt($(this).val().replace(/,/g, ''));
    });

    //total akhir
    var jasa = parseInt($('#jasa').val());
    var total = parseInt(num_total) + hpp_billet + jasa;
    $('#total_akhir').val(number_format(total));

    <?php if ($url == 'proses'): ?>

      //hpp
      var hpp = parseInt($('#total_akhir').val().replace(/,/g, '')) / parseInt($('#produk').val().replace(/,/g, ''));

      $('#hpp').val(hpp); 

    <?php endif ?>   

    setTimeout(function() {
        auto();
    }, 100);
  }

  auto();

</script>
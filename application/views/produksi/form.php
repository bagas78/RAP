<style type="text/css">
  .mb-7{
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
            <div class="col-md-12 mb-7">
              <label>Nomor Produksi</label>
              <input type="text" name="nomor" class="form-control" required id="nomor">
            </div>
            <div class="col-md-12 mb-7">
              <label>Tanggal Produksi</label>
              <input type="date" name="tanggal" class="form-control" required id="tanggal">
            </div>
            <div class="col-md-12 mb-7">
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
            <div class="col-md-12 mb-7">
              <label>Keterangan</label>
              <textarea name="keterangan" class="form-control" style="height: 110px;" id="keterangan"></textarea>
            </div>
          </div>
          <div class="col-md-2">
            <div class="col-md-12 mb-7">

              <label>Sebelum Produksi</label>
              <img id="previewImg1" onclick="clickFile(1)" style="width: 100%;">
              <input style="visibility: hidden;" id="file1" type="file" name="lampiran[]" onchange="previewFile(this,1)">
          
            </div>
          </div>
          <div class="col-md-2">
            <div class="col-md-12 mb-7">

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
              <th width="200">Bahan</th>
              <th>Qty</th>
              <th>Stok</th>
              <th>Harga</th>
              <th>Subtotal</th>
              <th><button type="button" onclick="clone()" class="btn btn-success btn-sm">+</button></th>
            </tr>
          </thead>
          <tbody id="paste">

             <tr id="copy">
              <td>
                <select required id="barang" class="barang form-control" name="barang[]">
                  <option value="" hidden>-- Pilih --</option>
                  <?php foreach ($bahan_data as $b): ?>
                    <option value="<?=@$b['bahan_id']?>"><?=@$b['bahan_nama']?></option>
                  <?php endforeach ?>
                </select>
              </td>
              <td>
                <div class="input-group">
                  <input type="number" name="qty[]" class="qty form-control" value="1" min="1">
                  <span class="satuan input-group-addon"></span>
                </div>
              </td>
              <td>
                <div class="input-group">
                  <input readonly="" type="text" name="stok[]" class="stok form-control" required>
                  <span class="satuan input-group-addon"></span>
                </div>
              </td>
              <td><input readonly="" type="text" name="harga[]" class="harga form-control" required value="0" min="0"></td>
              <td><input readonly="" type="text" name="subtotal[]" class="subtotal form-control" required value="0" min="0"></td>
              <td><button type="button" onclick="$(this).closest('tr').remove()" class="btn btn-danger btn-sm">-</button></td>
            </tr>

            <tr>
              <td colspan="3"></td>
              <td align="right">Qty Barang</td>
              <td><input id="qty_barang" readonly="" type="text" name="qty_barang" class="form-control"></td>
            </tr>

            <tr>
              <td colspan="3"></td>
              <td align="right">Qty Billet</td>
              <td>
                <div class="input-group">
                  <input required id="qty_billet" type="number" name="qty_billet" class="form-control" value="0" min="0">
                  <span id="stok_billet" class="input-group-addon"><?=number_format($billet['billet_stok'])?></span>
                </div>
              </td>
            </tr>

            <tr>
              <td colspan="3"></td>
              <td align="right">HPP Billet</td>
              <td>
                <input value="0" id="hpp_billet" readonly="" type="text" name="hpp_billet" class="form-control">
              </td>
            </tr>

            <tr hidden>
              <td colspan="3"></td>
              <td align="right">Biaya Jasa</td>
              <td>
                <div class="input-group">
                  <input id="jasa" type="number" name="jasa" class="form-control" value="0" min="0">
                  <span class="input-group-addon">Rp &#160;</span>
                </div>
              </td>
            </tr>

            <tr hidden>
              <td colspan="3"></td>
              <td align="right">Produk ( 1/2 ) Jadi</td>
              <td>
                <div class="input-group">
                  <input id="produk" type="number" name="produk" class="form-control" value="" min="0">
                  <span class="input-group-addon">Pcs</span>
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
              <td align="right">HPP Produksi</td>
              <td><input id="hpp" readonly="" type="text" name="hpp" class="form-control" value="0" min="0"></td>
            </tr>

            <tr>
              <td colspan="5" align="right">
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

// hidden menu proses produksi
$('#jasa').closest('tr').removeAttr('hidden', true);
$('#produk').closest('tr').removeAttr('hidden', true);
$('#produk').attr("required", true);

<?php endif ?>

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
        
        //stok
        if ($(location).attr('href').split("/").splice(5, 1).join("/") != '<?=@$url.'_edit'?>') {
          $('#copy:nth-child('+i+') > td:nth-child(3) > div > input').val(number_format(val['bahan_stok']));
        }

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

        if ($.inArray(id, arr) != -1) {
          alert_sweet('Bahan avalan sudah ada');
          $('#copy:nth-child('+i+') > td:nth-child(1) > select').val('').change();
          $('#copy:nth-child('+i+') > td:nth-child(3) > div > input').val('');
          $('#copy:nth-child('+i+') > td:nth-child(4) > input').val(0);
        }
        ////// end exist barang ///////////

      });
  });

  //copy paste
  function clone(){
    //paste
    // var clone = $('#copy').clone();
    // clone.find("span.select2 ").remove();
    // clone.find("select").select2({ placeholder: "-- Pilih --" });
    // clone.find("span.select2 ").css('width', '100%');
    // $("#paste").prepend(clone);

    //paste
    $('#paste').prepend($('#copy').clone());
    

    //blank new input
    $('#copy').find('select').val('');
    $('#copy').find('.qty').val(1);
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

       //cek stok
       if (parseInt(qty.val()) > parseInt(stok)) {
          
          alert_sweet('Stok barang kurang dari Qty');
          qty.val(1);
       }

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
    var hpp_billet = Math.round(<?=@$billet['billet_hpp']?> * parseInt($('#qty_billet').val()));
    $('#hpp_billet').val(number_format(hpp_billet));

    //total akhir
    var num_total = 0;
    $.each($('.subtotal'), function(index, val) {
        
      num_total += parseInt($(this).val().replace(/,/g, ''));
    });

    //total akhir
    var jasa = parseInt($('#jasa').val());
    var total = parseInt(num_total) + hpp_billet + jasa;
    $('#total_akhir').val(number_format(total));

    //hpp
    var hpp = Math.round(total / (parseInt($('#qty_barang').val().replace(/,/g, '')) + parseInt($('#qty_billet').val().replace(/,/g, ''))));
    $('#hpp').val(hpp);    

    setTimeout(function() {
        auto();
    }, 100);
  }

  auto();

</script>
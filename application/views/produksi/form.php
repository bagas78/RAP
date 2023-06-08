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
            <div class="pekerja form-group">
              <label>Pekerja</label>
                <select required name="pekerja[]" id="pekerja" class="form-control select2" multiple="multiple" data-placeholder="-- Pilih --"style="width: 100%;">
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
              <th width="300">Matras</th>
              <th width="300">Produk</th>
              <th width="300">Berat</th>              
              <th width="300">Qty</th>
              <th width="300">Subtotal</th>
              <th hidden width="150">ID</th>
              <th hidden width="150">Delete</th>
              <th><button type="button" onclick="clone()" class="add btn btn-success btn-sm">+</button></th>
            </tr>
          </thead>
          <tbody id="paste">

             <tr id="copy">
              <td>
                <input min="0" type="number" name="matras[]" class="matras form-control" value="0" required step='0.01'>
              </td>
              <td>
                <select required id="produk" class="produk form-control" name="produk[]">
                  <option value="" hidden>-- Pilih --</option>
                  <?php foreach ($produk_data as $p): ?>
                    <option value="<?=@$p['produk_id']?>"><?=@$p['produk_nama']?></option>
                  <?php endforeach ?>
                </select>
              </td>

              <td>
                <div class="input-group">
                  <input min="0" type="number" name="berat[]" class="berat form-control" value="0" required step="0.01">
                  <span class="input-group-addon">Kg</span>
                </div>
              </td>

              <td>
                <div class="input-group">
                  <input type="number" name="qty[]" class="qty form-control" required value="0" min="0">
                  <span class="satuan input-group-addon"></span>
                </div>
              </td>

              <td>
                <div class="input-group">
                  <input readonly min="0" type="text" name="subtotal[]" class="subtotal form-control" value="0" required>
                  <span class="input-group-addon">Kg</span>
                </div>
              </td>

              <!--hidden-->
              <td hidden>
                <input type="text" name="id[]" class="id form-control" value="0" style="width: 100px;">
              </td>
              <td hidden>
                <input type="text" name="delete[]" class="delete form-control" value="0" style="width: 100px;">
              </td>
              
              <td><button type="button" class="remove btn btn-danger btn-sm">-</button></td>
            </tr>

            <tr>
              <td colspan="3"></td>
              <td align="right">Total Produksi</td>
              <td>
                <div class="input-group">
                  <input readonly required id="total_produksi" type="number" name="total_produksi" class="form-control" value="0" min="0">
                  <span class="input-group-addon">Kg</span>
                </div>
              </td>
            </tr>

            <tr hidden>
              <td colspan="3"></td>
              <td align="right">Qty Produk</td>
              <td><input id="qty_produk" readonly="" type="text" name="qty_produk" class="form-control"></td>
            </tr>

            <tr hidden>
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
                  <span class="input-group-addon"><span id="stok_billet" hidden><?=number_format($billet_data['billet_stok'])?></span>Kg</span>
                </div>
              </td>
            </tr>

            <tr>
              <td colspan="3"></td>
              <td align="right">Biaya Jasa</td>
              <td>
                <div class="input-group">
                  <input id="jasa" type="number" name="jasa" class="form-control" value="0" min="0">
                  <span class="input-group-addon">Rp</span>
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
                  <span class="input-group-addon">Kg;</span>
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

//view UI
<?php if(@$view == 1):?>
  $('.back').removeAttr('hidden');
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

  $(document).on('change', '.produk', function() {

    var id = $(this).val();
    var index = $(this).closest('tr').index();
    var arr = new Array(); 
    var berat = $(this).closest('tr').find('.berat');
    var satuan = $(this).closest('tr').find('.satuan');

   /////// cek exist barang ///////////
    $.each($('.produk'), function(idx, val) {
        
        if (index != idx)
        arr.push($(this).val());

    });

    if (id != '') {

      if ($.inArray(id, arr) != -1) {
        var i = index + 1;

        alert_sweet('Produk sudah ada');

        //empty
        $(this).val('').change();
        berat.val(0);
        satuan.text('');
        
      }else{

        $.get('<?= base_url('produksi/proses_get_produk/') ?>'+id, function(data) {
      
          var val = JSON.parse(data);
          satuan.text(val.satuan_singkatan);

        });

      }
      ////// end exist barang ///////////
    }

  });

  //copy paste
  function clone(){
    //paste
    $('#paste').prepend($('#copy').clone());
    
    //blank new input
    $('#copy').find('select').val('');
    $('#copy').find('.qty').val(0);
    $('#copy').find('.id').val(0);
    $('#copy').find('.berat').val(0);

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
    
    //sum qty
    var sum_qty = 0;
    var sum_produksi = 0;
    $.each($('.qty'), function(index, val) {
       var i = index+1;
       var berat = Number($(this).closest('tr').find('.berat').val(), 10);
       var qty = Number($(this).val());
       var total = qty * berat;

       sum_qty += qty;
       sum_produksi += total;

       //subtotal
       $(this).closest('tr').find('.subtotal').val(total);

    });

    //sum total produksi
    $('#total_produksi').val(sum_produksi);

    //sum qty produk
    $('#qty_produk').val(sum_qty);

    //cek stok billet
    var billet = $('#qty_billet');
    var stok_billet = Number($('#stok_billet').text());
    if (Number(billet.val().replace(/,/g, '')) > stok_billet) {
        
      alert_sweet('Stok billet kurang');
      billet.val(0);
    }

    //total akhir
    var hps_billet = Number($('#hps_billet').val().replace(/,/g, ''));
    var qty_billet = Number(billet.val()) * hps_billet;
    var jasa = Number($('#jasa').val());
    var total = qty_billet + jasa;
    $('#total_akhir').val(number_format(total));

    //border none
    $('td').css('border-top', 'none');

    setTimeout(function() {
        auto();
    }, 100);
  }

  auto();

</script>
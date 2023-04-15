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
          <input id="po" type="text" class="form-control" placeholder="-- Tarik transaksi PO --">
        </div>
        <div class="col-md-1 col-xs-1">
          <button id="po_get" type="button" class="btn btn-primary"><i class="fa fa-search"></i></button>
        </div>
      </div>

    </div>
    <div class="box-body">

      <form method="post" enctype="multipart/form-data" class="bg-alice">

        <div class="row" style="margin-left: -8px;">
          <div class="col-md-3">
            <div class="form-group">
              <label>Nomor Peleburan</label>
              <input type="text" name="nomor" class="form-control" required id="nomor">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Tanggal Peleburan</label>
              <input type="date" name="tanggal" class="form-control" required id="tanggal">
            </div>
          </div>
        </div>

        <table class="table table-responsive table-borderless">
          <thead>
            <tr>
              <th width="200">Bahan</th>
              <th>Qty</th>
              <th>Stok</th>
              <th>Harga</th>
              <th>Subtotal</th>
              <th><button type="button" onclick="clone()" class="add btn btn-success btn-sm">+</button></th>
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
              <td>
                <div class="input-group">
                  <input readonly="" type="text" name="stok[]" class="stok form-control" required>
                  <span class="satuan input-group-addon"></span>
                </div>
              </td>
              <td><input readonly="" type="text" name="harga[]" class="harga form-control" required value="0" min="0"></td>
              <td><input readonly="" type="text" name="subtotal[]" class="subtotal form-control" required value="0" min="0"></td>
              <td><button type="button" onclick="$(this).closest('tr').remove()" class="remove btn btn-danger btn-sm">-</button></td>
            </tr>

            <tr>
              <td colspan="3"></td>
              <td align="right">Qty Akhir</td>
              <td>
                <input id="qty_akhir" readonly="" type="text" name="qty_akhir" class="form-control">
              </td>
            </tr>

            <tr>
              <td colspan="3"></td>
              <td align="right">Biaya Jasa</td>
              <td>
                <div class="input-group">
                  <input type="number" name="jasa" class="form-control" id="jasa" value="0" min="0">
                  <span class="input-group-addon">Rp &#160;</span>
                </div>
              </td>
            </tr>

            <tr>
              <td colspan="3"></td>
              <td align="right">Total Biaya</td>
              <td><input id="total" readonly="" type="text" name="total" class="form-control" value="0" min="0"></td>
            </tr>

            <tr>
              <td colspan="3"></td>
              <td align="right">Billet Sisa</td>
              <td>
                <div class="input-group">
                  <input value="0" min="0" required type="number" name="sisa" class="form-control" id="sisa">
                  <span class="input-group-addon" id="stok_sisa">0</span>
                </div>
              </td>
            </tr>

            <tr>
              <td colspan="3"></td>
              <td align="right">Hasil Billet</td>
              <td>
                <div class="input-group">
                  <input required type="number" name="billet" class="form-control" id="billet">
                  <span class="input-group-addon">Kg</span>
                </div>
              </td>
            </tr>

            <tr class="save">
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

//view UI
<?php if(@$view == 1):?>
  $('.add').remove();
  $('.remove').remove();
  $('.save').remove();
  $('.form-group, td').css('pointer-events', 'none');
<?php endif?>

//atribut
$('form').attr('action', '<?=base_url('produksi/'.@$url)?>');
$('#nomor').val('<?=@$nomor?>');
$('#tanggal').val('<?=date('Y-m-d')?>');

if ('<?=@$this->uri->segment(2)?>' == 'peleburan_add') {
  $('#stok_sisa').text('<?=@$sisa_data?>');
}

  //get barang
  $(document).on('change', '#barang', function() {
      var id = $(this).val();
      var index = $(this).closest('tr').index();
      $.get('<?=base_url('pembelian/get_barang/')?>'+id, function(data) {
        var val = JSON.parse(data);
        var i = (index + 1);
        
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
    $('#paste').prepend($('#copy').clone());

    //blank new input
    $('#copy').find('select').val('');
    $('#copy').find('.qty').val(1);
    $('#copy').find('.harga').val(0);
    $('#copy').find('.subtotal').val(0);
    $('#copy').find('.stok').val('');
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
          qty.val(0);
       }

    });

    //qty akhir
    $('#qty_akhir').val(number_format(num_qty));

    //total akhir
    var num_total = 0;
    $.each($('.subtotal'), function(index, val) {
        
      num_total += parseInt($(this).val().replace(/,/g, ''));
    });

    //total akhir
    var total = parseInt(num_total) + parseInt($('#jasa').val());
    $('#total').val(number_format(total));

    //cek sisa
    var sisa = $('#sisa');
    if (sisa.val() > parseInt($('#stok_sisa').text())) {
      alert_sweet('Stok billet sisa kurang dari jumlah');
      sisa.val(0);
    }

    setTimeout(function() {
        auto();
    }, 100);
  }

  auto();

</script>
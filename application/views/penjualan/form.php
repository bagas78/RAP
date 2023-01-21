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
              <label>Nomor Transaksi</label>
              <input readonly="" type="text" name="nomor" class="form-control" required id="nomor">
            </div>
            <div class="col-md-12 mb-7">
              <label>Tanggal Transaksi</label>
              <input type="date" name="tanggal" class="form-control" required id="tanggal">
            </div>
            <div class="col-md-12 mb-7">
              <label>Pelanggan</label>
              <select name="pelanggan" class="form-control select2" required id="pelanggan">
                <option value="" hidden>-- Pilih --</option>
                <?php foreach ($kontak_data as $s): ?>
                  <option value="<?= $s['kontak_id']?>"><?= $s['kontak_nama']?></option>
                <?php endforeach ?>
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <div class="col-md-12 mb-7">
              <label>Jatuh Tempo</label>
              <input type="date" name="jatuh_tempo" class="form-control" required id="jatuh_tempo">
            </div>
            <div class="col-md-12 mb-7">
              <label>Status Pembayaran</label>
              <select name="status" class="form-control" required id="status">
                <option value="" hidden>-- Pilih --</option>
                <option value="l">Lunas</option>
                <option value="b">Belum Lunas</option>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="col-md-12 mb-7">
              <label>Keterangan</label>
              <textarea name="keterangan" class="form-control" style="height: 110px;" id="keterangan"></textarea>
            </div>
          </div>
          <div class="col-md-2">
            <div class="col-md-12 mb-7">

              <label>Lampiran Photo</label>
              <img id="previewImg" onclick="clickFile()" style="width: 100%;">
              <input style="visibility: hidden;" id="file" type="file" name="lampiran" onchange="previewFile(this)">
          
            </div>
          </div>
        </div>

        <div class="clearfix"></div>

        <table class="table table-responsive table-borderless">
          <thead>
            <tr>
              <th width="200">Produk</th>
              <th>Qty</th>
              <th>Stok</th>
              <th>Potongan ( % )</th>
              <th>Harga</th>
              <th>Subtotal</th>
              <th><button type="button" onclick="clone()" class="btn btn-success btn-sm">+</button></th>
            </tr>
          </thead>
          <tbody id="paste">

             <tr id="copy">
              <td>
                <select required id="produk" class="produk form-control" name="barang[]">
                  <option value="" hidden>-- Pilih --</option>
                  <?php foreach ($produk_data as $b): ?>
                    <option value="<?=@$b['master_produk_id']?>"><?=@$b['master_produk_nama']?></option>
                  <?php endforeach ?>
                </select>
              </td>
              <td>
                <div class="input-group">
                  <input type="number" name="qty[]" class="qty form-control" value="0" min="1">
                  <span class="satuan input-group-addon"></span>
                </div>
              </td>
              <td>
                <div class="input-group">
                  <input type="text" name="stok[]" class="stok form-control" min="0" readonly="">
                  <span class="satuan input-group-addon"></span>
                </div>
              </td>
              <td><input min="0" type="number" name="potongan[]" class="potongan form-control" value="0" required></td>
              <td><input readonly="" type="text" name="harga[]" class="harga form-control" required value="0" min="0"></td>
              <td><input readonly="" type="text" name="subtotal[]" class="subtotal form-control" required value="0" min="0"></td>
              <td><button type="button" onclick="$(this).closest('tr').remove()" class="btn btn-danger btn-sm">-</button></td>
            </tr>

            <tr>
              <td colspan="4"></td>
              <td align="right">Qty Akhir</td>
              <td><input id="qty_akhir" readonly="" type="text" name="qty_akhir" class="form-control"></td>
            </tr>

            <tr>
              <td colspan="4"></td>
              <td align="right">PPN ( % )</td>
              <td>
                <input readonly="" id="ppn" type="text" name="ppn" class="form-control" value="<?=$ppn['pajak_persen']?>">
              </td>
              <td><input class="check" type="checkbox" checked="" style="-webkit-transform: scale(1.5);margin-top: 10px;"></td>
            </tr>

            <tr>
              <td colspan="4"></td>
              <td align="right">Total Akhir</td>
              <td><input id="total" readonly="" type="text" name="total" class="form-control" value="0" min="0"></td>
            </tr>

            <tr>
              <td colspan="6" align="right">
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

//atribut
$('form').attr('action', '<?=base_url('penjualan/'.@$url.'_save')?>');
$('#nomor').val('<?=@$nomor?>');
$('#tanggal').val('<?=date('Y-m-d')?>');
$('#previewImg').attr('src', '<?=base_url('assets/gambar/camera.png')?>');

  //get barang
  $(document).on('change', '#produk', function() {
      var id = $(this).val();
      var index = $(this).closest('tr').index();
      $.get('<?=base_url('penjualan/get_produk/')?>'+id, function(data) {
        var val = JSON.parse(data);
        var i = (index + 1);
        
        //qty
        var qty = $('#copy:nth-child('+i+') > td:nth-child(2) > div > input').val(0);

        //stok
        $('#copy:nth-child('+i+') > td:nth-child(3) > div > input').val(number_format(val['master_produk_stok']));

        //satuan
        var satuan = $('.satuan');
        $(satuan).empty().html(val['satuan_singkatan']);

        //harga
        $('#copy:nth-child('+i+') > td:nth-child(5) > input').val(number_format(val['master_produk_harga']));

        /////// cek exist barang ///////////
        var arr = new Array(); 
        $.each($('.produk'), function(idx, val) {
            
            if (index != idx)
            arr.push($(this).val());

        });

        if ($.inArray(id, arr) != -1) {

          alert_sweet('Bahan avalan sudah ada');
          
          $('#copy:nth-child('+i+') > td:nth-child(1) > select').val('').change();
          $('#copy:nth-child('+i+') > td:nth-child(3) > div > input').val('');
          $('#copy:nth-child('+i+') > td:nth-child(4) > input').val(0);
          $('#copy:nth-child('+i+') > td:nth-child(5) > input').val(0);
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
    $('#copy').find('.potongan').val(0);
    $('#copy').find('.qty').val(0);
    $('#copy').find('.harga').val(0);
    $('#copy').find('.subtotal').val(0);
    $('#copy').find('.satuan').html('');
  }

  //foto preview
  function clickFile(){
    $('#file').click();
  }
  function previewFile(input){
      var file = $("#file").get(0).files[0];

      if(file){
          var reader = new FileReader();

          reader.onload = function(){
              $("#previewImg").attr("src", reader.result);
          }

          reader.readAsDataURL(file);
      }
  }

  function auto(){

    //border none
    $('td').css('border-top', 'none');
    
    var num_qty = 0;
    $.each($('.qty'), function(index, val) {
       var i = index+1;

       var qty = $('#copy:nth-child('+i+') > td:nth-child(2) > div > input');
       var stok = $('#copy:nth-child('+i+') > td:nth-child(3) > div > input').val().replace(/,/g, '');
       var harga = $('#copy:nth-child('+i+') > td:nth-child(5) > input').val().replace(/,/g, '');
       var diskon = $('#copy:nth-child('+i+') > td:nth-child(4) > input').val();

       var sub = '#copy:nth-child('+i+') > td:nth-child(6) > input';
       var potongan = (parseInt(diskon) * parseInt(harga) / 100);  
       var subtotal = parseInt(qty.val()) * parseInt(harga) - potongan;
       num_qty += parseInt($(this).val());

       //subtotal
       $(sub).val(number_format(subtotal));

       //cek stok
       if (parseInt(qty.val()) > parseInt(stok)) {
          
          alert_sweet('Stok produk kurang dari Qty');
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
    var ppn = (parseInt($('#ppn').val()) * parseInt(num_total) / 100);
    var total = ppn + num_total;
    $('#total').val(number_format(total));

    setTimeout(function() {
        auto();
    }, 100);
  }

  auto();

  //ppn
  $(document).on('change', '.check', function() {
      
      if(this.checked) {
        //on    
        $('#ppn').val('<?=$ppn['pajak_persen']?>');
      }else{
        //off
        $('#ppn').val(0);
      }

  });

</script>
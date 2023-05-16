<style type="text/css">
  .mb-7{
    margin-bottom: 7%;
  }
  .readonly{
    /*pointer-events: none;*/
    background: #EEEEEE;
  }
  .readonly::-webkit-outer-spin-button,
  .readonly::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
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
 
      <div id="search" align="left">
        <div class="col-md-3 col-xs-11 row" style="margin-bottom: 0;">
          <input id="po" type="text" class="form-control" placeholder="PO-xxxxx">
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
              <label>Nomor Transaksi</label>
              <input readonly="" type="text" name="nomor" class="form-control" required id="nomor">
            </div>
            <div class="form-group">
              <label>Tanggal Transaksi</label>
              <input type="date" name="tanggal" class="form-control" required id="tanggal">
            </div>
            <div class="form-group">
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
            <div class="form-group">
              <label>Jatuh Tempo</label>
              <input type="date" name="jatuh_tempo" class="form-control" required id="jatuh_tempo">
            </div>
            <div class="form-group">
              <label>Pembayaran</label>
              <select name="pembayaran" class="form-control select2" required id="pembayaran">
                <option value="" hidden>-- Pilih --</option>
                <option value="tunai" hidden>Tunai</option>
                <?php foreach ($rekening_data as $r): ?>
                  <option value="<?= $r['rekening_id']?>"><?= $r['rekening_nama']?></option>
                <?php endforeach ?>
              </select>
            </div>
            <div class="form-group">
              <label>Status Pembayaran</label>
              <select name="status" class="form-control" required id="status">
                <option value="" hidden>-- Pilih --</option>
                <option value="lunas">Lunas</option>
                <option value="belum">Belum Lunas</option>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Keterangan</label>
              <textarea name="keterangan" class="form-control" style="height: 100px;" id="keterangan"></textarea>

              <!-- hidden pesanan nomor-->
              <input type="hidden" name="pesanan" id="pesanan" value="0">

            </div>

          </div>
          <div class="col-md-2">
            <div class="form-group">

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
              <th><button type="button" onclick="clone()" class="add btn btn-success btn-sm">+</button></th>
            </tr>
          </thead>
          <tbody id="paste">

             <tr id="copy">
              <td>
                <select required id="produk" class="produk form-control" name="barang[]">
                  <option value="" hidden>-- Pilih --</option>
                  <?php foreach ($produk_data as $b): ?>
                    <option value="<?=@$b['produk_id']?>"><?=@$b['produk_nama']?></option>
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
                  <input type="text" name="stok[]" class="stok form-control" min="0" readonly="" value="0">
                  <span class="satuan input-group-addon"></span>
                </div>
              </td>
              <td><input min="0" type="number" name="potongan[]" class="potongan form-control" value="0" required></td>
              <td><input type="text" name="harga[]" class="harga form-control readonly" value="0" min="1"></td>
              <td><input type="text" name="subtotal[]" class="subtotal form-control readonly" value="0" min="1"></td>

              <!--hidden-->
              <td hidden><input readonly="" type="text" name="hps[]" class="hps form-control" value="0"></td>
              <td hidden><input readonly="" type="text" name="jenis[]" class="jenis form-control"></td>
              <td hidden><input readonly="" type="text" name="warna[]" class="warna form-control"></td>

              <td><button type="button" onclick="$(this).closest('tr').remove()" class="remove btn btn-danger btn-sm">-</button></td>
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

            <tr class="save">
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

<div class="modal fade" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
          <div class="box-body">

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Nama Produk</label>
                  <select class="form-control id-produk" required>
                    <option value="" hidden>-- Pilih --</option>
                    <?php foreach ($produk_data as $p): ?>
                      <option value="<?=@$p['produk_id']?>"><?=@$p['produk_nama']?></option>
                    <?php endforeach ?>
                  </select>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Jenis</label>
                  <select class="form-control jenis-produk" required>
                    <option value="" hidden>-- Pilih --</option>
                    <?php foreach ($jenis_data as $j): ?>
                      <option value="<?=@$j['warna_jenis_id']?>"><?=@$j['warna_jenis_type']?></option>
                    <?php endforeach ?>
                  </select>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Warna</label>
                  <select class="form-control warna-produk" required>
                    <option value="" hidden>-- Pilih --</option>
                    <?php foreach ($warna_data as $w): ?>
                      <option hidden class="warna_<?=@$w['warna_jenis']?>" value="<?=@$w['warna_id']?>"><?=@$w['warna_nama']?></option>
                    <?php endforeach ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Stok</label>
                  <input min="1" value="0" type="number" class="stok-produk form-control" min="0" readonly="">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Harga</label>
                  <input min="1" value="0" type="number" class="harga-produk form-control" min="0" readonly="">

                  <!--hidden-->
                  <div hidden>
                  <input value="" type="text" class="index-produk form-control" readonly="">
                  <input value="" type="text" class="satuan-produk form-control" readonly="">
                  <input value="" type="text" class="hps-produk form-control" readonly="">
                  </div>

                </div>
              </div>
            </div>
          </div>
          <!-- /.box-body -->

          <div class="box-footer" style="background: aliceblue;">
            <button type="button" class="btn-produk btn btn-primary">Submit <i class="fa fa-check"></i></button>
             <button data-dismiss="modal" type="button" class="btn btn-danger">Close <i class="fa fa-times"></i></button>
          </div>
       </div>
      </div>
      <!-- /.modal-content -->
   </div>
    <!-- /.modal-dialog -->
  </div>
<!-- /.modal -->

<script type="text/javascript">

//PO
<?php if(@$url == 'po'):?>
  $('#search').attr('hidden', true);
<?php endif?>

//view UI
<?php if(@$view == 1):?>
  $('.back').removeAttr('hidden');
  $('#search').attr('hidden', true);
  $('.add').remove();
  $('.remove').remove();
  $('.save').remove();
  $('.form-group, td').css('pointer-events', 'none');
<?php endif?>

//atribut
$('form').attr('action', '<?=base_url('penjualan/'.@$url.'_save')?>');
$('#nomor').val('<?=@$nomor?>');
$('#tanggal').val('<?=date('Y-m-d')?>');
$('#previewImg').attr('src', '<?=base_url('assets/gambar/camera.png')?>');

  //get barang
  $(document).on('change', '#produk', function() {
      var id = $(this).val();
      var text = $(this).text();
      var index = $(this).closest('tr').index();

      /////// cek exist barang ///////////
      var arr = new Array(); 
      $.each($('.produk'), function(idx, val) {
          
          if (index != idx)
          arr.push($(this).val());

      });

      if (id != '') {

        if ($.inArray(id, arr) != -1) {
          var i = index + 1;

          alert_sweet('Produk sudah ada');
          
          $('#copy:nth-child('+i+') > td:nth-child(1) > select').val('').change();
          $('#copy:nth-child('+i+') > td:nth-child(2) > div > input').val(0);
          $('#copy:nth-child('+i+') > td:nth-child(3) > div > input').val('');
          $('#copy:nth-child('+i+') > td:nth-child(4) > input').val(0);
          $('#copy:nth-child('+i+') > td:nth-child(5) > input').val(0);
          $('#copy:nth-child('+i+') > td:nth-child(7) > input').val(0);
          
        }else{

          //empty
          $('.stok-produk').val(0);
          $('.jenis-produk').val('').change();
          $('.satuan-produk').val('');

          //index
          $('.index-produk').val(index);

          //produk
          $('.id-produk').val(id).change().attr('readonly',true).css('pointer-events','none');

          //modal
          $('.modal').modal('toggle');
        
        }
        ////// end exist barang ///////////
      }

  });

  $(document).on('change', '.jenis-produk', function() {
   
    var jenis = $('.jenis-produk').val();
    var warna = $('.warna-produk');

    //empty
    $('.stok-produk').val(0);
    $('.harga-produk').val(0);
    $('.satuan-produk').val('');
    $('.hps-produk').val('');

    //hapus readonly
    $('.warna-produk').val('').change().removeAttr('readonly').css('pointer-events', '');
    $('.warna-produk').attr('hidden',true);

    //class
    var cl = '.warna_'+jenis;

    switch (jenis) {
      case '1':
        //Anodizing
        $(cl).removeAttr('hidden');
        break;
      case '2':
        //Powder Coating
        $(cl).removeAttr('hidden');
        break;
      case '3':
        //MF
        $('.warna-produk').val(0).change().attr('readonly',true).css('pointer-events','none');
        break;
       
    }

    //jenis jual langsung
    // if (jenis == 3) {
    //   $('.warna-produk').val(0).change().attr('readonly',true).css('pointer-events','none');
    // }else{
    //   $('.warna-produk').val('').change().removeAttr('readonly').css('pointer-events', '');
    // }

  });

  $(document).on('change', '.warna-produk', function() {
    //produk get
    var id = $('.id-produk').val();
    var jenis = $('.jenis-produk').val();
    var warna = $('.warna-produk').val();

    //empty
    $('.stok-produk').val(0);
    $('.harga-produk').val(0);
    $('.satuan-produk').val('');

    $.get('<?=base_url('penjualan/get_produk/')?>'+id+'/'+jenis+'/'+warna, function(data) {
      
      var pro = JSON.parse(data);
      $('.stok-produk').val(pro['produk_barang_stok']);
      $('.harga-produk').val(pro['produk_barang_harga']);
      $('.satuan-produk').val(pro['satuan_singkatan']);
      $('.hps-produk').val(pro['produk_barang_hps']);

    });

  });

  $(document).on('click', '.btn-produk', function() {
    
    //modal produk
    var stok = $('.stok-produk');
    var jenis = $('.jenis-produk');
    var warna = $('.warna-produk');
    var harga = $('.harga-produk');
    var satuan = $('.satuan-produk');
    var hps = $('.hps-produk');
    var i = $('.index-produk').val() + 1;

    //form bawah
    var qty_ = $('#copy:nth-child('+i+') > td:nth-child(2) > div > input');
    var stok_ = $('#copy:nth-child('+i+') > td:nth-child(3) > div > input');
    var harga_ = $('#copy:nth-child('+i+') > td:nth-child(5) > input');
    var hps_ = $('#copy:nth-child('+i+') > td:nth-child(7) > input');
    var jenis_ = $('#copy:nth-child('+i+') > td:nth-child(8) > input');
    var warna_ = $('#copy:nth-child('+i+') > td:nth-child(9) > input');
    var satuan_ = $('.satuan');

    //modal
    qty_.val(0);
    stok_.val(stok.val());
    harga_.val(number_format(harga.val()));
    hps_.val(hps.val());
    jenis_.val(jenis.val());
    warna_.val(warna.val());
    satuan_.text(satuan.val());

    //modal close
    $('.modal').modal('toggle');

    // switch(true) {
    //   case stok.val() == 0:
    //     alert_sweet('stok produk kosong');
    //     break;
    //   case  harga.val() == 0:
    //     alert_sweet('harga masih 0');
    //     break;
    //   default:
 
        
    // }
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
    $('#copy').find('.hps').val(0);
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
       var potongan = (parseInt(diskon) / 100) * (parseInt(harga) * parseInt(qty.val()));
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
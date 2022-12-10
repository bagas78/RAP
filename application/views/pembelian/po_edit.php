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
    </div>
    <div class="box-body">

      <form action="<?=base_url('pembelian/po_update/'.@$data['pembelian_nomor'])?>" method="post" enctype="multipart/form-data" class="bg-alice">
        <div class="row">
          <div class="col-md-3">
            <div class="col-md-12 mb-7">
              <label>Nomor Transaksi</label>
              <input type="text" name="nomor" class="form-control" required value="<?=@$data['pembelian_nomor']?>">
            </div>
            <div class="col-md-12 mb-7">
              <label>Tanggal Transaksi</label>
              <input type="date" name="tanggal" class="form-control" required value="<?=@$data['pembelian_tanggal']?>">
            </div>
            <div class="col-md-12 mb-7">
              <label>Supplier</label>
              <select name="supplier" class="form-control select2" required id="supplier">
                <option value="" hidden>-- Pilih --</option>
                <?php foreach ($kontak_data as $s): ?>
                  <option value="<?= $s['kontak_id']?>"><?= $s['kontak_nama']?></option>
                <?php endforeach ?>
              </select>

              <script type="text/javascript">
                $('#supplier').val('<?=@$data['pembelian_supplier']?>').change();
              </script>

            </div>
          </div>
          <div class="col-md-3">
            <div class="col-md-12 mb-7">
              <label>Jatuh Tempo</label>
              <input type="date" name="jatuh_tempo" class="form-control" required value="<?=@$data['pembelian_jatuh_tempo']?>">
            </div>
            <div class="col-md-12 mb-7">
              <label>Status Pembayaran</label>
              <select name="status" class="form-control" required id="status">
                <option value="" hidden>-- Pilih --</option>
                <option value="l">Lunas</option>
                <option value="b">Belum Lunas</option>
              </select>

              <script type="text/javascript">
                $('#status').val('<?=@$data['pembelian_status']?>').change();
              </script>

            </div>
          </div>
          <div class="col-md-4">
            <div class="col-md-12 mb-7">
              <label>Keterangan</label>
              <textarea name="keterangan" class="form-control" style="height: 110px;"><?=@$data['pembelian_keterangan']?></textarea>
            </div>
          </div>
          <div class="col-md-2">
            <div class="col-md-12 mb-7">

              <label>Lampiran Photo</label>
              <img id="previewImg" onclick="clickFile()" style="width: 100%;" src="<?= (@$data['pembelian_lampiran'] != '')? base_url('assets/gambar/pembelian/po/'.@$data['pembelian_lampiran']) : base_url('assets/gambar/camera.png') ?>">
              <input style="visibility: hidden;" id="file" type="file" name="lampiran" onchange="previewFile(this)">
          
            </div>
          </div>
        </div>

        <div class="clearfix"></div>

        <table class="table table-responsive table-borderless">
          <thead>
            <tr>
              <th width="200">Nama Barang</th>
              <th>Qty</th>
              <th>Potongan ( % )</th>
              <th>Harga</th>
              <th>Subtotal</th>
              <th><button type="button" onclick="clone()" class="btn btn-success btn-sm">+</button></th>
            </tr>
          </thead>
          <tbody id="paste">

             <tr id="copy">
              <td>
                <select required id="barang" class="form-control" name="barang[]">
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
              <td><input min="0" type="number" name="potongan[]" class="potongan form-control" value="0" required></td>
              <td><input readonly="" type="text" name="harga[]" class="harga form-control" required value="0" min="0"></td>
              <td><input readonly="" type="text" name="subtotal[]" class="subtotal form-control" required value="0" min="0"></td>
              <td><button type="button" onclick="$(this).closest('tr').remove()" class="btn btn-danger btn-sm">-</button></td>
            </tr>

            <tr>
              <td colspan="3"></td>
              <td align="right">Qty Akhir</td>
              <td><input id="qty_akhir" readonly="" type="text" name="qty_akhir" class="form-control"></td>
            </tr>

            <tr>
              <td colspan="3"></td>
              <td align="right">PPN ( % )</td>
              <td>
                <input readonly="" id="ppn" type="text" name="ppn" class="form-control" value="<?=$ppn['pajak_persen']?>">
              </td>
              <td><input class="check" type="checkbox" checked="" style="-webkit-transform: scale(1.5);margin-top: 10px;"></td>
            </tr>

            <tr>
              <td colspan="3"></td>
              <td align="right">Total Akhir</td>
              <td><input id="total" readonly="" type="text" name="total" class="form-control" value="0" min="0"></td>
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

<script>;

  //get pembelian
  $.get('<?=base_url('pembelian/po_get_pembelian/'.$data['pembelian_nomor'])?>', function(data) {
    var json = JSON.parse(data);

    //clone
    for (var num = 1; num <= json.length - 1; num++) {
       clone();
    }

    $.each(json, function(index, val) {
      
      var i = index+1;

      //insert value
      $('#copy:nth-child('+i+') > td:nth-child(1) > select').val(val.pembelian_barang_barang).change();
      $('#copy:nth-child('+i+') > td:nth-child(2) > div > input').val(val.pembelian_barang_qty);
      $('#copy:nth-child('+i+') > td:nth-child(3) > div > input').val(val.pembelian_barang_potongan);

      //ppn 0
      if (<?=@$data['pembelian_ppn']?> == 0) {
        $('.check').removeAttr('checked').change();
      }

    });

  });
  
  //get barang
  $(document).on('change', '#barang', function() {
      var id = $(this).val();
      var index = $(this).closest('tr').index();
      $.get('<?=base_url('pembelian/po_get_barang/')?>'+id, function(data) {
        var val = JSON.parse(data);
        var i = (index + 1);
        
        //harga
        $('#copy:nth-child('+i+') > td:nth-child(4) > input').val(number_format(val['bahan_harga']));

        //satuan
        var satuan = $('#copy:nth-child('+i+') > td:nth-child(2) > div > span');
        $(satuan).empty().html(val['satuan_singkatan']);

      });
  });

  //copy paste
  function clone(){
    //paste
    $('#paste').prepend($('#copy').clone());

    //blank new input
    $('#copy').find('select').val('');
    $('#copy').find('.potongan').val(0);
    $('#copy').find('.qty').val(1);
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

  //border none
  $('td').css('border-top', 'none');

  function auto(){
    
    var num_qty = 0;
    $.each($('.qty'), function(index, val) {
       var i = index+1;

       var qty = $('#copy:nth-child('+i+') > td:nth-child(2) > div > input').val();
       var harga = $('#copy:nth-child('+i+') > td:nth-child(4) > input').val().replace(/,/g, '');
       var diskon = $('#copy:nth-child('+i+') > td:nth-child(3) > input').val();

       var sub = '#copy:nth-child('+i+') > td:nth-child(5) > input';
       var potongan = (parseInt(diskon) * parseInt(harga) / 100);  
       var subtotal = parseInt(qty) * parseInt(harga) - potongan;
       num_qty += parseInt($(this).val());

       //subtotal
       $(sub).val(number_format(subtotal));

    });

    //qty akhir
    $('#qty_akhir').val(num_qty);

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
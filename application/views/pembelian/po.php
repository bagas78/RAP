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

      <form action="<?=base_url('pembelian/save')?>" method="post" enctype="multipart/form-data" class="bg-alice">
        <div class="row">
          <div class="col-md-3">
            <div class="col-md-12 mb-7">
              <label>Nomor Transaksi</label>
              <input type="text" name="nomor" class="form-control" required value="<?=@$nomor?>">
            </div>
            <div class="col-md-12 mb-7">
              <label>Tanggal Transaksi</label>
              <input type="date" name="tanggal" class="form-control" required value="<?= date('Y-m-d') ?>">
            </div>
            <div class="col-md-12 mb-7">
              <label>Supplier</label>
              <select name="supplier" class="form-control select2" required>
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
              <input type="date" name="jatuh_tempo" class="form-control" required>
            </div>
            <div class="col-md-12 mb-7">
              <label>Status Pembayaran</label>
              <select name="status" class="form-control" required>
                <option value="" hidden>-- Pilih --</option>
                <option value="l">Lunas</option>
                <option value="b">Belum Lunas</option>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="col-md-12 mb-7">
              <label>Keterangan</label>
              <textarea name="keterangan" class="form-control" style="height: 110px;"></textarea>
            </div>
          </div>
          <div class="col-md-2">
            <div class="col-md-12 mb-7">

              <label>Lampiran Photo</label>
              <img id="previewImg" onclick="clickFile()" style="width: 100%;" src="<?= base_url('assets/gambar/camera.png') ?>">
              <input style="visibility: hidden;" id="file" type="file" name="lampiran">
          
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
              <td><input min="1" type="number" name="qty[]" class="qty form-control" value="1" required></td>
              <td><input min="0" type="number" name="potongan[]" class="potongan form-control" value="0" required></td>
              <td><input readonly="" type="number" name="harga[]" class="harga form-control" required value="0" min="0"></td>
              <td><input readonly="" type="number" name="subtotal[]" class="subtotal form-control" required value="0" min="0"></td>
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
            </tr>

            <tr>
              <td colspan="3"></td>
              <td align="right">Total Akhir</td>
              <td><input id="total" readonly="" type="text" name="total" class="form-control" value="0" min="0"></td>
            </tr>

            <tr>
              <td colspan="3"></td>
              <td align="right">Bayar</td>
              <td><input type="text" name="bayar" class="form-control" min="0" required></td>
            </tr>

            <tr>
              <td colspan="5" align="right">
                <button type="submit" class="btn btn-primary">Simpan <i class="fa fa-check"></i></button>
                <button type="button" onclick="location.reload()" class="btn btn-danger">Reset <i class="fa fa-times"></i></button>
              </td>
            </tr>

          </tbody>
        </table>

      </form>

    </div>
  </div>
  <!-- /.box -->

<script>;
  
  //get barang
  $(document).on('change', '#barang', function() {
      var id = $(this).val();
      var index = $(this).closest('tr').index();
      $.get('<?=base_url('pembelian/get_barang/')?>'+id, function(data) {
        var val = JSON.parse(data);
        $('#copy:nth-child('+(index + 1)+') > td:nth-child(4) > input').val(val['bahan_harga']);
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
  }

  //foto preview
  function clickFile(){
    $('#file').click();
  }
  function previewFile(input){
      var file = $("#file]").get(0).files[0];

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
       var qty = $('#copy:nth-child('+i+') > td:nth-child(2) > input').val();
       var harga = $('#copy:nth-child('+i+') > td:nth-child(4) > input').val();
       var sub = '#copy:nth-child('+i+') > td:nth-child(5) > input';
       var diskon = $('#copy:nth-child('+i+') > td:nth-child(3) > input').val();
       var potongan = (parseInt(diskon) * parseInt(harga) / 100); 
       var subtotal = parseInt(qty) * parseInt(harga) - potongan;
       num_qty += parseInt($(this).val());

       //subtotal
       $(sub).val(subtotal);
    });

    //qty akhir
    $('#qty_akhir').val(num_qty);

    //total akhir
    var num_total = 0;
    $.each($('.subtotal'), function(index, val) {
        
      num_total += parseInt($(this).val());
    });

    //total akhir
    $('#total').val(num_total);

    setTimeout(function() {
        auto();
    }, 100);
  }

  auto();

</script>
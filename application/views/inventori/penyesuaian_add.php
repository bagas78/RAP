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

        <div class="row" style="margin-left: -8px;">
          <div class="col-md-6">
            <div class="form-group">
              <label>Nomor</label>
              <input type="text" name="nomor" class="form-control" required id="nomor" readonly>
            </div>
            <div class="form-group">
              <label>Jenis</label>
              <select readonly style="pointer-events: none;" id="jenis" class="form-control" name="jenis" required>
                <option value="" hidden>-- Pilih --</option>
                <option value="pembelian">Pembelian</option>
                <option value="penjualan">Penjualan</option>
              </select>
            </div>
            <div class="form-group">
              <label>Transaksi</label>
              <select id="transaksi" class="form-control" name="transaksi" required>
                <option value="" hidden>-- Pilih --</option>
                <option value="perhitungan">Perhitungan</option>
                <option value="masuk">Masuk</option>
                <option value="keluar">Keluar</option>
              </select>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Kategori</label>
              <select id="kategori" class="form-control" name="kategori" required>
                <option value="" hidden>-- Pilih --</option>
                <option value="umum">Umum</option>
                <option value="rusak">Rusak</option>
              </select>
            </div>
            <div class="form-group">
              <label>Tanggal</label>
              <input id="tanggal" type="date" name="tanggal" class="form-control" required id="tanggal">
            </div>
            <div class="form-group">
              <label>Keterangan</label>
              <textarea class="form-control" name="keterangan" id="keterangan"></textarea>
            </div>
          </div>
        </div>

        <table class="table table-responsive table-borderless">
          <thead>
            <tr>
              <th width="180">Bahan / Produk</th>
              <th width="180" class="jenis_">Jenis</th>
              <th width="180" class="warna_">Warna</th>
              <th>Jumlah</th>
              <th>Stok</th>
              <th>Selisih</th>
              <th hidden>Status</th>
              <th><button type="button" onclick="clone()" class="add btn btn-success btn-sm">+</button></th>
            </tr>
          </thead>
          <tbody id="paste">

             <tr id="copy">
              <td>
                <select required id="barang" class="barang form-control" name="barang[]">
                  <option value="" hidden>-- Pilih --</option>
                  <?php foreach ($barang_data as $b): ?>
                    <option value="<?=@$b['id']?>"><?=@$b['nama']?></option>
                  <?php endforeach ?>
                </select>
              </td>
              <td class="jenis_">
                <select required id="barang_jenis" class="barang_jenis form-control" name="barang_jenis[]">
                  <option value="" hidden>-- Pilih --</option>
                  <?php foreach (@$jenis_data as $j): ?>
                    <option value="<?=@$j['warna_jenis_id']?>"><?=@$j['warna_jenis_type']?></option>
                  <?php endforeach ?>
                </select>
              <td class="warna_">
                <select required id="warna" class="warna form-control" name="warna[]">
                  <option value="" hidden>-- Pilih --</option>
                  <?php foreach (@$warna_data as $w): ?>
                    <option hidden class="<?='warna_'.@$w['warna_jenis']?>" value="<?=@$w['warna_id']?>"><?=@$w['warna_nama']?></option>
                  <?php endforeach ?>
                </select>
              </td>
              <td>
                <div class="input-group">
                  <input type="number" name="jumlah[]" class="jumlah form-control" required value="0" min="0">
                  <span class="satuan input-group-addon"></span>
                </div>
              </td>
              <td>
                <div class="input-group">
                  <input readonly type="number" name="stok[]" class="stok form-control" required value="0" min="0">
                  <span class="satuan input-group-addon"></span>
                </div>
              </td>
              <td>
                <div class="input-group">
                  <input readonly type="number" name="selisih[]" class="selisih form-control" required value="0" min="0">
                  <span class="satuan input-group-addon"></span>
                </div>
              </td>
              <td hidden>
                <select readonly style="pointer-events: none;" class="status form-control" name="status[]" required>
                  <option hidden value="">none</option>
                  <option value="bertambah">Bertambah</option>
                  <option value="berkurang">Berkurang</option>
                </select>
              </td>

              <td><button type="button" onclick="$(this).closest('tr').remove()" class="remove btn btn-danger btn-sm">-</button></td>
            </tr>

            <tr class="save">
              <td colspan="6" align="right">
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

//jenis
<?php if(@$jenis == 'pembelian'):?>
  $('.jenis_').remove();
  $('.warna_').remove();  
<?php endif?>

//atribut
$('form').attr('action', '<?=base_url('inventori/penyesuaian_save')?>');
$('#nomor').val('<?=@$nomor?>');
$('#jenis').val('<?=@$jenis?>').change();
$('#transaksi').val('<?=@$transaksi?>').change();
$('#kategori').val('<?=@$kategori?>').change();
$('#tanggal').val('<?=@$tanggal?>');

  //get barang
  $(document).on('change', '#barang', function() {

      //null
      $('#barang_jenis').val('').change();
      $('.stok').val(0);
      $('.selisih').val(0);
      
      var id = $(this).val();
      var index = $(this).closest('tr').index();
      var satuan = $(this).closest('tr').find('.satuan');
      var stok = $(this).closest('tr').find('.stok');
      var jumlah = $(this).closest('tr').find('.jumlah');
      var selisih = $(this).closest('tr').find('.selisih');
      var status = $(this).closest('tr').find('.status');
      var select = $(this).closest('tr').find('select');

      $.get('<?=base_url('inventori/penyesuaian_get/'.$jenis.'/')?>'+id, function(data) {
        var json = JSON.parse(data);
        var i = (index + 1);

        $.each(json, function(index, val) {
            
            <?php if(@$jenis == 'pembelian'):?>

              //stok pembelian
              $(stok).val(val.stok);
            <?php endif ?>
            
            $(satuan).html(val.satuan);

        });

        /////// cek exist barang ///////////
        var arr = new Array();
        $.each($('.barang'), function(idx, val) {
            
            if (index != idx)
            arr.push($(this).val());

        });

        if ($.inArray(id, arr) != -1) {
          alert_sweet('Bahan / Produk sudah ada');
          
          select.val('');
          jumlah.val(0);
          stok.val(0);
          selisih.val(0);
          satuan.text('');
        }
        ////// end exist barang ///////////

      });

  }); 

  //get jenis
  $(document).on('change', '#barang_jenis', function() {

    var id = $(this).val();
    var barang = $(this).closest('tr').find('.barang').val();

    //barang masih kosong
    if (barang == '') {
      $(this).val('');
      alert_sweet('Bahan / Produk belum di pilih');
    }

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

        //check stok MF
        var mf_val = $(this).closest('#copy').find('.mf_val');
        var mf_check = $(this).closest('#copy').find('.mf_check');

        if (mf_val.val() == 1) {
          mf_check.click();
          mf_check.css('pointer-events','none');
          mf_val.val(0);
        }

        break;
       
    }

  });

  //get warna
  $(document).on('change', '#warna', function() {

    var warna = $(this).val();
    var jenis = $(this).closest('tr').find('.barang_jenis').val();
    var barang = $(this).closest('tr').find('.barang').val();
    var stok = $(this).closest('tr').find('.stok');

    if (warna != '') {

      $.get('<?=base_url('inventori/penyesuaian_warna_get/')?>'+barang+'/'+jenis+'/'+warna, function(data) {

        var json = JSON.parse(data);
        
        if (json != null) {
          stok.val(json['stok']);
        }else{
          stok.val(0);
        }

      });
    }

  });

  //copy paste
  function clone(){
    //paste
    $('#paste').prepend($('#copy').clone());

    //blank new input
    $('#copy').find('select').val('');
    $('#copy').find('.jumlah').val(0);
    $('#copy').find('.stok').val(0);
    $('#copy').find('.selisih').val(0);
  }

  function auto(){

    //border none
    $('td').css('border-top', 'none');

    //selisih
    $.each($('.barang'), function(index, val) {
       
       var jumlah = $(this).closest('tr').find('.jumlah');
       var stok = $(this).closest('tr').find('.stok');
       var selisih = $(this).closest('tr').find('.selisih');
       var status = $(this).closest('tr').find('.status');

       var hasil = parseInt(stok.val()) - parseInt(jumlah.val());
       selisih.val(Math.abs(hasil));

       //status
       switch(true) {
          case hasil > 0 && jumlah.val() > 0:
            
            status.val('berkurang').change();
            break;
          case hasil < 0 && jumlah.val() > 0:
            
            status.val('bertambah').change();
            break;
          case jumlah.val() == 0:
            
            status.val('').change();
            break;
        }

    });    

    setTimeout(function() {
        auto();
    }, 100);
  }

  auto();

</script>
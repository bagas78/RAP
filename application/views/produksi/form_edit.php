<script>

  //atribut form
  $('form').attr('action', '<?=base_url('produksi/'.@$url.'_update/'.@$data['produksi_nomor'])?>');
  $('#nomor').val('<?=@$data['produksi_nomor']?>');
  $('#tanggal').val('<?=@$data['produksi_tanggal']?>');
  $('#shift').val('<?=@$data['produksi_shift']?>').change();
  $('#keterangan').val('<?=@$data['produksi_keterangan']?>');
  $('#mesin').val('<?=@$data['produksi_mesin']?>').change();

  if ('<?=@$data['produksi_lampiran_1']?>' != '') {
    $('#previewImg1').attr('src', '<?=base_url('assets/gambar/produksi/'.@$data['produksi_lampiran_1'])?>');
  }

  if ('<?=@$data['produksi_lampiran_2']?>' != '') {
    $('#previewImg2').attr('src', '<?=base_url('assets/gambar/produksi/'.@$data['produksi_lampiran_2'])?>');
  }

  //qty
  var stok_billet = parseInt($('#stok_billet').text()) + <?=@$data['produksi_billet_qty']?>;
  $('#stok_billet').text(stok_billet);
  $('#qty_billet').val('<?=@$data['produksi_billet_qty']?>');
  $('#jasa').val('<?=@$data['produksi_jasa']?>');
  $('#produk').val('<?=@$data['produksi_setengah_jadi']?>');

  //get produksi
  $.get('<?=base_url('produksi/get_produksi/'.$data['produksi_nomor'])?>', function(data) {
    var json = JSON.parse(data);

    //clone
    for (var num = 1; num <= json.length - 1; num++) {
     
      //paste
      clone();
      
      //blank new input
      $('#copy').find('select').val('');
      $('#copy').find('.qty').val(1);
      $('#copy').find('.harga').val(0);
      $('#copy').find('.subtotal').val(0);
      $('#copy').find('.satuan').html('');
      $('#copy').find('.stok').val('');

    }

    $.each(json, function(index, val) {
      
      var i = index+1;

      //insert value
      $('#copy:nth-child('+i+') > td:nth-child(1) > select').val(val.produksi_barang_barang);
      $('#copy:nth-child('+i+') > td:nth-child(2) > div > input').val(val.produksi_barang_qty);
      $('#copy:nth-child('+i+') > td:nth-child(4) > input').val(number_format(val.produksi_barang_harga));

      //kembalikan stok
      var re = parseInt(val.produksi_barang_qty) + parseInt(val.bahan_stok);
      $('#copy:nth-child('+i+') > td:nth-child(3) > div > input').val(re);

      //satuan
      var satuan = $('.satuan');
      $(satuan).empty().html(val.satuan_singkatan);

    });

  });

</script>
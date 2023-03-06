<script>

  //atribut form
  $('form').attr('action', '<?=base_url('penjualan/'.@$url.'_update/'.@$data['penjualan_nomor'])?>');
  $('#nomor').val('<?=@$data['penjualan_nomor']?>');
  $('#tanggal').val('<?=@$data['penjualan_tanggal']?>');
  $('#pelanggan').val('<?=@$data['penjualan_pelanggan']?>').change();
  $('#jatuh_tempo').val('<?=@$data['penjualan_jatuh_tempo']?>');
  $('#pembayaran').val('<?=@$data['penjualan_pembayaran']?>').change();
  $('#status').val('<?=@$data['penjualan_status']?>').change();
  $('#keterangan').val('<?=@$data['penjualan_keterangan']?>');

  if ('<?=@$data['penjualan_lampiran']?>' != '') { 
    $('#previewImg').attr('src', '<?=base_url('assets/gambar/penjualan/'.@$data['penjualan_lampiran'])?>');
  }

  //get penjualan
  $.get('<?=base_url('penjualan/get_penjualan/'.$data['penjualan_nomor'])?>', function(data) {
    var json = JSON.parse(data);

    //clone
    for (var num = 1; num <= json.length - 1; num++) {
      
      //paste 
      clone();

      //blank new input
      $('#copy').find('select').val('');
      $('#copy').find('.potongan').val(0);
      $('#copy').find('.qty').val(1);
      $('#copy').find('.harga').val(0);
      $('#copy').find('.subtotal').val(0);
      $('#copy').find('.satuan').html('');
    
    }

    $.each(json, function(index, val) {
      
      var i = index+1; 

      //insert value
      $('#copy:nth-child('+i+') > td:nth-child(1) > select').val(val.penjualan_barang_barang);
      $('#copy:nth-child('+i+') > td:nth-child(2) > div > input').val(val.penjualan_barang_qty); 

      //$('#copy:nth-child('+i+') > td:nth-child(3) > div > input').val(val.produk_barang_stok);
      $('#copy:nth-child('+i+') > td:nth-child(5) > input').val(number_format(val.produk_barang_harga));
      $('#copy:nth-child('+i+') > td:nth-child(7) > input').val(val.produk_barang_hps);

      $('#copy:nth-child('+i+') > td:nth-child(8) > input').val(val.penjualan_barang_jenis);
      $('#copy:nth-child('+i+') > td:nth-child(9) > input').val(val.penjualan_barang_warna);

      //kembalikan stok
      var re = parseInt(val.penjualan_barang_qty) + parseInt(val.produk_barang_stok);
      $('#copy:nth-child('+i+') > td:nth-child(3) > div > input').val(re);

      //satuan
      var satuan = $('.satuan');
      $(satuan).empty().html(val.satuan_singkatan);

      //ppn 0
      if (<?=@$data['penjualan_ppn']?> == 0) {
        $('.check').removeAttr('checked').change();
      }

    });

  });

</script>
<script>

  //atribut form
  $('form').attr('action', '<?=base_url('pembelian/umum_update/'.@$data['pembelian_umum_nomor'])?>');
  $('#nomor').val('<?=@$data['pembelian_umum_nomor']?>');
  $('#tanggal').val('<?=@$data['pembelian_umum_tanggal']?>');
  $('#pembayaran').val('<?=@$data['pembelian_umum_pembayaran']?>').change();
  $('#jatuh_tempo').val('<?=@$data['pembelian_umum_jatuh_tempo']?>');
  $('#status').val('<?=@$data['pembelian_umum_status']?>').change();
  $('#keterangan').val('<?=@$data['pembelian_umum_keterangan']?>');

  if ('<?=@$data['pembelian_umum_lampiran']?>' != '') {
    $('#previewImg').attr('src', '<?=base_url('assets/gambar/pembelian_umum/'.@$data['pembelian_umum_lampiran'])?>');
  }

  //get pembelian
  $.get('<?=base_url('pembelian/get_pembelian_umum/'.$data['pembelian_umum_nomor'])?>', function(data) {
    var json = JSON.parse(data);

    //clone
    for (var num = 1; num <= json.length - 1; num++) {
      
      //paste 
      clone();

      //blank new input
      $('#copy').find('.barang').val('');
      $('#copy').find('.harga').val('');
      $('#copy').find('.qty').val(1);
      $('#copy').find('.potongan').val(0);
      $('#copy').find('.subtotal').val(0);
    
    }

    $.each(json, function(index, val) {
      
      var i = index+1;

      //insert value
      $('#copy:nth-child('+i+') > td:nth-child(1) > input').val(val.pembelian_umum_barang_barang);
      $('#copy:nth-child('+i+') > td:nth-child(2) > input').val(val.pembelian_umum_barang_harga);
      $('#copy:nth-child('+i+') > td:nth-child(3) > input').val(val.pembelian_umum_barang_qty);
      $('#copy:nth-child('+i+') > td:nth-child(4) > input').val(val.pembelian_umum_barang_potongan);

      //ppn 0
      if (<?=@$data['pembelian_umum_ppn']?> == 0) {
        $('.check').removeAttr('checked').change();
      }

    });

  });

</script>
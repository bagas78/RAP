<script>;

  //atribut form
  $('form').attr('action', '<?=base_url('pembelian/'.@$url.'_update/'.@$data['pembelian_nomor'])?>');
  $('#nomor').val('<?=@$data['pembelian_nomor']?>');
  $('#tanggal').val('<?=@$data['pembelian_tanggal']?>');
  $('#supplier').val('<?=@$data['pembelian_supplier']?>').change();
  $('#jatuh_tempo').val('<?=@$data['pembelian_jatuh_tempo']?>');
  $('#status').val('<?=@$data['pembelian_status']?>').change();
  $('#keterangan').val('<?=@$data['pembelian_keterangan']?>');

  if ('<?=@$data['pembelian_lampiran']?>' != '') {
    $('#previewImg').attr('src', '<?=base_url('assets/gambar/pembelian/'.@$data['pembelian_lampiran'])?>');
  } else {
    $('#previewImg').attr('src', '<?=base_url('assets/gambar/camera.png')?>');
  }

  //get pembelian
  $.get('<?=base_url('pembelian/get_pembelian/'.$data['pembelian_nomor'])?>', function(data) {
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

</script>
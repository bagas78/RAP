<script>

  //atribut form
  $('form').attr('action', '<?=base_url('produksi/'.@$url.'_update/'.@$data['produksi_nomor'])?>');
  $('#nomor').val('<?=@$data['produksi_nomor']?>');
  $('#tanggal').val('<?=@$data['produksi_tanggal']?>');
  $('#shift').val('<?=@$data['produksi_shift']?>').change();
  $('#keterangan').val('<?=@$data['produksi_keterangan']?>');

  if ('<?=@$data['produksi_lampiran_1']?>' != '') {
    $('#previewImg1').attr('src', '<?=base_url('assets/gambar/produksi/'.@$data['produksi_lampiran_1'])?>');
  }

  if ('<?=@$data['produksi_lampiran_2']?>' != '') {
    $('#previewImg2').attr('src', '<?=base_url('assets/gambar/produksi/'.@$data['produksi_lampiran_2'])?>');
  }

  //get produksi
  $.get('<?=base_url('produksi/get_produksi/'.$data['produksi_nomor'])?>', function(data) {
    var json = JSON.parse(data);

    //clone
    for (var num = 1; num <= json.length - 1; num++) {
       clone();
    }

    $.each(json, function(index, val) {
      
      var i = index+1;

      //insert value
      $('#copy:nth-child('+i+') > td:nth-child(1) > select').val(val.produksi_barang_barang).change();
      $('#copy:nth-child('+i+') > td:nth-child(2) > div > input').val(val.produksi_barang_qty);

    });

  });

</script>
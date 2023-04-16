<script>

  //atribut form
  $('#nomor').val('<?=@$data['pewarnaan_nomor']?>');
  $('#tanggal').val('<?=@$data['pewarnaan_tanggal']?>');

  //get produksi
  $.get('<?=base_url('produksi/pewarnaan_get/'.$data['pewarnaan_id'])?>', function(data) {
    var json = JSON.parse(data);

    //clone
    for (var num = 1; num <= json.length - 1; num++) {
     
      //paste
      clone();

    }

    $.each(json, function(index, val) {
      
      var i = index+1;

      //insert value
      $('#copy:nth-child('+i+') > td:nth-child(1) > select').val(val.pewarnaan_barang_barang); 
      $('#copy:nth-child('+i+') > td:nth-child(2) > input').val(number_format(val.pewarnaan_barang_stok)); 
      $('#copy:nth-child('+i+') > td:nth-child(3) > select').val(val.pewarnaan_barang_jenis); 
      $('#copy:nth-child('+i+') > td:nth-child(4) > select').val(val.pewarnaan_barang_warna); 
      $('#copy:nth-child('+i+') > td:nth-child(5) > input').val(number_format(val.pewarnaan_barang_qty)); 
      $('#copy:nth-child('+i+') > td:nth-child(6) > input').val(number_format(val.pewarnaan_barang_cacat)); 

    });

  });

</script>
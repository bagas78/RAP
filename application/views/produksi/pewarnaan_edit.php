<script>

  //atribut form
  $('#nomor').val('<?=@$data['pewarnaan_nomor']?>');
  $('#tanggal').val('<?=@$data['pewarnaan_tanggal']?>');

  //get produksi
  $.get('<?=base_url('produksi/pewarnaan_get/'.$data['pewarnaan_id'])?>', function(data) {
    var json = JSON.parse(data);

    //clone
    var loop = (json.length - 1);
    var i = 0;
    for (var num = 1; num <= loop; num++) {
     
      //paste
      clone();
      
      i++
    }

   if (i == loop) {


      $.each(json, function(index, val) {

        var to = index+1;
        // insert value

        $('#copy:nth-child('+to+') > td:nth-child(1) > select').val(val.pewarnaan_barang_barang); 
        $('#copy:nth-child('+to+') > td:nth-child(2) > input').val(val.pewarnaan_barang_stok); 
        $('#copy:nth-child('+to+') > td:nth-child(3) > select').val(val.pewarnaan_barang_jenis); 
        $('#copy:nth-child('+to+') > td:nth-child(4) > select').val(val.pewarnaan_barang_warna); 
        $('#copy:nth-child('+to+') > td:nth-child(5) > input').val(val.pewarnaan_barang_qty);

      });


   }

  });

</script>
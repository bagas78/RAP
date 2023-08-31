<script>

  //atribut form
  $('#nomor').val('<?=@$data['packing_nomor']?>');
  $('#tanggal').val('<?=@$data['packing_tanggal']?>');

  //get produksi
  $.get('<?=base_url('produksi/packing_get/'.$data['packing_id'])?>', function(data) {
    var json = JSON.parse(data);

    //clone
    for (var num = 1; num <= json.length - 1; num++) {
     
      //paste
      $('#paste').prepend($('#copy').clone());

    }

    $.each(json, function(index, val) {
      
      var i = index+1;

      //insert value
      $('#copy:nth-child('+i+') > td:nth-child(1) > select').val(val.packing_barang_barang); 
      $('#copy:nth-child('+i+') > td:nth-child(2) > select').val(val.packing_barang_jenis); 
      $('#copy:nth-child('+i+') > td:nth-child(3) > select').val(val.packing_barang_warna); 
      $('#copy:nth-child('+i+') > td:nth-child(4) > input').val(val.packing_barang_stok); 
      $('#copy:nth-child('+i+') > td:nth-child(5) > input').val(val.packing_barang_qty); 

    });

  });

</script>
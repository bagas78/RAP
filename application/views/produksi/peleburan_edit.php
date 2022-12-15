<script>;

  //atribut form
  $('#nomor').val('<?=@$data['peleburan_nomor']?>');
  $('#tanggal').val('<?=@$data['peleburan_tanggal']?>');
  $('#magnesium').val('<?=@$data['peleburan_magnesium']?>');
  $('#pembantu').val('<?=@$data['peleburan_pembantu']?>');
  $('#billet').val('<?=@$data['peleburan_billet']?>');

  //get peleburan
  $.get('<?=base_url('produksi/get_peleburan/'.$data['peleburan_nomor'])?>', function(data) {
    var json = JSON.parse(data);

    //clone
    for (var num = 1; num <= json.length - 1; num++) {
       clone();
    }

    $.each(json, function(index, val) {
      
      var i = index+1;

      //insert value
      $('#copy:nth-child('+i+') > td:nth-child(1) > select').val(val.peleburan_barang_barang).change();
      $('#copy:nth-child('+i+') > td:nth-child(2) > div > input').val(val.peleburan_barang_qty);
      $('#copy:nth-child('+i+') > td:nth-child(3) > div > input').val(val.peleburan_barang_potongan);

    });

  });

</script>
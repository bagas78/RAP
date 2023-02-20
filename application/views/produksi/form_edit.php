<script>

  //atribut form
  $('form').attr('action', '<?=base_url('produksi/'.@$url.'_update/'.@$data['produksi_nomor'])?>');
  $('#nomor').val('<?=@$data['produksi_nomor']?>');
  $('#tanggal').val('<?=@$data['produksi_tanggal']?>');
  $('#shift').val('<?=@$data['produksi_shift']?>').change();
  $('#keterangan').val('<?=@$data['produksi_keterangan']?>');
  $('#mesin').val('<?=@$data['produksi_mesin']?>').change();
  $('#pekerja').val(<?=@$data['produksi_pekerja']?>).change();

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
  $('#sisa_billet').val('<?=@$data['produksi_billet_sisa']?>');

  //get produksi
  $.get('<?=base_url('produksi/get_produksi/'.$data['produksi_nomor'])?>', function(data) {
    var json = JSON.parse(data);

    //clone
    for (var num = 1; num <= json.length - 1; num++) {
     
      //paste
      clone();
      
      //blank new input
      $('#copy').find('select').val('');
      $('#copy').find('.qty').val(0);

    }

    $.each(json, function(index, val) {
      
      var i = index+1;

      //insert value
      $('#copy:nth-child('+i+') > td:nth-child(1) > select').val(val.produksi_barang_barang).change(); 
      $('#copy:nth-child('+i+') > td:nth-child(2) > select').val(val.produksi_barang_jenis).change();
      $('#copy:nth-child('+i+') > td:nth-child(4) > input').val(number_format(val.produksi_barang_qty));
      $('#copy:nth-child('+i+') > td:nth-child(5) > input').val(val.produksi_barang_id);

      //jenis
      var warna = val.produksi_barang_warna;
      if (warna == 0) {

        $('#copy:nth-child('+i+') > td:nth-child(3) > select').val(val.produksi_barang_warna).change().attr('readonly',true).css('pointer-events','none');
      }else{

        $('#copy:nth-child('+i+') > td:nth-child(3) > select').val(val.produksi_barang_warna).change();
      }

    });

  });

</script>
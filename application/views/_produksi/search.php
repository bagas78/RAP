<script>;

//search
$('#search').removeAttr('hidden',true);

$(function(){

  $.get('<?=base_url('produksi/search/0')?>', function(response) {
  	
  	var json = JSON.parse(response);
  	var data = new Array();

  	$.each(json, function(index, val) {
  		data.push(val.nomor);
  	});

  	$("#po").autocomplete({
	    source: data
	});

  });
  
});

$(document).on('click', '#po_get', function() {

	$("table").load(location.href+" table>*","", function (){	

		var nomor = $('#po').val();

     $.get('<?=base_url('produksi/search_data/')?>'+nomor, function(response) {
     	
     	var json = JSON.parse(response);

     	$('#nomor').val(json[0]['produksi_nomor']);
	  	$('#tanggal').val(json[0]['produksi_tanggal']);
	  	$('#status').val(json[0]['produksi_status']).change();
	  	$('#shift').val(json[0]['produksi_shift']).change();
	  	$('#keterangan').val(json[0]['produksi_keterangan']);
	  	$('#mesin').val(json[0]['produksi_mesin']).change();


	  	//lampiran
	  	if (json[0]['produksi_lampiran_1'] != null) {
			  $('#previewImg1').attr('src', '<?=base_url('assets/gambar/produksi/')?>'+json[0]['produksi_lampiran_1']);
			}else{
				$('#previewImg1').attr('src', '<?=base_url('assets/gambar/1.png')?>');
			}
			if (json[0]['produksi_lampiran_2'] != null) {
			  $('#previewImg2').attr('src', '<?=base_url('assets/gambar/produksi/')?>'+json[0]['produksi_lampiran_2']);
			}else{
				$('#previewImg2').attr('src', '<?=base_url('assets/gambar/2.png')?>');
			}
			/////

			//clone
			for (var num = 1; num <= json.length - 1; num++) {
		       clone();
		   }

			//keranjang
			$.each(json, function(index, val) {
	      
		      var i = index+1;

		      //insert value
		      $('#copy:nth-child('+i+') > td:nth-child(1) > select').val(val.produksi_barang_barang);
		      $('#copy:nth-child('+i+') > td:nth-child(2) > select').val(val.produksi_barang_jenis).change();
		      $('#copy:nth-child('+i+') > td:nth-child(3) > select').val(val.produksi_barang_warna).change();
		      $('#copy:nth-child('+i+') > td:nth-child(4) > .input-group > input').val(val.produksi_barang_mf_stok);
		      $('#copy:nth-child('+i+') > td:nth-child(5) > input').val(val.produksi_barang_qty);
		      $('#copy:nth-child('+i+') > td:nth-child(6) > input').val(val.produksi_barang_barang);

		      //check MF
		      if (val.produksi_barang_mf == 1) {

		      	$('#copy:nth-child('+i+') > td:nth-child(4) > .input-group > .satuan > .mf_check').click();

		      }

		    });

				//billet
				var stok_billet = parseInt($('#stok_billet').text()) + parseInt(json[0]['produksi_billet_qty']);
	  		$('#stok_billet').text(stok_billet);
				$('#qty_billet').val(json[0]['produksi_billet_qty']);

				//jasa
				$('#jasa').val(json[0]['produksi_jasa']);
				//sisa
				$('#sisa_billet').val(json[0]['produksi_billet_sisa']);

	  });

	});

 });

</script>
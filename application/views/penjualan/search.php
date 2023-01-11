<script>;

//search
$('#search').removeAttr('hidden',true);

$(function(){

  $.get('<?=base_url('penjualan/search/'.@$search)?>', function(response) {
  	
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

	var reload = $("form").load(location.href+" form>*","");

	if (reload) {

		var nomor = $('#po').val();

	     $.get('<?=base_url('penjualan/search_data/')?>'+nomor, function(response) {
	     	
	     	var json = JSON.parse(response);

	     	$('#nomor').val(json[0]['penjualan_nomor']);
		  	$('#tanggal').val(json[0]['penjualan_tanggal']);
		  	$('#pelanggan').val(json[0]['penjualan_pelanggan']).change();
		  	$('#jatuh_tempo').val(json[0]['penjualan_jatuh_tempo']);
		  	$('#status').val(json[0]['penjualan_status']).change();
		  	$('#keterangan').val(json[0]['penjualan_keterangan']);

		  	if (json[0]['penjualan_lampiran'] != '') {
			  $('#previewImg').attr('src', '<?=base_url('assets/gambar/penjualan/')?>'+json[0]['penjualan_lampiran']);
			} else {
			  $('#previewImg').attr('src', '<?=base_url('assets/gambar/camera.png')?>');
			}

			//clone
			for (var num = 1; num <= json.length - 1; num++) {
		       clone();
		    }

			//keranjang
			$.each(json, function(index, val) {
	      
		      var i = index+1;

		      //insert value
		      $('#copy:nth-child('+i+') > td:nth-child(1) > select').val(val.penjualan_barang_barang).change();
		      $('#copy:nth-child('+i+') > td:nth-child(2) > div > input').val(val.penjualan_barang_qty);
		      $('#copy:nth-child('+i+') > td:nth-child(3) > div > input').val(val.penjualan_barang_stok);
		      $('#copy:nth-child('+i+') > td:nth-child(4) > div > input').val(val.penjualan_barang_potongan);

		    });

		    //ppn 0
	      	if (json[0]['penjualan_ppn'] == 0) {
	        	$('.check').removeAttr('checked').change();
	      	}

	     });
	}

 });

</script>
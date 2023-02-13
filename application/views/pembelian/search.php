<script>;

//search
$('#search').removeAttr('hidden',true);

$(function(){

  $.get('<?=base_url('pembelian/search')?>', function(response) {
  	
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

	$("form").load(location.href+" form>*","", function(){

			var nomor = $('#po').val();

	     $.get('<?=base_url('pembelian/search_data/')?>'+nomor, function(response) {
	     	
	     	var json = JSON.parse(response);

	     	$('#nomor').val(json[0]['pembelian_nomor']);
		  	$('#tanggal').val(json[0]['pembelian_tanggal']);
		  	$('#supplier').val(json[0]['pembelian_supplier']).change();
		  	$('#jatuh_tempo').val(json[0]['pembelian_jatuh_tempo']);
		  	$('#status').val(json[0]['pembelian_status']).change();
		  	$('#keterangan').val(json[0]['pembelian_keterangan']);
		  	$('#pembayaran').val(json[0]['pembelian_pembayaran']);

		  	if (json[0]['pembelian_lampiran'] != '') {
			  $('#previewImg').attr('src', '<?=base_url('assets/gambar/pembelian/')?>'+json[0]['pembelian_lampiran']);
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
		      $('#copy:nth-child('+i+') > td:nth-child(1) > select').val(val.pembelian_barang_barang).change();
		      $('#copy:nth-child('+i+') > td:nth-child(3) > div > input').val(val.pembelian_barang_qty);
		      $('#copy:nth-child('+i+') > td:nth-child(4) > div > input').val(val.pembelian_barang_potongan);

		    });

		    //ppn 0
	      	if (json[0]['pembelian_ppn'] == 0) {
	        	$('.check').removeAttr('checked').change();
	      	}

	     });

	});

 });

</script>
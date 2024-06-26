<script>

$(document).on('keyup | change | keydown | keypress', '#so', function() {

	var val = $(this).val();

	if (val) {

		$.get('<?=base_url('penjualan/search/')?>'+val, function(response) {
  	
	  	var json = JSON.parse(response);
	  	var data = new Array();

	  	$.each(json, function(index, val) {
	  		data.push(val.penjualan_nomor);
	  	}); 

	  	$("#so").autocomplete({
		    source: data
			});
	 
	  });


	}
  
});

$(document).on('click', '#so_get', function() {

	$("table").load(location.href+" table>*","", function(){

			var nomor = $('#so').val().split('_');

	     $.get('<?=base_url('penjualan/search_data/')?>'+nomor[0], function(response) {
	     	
	     	var json = JSON.parse(response);

		  	$('#nomor').val(json[0]['penjualan_nomor']).change();
		  	$('#tanggal').val(json[0]['penjualan_tanggal']);
		  	$('#pelanggan').val(json[0]['penjualan_pelanggan']).change();
		  	$('#jatuh_tempo').val(json[0]['penjualan_jatuh_tempo']);
		  	$('#pembayaran').val(json[0]['penjualan_pembayaran']).change();
		  	$('#status').val(json[0]['penjualan_status']).change();
		  	$('#keterangan').val(json[0]['penjualan_keterangan']).change();

		  	if (json[0]['penjualan_lampiran'] != '') { 
			    $('#previewImg').attr('src', '<?=base_url('assets/gambar/penjualan/')?>'+json[0]['penjualan_lampiran']);
			  }

			//clone
			for (var num = 1; num <= json.length - 1; num++) {
		       $('#paste').prepend($('#copy').clone());
		    }

			//keranjang
			$.each(json, function(index, val) {
	      
		      var i = index+1;

		      //insert value
		      $('#copy:nth-child('+i+') > td:nth-child(1) > select').val(val.penjualan_barang_barang);
		      $('#copy:nth-child('+i+') > td:nth-child(2) > select').val(val.penjualan_barang_jenis);
      		  $('#copy:nth-child('+i+') > td:nth-child(3) > select').val(val.penjualan_barang_warna);

		      $('#copy:nth-child('+i+') > td:nth-child(4) > div > input').val(val.penjualan_barang_qty);

		       $('#copy:nth-child('+i+') > td:nth-child(6) > input').val(val.penjualan_barang_potongan);

		      $('#copy:nth-child('+i+') > td:nth-child(5) > div > input').val(val.penjualan_barang_stok);


		      $('#copy:nth-child('+i+') > td:nth-child(7) > input').val(val.penjualan_barang_harga);
		      $('#copy:nth-child('+i+') > td:nth-child(8) > input').val(val.penjualan_barang_hps);

		      //satuan
        	var satuan = $('.satuan');
        	$(satuan).empty().html(val.satuan_singkatan);

        	//ppn 0
		      if (val.penjualan_ppn == 0) {
		        $('.check').removeAttr('checked').change();
		      }

		    });

	  });

	});

 });

</script>
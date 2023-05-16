<script>

$(document).on('keyup | change | keydown | keypress', '#po', function() {

	var val = $(this).val();

	if (val) {

		$.get('<?=base_url('penjualan/search/')?>'+val, function(response) {
  	
	  	var json = JSON.parse(response);
	  	var data = new Array();

	  	$.each(json, function(index, val) {
	  		data.push(val.penjualan_nomor);
	  	}); 

	  	$("#po").autocomplete({
		    source: data
			});
	 
	  });


	}
  
});

$(document).on('click', '#po_get', function() {

	$("table").load(location.href+" table>*","", function(){

			var nomor = $('#po').val().split('_');

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
		       clone();
		    }

			//keranjang
			$.each(json, function(index, val) {
	      
		      var i = index+1;

		      //insert value
		      $('#copy:nth-child('+i+') > td:nth-child(1) > select').val(val.penjualan_barang_barang);
		      $('#copy:nth-child('+i+') > td:nth-child(2) > div > input').val(val.penjualan_barang_qty);

		      $('#copy:nth-child('+i+') > td:nth-child(3) > div > input').val(val.penjualan_barang_stok);
		      $('#copy:nth-child('+i+') > td:nth-child(5) > input').val(number_format(val.penjualan_barang_harga));
		      $('#copy:nth-child('+i+') > td:nth-child(7) > input').val(val.penjualan_barang_hps);

		      $('#copy:nth-child('+i+') > td:nth-child(8) > input').val(val.penjualan_barang_jenis);
		      $('#copy:nth-child('+i+') > td:nth-child(9) > input').val(val.penjualan_barang_warna);

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
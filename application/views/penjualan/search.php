<script>

$(document).on('keyup', '#po', function() {

  $.get('<?=base_url('penjualan/search/'.@$search)?>', function(response) {
  	
  	var json = JSON.parse(response);
  	var data = new Array();

  	$.each(json, function(index, val) {
  		data.push(val.nomor+'_( '+val.nama+' )');
  	}); 

  	$("#po").autocomplete({
	    source: data
		});
 
  });
  
});

$(document).on('click', '#po_get', function() {

	$("table").load(location.href+" table>*","", function(){

			var nomor = $('#po').val().split('_');

	     $.get('<?=base_url('penjualan/search_data/')?>'+nomor[0], function(response) {
	     	
	     	var json = JSON.parse(response);

		  	$('#pelanggan').val(json[0]['produksi_pesanan']).change();
		  	$('#pesanan').val(json[0]['produksi_nomor']);

			//clone
			for (var num = 1; num <= json.length - 1; num++) {
		       clone();
		    }

			//keranjang
			$.each(json, function(index, val) {
	      
		      var i = index+1;

		      //insert value
		      $('#copy:nth-child('+i+') > td:nth-child(1) > select').val(val.produksi_barang_barang);
		      $('#copy:nth-child('+i+') > td:nth-child(2) > div > input').val(val.produksi_barang_qty);

		      $('#copy:nth-child('+i+') > td:nth-child(3) > div > input').val(val.produk_barang_stok);
		      $('#copy:nth-child('+i+') > td:nth-child(5) > input').val(number_format(val.produk_barang_harga));
		      $('#copy:nth-child('+i+') > td:nth-child(7) > input').val(val.produk_barang_hps);

		      $('#copy:nth-child('+i+') > td:nth-child(8) > input').val(val.produksi_barang_jenis);
		      $('#copy:nth-child('+i+') > td:nth-child(9) > input').val(val.produksi_barang_warna);

		      //satuan
        	var satuan = $('.satuan');
        	$(satuan).empty().html(val.satuan_singkatan);

		    });

	  });

	});

 });

</script>
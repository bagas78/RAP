<script>

$(function(){

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

	     	console.log(json);

		  	$('#pelanggan').val(json[0]['produksi_pesanan']).change();

			//clone
			for (var num = 1; num <= json.length - 1; num++) {
		       clone();
		    }

			//keranjang
			// $.each(json, function(index, val) {
	      
		 //      var i = index+1;

		 //      //insert value
		 //      $('#copy:nth-child('+i+') > td:nth-child(1) > select').val(val.penjualan_barang_barang);
		 //      $('#copy:nth-child('+i+') > td:nth-child(2) > div > input').val(val.penjualan_barang_qty);
		 //      $('#copy:nth-child('+i+') > td:nth-child(4) > div > input').val(number_format(val.penjualan_barang_potongan));
		 //      $('#copy:nth-child('+i+') > td:nth-child(5) > input').val(number_format(val.penjualan_barang_harga));

		 //      //kembalikan stok
		 //      var re = parseInt(val.penjualan_barang_qty) + parseInt(val.master_produk_stok);
		 //      $('#copy:nth-child('+i+') > td:nth-child(3) > div > input').val(re);

		 //      //satuan
   //      	var satuan = $('.satuan');
   //      	$(satuan).empty().html(val.satuan_singkatan);

		 //    });

	  });

	});

 });

</script>
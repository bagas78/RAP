<script>;
//place holder
$('#po').attr('placeholder', '<?=@$place?>');


//search
$('#search').removeAttr('hidden',true);

$(function(){

  $.get('<?=base_url('produksi/search/'.@$tarik)?>', function(response) {
  	
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

     $.get('<?=base_url('produksi/search_data/')?>'+nomor, function(response) {
     	
     	var json = JSON.parse(response);

     	$('#nomor').val(json[0]['produksi_nomor']);
	  	$('#tanggal').val(json[0]['produksi_tanggal']);
	  	$('#status').val(json[0]['produksi_status']).change();
	  	$('#shift').val(json[0]['produksi_shift']).change();
	  	$('#keterangan').val(json[0]['produksi_keterangan']);

	  	if (json[0]['produksi_lampiran_1'] != '') {
			  $('#previewImg1').attr('src', '<?=base_url('assets/gambar/produksi/')?>'+json[0]['produksi_lampiran_1']);
			}else{
				$('#previewImg1').attr('src', '<?=base_url('assets/gambar/1.png')?>');
			}
			if (json[0]['produksi_lampiran_2'] != '') {
			  $('#previewImg2').attr('src', '<?=base_url('assets/gambar/produksi/')?>'+json[0]['produksi_lampiran_2']);
			}else{
				$('#previewImg2').attr('src', '<?=base_url('assets/gambar/2.png')?>');
			}

			$('#qty_billet').val(json[0]['produksi_billet_qty']);

			//clone
			for (var num = 1; num <= json.length - 1; num++) {
		       clone();
		   }

			//keranjang
			$.each(json, function(index, val) {
	      
		      var i = index+1;

		      //insert value
		      $('#copy:nth-child('+i+') > td:nth-child(1) > select').val(val.produksi_barang_barang).change();
		      $('#copy:nth-child('+i+') > td:nth-child(2) > div > input').val(val.produksi_barang_qty);
		      $('#copy:nth-child('+i+') > td:nth-child(3) > div > input').val(val.produksi_barang_potongan);

		    });

		    //ppn 0
	      	if (json[0]['produksi_ppn'] == 0) {
	        	$('.check').removeAttr('checked').change();
	      	}

	     });
	}

 });

</script>
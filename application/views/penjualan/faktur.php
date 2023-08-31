<?php $set = $this->query_builder->view_row("SELECT * FROM t_logo"); ?>

<!DOCTYPE html>
<html>
<head> 
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= strtoupper(@$title) ?> | <?=@$set['logo_nama'] ?></title> 

	<!-- Bootstrap 3.3.7 --> 
  	<link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css"> 

  	<!-- jQuery 3 -->
  	<script src="<?php echo base_url() ?>adminLTE/bower_components/jquery/dist/jquery.min.js"></script>

  	<!--number format-->
  	<script src="<?php echo base_url() ?>assets/js/number_format.js"></script>

  	<style type="text/css">
  		.box{
  			padding: 3%;
  		}
  		.tit{
  			border-width: 2px;
		    border-style: solid;
		    padding: 0.5%;
		    font-weight: bold;
  		}
  	</style>

</head>
<body>

	<div class="box">

		<div class="col-md-6 col-xs-6">
			<h4><?=strtoupper($set['logo_nama'])?></h4>
			<p><?=strtoupper($set['logo_alamat'])?></p>
			<p>Telp : <?=$set['logo_telp']?></p>
		</div>

		<div class="col-md-6 col-xs-6" style="text-align: right;">
			<p><?=@$data[0]['penjualan_nomor']?></p>
			<p><?=date_format(date_create(@$data[0]['penjualan_tanggal']), 'd M Y')?></p>
			<p><?=@$data[0]['user_name']?></p>
		</div>	

		<div class="col-md-12 col-xs-12" align="center">
			<span class="tit">NOTA PENJUALAN</span>
			<br/><br/><br/>
		</div>	

		<div class="col-md-12 col-xs-12">
			<table>
				<tr>
					<td>Nama Customer : <?=@$data[0]['kontak_nama']?></td>
				</tr>
				<tr><td><p></td></tr>
				<tr>
					<td><?=@$data[0]['kontak_alamat']?>, Telp : <?=@$data[0]['kontak_tlp']?></td>
				</tr>
			</table>
		</div>	

		<div class="clearfix"></div><br/>
		
		<table class="table table-responsive table-borderless">
			<thead>
				<tr>
					<th width="70">No</th>
					<th>Produk</th>
					<th>Qty</th>
					<th>Disc</th>
					<th>Harga</th>
					<th>Subtotal</th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 1; ?>
				<?php foreach ($data as $val): ?>

					<tr>
						<td><?=$i?></td>
						<td><?=@$val['produk_nama']?> <?=@$val['warna_nama']?></td>
						<td class="qty"><?=number_format(@$val['penjualan_barang_qty']).' '.@$val['satuan_singkatan']?></td>
						<td>Rp. <span class="diskon"><?=number_format(@$val['penjualan_barang_potongan'])?></span></td>
						<td>Rp. <span class="harga"><?=number_format(@$val['penjualan_barang_harga'])?></span></td>
						<td>Rp. <span class="subtotal"><?=number_format(@$val['penjualan_barang_subtotal'])?></span></td>
					</tr>
				
				<?php $i++ ?>
				<?php endforeach ?>

				<tr>
					<td colspan="4"></td>
					<td>Total</td>
					<td>Rp. <span id="total_akhir"></span></td>
				</tr>
				<tr>
					<td style="border-top: 0;" colspan="4">Terbilang : </td>
					<td style="border-top: 0;">Diskon</td>
					<td style="border-top: 0;">Rp. <span id="total_diskon"></span></td>
				</tr>
				<tr>
					<td style="border-top: 0;" colspan="4">Jatuh Tempo : <?php @$d = date_create($data[0]['penjualan_jatuh_tempo']); echo date_format($d, 'd M Y') ?></td>
					<td style="border-top: 0;">PPN <?=@$data[0]['penjualan_ppn']?>%</td>
					<td style="border-top: 0;">Rp. <span id="ppn"></span></td>
				</tr>
				<tr>
					<td style="border-top: 0;" colspan="4"></td>
					<td style="border-top: 0;">Total Transfer</td>
					<td style="border-top: 0;">Rp. <span id="akhir"></span></td>
				</tr>

			</tbody>
		</table>

		<div class="clearfix"></div><br/>

		<div class="col-md-4 col-xs-4">
			<center style="float: left;">
			<p>Penerima</p>
			<br/><br/><br/>
			<p>( ___________________  )</p>
			</center>
		</div>

		<div class="col-md-4 col-xs-4">
			<center>
			<p>PT. Rajawali Alumunium Perkasa</p>
			<br/><br/><br/>
			<p>( ___________________  )</p>
			</center>
		</div>

	</div>

</body>
</html>

<script type="text/javascript">
	
	var total = 0;
	var sum = 0;
	$.each($('.subtotal'), function() {
		 
		 total += parseInt($(this).text().replace(/,/g, ''));
		 sum += parseInt($(this).closest('tr').find('.qty').text().replace(/,/g, '')) * parseInt($(this).closest('tr').find('.harga').text().replace(/,/g, ''));
		 
	});

	$('#total_akhir').text(number_format(total));

	//diskon
	var diskon = 0;
	$.each($('.diskon'), function() {
		 
		 diskon += parseInt($(this).text().replace(/,/g, ''));
		 
	});

	$('#total_diskon').text(number_format(sum - total));

	//ppn
	var ppn = (<?=@$data[0]['penjualan_ppn']?>) * total / 100;
	$('#ppn').text(number_format(ppn));

	//total akhir
	var akhir = number_format(ppn + total);
	$('#akhir').text(akhir);

	//translate
	// $.ajax({
	//   url: '<?php //echo base_url('translate/content/id') ?>',
	//   type: 'POST',
	//   dataType: 'json',
	//   data: {text: akhir.replace(/,/g, '')},
	// })
	// .done(function(data) {
	    
	//   console.log(data);

	// });

	// print
	window.print();
    window.onafterprint = back;

    function back() {
        window.history.back();
    }

</script>
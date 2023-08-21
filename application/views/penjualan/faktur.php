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
			<span class="tit">INVOICE PENJUALAN</span>
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
		
		<table class="table table-responsive table-bordered">
			<thead>
				<tr>
					<th width="70">No</th>
					<th>Produk</th>
					<th>Jenis</th>
					<th>Warna</th>
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
						<td><?=$val['produk_nama']?></td>
						<td><?=$val['warna_jenis_type']?></td>
						<td><?=$val['warna_nama']?></td>
						<td><?=number_format($val['penjualan_barang_qty'])?></td>
						<td><?=number_format($val['penjualan_barang_potongan'])?></td>
						<td><?=number_format($val['penjualan_barang_harga'])?></td>
						<td class="subtotal"><?=number_format($val['penjualan_total'])?></td>
					</tr>
				
				<?php $i++ ?>
				<?php endforeach ?>

				<tr>
					<td colspan="6"></td>
					<td>PPN</td>
					<td id="ppn"><?=@$data[0]['penjualan_ppn']?>%</td>
				</tr>
				<tr>
					<td>Jatuh Tempo</td>
					<td colspan="5"><?php @$d = date_create($data[0]['penjualan_jatuh_tempo']); echo date_format($d, 'd M Y') ?></td>
					<td>Total Akhir</td>
					<td id="total_akhir"></td>
				</tr>
				<tr>
					<td>Keterangan</td>
					<td colspan="7"><?=@$data[0]['penjualan_keterangan']?></td>
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
			<p>PT. Alumunium Perkasa</p>
			<br/><br/><br/>
			<p>( ___________________  )</p>
			</center>
		</div>

	</div>

</body>
</html>

<script type="text/javascript">
	
	var subtotal = $('.subtotal');
	var num = 0;
	$.each(subtotal, function(index, val) {
		 
		 num += parseInt($(this).text().replace(/,/g, ''));
		 
	});

	var ppn = (<?=@$data[0]['penjualan_ppn']?>) * num / 100;
	var total = ppn + num;

	$('#total_akhir').text(number_format(total));

	
	// print
	window.print();
    window.onafterprint = back;

    function back() {
        window.history.back();
    }

</script>
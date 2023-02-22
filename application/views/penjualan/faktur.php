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
  			float: right;
		    border-width: 2px;
		    border-style: solid;
		    padding: 0.5%;
		    font-weight: bold;
  		}
  	</style>

</head>
<body>

	<div class="box">

		<span class="tit">FAKTUR PENJUALAN</span>

		<h4><?=strtoupper($set['logo_nama'])?></h4>
		<p><?=strtoupper($set['logo_alamat'])?></p>
		<p>Telp : <?=$set['logo_telp']?></p>

		<div class="clearfix"></div><br/>
		
		<table class="table table-responsive table-bordered">
			<thead>
				<tr>
					<td>Nama</td>
					<td colspan="4"><?=@$data[0]['kontak_nama']?></td>
				<tr>
					<td>Alamat</td>
					<td colspan="4"><?=@$data[0]['kontak_alamat']?></td>
				</tr>
				<tr>
					<td>Telp</td>
					<td colspan="4"><?=@$data[0]['kontak_tlp']?></td>
				</tr>
				<tr>
					<th width="70">No</th>
					<th>Produk</th>
					<th>Jenis</th>
					<th>Warna</th>
					<th>Qty</th>
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
						<td><?=number_format($val['penjualan_barang_harga'])?></td>
						<td class="subtotal"><?=number_format($val['penjualan_total'])?></td>
					</tr>
				
				<?php $i++ ?>
				<?php endforeach ?>

				<tr>
					<td colspan="5"></td>
					<td>PPN</td>
					<td id="ppn"><?=@$data[0]['penjualan_ppn']?>%</td>
				</tr>
				<tr>
					<td>Jatuh Tempo</td>
					<td colspan="4"><?php @$d = date_create($data[0]['penjualan_jatuh_tempo']); echo date_format($d, 'd M Y') ?></td>
					<td>Total Akhir</td>
					<td id="total_akhir"></td>
				</tr>
				<tr>
					<td>Keterangan</td>
					<td colspan="6"><?=@$data[0]['penjualan_keterangan']?></td>
				</tr>

			</tbody>
		</table>

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
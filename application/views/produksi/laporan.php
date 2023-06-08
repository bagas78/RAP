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
		    font-size: x-large;
  		}
  	</style>

</head>
<body>

	<div class="box">

		<div class="row">

			<div class="col-md-12" align="center">
				<span class="tit">LAPORAN PRODUKSI</span>
			</div>

			<div class="clearfix"></div><br/>

			<div class="col-md-12" align="center">
				<span style="font-size: x-large;">Tanggal : <?php $d = date_create($data[0]['produk_tanggal']); echo date_format($d, 'd/m/Y'); ?></span>
			</div>

			<div class="clearfix"></div><br/>

			<div class="col-md-12">
			
				<table class="table table-responsive table-bordered">
					<thead>
						<tr>
							<th width="70">No</th>
							<th>Matras</th>
							<th>Nama Profil</th>
							<th>Gambar</th>
							<th>Panjang</th>
							<th>Berat / Btg</th>
							<th>Jumlah</th>
							<th>Subtotal</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; ?>
						<?php foreach ($data as $val): ?>

							<tr>
								<td><?=$i?></td>
								<td class="matras"><?=@$val['produksi_barang_matras']?></td>
								<td><?=@$val['produk_nama']?></td>
								<td></td>
								<td><?=@$val['produk_panjang'].' Cm'?></td>
								<td><?=number_format(@$val['produk_berat']).' Kg'?></td>
								<td><?=number_format(@$val['produksi_barang_qty'])?></td>
								<td class="subtotal"><?=number_format(@$val['produk_berat'] * @$val['produksi_barang_qty']).' Kg'?></td>
							</tr>
						
						<?php $i++ ?>
						<?php endforeach ?>

					</tbody>
				</table>
			</div>

			<div class="col-md-12 col-xs-12">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Jumlah Matras</th>
							<th>Jumlah Billet</th>
							<th>Sisa Billet</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="matras_sum"></td>
							<td><?=number_format(@$data[0]['produksi_billet_qty']).' Kg'?></td>
							<td><?=number_format(@$data[0]['produksi_billet_sisa']).' Kg'?></td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="clearfix"></div><br/>

			<div class="col-md-6 col-xs-6">
				<?php if ($data[0]['produksi_pekerja'] != 'null'): ?>
					<h4>Pekerja</h4>
					<?php $s = 1; ?>
					<?php foreach (json_decode($data[0]['produksi_pekerja']) as $key => $value): ?>
						<?php $kar = $this->query_builder->view_row("SELECT * FROM t_karyawan WHERE karyawan_id = '$value'"); ?>
						<p><?=$s.'. '.$kar['karyawan_nama']?></p>
					<?php $s++; ?>
					<?php endforeach ?>
				<?php endif ?>
			</div>

			<div class="col-md-6 col-xs-6">
				<center style="float: right;">
				<p>Di Buat oleh</p>
				<br/><br/><br/>
				<p>( ___________________  )</p>
				</center>
			</div>

		</div>

	</div>

</body>
</html>

<script type="text/javascript">

	var matras = $('.matras');
	var num_matras = 0;
	$.each(matras, function(index, val) {
		 
		 num_matras += Number($(this).text().replace(/,/g, ''));
		 
	});

	$('.matras_sum').text(number_format(num_matras));

	
	//print
	window.print();
    window.onafterprint = back;

    function back() {
        window.history.back();
    }

</script>
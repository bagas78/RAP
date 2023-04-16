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
				<span class="tit">LAPORAN PEWARNAAN</span>
			</div>

			<div class="clearfix"></div><br/>

			<div class="col-md-12" align="center">
				<span style="font-size: x-large;">Tanggal : <?php $d = date_create(@$data[0]['pewarnaan_packing_tanggal']); echo date_format($d, 'd/m/Y'); ?></span>
			</div>

			<div class="clearfix"></div><br/>

			<div class="col-md-12">
			
				<table class="table table-responsive table-bordered">
					<thead>
						<tr>
							<th width="70">No</th>
							<th>Nama Profil</th>
							<th>Warna</th>
							<th>Panjang</th>
							<th>Berat</th>
							<th>Jumlah</th>
							<th>Cacat</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; ?>
						<?php foreach (@$data as $val): ?>

							<tr>
								<td><?=$i?></td>
								<td><?=@$val['produk_nama']?></td>
								<td><?=@$val['warna_nama']?></td>
								<td><?=@$val['produk_panjang'].' Cm'?></td>
								<td><?=@$val['produk_berat'].' Kg'?></td>
								<td><?=number_format(@$val['pewarnaan_barang_qty'])?></td>
								<td><?=number_format(@$val['pewarnaan_barang_warna_cacat'])?></td>
							</tr>
						
						<?php $i++ ?>
						<?php endforeach ?>

					</tbody>
				</table>
			</div>

			<div class="clearfix"></div><br/>

			<div class="col-md-6 col-xs-6">
				
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

	
	//print
	window.print();
    window.onafterprint = back;

    function back() {
        window.history.back();
    }

</script>
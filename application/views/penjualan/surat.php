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
		    padding: 0.5%;
		    font-weight: bold;
		    font-size: x-large;
		    text-decoration: underline;
  		}
  	</style>

</head>
<body>

	<div class="box">

		<div class="col-md-6 col-xs-6">
			<center style="float: left;">
			<h4><?=strtoupper($set['logo_nama'])?></h4>
			<p><?=strtoupper($set['logo_alamat'])?></p>
			<p>Telp : <?=$set['logo_telp']?></p>
			</center>
		</div>
		<div align="right" class="col-md-6 col-xs-6" style="font-weight: bolder;">
			<p>KEPADA &#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;</p>
			<p>YTH ________________</p>
			<p>____________________</p>
			<p>____________________</p>
		</div>

		<div class="clearfix"></div><br/>

		<center><span class="tit">SURAT JALAN</span></center>

		<div class="clearfix"></div><br/>

		<p>No : <?=@$data[0]['penjualan_nomor']?></p>
		<p>Harap di terima dengan baik barang - barang tersebut di bawah ini :</p>
		
		<table class="table table-responsive table-bordered">
			<thead>
				<tr>
					<th style="width: 1px;">No</th>
					<th>Macam / Jenis Barang</th>
					<th>Jumlah</th>
					<th>Ketebalan</th>
					<th>Panjang</th>
					<th>Lebar</th>
					<th>Berat</th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 1; ?>
				<?php foreach ($data as $val): ?>

					<tr>
						<td><?=$i?></td>
						<td><?=@$val['master_produk_nama']?></td>
						<td><?=number_format(@$val['penjualan_barang_qty']).' '.@$val['satuan_singkatan']?></td>
						<td><?=@$val['master_produk_ketebalan']?> Cm</td>
						<td><?=@$val['master_produk_panjang']?> Cm</td>
						<td><?=@$val['master_produk_lebar']?> Cm</td>
						<td><?=@$val['master_produk_berat']?> Kg</td>
					</tr>
				
				<?php $i++ ?>
				<?php endforeach ?>

				<tr>
					<td>Keterangan</td>
					<td colspan="7"><?=@$data[0]['penjualan_keterangan']?></td>
				</tr>

			</tbody>
		</table>

		<?php $d = date_create(date('Y-m-d'));?>

		<p align="right"><?=strtoupper($set['logo_kota']).', '.date_format($d, 'd M Y')?></p>
		<br/><br/>

		<div class="col-md-4 col-xs-4">
			<center style="float: left;">
			<p>Penerima :</p>
			<br/><br/>
			<p>( ___________________  )</p>
			</center>
		</div>

		<div class="col-md-4 col-xs-4">
			<center>
			<p>Pengirim :</p>
			<br/><br/>
			<p>( ___________________  )</p>
			</center>
		</div>

		<div class="col-md-4 col-xs-4">
			<center style="float: right;">
			<p>Mengetahui :</p>
			<br/><br/>
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

	
	//print
	window.print();
    window.onafterprint = back;

    function back() {
        window.history.back();
    }

</script>
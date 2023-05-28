<script type="text/javascript">
	
	//attribut
	$('.back').removeAttr('hidden');
	$('#nomor').val('<?=$data[0]['penyesuaian_nomor']?>');
	$('#transaksi').val('<?=$data[0]['penyesuaian_transaksi']?>');
	$('#kategori').val('<?=$data[0]['penyesuaian_kategori']?>');
	$('#tanggal').val('<?=$data[0]['penyesuaian_tanggal']?>');
	$('#keterangan').val('<?=$data[0]['penyesuaian_keterangan']?>');

	//clone
	var n = '<?=count($data)?>';
	for (var i = 1; i < n; i++) {
		
		//clone
		clone();
	}

	//loop
	<?php $i = 1; ?>
	<?php foreach(@$data as $val): ?> 

		if ('<?= $val['penyesuaian_jenis'] ?>' == 'penjualan') {
			//penjualan
			$('#copy:nth-child(<?=$i?>) > td:nth-child(1) > select').val('<?=$val['penyesuaian_barang_barang']?>').change();
			$('#copy:nth-child(<?=$i?>) > td:nth-child(2) > select').val('<?=$val['penyesuaian_barang_jenis']?>');
			$('#copy:nth-child(<?=$i?>) > td:nth-child(3) > select').val('<?=$val['penyesuaian_barang_warna']?>');
			$('#copy:nth-child(<?=$i?>) > td:nth-child(4) > div > input').val('<?=$val['penyesuaian_barang_jumlah']?>');
			$('#copy:nth-child(<?=$i?>) > td:nth-child(5) > div > input').val('<?=$val['penyesuaian_barang_stok']?>');

		}else{
			//pembelian
			$('#copy:nth-child(<?=$i?>) > td:nth-child(1) > select').val('<?=$val['penyesuaian_barang_barang']?>').change();
			$('#copy:nth-child(<?=$i?>) > td:nth-child(2) > div > input').val('<?=$val['penyesuaian_barang_jumlah']?>');
			$('#copy:nth-child(<?=$i?>) > td:nth-child(3) > div > input').val('<?=$val['penyesuaian_barang_stok']?>');

		}

	<?php $i++; ?>
	<?php endforeach ?>

</script>
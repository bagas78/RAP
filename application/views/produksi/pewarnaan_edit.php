<script type="text/javascript">
	$('form').attr('action', '<?=base_url('produksi/'.@$url.'/'.@$data['pewarnaan_id'])?>');
	$('#nomor').val('<?=@$data['pewarnaan_nomor']?>');
	$('#jumlah').val('<?=@$data['pewarnaan_jumlah']?>');
	$('#hpp').val('<?=@$data['pewarnaan_hpp']?>');
	$('#hpp_total').val('<?=@$data['pewarnaan_hpp_total']?>');
	$('#produk').val('<?=@$data['pewarnaan_produk']?>').change();

	//penambahan stok saat ini dan stok edit
	var stok = parseInt($('#stok').text()) + <?=@$data['pewarnaan_jumlah']?>;
	$('#stok').text(stok);
</script>
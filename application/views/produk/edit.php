<script type="text/javascript">
	$('form').attr('action', '<?=base_url('produk/update/'.@$data['master_produk_id'])?>');;
	$('#kode').val('<?=@$data['master_produk_kode']?>');
	$('#nama').val('<?=@$data['master_produk_nama']?>');
	$('#pewarnaan').val('<?=@$data['master_produk_pewarnaan']?>').change();
	$('#harga').val('<?=@$data['master_produk_harga']?>');
	$('#satuan').val('<?=@$data['master_produk_satuan']?>').change();
	$('#merk').val('<?=@$data['master_produk_merk']?>');
	$('#ketebalan').val('<?=@$data['master_produk_ketebalan']?>');
	$('#panjang').val('<?=@$data['master_produk_panjang']?>');
	$('#lebar').val('<?=@$data['master_produk_lebar']?>');
	$('#berat').val('<?=@$data['master_produk_berat']?>');
	$('#keterangan').val('<?=@$data['master_produk_keterangan']?>');
</script>
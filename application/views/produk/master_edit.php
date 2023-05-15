<script type="text/javascript">
	$('form').attr('action', '<?=base_url('produk/master_update/'.@$data['produk_id'])?>');;
	$('#kode').val('<?=@$data['produk_kode']?>');
	$('#nama').val('<?=@$data['produk_nama']?>');
	$('#satuan').val('<?=@$data['produk_satuan']?>').change();
	$('#merk').val('<?=@$data['produk_merk']?>');
	$('#ketebalan').val('<?=@$data['produk_ketebalan']?>');
	$('#panjang').val('<?=@$data['produk_panjang']?>');
	$('#lebar').val('<?=@$data['produk_lebar']?>');
	//$('#berat').val('<?=@$data['produk_berat']?>');
	$('#keterangan').val('<?=@$data['produk_keterangan']?>');
	$('#colly').val('<?=@$data['produk_colly']?>');
</script>
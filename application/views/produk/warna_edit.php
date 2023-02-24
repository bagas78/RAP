<script type="text/javascript">
	$('form').attr('action', '<?=base_url('produk/warna_update/'.@$data['warna_id'])?>');;
	$('#kode').val('<?=@$data['warna_kode']?>');
	$('#jenis').val('<?=@$data['warna_jenis']?>').change();
	$('#nama').val('<?=@$data['warna_nama']?>');
	$('#keterangan').val('<?=@$data['warna_keterangan']?>');
</script>
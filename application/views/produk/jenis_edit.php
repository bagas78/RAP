<script type="text/javascript">
	$('form').attr('action', '<?=base_url('produk/jenis_update/'.@$data['warna_jenis_id'])?>');;
	$('#kode').val('<?=@$data['warna_jenis_kode']?>');
	$('#type').val('<?=@$data['warna_jenis_type']?>');
	$('#keterangan').val('<?=@$data['warna_jenis_keterangan']?>');
</script>
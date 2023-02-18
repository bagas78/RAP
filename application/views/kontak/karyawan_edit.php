<script type="text/javascript">
	$('form').attr('action', '<?=base_url('kontak/karyawan_update/'.@$data['karyawan_id'])?>');
	$('#nama').val('<?=@$data['karyawan_nama']?>');
	$('#telp').val('<?=@$data['karyawan_telp']?>');
	$('#alamat').val('<?=@$data['karyawan_alamat']?>').change();
</script>
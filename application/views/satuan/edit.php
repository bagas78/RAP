<script type="text/javascript">
	$('form').attr('action', '<?=base_url('satuan/update/'.@$data['satuan_id'])?>');
	$('.kepanjangan').val('<?=@$data['satuan_kepanjangan']?>');
	$('.singkatan').val('<?=@$data['satuan_singkatan']?>');
</script>
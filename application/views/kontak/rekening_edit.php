<script type="text/javascript">
	$('form').attr('action', '<?=base_url('kontak/rekening_update/'.@$data['rekening_id'])?>');
	$('#nama').val('<?=@$data['rekening_nama']?>');
	$('#rek').val('<?=@$data['rekening_no']?>');
	$('#bank').val('<?=@$data['rekening_bank']?>').change();
</script>
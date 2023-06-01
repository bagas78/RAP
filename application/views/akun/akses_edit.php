<script type="text/javascript">

$('form').attr('action', '<?=base_url('akun/akses_update/'.@$id)?>');

$('#nama').val('<?=$data['nama']?>');
	
<?php foreach(@$data as $key => $val): ?>

<?php if($val == 1): ?>

	$("input.radio[name='<?=$key?>']").click();

<?php endif ?>

<?php endforeach ?>

</script>
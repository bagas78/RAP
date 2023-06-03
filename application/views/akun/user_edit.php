<script type="text/javascript">
  
$('form').attr('action', '<?=base_url('akun/user_update/'.@$data['user_id'])?>'); 
$('#nama').val('<?=@$data['user_name'] ?>');
$('#email').val('<?=@$data['user_email'] ?>');
$("#pass").empty();
$("#re").empty();
$('.edit').text('* isi untuk mengganti');
$("#level").val('<?=@$data['user_level'] ?>').change();

</script>
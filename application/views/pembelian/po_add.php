<script>;

//atribut
$('form').attr('action', '<?=base_url('pembelian/po_save')?>');
$('#nomor').val('<?=@$nomor?>');
$('#tanggal').val('<?=date('Y-m-d')?>');
$('#previewImg').attr('src', '<?=base_url('assets/gambar/camera.png')?>');

</script>
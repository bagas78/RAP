
    <!-- Main content --> 
    <section class="content">

      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border">

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
         
          <form class="bg-alice" action="<?=base_url('kontak/update/'.$data['kontak_id'])?>" method="POST">
            
            <!--hidden-->
            <input type="hidden" name="jenis" value="<?=@$jenis?>">

            <div class="row">
              <div class="col-lg-6">
                <label>Kode <?= (@$jenis == 's')?'Supplier':'Pelanggan' ?></label>
                <input readonly="" type="text" name="kode" class="form-control" required value="<?=@$data['kontak_kode']?>">
              </div>
              <div class="col-lg-6">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" required value="<?=@$data['kontak_nama']?>">
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <label>Alamat</label>
                <input type="text" name="alamat" class="form-control" required value="<?=@$data['kontak_alamat']?>">
              </div>
              <div class="col-lg-6">
                <label>No. Telepon</label>
                <input type="number" name="tlp" class="form-control" required value="<?=@$data['kontak_tlp']?>">
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <label>Email</label>
                <input type="text" name="email" class="form-control" required value="<?=@$data['kontak_email']?>">
              </div>
              <div class="col-lg-6">
                <label>No. Rekening</label>
                <input type="number" name="rek" class="form-control" required value="<?=@$data['kontak_rek']?>">
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <label>Bank</label>
                <select id="bank" name="bank" class="form-control select2" required>
                  <option value="" hidden>-- Pilih --</option>
                  <?php foreach ($bank as $b): ?>
                    <option value="<?=@$b['bank_id']?>"><?=@$b['bank_nama']?></option>
                  <?php endforeach ?>
                </select>

                <script type="text/javascript">
                  $('#bank').val(<?=@$data['kontak_bank']?>).change();
                </script>

              </div>
              <div class="col-lg-6">
                <label>NPWP</label>
                <input type="text" name="npwp" class="form-control" required value="<?=@$data['kontak_npwp']?>">
              </div>
            </div>

            <br/>

            <button type="submit" class="btn btn-success">Simpan <i class="fa fa-check"></i></button>
            <a href="<?= @$_SERVER['HTTP_REFERER'] ?>"><button type="button" class="btn btn-danger">Batal <i class="fa fa-times"></i></button></a>

          </form>

        </div>

        
      </div>
      <!-- /.box -->
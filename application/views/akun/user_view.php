
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

          <center>
            <img width="150" class="img-thumbnail" src="<?= (@$data['user_foto']) ? base_url('assets/gambar/user/').@$data['user_foto'] : base_url('assets/gambar/user/no.jpg') ?>">
          </center>
          <br/>

          <table class="table">
            <tr>
              <td>Nama</td>
              <td>: <?=@$data['user_name']?></td>
            </tr>
            <tr>
              <td>Tempat Tanggal Lahir</td>
              <td>: <?=@$data['user_ttl']?></td>
            </tr>
            <tr>
              <td>Email</td>
              <td>: <?=@$data['user_email']?></td>
            </tr>
            <tr>
              <td>No. Telepon</td>
              <td>: <?=@$data['user_nohp']?></td>
            </tr>
            <tr>
              <td>Alamat</td>
              <td>: <?=@$data['user_alamat']?></td>
            </tr>
             <tr>
              <td>Level</td>
              <td>: <?=@$data['level_nama']?></td>
            </tr>
            <tr>
              <td>Biodata</td>
              <td>: <?=@$data['user_biodata']?></td>
            </tr>
          </table>

          <br/><hr>

          <a href="<?= $_SERVER['HTTP_REFERER'] ?>"><button type="button" class="btn btn-primary"><i class="fa fa-angle-double-left"></i> Kembali</button></a>

        </div>
      </div>
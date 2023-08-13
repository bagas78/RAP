
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

          <table class="table table-bordered" style="width: 100%;">
            <thead>
              <tr>
                <td rowspan="2">Normal Akun</td>
                <td colspan="2" align="center">Mutasi</td>
              </tr>
              <tr>
                <td style="background: lightgreen;"><i class="fa fa-plus"></i></td>
                <td style="background: pink;"><i class="fa fa-minus"></i></td>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($normal_data as $v): ?>
              <tr>
                <td><?=@$v['akun_normal_nama']?></td>
                <td><?=@$v['akun_normal_plus']?></td>
                <td><?=@$v['akun_normal_min']?></td>
              </tr>
              <?php endforeach ?>
            </tbody>
          </table>
          
          <div class="clearfix"></div><br/>

          <table class="table table-bordered table-hover" style="width: 100%;">
                <thead>
                <tr>
                  <td rowspan="2">Akun</td>
                  <td rowspan="2">Normal Akun</td>
                  <td colspan="2" align="center">Mutasi</td>
                </tr>
                <tr>
                  <td style="background: lightgreen;"><i class="fa fa-plus"></i></td>
                  <td style="background: pink;"><i class="fa fa-minus"></i></td>
                </tr>
                </thead>
                <tbody>
                  <?php foreach (@$akun_data as $val): ?>
                    <tr>
                      <td><?=@$val['akun_nama']?></td>
                      <td><?=@$val['akun_normal_nama']?></td>
                      <td><?=@$v['akun_normal_plus']?></td>
                      <td><?=@$v['akun_normal_min']?></td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>

        </div>

        
      </div>
      <!-- /.box -->

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
          
          <table id="example" class="table table-bordered table-hover" style="width: 100%;">
                <thead>
                <tr>
                  <th width="1">Nomor</th>
                  <th>Akun</th>
                  <th>Normal Akun</th>
                  <th>Plus (+)</th>
                  <th>Min (-)</th>
                </tr>
                </thead>
                <tbody>
                  <?php foreach ($data as $val): ?>
                    <tr>
                      <td><?=@$val['coa_nomor']?></td>
                      <td><?=@$val['coa_akun']?></td>
                      <td><?=@$val['coa_sub_akun'].' ( '.@$val['coa_sub_nomor'].' ) '?></td>
                      <td><?= (@$val['coa_sub_plus'] == 'K')?'<span style="background: papayawhip; padding: 2%;" span>Kredit</span>':'<span style="background: lightgreen; padding: 2%;">Debit</span>'?></td>
                      <td><?= (@$val['coa_sub_min'] == 'K')?'<span style="background: papayawhip; padding: 2%;" span>Kredit</span>':'<span style="background: lightgreen; padding: 2%;">Debit</span>'?></td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>

        </div>

        
      </div>
      <!-- /.box -->
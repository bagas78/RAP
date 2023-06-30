
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
                <td rowspan="2" width="1">Nomor</td>
                <td rowspan="2">Normal Akun</td>
                <td colspan="2" align="center">Mutasi</td>
              </tr>
              <tr>
                <td style="background: lightgreen;"><i class="fa fa-plus"></i></td>
                <td style="background: pink;"><i class="fa fa-minus"></i></td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>111</td>
                <td>Modal</td>
                <td>Kredit</td>
                <td>Debit</td>
              </tr>
              <tr>
                <td>121</td>
                <td>Harta</td>
                <td>Debit</td>
                <td>Kredit</td>
              </tr>
              <tr>
                <td>131</td>
                <td>Utang</td>
                <td>Kredit</td>
                <td>Debit</td>
              </tr>
              <tr>
                <td>141</td>
                <td>Pendapatan</td>
                <td>Kredit</td>
                <td>Debit</td>
              </tr>
              <tr>
                <td>151</td>
                <td>Beban</td>
                <td>Debit</td>
                <td>Kredit</td>
              </tr>
            </tbody>
          </table>
          
          <div class="clearfix"></div><br/>

          <table class="table table-bordered table-hover" style="width: 100%;">
                <thead>
                <tr>
                  <th width="1">Nomor</th>
                  <th>Akun</th>
                  <th>Normal Akun</th>
                </tr>
                </thead>
                <tbody>
                  <?php foreach ($data as $val): ?>
                    <tr>
                      <td><?=@$val['coa_nomor']?></td>
                      <td><?=@$val['coa_akun']?></td>
                      <td><?=@$val['coa_sub_akun']?></td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>

        </div>

        
      </div>
      <!-- /.box -->
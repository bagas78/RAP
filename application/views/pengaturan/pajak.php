
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
         
          <table class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Jenis Pajak</th>
                  <th>Persentase</th>
                  <th>Last Update</th>
                  <th width="1">Action</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($data as $key): ?>
                                  
                  <tr>
                    <td><?= $key['pajak_jenis'] ?></td>
                    <td><?= $key['pajak_persen'].'%' ?></td>
                    <td><?= $key['pajak_update'] ?></td>
                    <td style="width: 100px;">
                      <div>
                      <button class="btn btn-xs btn-primary pajak_add" data-toggle="modal" data-target="#modal-edit<?= $key['pajak_id'] ?>"><i class="fa fa-edit"></i></button>

                      </div>
                    </td>
                  </tr>

                  <div class="modal fade" id="modal-edit<?= $key['pajak_id'] ?>">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Edit Data</h4>
                        </div>
                        <div class="modal-body">
                          <form role="form" method="post" action="<?= base_url() ?>pengaturan/pajak_update/<?= $key['pajak_id'] ?>" enctype="multipart/form-data">
                            <div class="box-body">
                              <div class="form-group">
                                <label>Jenis Pajak</label>
                                <input readonly="" type="text" class="form-control" value="<?=@$key['pajak_jenis'] ?>">
                              </div>
                              <div class="form-group">
                                <label>Persentase (%)</label>
                                <input required="" type="text" name="persen" class="form-control" value="<?=@$key['pajak_persen'] ?>">
                              </div>
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                              <button type="submit" class="btn btn-success">Submit <i class="fa fa-check"></i></button>
                               <button type="reset" class="btn btn-danger">Reset <i class="fa fa-times"></i></button>
                            </div>
                          </form>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal -->

                <?php endforeach ?>

                </tfoot>
              </table>

        </div>

        
      </div>
      <!-- /.box -->
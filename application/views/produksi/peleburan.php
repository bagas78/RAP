
    <!-- Main content --> 
    <section class="content">

      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border">
 
            <div align="left">
              <a href="<?= base_url('produksi/peleburan_add') ?>"><button class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button></a>
            </div>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          
          <table id="example" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th>Nomor</th>
              <th>Jumlah Billet</th>
              <th>Tanggal Peleburan</th>
              <th width="10">Action</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
          </table>

          <div class="col-md-6 row">
            <table class="table table-bordered">
              <tr>
                <td style="background: cornsilk;">Stok Billet</td>
                <td><?=$total['billet_stok'].' pcs'?></td>
              </tr>
              <tr>
                <td style="background: ghostwhite;">Terakir Di Tambah</td>
                <td><?php $date = date_create($total['billet_update']); echo date_format($date,'d/m/Y');?></td>
              </tr>
            </table>
          </div>

        </div>

        
      </div>
      <!-- /.box -->

<script type="text/javascript">
    var table;
    $(document).ready(function() {

        //datatables
        table = $('#example').DataTable({ 

            "processing": true, 
            "serverSide": true,
            "order":[],  
            
            "ajax": {
                "url": "<?=site_url('produksi/peleburan_get_data')?>",
                "type": "GET"
            },
            "columns": [                               
                        { "data": "peleburan_nomor"},
                        { "data": "peleburan_billet",
                        "render":
                        function( data ){
                          return data+" pcs";
                        }
                        },
                        { "data": "peleburan_tanggal",
                        "render":
                        function( data ){
                          return "<span>"+moment(data).format("DD/MM/YYYY")+"</span>";
                        }
                        },
                        { "data": "peleburan_id",
                        "render": 
                        function( data ) {
                            return "<a href='<?php echo base_url('produksi/peleburan_edit/')?>"+data+"'><button class='btn btn-xs btn-primary'><i class='fa fa-edit'></i></button></a> "+
                            "<button onclick=del('<?php echo base_url('produksi/peleburan_delete/')?>"+data+"') class='btn btn-xs btn-danger'><i class='fa fa-trash'></i></button>";
                          }
                        },
                        
                    ],
        });

    });
</script>
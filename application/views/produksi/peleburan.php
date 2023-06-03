
<style type="text/css">
  .notice{
    background: crimson;
    color: white;
    padding: 1%;
  }
</style>

    <!-- Main content --> 
    <section class="content">

      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border">
 
            <div align="left" class="peleburan_add">
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
          
          <table id="example" class="table table-bordered table-hover" style="width: 100%;">
            <thead>
            <tr>
              <th>Nomor</th>
              <th>Jumlah Billet</th>
              <th>Biaya Produksi</th>
              <th>Tanggal Peleburan</th>
              <th width="10">Action</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
          </table>

          <div class="col-md-6 row">

            <br/><br/>

            <span class="notice"><i class="fa fa-info-circle"></i> Stok Billet Terbaru Setelah Produksi</span>
            <div class="clearfix"></div><br/>

            <table class="table table-bordered">
              <tr>
                <td style="background: cornsilk;">Stok Billet</td>
                <td><?=number_format(@$total['billet_stok']).' Kg'?></td>
              </tr>
              <tr>
                <td style="background: cornsilk;">Di Gunakan</td>
                <td><?=number_format(@$total['billet_min']).' Kg'?></td>
              </tr>
              <tr>
                <td style="background: cornsilk;">Sisa Produksi</td>
                <td><?=number_format(@$total['billet_sisa']).' Kg'?></td>
              </tr>
              <tr>
                <td style="background: cornsilk;">Harga Pokok Satuan ( HPS )</td>
                <td><?='Rp. '.number_format(@$total['billet_hps'])?></td>
              </tr>
              <tr>
                <td style="background: cornsilk;">Harga Pokok Produksi ( HPP )</td>
                <td><?='Rp. '.number_format(@$total['billet_hpp'])?></td>
              </tr>
              <tr>
                <td style="background: ghostwhite;">Terakir Di Tambah</td>
                <td><?php $date = date_create(@$total['billet_update']); echo date_format($date,'d/m/Y');?></td>
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
            "scrollX": true,  
            
            "ajax": {
                "url": "<?=site_url('produksi/peleburan_get_data')?>",
                "type": "GET"
            },
            "columns": [                               
                        { "data": "peleburan_nomor"},
                        { "data": "peleburan_billet",
                        "render":
                        function( data ){
                          return data+" Kg";
                        }
                        },
                        { "data": "peleburan_biaya",
                        "render":
                        function(data) {
                          return 'Rp. '+number_format(data);
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
                            return "<a href='<?php echo base_url('produksi/peleburan_view/')?>"+data+"'><button class='btn btn-xs btn-success'><i class='fa fa-eye'></i></button></a> "+
                            "<a hidden href='<?php echo base_url('produksi/peleburan_edit/')?>"+data+"'><button class='btn btn-xs btn-primary peleburan_add'><i class='fa fa-edit'></i></button></a> "+
                            "<button onclick=del('<?php echo base_url('produksi/peleburan_delete/')?>"+data+"') class='btn btn-xs btn-danger peleburan_del'><i class='fa fa-trash'></i></button>";
                          }
                        },
                        
                    ],
        });

    });
</script>

    <!-- Main content --> 
    <section class="content">
 
      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border">
 
            <div align="left">
              <a href="<?= base_url('penjualan/'.@$url.'_add') ?>"><button class="btn-tambah btn btn-primary"><i class="fa fa-plus"></i> Tambah</button></a>
               <button onclick="filter('l')" class="btn-lunas btn btn-default"><i class="fa fa-filter"></i> Lunas</button>
              <button onclick="filter('b')" class="btn-belum btn btn-default"><i class="fa fa-filter"></i> Belum Lunas</button>
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
                  <th>Pelanggan</th>
                  <th>Jatuh Tempo</th>
                  <th>Status</th>
                  <th width="1">Lihat</th>
                  <th class="action" width="80">Action</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
              </table>

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
                "url": "<?=site_url('penjualan/'.@$url.'_get_data')?>",
                "type": "GET"
            },
            "columns": [                               
                        { "data": "penjualan_nomor"},
                        { "data": "kontak_nama"},
                        { "data": "penjualan_jatuh_tempo",
                        "render": 
                        function( data ) {
                            return "<span>"+moment(data).format("DD/MM/YYYY")+"</span>";
                          }
                        },
                        { "data": "penjualan_status",
                        "render": 
                        function( data ) {
                            if (data == 'l') {var s = 'Lunas';} else {var s = 'Belum Lunas';}
                            return "<span>"+s+"</span>";
                          }
                        },
                        { "data": "penjualan_id",
                        "render": 
                        function( data ) {
                            return "<a class='view' href='<?php echo base_url('penjualan/'.@$url.'_view/')?>"+data+"'><button class='btn btn-xs btn-default'>Detail <i class='fa fa-eye'></i></button></a>";
                          }
                        },
                        { "data": "penjualan_id",
                        "render": 
                        function( data ) {
                            return "<a class='edit' href='<?php echo base_url('penjualan/'.@$url.'_edit/')?>"+data+"'><button class='btn btn-xs btn-primary'><i class='fa fa-edit'></i></button></a> "+
                            "<button onclick=del('<?php echo base_url('penjualan/'.@$url.'_delete/')?>"+data+"') class='del btn btn-xs btn-danger'><i class='fa fa-trash'></i></button> "+
                            "<a class='faktur' href='<?php echo base_url('penjualan/faktur/')?>"+data+"'><button class='btn btn-xs btn-warning'><i class='fa fa-file-text'></i></button></a> "+
                            "<a class='kirim' href='<?php echo base_url('penjualan/kirim_barang/')?>"+data+"'><button class='btn btn-xs btn-success'><i class='fa fa-truck'></i></button></a> "+
                             "<a class='surat' href='<?php echo base_url('penjualan/surat/')?>"+data+"'><button class='btn btn-xs btn-info'><i class='fa fa-truck'></i></button></a>";
                          }
                        },
                        
                    ],
            });

        });

function filter($val){
  var table = $('#example').DataTable();
  table.search($val).draw();
}

function re(){
  //remove button
  if('<?= @$url ?>' == 'kirim'){
    $('.edit').remove();
    $('.del').remove();
    $('.faktur').remove();
    $('.kirim').remove();
    $('.btn-tambah').remove();
    $('.btn-lunas').remove();
    $('.btn-belum').remove();

    //width
    $('.action').css('width', '10px');
  }
  if('<?= @$url ?>' == 'packing'){
    $('.surat').remove();
    $('.faktur').remove();

    //width
    $('.action').css('width', '60px');
  }
  if('<?= @$url ?>' == 'produk' || '<?= @$url ?>' == 'po'){
    $('.faktur').remove();
    $('.kirim').remove();
    $('.surat').remove();
    $('.faktur').remove();

    //width
    $('.action').css('width', '10px');
  }
}

function auto(){

    re();

    setTimeout(function() {
        auto();
    }, 100);
  }

  auto();
 
</script>
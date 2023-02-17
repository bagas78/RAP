
    <!-- Main content --> 
    <section class="content">

      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border">
 
            <div align="left">
              <a href="<?= base_url('produk/master_add') ?>"><button class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button></a>
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
                  <th>Kode</th>
                  <th>Nama</th>
                  <th>Jenis</th>
                  <th>Warna</th>
                  <th>Stok</th>
                  <th>Satuan</th>
                  <th>Harga Pokok Satuan</th>
                  <th>Harga Jual Satuan</th>
                  <th width="50">Action</th>
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
            "scrollX": true, 
            "order":[],  
            
            "ajax": {
                "url": "<?=site_url('produk/master_get_data') ?>",
                "type": "GET"
            },
            "columns": [                               
                        { "data": "master_produk_kode"},
                        { "data": "master_produk_nama"},
                        { "data": "pewarnaan_jenis_type"},
                        { "data": "warna_nama"},
                        { "data": "master_produk_stok"},
                        { "data": "satuan_singkatan"},
                        { "data": "master_produk_hps",
                        "render":
                        function( data ) {
                          if(data == ''){s = '-';}else{s = number_format(data);}
                          return "<span>"+s+"</span>";
                        }
                        },
                        { "data": "master_produk_harga",
                        "render":
                        function( data ) {
                          return "<span>"+number_format(data)+"</span>";
                        }
                        },
                        { "data": "master_produk_id",
                        "render": 
                        function( data ) {
                            return "<a href='<?php echo base_url('produk/master_edit/')?>"+data+"'><button class='btn btn-xs btn-primary'><i class='fa fa-edit'></i></button></a> "+
                            "<button onclick=del('<?php echo base_url('produk/master_delete/')?>"+data+"') class='btn btn-xs btn-danger'><i class='fa fa-trash'></i></button>";
                          }
                        },
                        
                    ],
        });

    });
</script>

    <!-- Main content --> 
    <section class="content">
 
      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border">
 
            <div align="left">
              <button onclick="filter('avalan')" class="btn btn-default"><i class="fa fa-filter"></i> Bahan Avalan</button>
              <button onclick="filter('utama')" class="btn btn-default"><i class="fa fa-filter"></i> Bahan Baku Utama</button>
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
                  <th>Supplier</th>
                  <th>Jatuh Tempo</th>
                  <th>Kategori</th>
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
            "order":[], 
            "scrollX": true, 
            
            "ajax": {
                "url": "<?=site_url('pembelian/bayar_get_data')?>",
                "type": "GET"
            },
            "columns": [                               
                        { "data": "pembelian_nomor"},
                        { "data": "kontak_nama"},
                        { "data": "pembelian_jatuh_tempo",
                        "render": 
                        function( data ) {
                            return "<span>"+moment(data).format("DD/MM/YYYY")+"</span>";
                          }
                        },
                        { "data": "pembelian_kategori",
                        "render": 
                        function( data ) {
                            if (data == 'avalan') {var s = 'Bahan Avalan';} else {var s = 'Bahan Baku Utama';}
                            return "<span>"+s+"</span>";
                          }
                        },
                        { "data": "pembelian_id",
                        "render": 
                        function( data ) {
                            return "<button onclick=bayar('<?php echo base_url('pembelian/bayar_rotate/')?>"+data+"') class='btn btn-xs btn-success'><i class='fa fa-exchange'></i></button> "+
                            "<a href='<?php echo base_url('pembelian/bayar_edit/')?>"+data+"'><button class='btn btn-xs btn-primary'><i class='fa fa-edit'></i></button></a>";
                          }
                        },
                        
                    ],
        });

    });

function filter($val){
  var table = $('#example').DataTable();
  table.search($val).draw();
}

function bayar(url){
    swal({
      title: "Apa kamu yakin?",
      text: "Bayar Lunas Transaksi Ini ?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
  
        $(location).attr('href',url);
        
      }
    });
  }
 
</script>
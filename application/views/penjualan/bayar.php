
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
                  <th>Nomor</th>
                  <th>Supplier</th>
                  <th>Jatuh Tempo</th>
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
                "url": "<?=site_url('penjualan/bayar_get_data')?>",
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
                        { "data": "penjualan_id",
                        "render": 
                        function( data ) {
                            return "<button onclick=bayar('<?php echo base_url('penjualan/bayar_rotate/')?>"+data+"') class='btn btn-xs btn-success'><i class='fa fa-exchange'></i></button> "+
                            "<a href='<?php echo base_url('penjualan/bayar_edit/')?>"+data+"'><button class='btn btn-xs btn-primary'><i class='fa fa-edit'></i></button></a>";
                          }
                        },
                        
                    ],
        });

    });

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
<style type="text/css">
  .tit{
    font-size: 20px;
    background: #343a40;
    width: fit-content;
    color: white;
    padding: 0.5%;
    font-weight: 800;
  } 
</style>

<!-- Main content -->  
<section class="content"> 

  <div class="box">
    <div class="box-header with-border">

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
    </div>
    <div class="box-body">
  
      <span class="tit">Stok Bahan Baku</span>
      
      <table id="example1" class="table table-responsive table-borderless">
        <thead>
          <tr>
            <th>Bahan</th>
            <th width="1">Stok</th>
            <th width="1">Satuan</th>
          </tr>
        </thead>
      </table>

      <br/><hr>

      <span class="tit">Stok Produk</span>
      
      <table id="example2" class="table table-responsive table-borderless">
        <thead>
          <tr>
            <th>Produk</th>
            <th>Warna</th>
            <th width="1">Stok</th>
            <th width="1">Satuan</th>
          </tr>
        </thead>
      </table> 

    </div>
  </div>

  <div class="box">
    <div class="box-header with-border">

      <div class="col-md-1 col-xs-1">
        <form method="POST" action="">
          <input type="hidden" name="filter" value="1">
          <button type="submit" class="btn btn-default <?=(@$filter == 1)?'active':'' ?>">Harian <i class="fa fa-filter"></i></button>
        </form>
      </div>
      <div class="col-md-1 col-xs-1">
        <form method="POST" action="">
          <input type="hidden" name="filter" value="2">
          <button type="submit" class="btn btn-default <?=(@$filter == 2)?'active':'' ?>">Bulanan <i class="fa fa-filter"></i></button>
        </form>
      </div>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
    </div>
    <div class="box-body">

      <div id="chartContainer" style="height: 300px; width: 100%;"></div>

    </div>
  </div>

<script type="text/javascript">
  var table1;
    $(document).ready(function() {

        //datatables
        table1 = $('#example1').DataTable({ 

            "searching"     : false,
            "bLengthChange" : false,
            "info"          : false,
            "pageLength"    : 5,
            "processing"    : true, 
            "serverSide"    : true,
            "order"         :[],
            
            "ajax": {
                "url": "<?=site_url('pembelian/bahan_get_data') ?>",
                "type": "GET"
            },
            "columns": [  
                        { "data": "bahan_nama"},
                        { "data": "bahan_stok",
                        "render":
                        function(data) {
                          return "<span>"+number_format(data)+"</span>";
                        }},
                        { "data": "satuan_singkatan"},
                        
                    ],
        });

    });

  var table2;
    $(document).ready(function() {

        //datatables
        table1 = $('#example2').DataTable({ 
            
            "searching"     : false,
            "bLengthChange" : false,
            "info"          : false,
            "pageLength"    : 5,
            "processing"    : true, 
            "serverSide"    : true,
            "order"         :[],
            
            "ajax": {
                "url": "<?=site_url('dashboard/produk') ?>",
                "type": "GET"
            },
            "columns": [  
                        { "data": "produk_nama"},
                        { "data": "warna_nama"},
                        { "data": "produk_barang_stok",
                        "render":
                        function(data) {
                          return "<span>"+number_format(data)+"</span>";
                        }},
                        { "data": "satuan_singkatan"},
                        
                    ],
        });

    });

</script>

<script>
window.onload = function () {

var options = {
  theme: "light2",
  exportEnabled: false,
  animationEnabled: true,
  title:{
    text: "Grafik Pembelian | Produksi | Penjualan Tahun <?=date('Y')?>"
  },
  subtitles: [{
    text: ""
  }],
  axisX: {
    title: ""
  },
  axisY: {
    title: "",
    titleFontColor: "#4F81BC",
    lineColor: "#4F81BC",
    labelFontColor: "#4F81BC",
    tickColor: "#4F81BC"
  },
  axisY2: {
    title: "",
    titleFontColor: "#C0504E",
    lineColor: "#C0504E",
    labelFontColor: "#C0504E",
    tickColor: "#C0504E"
  },
  axisY3: {
    title: "",
    titleFontColor: "#C0504E",
    lineColor: "#C0504E",
    labelFontColor: "#C0504E",
    tickColor: "#C0504E"
  },
  toolTip: {
    shared: true
  },
  legend: {
    cursor: "pointer",
    itemclick: toggleDataSeries
  },
  data: [{
    type: "spline",
    name: "Pembelian",
    showInLegend: true,
    xValueFormatString: "<?=(@$filter == 1)?'DD MMMM YYYY':'MMMM YYYY' ?>",
    yValueFormatString: "Rp #,##0.#",
    dataPoints: [

      <?php foreach($pembelian_data as $p): ?>

        { x: new Date(<?=$p['tahun'].','.$p['bulan'].','.$p['tanggal']?>),  y: <?=$p['total']?> },

      <?php endforeach ?>
    
    ]
  },
  {
    type: "spline",
    name: "Produksi",
    axisYType: "secondary",
    showInLegend: true,
    xValueFormatString: "<?=(@$filter == 1)?'DD MMMM YYYY':'MMMM YYYY' ?>",
    yValueFormatString: "Rp #,##0.#",
    dataPoints: [
      
      <?php foreach($produksi_data as $p): ?>

        { x: new Date(<?=$p['tahun'].','.$p['bulan'].','.$p['tanggal']?>),  y: <?=$p['total']?> },

      <?php endforeach ?>

    ]
  },
  {
    type: "spline",
    name: "Penjualan",
    axisYType: "secondary",
    showInLegend: true,
    xValueFormatString: "<?=(@$filter == 1)?'DD MMMM YYYY':'MMMM YYYY' ?>",
    yValueFormatString: "Rp #,##0.#",
    dataPoints: [
      
      <?php foreach($penjualan_data as $p): ?>

        { x: new Date(<?=$p['tahun'].','.$p['bulan'].','.$p['tanggal']?>),  y: <?=$p['total']?> },

      <?php endforeach ?>

    ]
  }]
};

$("#chartContainer").CanvasJSChart(options);

function toggleDataSeries(e) {
  if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
    e.dataSeries.visible = false;
  } else {
    e.dataSeries.visible = true;
  }
  e.chart.render();
}

}

</script>

<script src="https://cdn.canvasjs.com/jquery.canvasjs.min.js"></script>
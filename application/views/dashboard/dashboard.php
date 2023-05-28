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
      
      <table id="example1" class="table table-responsive table-bordered">
        <thead>
          <tr>
            <th>Bahan</th>
            <th>Stok</th>
            <th>Satuan</th>
          </tr>
        </thead>
      </table>

      <br/><hr>

      <span class="tit">Stok Produk</span>
      
      <table id="example2" class="table table-responsive table-bordered">
        <thead>
          <tr>
            <th>Produk</th>
            <th>Stok</th>
            <th>Satuan</th>
          </tr>
        </thead>
      </table> 

    </div>
  </div>

  <div class="box">
    <div class="box-header with-border">

      <button class="btn btn-default active">Harian <i class="fa fa-filter"></i></button>
      <button class="btn btn-default">Mingguan <i class="fa fa-filter"></i></button>
      <button class="btn btn-default">Bulanan <i class="fa fa-filter"></i></button>

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
            "info"          :     false,
            "pageLength"    : 5,
            "processing"    : true, 
            "serverSide"    : true,
            "order"         :[],  
            "scrollX"       : true,
            
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
            "info"          :     false,
            "pageLength"    : 5,
            "processing"    : true, 
            "serverSide"    : true,
            "order"         :[],  
            "scrollX"       : true,
            
            "ajax": {
                "url": "<?=site_url('produk/master_get_data') ?>",
                "type": "GET"
            },
            "columns": [  
                        { "data": "produk_nama"},
                        { "data": "stok",
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
    text: "Grafik Pembelian | Produksi | Penjualan"
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
    xValueFormatString: "MMM YYYY",
    yValueFormatString: "Rp #,##0.#",
    dataPoints: [
      { x: new Date(2016, 0, 1),  y: 120 },
      { x: new Date(2016, 1, 1), y: 135 },
      { x: new Date(2016, 2, 1), y: 144 },
      { x: new Date(2016, 3, 1),  y: 103 },
      { x: new Date(2016, 4, 1),  y: 93 },
      { x: new Date(2016, 5, 1),  y: 129 },
      { x: new Date(2016, 6, 1), y: 143 },
      { x: new Date(2016, 7, 1), y: 156 },
      { x: new Date(2016, 8, 1),  y: 122 },
      { x: new Date(2016, 9, 1),  y: 106 },
      { x: new Date(2016, 10, 1),  y: 137 },
      { x: new Date(2016, 11, 1), y: 142 }
    ]
  },
  {
    type: "spline",
    name: "Produksi",
    axisYType: "secondary",
    showInLegend: true,
    xValueFormatString: "MMM YYYY",
    yValueFormatString: "Rp #,##0.#",
    dataPoints: [
      { x: new Date(2016, 0, 1),  y: 19034.5 },
      { x: new Date(2016, 1, 1), y: 20015 },
      { x: new Date(2016, 2, 1), y: 27342 },
      { x: new Date(2016, 3, 1),  y: 20088 },
      { x: new Date(2016, 4, 1),  y: 20234 },
      { x: new Date(2016, 5, 1),  y: 29034 },
      { x: new Date(2016, 6, 1), y: 30487 },
      { x: new Date(2016, 7, 1), y: 32523 },
      { x: new Date(2016, 8, 1),  y: 20234 },
      { x: new Date(2016, 9, 1),  y: 27234 },
      { x: new Date(2016, 10, 1),  y: 33548 },
      { x: new Date(2016, 11, 1), y: 32534 }
    ]
  },
  {
    type: "spline",
    name: "Penjualan",
    axisYType: "secondary",
    showInLegend: true,
    xValueFormatString: "MMM YYYY",
    yValueFormatString: "Rp #,##0.#",
    dataPoints: [
      { x: new Date(2016, 0, 1),  y: 39034.5 },
      { x: new Date(2016, 1, 1), y: 10015 },
      { x: new Date(2016, 2, 1), y: 17342 },
      { x: new Date(2016, 3, 1),  y: 50088 },
      { x: new Date(2016, 4, 1),  y: 60234 },
      { x: new Date(2016, 5, 1),  y: 59034 },
      { x: new Date(2016, 6, 1), y: 20487 },
      { x: new Date(2016, 7, 1), y: 12523 },
      { x: new Date(2016, 8, 1),  y: 30234 },
      { x: new Date(2016, 9, 1),  y: 67234 },
      { x: new Date(2016, 10, 1),  y: 83548 },
      { x: new Date(2016, 11, 1), y: 12534 }
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
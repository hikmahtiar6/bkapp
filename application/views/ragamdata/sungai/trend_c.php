<h3 align="center"><?php echo $dt['parameter'] ?></h3>
<canvas id="barChart" height="300"></canvas>


<p>
<div style="width:20px;height:20px;background:#33CCFF; float:left; margin-right:10px;"></div> Musim Kemarau
<div style="margin-left:5em; display:inline-block"> Baku Mutu : <?php echo $bakumutu ?></div>
<p/>
<p><div style="width:20px;height:20px;background:#007D00; float:left; margin-right:10px;"></div> Musim Penghujan<p/>

<!-- ChartJS 1.0.1 -->
<script src="<?php echo base_url() ?>assets/plugins/chartjs/Chart.min.js" type="text/javascript"></script>
<!-- page script -->
<script>
  $(function () {

    var areaChartData = {
      labels: [

      <?php
      echo $thn;
      ?>
      ],

      datasets: [
        {
          label: "Musim Kemarau",
          fillColor: "#33CCFF",
          strokeColor: "#33CCFF",
          pointColor: "#33CCFF",
          data: [
          <?php
            echo $periode_satu;
          ?>
          ]
        },
        {
          label: "Musim Penghujan",
          fillColor: "#007D00",
          strokeColor: "#007D00",
          pointColor: "#007D00",
          data: [
          <?php
          	echo $periode_dua;
            
          ?>
          ]
        }
      ]
    };

    var barChartCanvas = $("#barChart").get(0).getContext("2d");
    var barChart = new Chart(barChartCanvas);
    var barChartData = areaChartData;
    var barChartOptions = {
      scaleBeginAtZero: true,
      scaleShowGridLines: true,
      scaleGridLineColor: "rgba(0,0,0,0.2)",
      scaleGridLineWidth: 1,
      scaleShowHorizontalLines: true,
      scaleShowVerticalLines: true,
      barShowStroke: true,
      barStrokeWidth: 1,
      barValueSpacing: 7,
      barDatasetSpacing: 1,
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
      responsive: true,
      maintainAspectRatio: false
    };

    barChartOptions.datasetFill = false;
    barChart.Bar(areaChartData, barChartOptions);
  });
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <?php echo $title ?>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li>Pengelolaan Lingkungan Hidup</li>
    <li class="active"><?php echo $title ?></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- BAR CHART -->
      <div class="box box-success">
        <div class="box-header with-border">
          <form class="box-title" method="get" action="<?php echo site_url('adm_sungai/chart') ?>">
            <select name="tahun">
              <option value="">- Pilih Tahun -</option>
              <?php
              foreach ($tahun->result() as $t) {
                $s = '';
                if($t->tahunuji_sungai==$this->input->get('tahun')) {
                  $s = 'selected';
                }
                echo '<option value="'.$t->tahunuji_sungai.'" '.$s.'>'.$t->tahunuji_sungai.'</option>';
              }
              ?>
            </select>
            <select name="parameter">
              <option value="">- Pilih Parameter -</option>
              <?php
              foreach ($parameter->result() as $t) {
                $s = '';
                if($t->par_sungai_situ_id==$this->input->get('parameter')) {
                  $s = 'selected';
                }
                echo '<option value="'.$t->par_sungai_situ_id.'" '.$s.'>'.$t->parameter.'</option>';
              }
              ?>
            </select>
            <button type="submit" name="filter" value="go">Filter</button>
          </form>
        </div>
        <div class="box-body">
          <h3 align="center"><?php echo $dt->parameter ?></h3>
          <canvas id="barChart" height="330"></canvas>
        </div><!-- /.box-body -->
      </div><!-- /.box -->

    </div><!-- /.col (RIGHT) -->
  </div><!-- /.row -->
  <!-- ChartJS 1.0.1 -->
    <script src="<?php echo base_url() ?>assets/plugins/chartjs/Chart.min.js" type="text/javascript"></script>
  <!-- page script -->
    <script>
      $(function () {
        /* ChartJS
         * -------
         * Here we will create a few charts using ChartJS
         */

        var areaChartData = {
          labels: [
          <?php
          foreach ($lokasi->result() as $l) {
            echo '"'.$l->nama_lokasi.'",';
          }
          ?>
          ],
          datasets: [
            {
              label: "Periode I",
              fillColor: "rgba(210, 214, 222, 1)",
              strokeColor: "rgba(210, 214, 222, 1)",
              pointColor: "rgba(210, 214, 222, 1)",
              pointStrokeColor: "#c1c7d1",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(220,220,220,1)",
              data: [
              <?php
              foreach ($lokasi->result() as $l) {
                echo hasil_uji_sungai(array('lokasiuji_sungai_id'=>$l->lokasiuji_sungai_id,'periode'=>0,'tahunuji_sungai'=>$thn,'b.par_sungai_situ_id'=>$idp));
                echo ","; 
              }
              ?>
              ]
            },
            {
              label: "Periode II",
              fillColor: "rgba(60,141,188,0.9)",
              strokeColor: "rgba(60,141,188,0.8)",
              pointColor: "#3b8bba",
              pointStrokeColor: "rgba(60,141,188,1)",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(60,141,188,1)",
              data: [
              <?php
              foreach ($lokasi->result() as $l) {
                echo hasil_uji_sungai(array('lokasiuji_sungai_id'=>$l->lokasiuji_sungai_id,'periode'=>1,'tahunuji_sungai'=>$thn,'b.par_sungai_situ_id'=>$idp));
                echo ","; 
              }
              ?>
              ]
            }
          ]
        };

        //-------------
        //- BAR CHART -
        //-------------
        var barChartCanvas = $("#barChart").get(0).getContext("2d");
        var barChart = new Chart(barChartCanvas);
        var barChartData = areaChartData;
        barChartData.datasets[1].fillColor = "#00a65a";
        barChartData.datasets[1].strokeColor = "#00a65a";
        barChartData.datasets[1].pointColor = "#00a65a";
        var barChartOptions = {
          //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
          scaleBeginAtZero: true,
          //Boolean - Whether grid lines are shown across the chart
          scaleShowGridLines: true,
          //String - Colour of the grid lines
          scaleGridLineColor: "rgba(0,0,0,.05)",
          //Number - Width of the grid lines
          scaleGridLineWidth: 1,
          //Boolean - Whether to show horizontal lines (except X axis)
          scaleShowHorizontalLines: true,
          //Boolean - Whether to show vertical lines (except Y axis)
          scaleShowVerticalLines: true,
          //Boolean - If there is a stroke on each bar
          barShowStroke: true,
          //Number - Pixel width of the bar stroke
          barStrokeWidth: 2,
          //Number - Spacing between each of the X value sets
          barValueSpacing: 5,
          //Number - Spacing between data sets within X values
          barDatasetSpacing: 1,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
          //Boolean - whether to make the chart responsive
          responsive: true,
          maintainAspectRatio: false
        };

        barChartOptions.datasetFill = false;
        barChart.Bar(areaChartData, barChartOptions);
      });
    </script>
</section><!-- /.content -->
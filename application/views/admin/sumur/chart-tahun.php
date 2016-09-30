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
          <form class="box-title" method="get" action="<?php echo site_url('adm_sumur/chart_tahun') ?>">
            <select name="tahun1">
              <option value="">- Pilih Tahun -</option>
              <?php
              foreach ($tahun->result() as $t) {
                $s = '';
                if($t->tahunuji_sumur==$this->input->get('tahun1')) {
                  $s = 'selected';
                }
                echo '<option value="'.$t->tahunuji_sumur.'" '.$s.'>'.$t->tahunuji_sumur.'</option>';
              }
              ?>
            </select>
            <span>s/d</span>
            <select name="tahun2">
              <option value="">- Pilih Tahun -</option>
              <?php
              foreach ($tahun->result() as $t) {
                $s = '';
                if($t->tahunuji_sumur==$this->input->get('tahun2')) {
                  $s = 'selected';
                }
                echo '<option value="'.$t->tahunuji_sumur.'" '.$s.'>'.$t->tahunuji_sumur.'</option>';
              }
              ?>
            </select>
            <select name="sumur">
              <option value="">- Pilih Lokasi -</option>
              <?php
              foreach ($lokasi->result() as $l) {
                $s = '';
                if($l->lokasiuji_sumur_id==$this->input->get('sumur')) {
                  $s = 'selected';
                }
                echo '<option value="'.$l->lokasiuji_sumur_id.'" '.$s.'>'.$l->nama_lokasi.'</option>';
              }
              ?>
            </select>
            <select name="parameter">
              <option value="">- Pilih Parameter -</option>
              <?php
              foreach ($parameter->result() as $t) {
                $s = '';
                if($t->par_sumur_id==$this->input->get('parameter')) {
                  $s = 'selected';
                }
                echo '<option value="'.$t->par_sumur_id.'" '.$s.'>'.$t->parameter.'</option>';
              }
              ?>
            </select>
            <button type="submit" name="filter" value="go">Filter</button>
          </form>
        </div>
        <div class="box-body">
          <h3 align="center"><?php echo $dt['parameter'] ?></h3>
          <canvas id="barChart" height="300"></canvas>
        </div><!-- /.box-body -->
        <div class="box-footer">
          <div style="display:inline-block"> Baku Mutu : <?php echo $bakumutu ?></div>
        </div>
      </div><!-- /.box -->

    </div><!-- /.col (RIGHT) -->
  </div><!-- /.row -->
  <!-- ChartJS 1.0.1 -->
    <script src="<?php echo base_url() ?>assets/plugins/chartjs/Chart.min.js" type="text/javascript"></script>
  <!-- page script -->
    <script>
      $(function () {

        var areaChartData = {
          labels: [
          //tahun
          <?php
          for($i=$tahun1; $i<=$tahun2; $i++){
            echo $i.',';
          }
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
                for($i=$tahun1; $i<=$tahun2; $i++){
                  echo hsumur(array('a.lokasiuji_sumur_id'=>$sumur,'par_sumur_id'=>$par,'tahunuji_sumur'=>$i));
                  echo ',';
                }
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
          barDatasetSpacing: 0,
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
          responsive: true,
          maintainAspectRatio: false
        };

        barChartOptions.datasetFill = false;
        barChart.Bar(areaChartData, barChartOptions);
      });
    </script>
</section><!-- /.content -->
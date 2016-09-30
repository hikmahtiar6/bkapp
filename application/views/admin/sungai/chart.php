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
          <h3 align="center"><?php echo $dt['parameter'] ?></h3>
          <canvas id="barChart" height="400"></canvas>
        </div><!-- /.box-body -->
        <div class="box-footer">
          <p><div style="width:20px;height:20px;background:#33CCFF; float:left; margin-right:10px;"></div> Musim Kemarau
            <div style="margin-left:5em; display:inline-block"> Baku Mutu : <?php echo $bakumutu ?></div>
          <p/>
          <p><div style="width:20px;height:20px;background:#007D00; float:left; margin-right:10px;"></div> Musim Kemarau<p/>
        </div>
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
          $jml = $lokasi->num_rows();
          $no = 1;
          foreach ($lokasi->result() as $l) {
            echo '"('.$l->lokasi_uji.') '.$l->nama_lokasi.'"';
            if($no==$jml) {} else {
              echo ',';
            }
          $no++;
          }
          ?>
          ],
          datasets: [
            {
              label: "Periode I",
              fillColor: "#33CCFF",
              strokeColor: "#33CCFF",
              pointColor: "#33CCFF",
              data: [
              <?php
              $jml = $lokasi->num_rows();
              $no = 1;
              foreach ($lokasi->result() as $l) {
                echo hasil_uji_sungai(array('lokasiuji_sungai_id'=>$l->lokasiuji_sungai_id,'periode'=>0,'tahunuji_sungai'=>$thn,'b.par_sungai_situ_id'=>$idp));
                if($no==$jml) {} else {
                  echo ',';
                }
              $no++;
              }
              ?>
              ]
            },
            {
              label: "Periode II",
              fillColor: "#007D00",
              strokeColor: "#007D00",
              pointColor: "#007D00",
              data: [
              <?php
              $jml = $lokasi->num_rows();
              $no = 1;
              foreach ($lokasi->result() as $l) {
                echo hasil_uji_sungai(array('lokasiuji_sungai_id'=>$l->lokasiuji_sungai_id,'periode'=>1,'tahunuji_sungai'=>$thn,'b.par_sungai_situ_id'=>$idp));
                if($no==$jml) {} else {
                  echo ',';
                }
              $no++; 
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
        var barChartOptions = {
          scaleBeginAtZero: true,
          scaleShowGridLines: true,
          scaleGridLineColor: "rgba(0,0,0,0.2)",
          scaleGridLineWidth: 1,
          scaleShowHorizontalLines: true,
          scaleShowVerticalLines: true,
          barShowStroke: true,
          barStrokeWidth: 1,
          barValueSpacing: 4,
          barDatasetSpacing: 1,
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
          responsive: true,
          maintainAspectRatio: false
        };

        barChartOptions.datasetFill = false;
        barChart.Bar(areaChartData, barChartOptions);
      });
    </script>
</section><!-- /.content -->
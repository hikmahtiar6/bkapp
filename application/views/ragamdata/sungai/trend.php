<section class="content-header">
  <h1><?php echo $title ?></h1>
  <ol class="breadcrumb">
      <label>Filter : </label>
      <select name="tahun1" id="tahun1">
              <option value="">- Pilih Tahun -</option>
              <?php
              foreach ($tahun->result() as $t) {
                echo '<option value="'.$t->tahunuji_sungai.'" >'.$t->tahunuji_sungai.'</option>';
              }
              ?>
            </select>
            <span>s/d</span>
            <select name="tahun2" id="tahun2">
              <option value="">- Pilih Tahun -</option>
              <?php
              foreach ($tahun->result() as $t) {
                echo '<option value="'.$t->tahunuji_sungai.'" >'.$t->tahunuji_sungai.'</option>';
              }
              ?>
            </select>
            <select name="sungai" id="lksungai">
              <option value="">- Pilih Lokasi -</option>
              <?php
              foreach ($lokasi->result() as $l) {
                echo '<option value="'.$l->lokasiuji_sungai_id.'" >'.$l->nama_lokasi.'</option>';
              }
              ?>
            </select>
            <select name="parameter" id="parameter">
              <option value="">- Pilih Parameter -</option>
              <?php
              foreach ($parameter->result() as $t) {
                echo '<option value="'.$t->par_sungai_situ_id.'" >'.$t->parameter.'</option>';
              }
              ?>
            </select>
      <button type="submit" id="proses">Proses</button>
  </ol>
</section>

<section class="content">
  <div style="background:#fff;padding:10px;" id="report">
    <center>Data belum di filter.</center>
  </div>
</section>

<script>
  $("#proses").click(function() {
    $("#loading").show();
    var thn = $("#tahun1").val();
    var thn2 = $("#tahun2").val();
    var s = $("#lksungai").val();
    var ad = $("#parameter").val();
    $.ajax({
      type: "POST",
      url: "<?php echo site_url('trend/trend_sungai')?>",
      data: "tahun1="+thn+"&tahun2="+thn2+"&sungai="+s+"&parameter="+ad,
      success: function(data) {
        $("#loading").hide();
        $("#report").html(data);
      }
    });
  });
</script>
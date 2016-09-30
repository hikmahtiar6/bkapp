<section class="content-header">
  <h1><?php echo $title ?></h1>
  <ol class="breadcrumb">
      <label>Filter : </label>
      <select id="tahunuji" name="tahunuji">
        <option value="">- Pilih Tahun -</option>
        <?php
        if($tahunuji->num_rows()>0) {
          foreach ($tahunuji->result() as $rows) {
            ?>
            <option value="<?php echo $rows->tahunuji_sungai ?>"><?php echo $rows->tahunuji_sungai ?></option>
            <?php
          }
        }
        ?>
      </select>
      <select id="namasungai" name="sungai">
        <option value="">-Pilih Sungai-</option>
        <?php
        if($sungai->num_rows()>0) {
          foreach ($sungai->result() as $rows) {
            ?>
            <option value="<?php echo $rows->sungai_id ?>"><?php echo $rows->nama_sungai ?></option>
            <?php
          }
        }
        ?>
      </select>
      <select id="lokasi" name="lokasi">
        <option value="">-Pilih Lokasi-</option>
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
  $("#namasungai").change(function() {
    var su = $("#namasungai").val();
    $.ajax({
      url: "<?php echo site_url('ragam_data/lokasi_sungai')?>",
      data: "sungai="+su,
      success: function(data) { 
        $("#lokasi").html(data);
      }
    });
  });
  $("#proses").click(function() {
    $("#loading").show();
    var thn = $("#tahunuji").val();
    var lks = $("#lokasi").val();
    $.ajax({
      type: "POST",
      url: "<?php echo site_url('ragam_data/report_sungai')?>",
      data: "tahunuji="+thn+"&lokasi="+lks,
      success: function(data) {
        $("#loading").hide();
        $("#report").html(data);
      }
    });
  });
</script>
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
            <option value="<?php echo $rows->tahunuji_cerobong ?>"><?php echo $rows->tahunuji_cerobong ?></option>
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
  $("#proses").click(function() {
    $("#loading").show();
    var thn = $("#tahunuji").val();
    var lks = $("#lokasi").val();
    $.ajax({
      type: "POST",
      url: "<?php echo site_url('ragam_data/report_cerobong')?>",
      data: "tahunuji="+thn+"&lokasi="+lks,
      success: function(data) {
        $("#loading").hide();
        $("#report").html(data);
      }
    });
  });
  $("#tahunuji").change(function() {
    $("#loading").show();
    var thn = $("#tahunuji").val();
    $.ajax({
      type: "POST",
      url: "<?php echo site_url('ragam_data/pilih_tahun_cerobong')?>",
      data: "tahunuji="+thn,
      success: function(data) {
        $("#loading").hide();
        $("#lokasi").html(data);
      }
    });
  });
</script>
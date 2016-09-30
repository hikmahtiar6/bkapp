<section class="content-header">
  <h1><?php echo $title ?></h1>
  <ol class="breadcrumb">
      <label>Filter : </label>
      <select id="tahun" name="tahun">
        <option value="">- Semua Data -</option>
        <?php
        if($tahun->num_rows()>0) {
          foreach ($tahun->result() as $rows) {
            ?>
            <option value="<?php echo $rows->thn ?>"><?php echo $rows->thn ?></option>
            <?php
          }
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
    var thn = $("#tahun").val();
    $.ajax({
      type: "POST",
      url: "<?php echo site_url('ragam_data/report_kendaraan')?>",
      data: "tahun="+thn,
      success: function(data) {
        $("#loading").hide();
        $("#report").html(data);
      }
    });
  });
</script>
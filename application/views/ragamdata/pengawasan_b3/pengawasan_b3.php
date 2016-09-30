<section class="content-header">
  <h1><?php echo $title ?></h1>
  <ol class="breadcrumb">
      <label>Filter : </label>
      <select id="jenis" name="jenis">
        <option value="">- Pilih Jenis Kegiatan -</option>
        <?php
        if($jenis_kegiatan->num_rows()>0) {
          foreach ($jenis_kegiatan->result() as $rows) {
            ?>
            <option value="<?php echo $rows->jenis_kegiatan ?>"><?php echo $rows->jenis_kegiatan ?></option>
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
    var thn = $("#jenis").val();
    $.ajax({
      type: "POST",
      url: "<?php echo site_url('ragam_data/report_pengawasan_b3')?>",
      data: "jenis="+thn,
      success: function(data) {
        $("#loading").hide();
        $("#report").html(data);
      }
    });
  });
</script>
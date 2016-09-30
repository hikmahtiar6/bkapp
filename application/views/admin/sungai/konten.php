<form id="form" method="post" enctype="multipart/form-data" action="<?php echo site_url('adm_sungai/edit_titik') ?>">
            <input type="hidden" name="id" value="<?php echo $titik_hulu['titik_uji_sungai_id'] ?>">
            <input type="hidden" name="icon_map" value="icon-<?php echo $titik_hulu['bagian'] ?>.png">
            <div class="gllpLatlonPicker">
              <div class="gllpMap" style="width:100%; height:280px;">Lokasi Map</div>
              <br>
                  <div class="form-group">
                      <label>Latitude</label>
                      <input type="text" name="lat" class="form-control gllpLatitude" value="<?php echo $titik_hulu['lat'] ?>">
                  </div>

                  <div class="form-group">
                      <label>Longitude</label>
                      <input type="text" name="lng" class="form-control gllpLongitude" value="<?php echo $titik_hulu['lng'] ?>">
                  </div>
            </div>
            <div class="form-group">
              <label>Nama Sub DAS</label>
              <input type="text" name="nama_sub_das" value="<?php echo $titik_hulu['nama_sub_das'] ?>" class="form-control">
            </div>
            <!-- Hidden
            <div class="form-group">
              <label>Hasil Pengujian</label>
              <textarea name="hasil_uji" class="form-control"><?php echo $titik_hulu['hasil_uji'] ?></textarea>
            </div>
            -->
            <div class="form-group">
              <label>Hasil Pengujian</label>
              <table class="table table-bordered table-hover">
              <?php
              $no = 1;
              foreach ($parameter->result() as $rows) {
              ?>
                <tr>
                  <td><?php echo $rows->parameter ?><input type="hidden" name="parameter_id[<?php echo $rows->parameter_id ?>]" value="<?php echo $rows->parameter_id ?>"></td>
                  <td><?php echo $rows->baku_mutu ?></td>
                  <td><?php echo $rows->satuan ?></td>
                  <td><input type="text" class="form-control" name="hasil[<?php echo $rows->parameter_id ?>]" value="<?php echo hasil_uji($rows->parameter_id,$titik_hulu['titik_uji_sungai_id']) ?>"></td>
                  <td>
                  <?php
                  $sec1 = ''; $sec2 = '';
                  if(status_hasil_uji($rows->parameter_id,$titik_hulu['titik_uji_sungai_id'])=="Memenuhi") {
                    $sec1 = 'checked';
                  } else {
                    $sec2 = 'checked';
                  }
                  ?>
                    <label><input type="radio" name="status[<?php echo $rows->parameter_id ?>]" value="Memenuhi" <?php echo $sec1 ?> > Memenuhi</label>&nbsp;
                    <label><input type="radio" name="status[<?php echo $rows->parameter_id ?>]" value="Tidak Memenuhi" <?php echo $sec2 ?>> Tidak Memenuhi</label>
                  </td>
                </tr>
              <?php
              $no++;
              }
              ?>
              </table>
            </div>
            <div class="form-group">
              <label>foto</label>
              <input type="file" name="foto" id="foto">
            </div>
            <div id="gambar">
              <?php
              if($titik_hulu['foto']!='') {
                echo "<img src='".base_url('uploads/ragamdata/air/sungai/thumb/'.$titik_hulu['foto'])."' />";
              } else {
                echo "Tidak ada foto";
              }
              ?>
            </div>
            
            <hr/>
            <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
            <input type="reset" name="batal" value="Batal" class="btn btn-default">
            <div id="loading" style="display:none">Loading...</div>
          </form>
<!-- Maps -->
<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/gmaps/css/style.css')?>" />
<script src="<?php echo base_url('assets/gmaps/js/OpenLayers.js')?>"></script>
<script src="<?php echo base_url('assets/gmaps/js/jquery-position-picker.debug.js')?>"></script>

<script>

$("#form").submit(function(e) {
  e.preventDefault();
  $("#loading").show();
  $.ajax({
    type: "POST",
    url: "<?php echo site_url('adm_sungai/edit_titik') ?>",
    enctype: 'multipart/form-data',
    contentType: false,
    cache: false,
    processData: false,
    data: new FormData(this),
    success: function(data) {
      $("#loading").hide();
      alert("Sukses, Data diperbaharui!!");
      $("#gambar").html(data);
      document.getElementById('foto').value = "";
    }
  });
});

</script>
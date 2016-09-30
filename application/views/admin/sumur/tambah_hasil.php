<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <?php echo $title ?>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li>Pengujian</li>
    <li class="active"><?php echo $title ?></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

<?php
if($this->session->flashdata('success')) {
  echo '
  <div class="alert alert-success">'.$this->session->flashdata('success').'</div> 
  ';
}
if($this->session->flashdata('error')) {
  echo '
  <div class="alert alert-danger">'.$this->session->flashdata('error').'</div> 
  ';
}

?>
<div id="loading" style="display:none;margin-bottom:10px;" class="btn btn-warning btn-block">LOADING...</div>
<div class="row">

  <div class="col-md-4">
    <div class="box">
      <div class="box-body">

        <div class="row">
        <form method="post" id="cekdatapengujian">
          <div class="col-md-8 form-group">
            <input type="text" class="form-control" placeholder="Tahun pengujian" name="tahunuji" id="tahunuji" value="<?php echo $this->uri->segment(3) ?>">
            <p class="help-block text-red"><?php echo form_error('tahunuji', ' ')?></p>
          </div>
          <div class="col-md-12 form-group">
            <select name="lokasiuji" class="form-control" id="lokasiuji">
              <option value="">- Pilih Lokasi Pengujian -</option>
              <?php
              foreach ($lokasiuji->result() as $row) {
                echo '<option value="'.$row->lokasiuji_sumur_id.'">'.$row->nama_lokasi.'</option>';
              }
              ?>
            </select>
            <p class="help-block text-red"><?php echo form_error('lokasiuji', ' ')?></p>
          </div>
          <div class="col-md-12">
            <button class="btn btn-primary">Cek Data</button>
            <a href="<?php echo site_url('adm_sumur') ?>" class="btn btn-default">Kembali</a>
          </div>
        </form>
        </div>
        
      </div>
    </div>

    <div class="box" id="boximport" style="display:none;">
      <div class="box-header with-border">
        <h3 class="box-title">Import Data</h3>
      </div>
      <div class="box-body">
        <form method="post" id="uploadcsv">
            <input type="hidden" name="t" value="" id="t">
            <input type="hidden" name="l" value="" id="l">
            <input type="file" name="csvfile" id="csvfile">
            <button class="btn btn-primary">Upload</button>
        </form>
      </div>
    </div>
  </div>

  <div class="col-md-8">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">List Data</h3>
      </div>
      <div class="box-body" id="formhasil">
        <div class="callout callout-info">
          <strong>Data tidak ada,</strong>
          <p>Cek data terlebih dahulu.</p>
        </div>
      </div>
      
    </div>
  </div>

  
</div>
</section><!-- /.content -->

<script type="text/javascript">
  $("#cekdatapengujian").submit(function(e) {
    e.preventDefault();
    var t = $("#tahunuji").val();
    var l = $("#lokasiuji").val();
    $("#loading").show();
    $.ajax({
      type: "POST",
      url: "<?php echo site_url('adm_sumur/cekdatapengujian') ?>",
      enctype: 'multipart/form-data',
      contentType: false,
      cache: false,
      processData: false,
      data: new FormData(this),
      success: function(data) {
        $("#loading").hide();
        $("#formhasil").html(data);
        $("#boximport").show();
        $("#t").val(t);
        $("#l").val(l);
      }
    });
  });


  $("#uploadcsv").submit(function(e) {
    e.preventDefault();
    $("#loading").show();
    $.ajax({
      type: "POST",
      url: "<?php echo site_url('adm_sumur/importdata') ?>",
      enctype: 'multipart/form-data',
      contentType: false,
      cache: false,
      processData: false,
      data: new FormData(this),
      success: function(data) {
        $("#loading").hide();
        $("#csvfile").val("");
        $("#formhasil").html(data);
      }
    });
  });
</script>
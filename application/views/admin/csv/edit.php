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


echo form_open_multipart('adm_csv/edit');
//echo form_hidden('id',$item['pengujian_sungai_id']);
?>
<div class="box">
  <div class="box-header text-right">
      <button type="submit" class="btn btn-sm bg-orange"><i class="fa fa-save"></i> Simpan</button>
      <button type="reset" class="btn btn-sm btn-default"> Reset</button>
      <a href="<?php echo site_url('adm_csv')?>" class="btn btn-sm bg-grey">Kembali</a>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="box">
      <div class="box-body">
	  
		<div class="form-group">
          
          <input type="text" name="id" value="<?php echo $item['pengujian_sungai_id'] ?>" class="form-control">
        </div>
		
		
		
        <div class="form-group">
          <label>Nama Sungai*</label>
          <input type="text" name="nama_sungai" value="<?php echo $item['nama_sungai'] ?>" class="form-control">
        </div>
		
		
    <div class="box">
      <div class="box-body">
        <div class="gllpLatlonPicker">
          <div class="gllpMap" style="width:100%; height:250px;">Lokasi Map</div>
          <br>
              <div class="form-group">
                  <label for="exampleInputPassword1">Latitude</label>
                  <input type="text" name="lat" class="form-control gllpLatitude" value="<?php echo $item['lat']?>">
              </div>

              <div class="form-group">
                  <label for="exampleInputPassword1">Longitude</label>
                  <input type="text" name="lng" class="form-control gllpLongitude" value="<?php echo $item['lng']?>">
              </div>
        </div>
        <div class="form-group">
          <label>Periode Uji</label>
          <input type="text" name="periode_uji" value="<?php echo $item['periode_uji'] ?>" class="form-control">
        </div>
        <div class="form-group">
          <label>Waktu Pengujian*</label>
          <input type="text" name="waktu_pengujian" value="<?php echo $item['waktu_pengujian']?>" class="form-control" id="dp2">
        </div>
        <div class="form-group">
          <label>Temperature*</label>
          <input type="text" name="temperature" value="<?php echo $item['temperature'] ?>" class="form-control">
        </div>
		<div class="form-group">
          <label>TDS*</label>
          <input type="text" name="tds" value="<?php echo $item['tds'] ?>" class="form-control">
        </div>
		<div class="form-group">
          <label>TSS*</label>
          <input type="text" name="tss" value="<?php echo $item['tss'] ?>" class="form-control">
        </div>
		<div class="form-group">
          <label>Debit*</label>
          <input type="text" name="debit" value="<?php echo $item['debit'] ?>" class="form-control">
        </div>
		<div class="form-group">
          <label>PH*</label>
          <input type="text" name="ph" value="<?php echo $item['ph'] ?>" class="form-control">
        </div>
		<div class="form-group">
          <label>BOD*</label>
          <input type="text" name="bod" value="<?php echo $item['bod'] ?>" class="form-control">
        </div>
		<div class="form-group">
          <label>COD*</label>
          <input type="text" name="cod" value="<?php echo $item['cod'] ?>" class="form-control">
        </div>
		<div class="form-group">
          <label>DO*</label>
          <input type="text" name="do" value="<?php echo $item['do'] ?>" class="form-control">
        </div>
		<div class="form-group">
          <label>Total Phospate Po4*</label>
          <input type="text" name="total_phospate_po4" value="<?php echo $item['total_phospate_po4'] ?>" class="form-control">
        </div>
		<div class="form-group">
          <label>Nitrate No3*</label>
          <input type="text" name="nitrate_no3" value="<?php echo $item['nitrate_no3'] ?>" class="form-control">
        </div>
		<div class="form-group">
          <label>Arsenic As*</label>
          <input type="text" name="arsenic_as" value="<?php echo $item['arsenic_as'] ?>" class="form-control">
        </div>
		<div class="form-group">
          <label>Cobalt Co*</label>
          <input type="text" name="cobalt_co" value="<?php echo $item['cobalt_co'] ?>" class="form-control">
        </div>
		<div class="form-group">
          <label>Boron B*</label>
          <input type="text" name="boron_b" value="<?php echo $item['boron_b'] ?>" class="form-control">
        </div>
		<div class="form-group">
          <label>elenium Se*</label>
          <input type="text" name="selenium_se" value="<?php echo $item['selenium_se'] ?>" class="form-control">
        </div>
		<div class="form-group">
          <label>Cadmium Cd*</label>
          <input type="text" name="cadmium_cd" value="<?php echo $item['cadmium_cd'] ?>" class="form-control">
        </div>
    </div>

      </div>
    </div>
  </div>
</div>
<div class="col-md-6">
<div class="box">
      <div class="box-body">
	  
        <div class="form-group">
          <label>Chrom Hexavalen Cr6*</label>
          <input type="text" name="chrom_hexavalen_cr6" value="<?php echo $item['chrom_hexavalen_cr6'] ?>" class="form-control">
        </div>
		<div class="form-group">
          <label>Copper Cu*</label>
          <input type="text" name="copper_cu" value="<?php echo $item['copper_cu'] ?>" class="form-control">
        </div>
		<div class="form-group">
          <label>Lead Pb*</label>
          <input type="text" name="lead_pb" value="<?php echo $item['lead_pb'] ?>" class="form-control">
        </div>
		<div class="form-group">
          <label>Mercury Hg*</label>
          <input type="text" name="mercury_hg" value="<?php echo $item['mercury_hg'] ?>" class="form-control">
        </div>
		<div class="form-group">
          <label>Zinc Zn*</label>
          <input type="text" name="zinc_zn" value="<?php echo $item['zinc_zn'] ?>" class="form-control">
        </div>
		<div class="form-group">
          <label>Cyanide Cn*</label>
          <input type="text" name="cyanide_cn" value="<?php echo $item['cyanide_cn'] ?>" class="form-control">
        </div>
		<div class="form-group">
          <label>Flouride F*</label>
          <input type="text" name="flouride_f" value="<?php echo $item['flouride_f'] ?>" class="form-control">
        </div>
		<div class="form-group">
          <label>Nitrite No2*</label>
          <input type="text" name="nitrite_no2" value="<?php echo $item['nitrite_no2'] ?>" class="form-control">
        </div>
		<div class="form-group">
          <label>Free Chlorine Cl2*</label>
          <input type="text" name="free_chlorine_cl2" value="<?php echo $item['free_chlorine_cl2'] ?>" class="form-control">
        </div>
		<div class="form-group">
          <label>Sulfide h2s*</label>
          <input type="text" name="sulfide_h2s" value="<?php echo $item['sulfide_h2s'] ?>" class="form-control">
        </div>
		<div class="form-group">
          <label>Ammonia*</label>
          <input type="text" name="ammonia" value="<?php echo $item['ammonia'] ?>" class="form-control">
        </div>
		<div class="form-group">
          <label>Chloride Cl*</label>
          <input type="text" name="chloride_cl" value="<?php echo $item['chloride_cl'] ?>" class="form-control">
        </div>
		<div class="form-group">
          <label>Iron Fe*</label>
          <input type="text" name="iron_fe" value="<?php echo $item['iron_fe'] ?>" class="form-control">
        </div>
		<div class="form-group">
          <label>Manganese Mn*</label>
          <input type="text" name="manganese_mn" value="<?php echo $item['manganese_mn'] ?>" class="form-control">
        </div>
		<div class="form-group">
          <label>Barium Ba*</label>
          <input type="text" name="barium_ba" value="<?php echo $item['barium_ba'] ?>" class="form-control">
        </div>
		<div class="form-group">
          <label>Sulfat*</label>
          <input type="text" name="sulfat" value="<?php echo $item['sulfat'] ?>" class="form-control">
        </div>
		<div class="form-group">
          <label>Fecal Coliform*</label>
          <input type="text" name="fecal_coliform" value="<?php echo $item['fecal_coliform'] ?>" class="form-control">
        </div>
		<div class="form-group">
          <label>Total Coliform*</label>
          <input type="text" name="total_coliform" value="<?php echo $item['total_coliform'] ?>" class="form-control">
        </div>
		<div class="form-group">
          <label>Oil Fat*</label>
          <input type="text" name="oil_fat" value="<?php echo $item['oil_fat'] ?>" class="form-control">
        </div>
		<div class="form-group">
          <label>Detergent Mbas*</label>
          <input type="text" name="detergent_mbas" value="<?php echo $item['detergent_mbas'] ?>" class="form-control">
        </div>
		<div class="form-group">
          <label>Phenol*</label>
          <input type="text" name="phenol" value="<?php echo $item['phenol'] ?>" class="form-control">
        </div>


</div>
</form>
</section><!-- /.content -->

<!-- CK Editor -->
<script src="<?php echo base_url()?>assets/plugins/ckeditor/ckeditor.js"></script>
<script language="javascript">
CKEDITOR.replace( 'editor1', {
filebrowserBrowseUrl : '<?php echo base_url()?>assets/plugins/ckfinder/ckfinder.html',
filebrowserImageBrowseUrl : '<?php echo base_url()?>assets/plugins/ckfinder/ckfinder.html?type=Images',
filebrowserFlashBrowseUrl : '<?php echo base_url()?>assets/plugins/ckfinder/ckfinder.html?type=Flash',
filebrowserUploadUrl : '<?php echo base_url()?>assets/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
filebrowserImageUploadUrl : '<?php echo base_url()?>assets/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
filebrowserFlashUploadUrl : '<?php echo base_url()?>assets/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
filebrowserWindowWidth : '700',
filebrowserWindowHeight : '400'});
CKEDITOR.replace('editor2');</script>
<!-- Maps -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/gmaps/css/style.css')?>" />
<script src="<?php echo base_url('assets/gmaps/js/OpenLayers.js')?>"></script>
<script src="<?php echo base_url('assets/gmaps/js/jquery-position-picker.debug.js')?>"></script>
<script src="<?php echo base_url('assets/gmaps/js/jscolor.js')?>"></script>
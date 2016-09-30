<?php
if($datahasiluji->num_rows()>0) {
?>
<table class="table table-bordered table-hover" id="list">
	<thead>
		<tr>
			<th>Parameter</th>
			<th>Baku mutu</th>
			<th>Hasil uji</th>
			<th>Keterangan</th>
			<th>Alat</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$no = 1;
		foreach ($datahasiluji->result() as $dt) {
		?>
		<tr>
			<td><?php echo $dt->parameter ?></td>
			<td><?php echo $dt->baku_mutu ?></td>
			<td><?php echo $dt->tandabaca.''.$dt->hasil_uji ?></td>
			<td><?php echo $dt->ket_akhir ?></td>
			<td>
				<input type="hidden" value="<?php echo $dt->par_ambien_id ?>" id="parameter<?php echo $no ?>">
				<input type="hidden" value="<?php echo $dt->tandabaca ?>" id="tandabaca<?php echo $no ?>">
				<input type="hidden" value="<?php echo $dt->baku_mutu ?>" id="bakumutu<?php echo $no ?>">
				<input type="hidden" value="<?php echo $dt->hasil_uji ?>" id="hasiluji<?php echo $no ?>">
				<input type="hidden" value="<?php echo $dt->ket_akhir ?>" id="ket<?php echo $no ?>">
				<a href="#" id="edit<?php echo $no ?>" class="btn btn-xs bg-green"><i class="fa fa-edit"></i></a>
				<a href="#" id="hapushasiluji<?php echo $no ?>" class="btn btn-xs bg-red"><i class="fa fa-trash-o"></i></a>
			</td>
		</tr>
		<script type="text/javascript">
			$("#hapushasiluji<?php echo $no ?>").click(function(){
				var parameter = $("#parameter<?php echo $no ?>").val();
				var lokasiuji = $("#lokasiuji").val();
				var tahunuji = $("#tahunuji").val();
				var tanto = "parameter="+parameter+"&tahun="+tahunuji+"&lokasi="+lokasiuji;
				$("#loading").show();
				$.ajax({
				  type: "POST",
			      url: "<?php echo site_url('adm_ambien/hapushasiluji') ?>",
			      cache: false,
			      data: tanto, 
			      success: function(data) {
			        $("#loading").hide();
			        $("#formhasil").html(data);
			      }
			    });
			});
			$("#edit<?php echo $no ?>").click(function() {
				var parameter = $("#parameter<?php echo $no ?>").val();
				var bakumutu = $("#bakumutu<?php echo $no ?>").val();
				var tandabaca = $("#tandabaca<?php echo $no ?>").val();
				var hasiluji = $("#hasiluji<?php echo $no ?>").val();
				var ket = $("#ket<?php echo $no ?>").val();

				$("#parameter").val(parameter);
				$("#bakumutu").val(bakumutu);
				$("#tandabaca").val(tandabaca);
				$("#hasiluji").val(hasiluji);
				$("#ket_akhir").val(ket);
			});
		</script>
		<?php
		$no++;
		}
		?>
	</tbody>
</table>
<?php } ?>
<hr/>
<div class="row">
<form id="tmbhasiluji" method="post">
	<div class="col-md-3" style="padding-right:5px;">
		<select name="parameter" class="form-control" id="parameter">
			<?php
			foreach ($parameter->result() as $row) {
				echo "<option value='".$row->par_ambien_id."'>".$row->parameter."</option>";
			}
			?>
		</select>
		<input type="hidden" name="tahunuji" value="<?php echo $tahun ?>">
		<input type="hidden" name="lokasiuji" value="<?php echo $lokasi ?>">
	</div>
	<div class="col-md-2">
		<input type="text" class="form-control" placeholder="Baku mutu" name="bakumutu" required id="bakumutu">
	</div>
	<div class="col-md-1" style="padding-right:5px;padding-left:5px;">
		<input type="text" class="form-control" placeholder="Tandabaca" name="tandabaca" id="tandabaca">
	</div>
	<div class="col-md-2" style="padding-right:5px;padding-left:5px;">
		<input type="text" class="form-control" placeholder="Hasil uji" name="hasiluji" required id="hasiluji">
	</div>
	<div class="col-md-2">
		<select name="ket" class="form-control" id="ket_akhir">
			<option>Memenuhi</option>
			<option>Tidak Memenuhi</option>
		</select>
	</div>
	<div class="col-md-2">
		<button type="submit" class="btn btn-primary btn-block">Simpan</button>
	</div>
</form>
</div>

<script type="text/javascript">
$("#tmbhasiluji").submit(function(e) {
    e.preventDefault();
    $("#loading").show();
    $.ajax({
      type: "POST",
      url: "<?php echo site_url('adm_ambien/tmbhasiluji') ?>",
      contentType: false,
      cache: false,
      processData: false,
      data: new FormData(this),
      success: function(data) {
        $("#loading").hide();
        $("#formhasil").html(data);
      }
    });
  });
</script>
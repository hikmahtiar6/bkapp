<div class="row">
	<div class="col-md-12"><h2>Album <?php echo $album['album_title'] ?></h2></div>
	<?php
	if($listview->num_rows()>0) {
	foreach ($listview->result() as $al) {
	?>
	<div class="col-md-3">
		<div class="image-container image-galeri">
			<a href="#" data-toggle="modal" data-target="#myModal<?php echo $al->galeri_id ?>">
			<img src="<?php echo base_url('uploads/galeri/'.$al->image) ?>" class="galeri">
			<div class="overlay"><?php echo $al->galeri_title ?></div>
			</a>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="myModal<?php echo $al->galeri_id ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo $al->galeri_title ?>">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="<?php echo $al->galeri_title ?>"><?php echo $al->galeri_title ?></h4>
	      </div>
	      <div class="modal-body">
	       	<img src="<?php echo base_url('uploads/galeri/'.$al->image) ?>" class="galeri" width="100%">
	       	<div><?php echo $al->description ?></div>
	      </div>
	    </div>
	  </div>
	</div>
	<?php
	}
} else {
	echo '<div class="col-md-12">Maaf, tidak ada foto di album ini!!</div>';
}
	?>
</div>
<div class="row">
	<div class="col-md-12"><h2>Album Galeri</h2></div>
	<?php
	foreach ($album->result() as $al) {
	?>
	<div class="col-md-3">
		<div class="image-container image-galeri">
			<a href="<?php echo site_url('galeri/album/'.$al->album_id) ?>">
			<img src="<?php echo galeri_album($al->album_id) ?>" class="galeri">
			<div class="overlay">
			<?php echo $al->album_title ?>
			</div>
			</a>
		</div>
	</div>
	<?php
	}
	?>
</div>
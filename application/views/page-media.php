<div class="w3-content w3-quarter w3-white w3-padding">
	<div class="w3-card-2 w3-round w3-white">
		<div class="w3-container w3-padding">
		<h3>Navigasi</h3>
			<div class="list-group">
			<?php
			foreach ($listpost->result() as $rows) {
			$cls = '';
			if($content['post_id']==$rows->post_id) {
				$cls = 'active';
			}
			?>
			<a href="<?php echo linked($rows->post_id, $rows->title) ?>" class="list-group-item <?php echo $cls ?>"><?php echo $rows->title ?></a>
			<?php
			}
			?>
			  
			</div>
		</div>
	</div>
</div>
<!-- end of left column -->
<!-- right column -->
<div class="w3-content w3-threequarter w3-white w3-padding m3">	
	<div class="w3-card-2 w3-round w3-white">
		<div class="w3-container">
		<h2><?php echo $content['title'] ?></h2>
			<div class="content-meta margin-y-5">
				<small><i class="fa fa-calendar"></i> <?php echo convert_tanggal($content['date_publish']) ?> </small>
				<small class="margin-x-10"><i class="fa fa-eye"></i> Views : <?php echo $content['view'] ?></small>
				<small><i class="fa fa-user"></i> By <a><?php echo $content['user_name'] ?></a></small>
			</div>
			<div align="justify">
			<?php echo $content['body'] ?>
			</div>
			<embed src="<?php echo base_url('uploads/post/media/'.$content['image']);?>" width="100%" height="650" type="application/pdf"/>	
		</div>
	</div>
</div>
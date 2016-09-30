<!DOCTYPE html>
<style>
	body{
		margin:0px;
		padding:0px;
		overflow:hidden;
	}
</style>
<html>
<head>
	<link rel="icon" href="<?php echo base_url('assets/css/image/kotabogor.png') ?>">
	<title>
		<?php 
			foreach ($query->result() as $r){
				echo $r->file_name;
			}
		?>
	</title>
</head>
<body>
		<embed src="<?php echo base_url()?>uploads/perizinan/direktori/<?php echo $alamat_file ?>" width="100%" height="670" />
</body>
</html>
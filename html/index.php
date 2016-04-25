<?php
	include("header.inc");

	$index_json = file_get_contents('config/index.json');
	$INDEXCONF = json_decode($index_json);
?>

			<div class="jumbotron">
				<img class="img-responsive" src="<?php echo $INDEXCONF->banner ?>"/>
				<p><?php echo $INDEXCONF->welcome ?></p>
			</div>

			<!-- Example row of columns -->
			<div class="row">
				<div class="col-md-4">
					<h2><?php echo $INDEXCONF->section_1_heading ?></h2>
					<p><?php echo $INDEXCONF->section_1_message ?></p>
				</div>
				<div class="col-md-4">
					<h2><?php echo $INDEXCONF->section_2_heading ?></h2>
					<p><?php echo $INDEXCONF->section_2_message ?></p>
			 </div>
				<div class="col-md-4">
					<h2><?php echo $INDEXCONF->section_3_heading ?></h2>
					<p><?php echo $INDEXCONF->section_3_message ?></p>
				</div>
			</div>

<?php
	include("footer.inc");
?>
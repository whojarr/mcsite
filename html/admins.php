<?php
	include("header.inc");

	$site_json = file_get_contents('config/site.json');
	$SITECONF = json_decode($site_json);

	$server_json = file_get_contents('config/server.json');
	$SERVERCONF = json_decode($server_json);

	$admins_json = file_get_contents('config/admins.json');
	$ADMINSCONF = json_decode($admins_json);

?>

				<h2 class="sub-header"><?php echo $SERVERCONF->name ?> Admins</h2>
				<?php 
					foreach ($ADMINSCONF as $group=>$admins) {
						echo '<h2>'.$group.'</h2>';

						foreach ($admins as $player) {

							if(!file_exists('images/admins_images/'.$player->{'uuid'}.'.png')) {
								$imgurl =  $SITECONF->urls->www_internal.'/3d.php?user='.$player->{"name"}.'&aa=true&headOnly=true&ratio=6';
								$imgfile = $SITECONF->path . 'html/images/admins_images/'.$player->{'uuid'}.'.png';
								copy($imgurl, $imgfile);
							}

							echo '<div class="table-responsive"><table class="table"><tr><th>'. $player->{'name'} .'</th></thead><tbody>';
							echo '<tr><td>';
							echo '<img src="images/admins_images/'.$player->{'uuid'}.'.png"/>';
							echo '</td><tr></tbody></table></div>';

						}
					}
				?>

<?php
	include("footer.inc");
?>

<?php
	include("header.inc");

	$community_json = file_get_contents('config/community.json');
	$COMMUNITYCONF = json_decode($community_json);
?>

			<div class="container">
				<?php
					if($COMMUNITYCONF->facebook->url !== '') {
						echo '<h2 class="sub-header">Facebook</h2>';
						echo '<p>';
						echo 'Join us on Facebook <a href="'.$COMMUNITYCONF->facebook->url.'" target="_blank">'.$COMMUNITYCONF->facebook->url.'</a>';
						echo '</p>';
					}
				?>

				<?php
					if($COMMUNITYCONF->forum->url !== '') {
						echo '<h2 class="sub-header">Forum</h2>';
						echo '<p>';
						echo 'See our info on the Forum <a href="'.$COMMUNITYCONF->forum->url.'" target="_blank">'.$COMMUNITYCONF->forum->url.'</a>';
						echo '</p>';
					}
				?>

				<?php
					if($COMMUNITYCONF->teamspeak->server !== '') {
						echo '<h2 class="sub-header">Teamspeak</h2>';
						echo '<p>';
						echo 'Join our Teamspeak Server <a href="'.$COMMUNITYCONF->teamspeak->server.'" target="_blank">'.$COMMUNITYCONF->teamspeak->server.'</a>';
						echo '</p>';
					}
				?>

				<?php
					if($COMMUNITYCONF->discord->server !== '') {
						echo '<h2 class="sub-header">Discord</h2>';
						echo '<p>';
						echo 'Join our Discord Chat Channels <a href="'.$COMMUNITYCONF->discord->server.'" target="_blank">'.$COMMUNITYCONF->discord->server.'</a>';
						echo '</p>';
					}
					if($COMMUNITYCONF->discord->widget_url !== '') {
						echo '<p>';
						echo '<iframe src="'.$COMMUNITYCONF->discord->widget_url.' width="350" height="500" allowtransparency="true" frameborder="0"></iframe>';
						echo '</p>';
					}
				?>
			</div>

<?php
	include("footer.inc");
?>
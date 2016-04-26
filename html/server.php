<?php

	include("header.inc");
	include_once ('includes/restcall.php');

	$server_json = file_get_contents('config/server.json');
	$SERVERCONF = json_decode($server_json);

	$server_rest_response = RestCallAPI('get', 'https://craftapi.com/api/server/info/' . $SERVERCONF->server);

	$server_rest_json = json_decode($server_rest_response);
	$players = $server_rest_json->{'players'};
	$sample = $players->{"sample"};
	$version = $server_rest_json->{'version'};
	
?>

			<div class="container">

				<h1><?php print($server_rest_json->{'server'}) ?></h1>
				<p><b>Latency:</b> <?php print($server_rest_json->{'latency'}) ?><p/>
				<p>
					<b>Players Online:</b> <?php print($players->{'online'}) ?><br/>
					<?php
						foreach ($sample as $player) {
							print $player->{'name'};
							print "<br/>";
							// 	write updated player info to file
							$player_json = json_encode($player);
							$player_file = fopen("data/players_online/" . $player->{"id"} . '.json', 'w');
							fwrite($player_file, $player_json);
							fclose($player_file);
							// TODO: use the 3d api instead of calling the url
							// create a 3d render image of the player
							$imgurl =  $SITECONF->urls->www_internal.'/3d.php?user='.$player->{"name"}.'&aa=true&ratio=2';
							$file = $SITECONF->path . 'html/images/players_images/'.$player->{"id"}.'.png';
							copy($imgurl, $file);
						}
					?>
				</p>
				<p><b>Players Max:</b> <?php print($players->{"max"}) ?><p/>
				<p><b>MOTD:</b> <?php print($server_rest_json->{'motd'}) ?><p/>
				<p><b>Version:</b> <?php print($version->{'name'}) ?><p/>

			</div>

<?php
	include("footer.inc");
?>
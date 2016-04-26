<?php

	include("header.inc");

	$server_json = file_get_contents('config/server.json');
	$SERVERCONF = json_decode($server_json);

	$players_dir = 'data/players_online';
	$players_array = array();

	foreach (scandir($players_dir) as $file) {
		if ('.' === $file) continue;
		if ('..' === $file) continue;
		$player_files[] = $file;
		$player_file = fopen($players_dir . '/' . $file, 'r');
		$player_json_string = fread($player_file,filesize($players_dir . '/' . $file));
		$player_json = json_decode($player_json_string);
		$player_lastseen_int = date ("YmdHis", filemtime($players_dir . '/' .$file));
		$player_lastseen = date ("F d Y H.i", filemtime($players_dir . '/' .$file));
		$player_json->last_seen_int = $player_lastseen_int;
		$player_json->last_seen = $player_lastseen;
		array_push($players_array, $player_json);
		fclose($player_file);
	}

	function cmp($a, $b) {
		return strcmp($b->last_seen_int, $a->last_seen_int);
	}
	
	usort($players_array, "cmp");
?>

			<h2 class="sub-header"><?php echo $SERVERCONF->name ?> Players</h2>
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th></th>
							<th>Name</th>
							<th>Last Seen</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							foreach ($players_array as $player) {
								echo "<tr>";
								echo "<td><img src='images/players_images/".$player->id.".png'/></td>";
								echo "<td>".$player->name."</td>";
								echo "<td>".$player->last_seen."</td>";
								echo "</tr>";
							}
						?>
					</tbody>
				</table>
			</div>

	
<?php 
	include("footer.inc");
?>


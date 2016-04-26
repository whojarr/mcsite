<?php

	include("header.inc");

	$server_json = file_get_contents('config/server.json');
	$SERVERCONF = json_decode($server_json);

	$player_file = fopen('data/banned-players.json', 'r');
	$player_json = fread($player_file,filesize('data/banned-players.json'));
	$player_array = json_decode($player_json);

	usort($player_array, function($a, $b) {
		if ($b->created == $a->created) {
			return 0;
		}
		return $b->created < $a->created ? -1 : 1;
	});
?>

			<h2 class="sub-header"><?php echo $SERVERCONF->name ?> Players</h2>
			 <div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Name</th>
							<th>Reaon</th>
							<th>Date</th>
							<th>Length</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							foreach ($player_array as $player) {
								echo "<tr>";
								echo "<td>".$player->name."</td>";
								echo "<td>".$player->reason."</td>";
								echo "<td>".date('Y-m-d H:i', strtotime($player->created)) ."</td>";
								echo "<td>".$player->expires."</td>";
								echo "</tr>";
							}
						?>
					</tbody>
				</table>
			</div>

<?php
	include("header.inc");
?>
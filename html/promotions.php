<?php
	include("header.inc");

	$server_json = file_get_contents('config/server.json');
	$SERVERCONF = json_decode($server_json);

	$autopromote_yaml = yaml_parse_file('data/plugins/noirland_autopromote/config.yml');
	$autopromote_ranks_array = $autopromote_yaml['ranks'];

	// build a new array with a flat assocative array for out put and ordering
	$ranks_array = array();

	foreach ($autopromote_ranks_array as $rank=>$key) {

		// cover user being lastseen or array index if not present
		if( array_key_exists('default', $key) ) {
			$default = $key['default'];
		}
		else {
			$default = "";
		}

		if( array_key_exists('noPromote', $key) ) {
			$nopromote = $key['noPromote'];
		}
		else {
			$nopromote = "";
		}

		if( array_key_exists('promoteTo', $key) ) {
			$promoteto= $key['promoteTo'];
		}
		else {
			$promoteto = "";
		}

		if( array_key_exists('playTimeNeeded', $key) ) {
			$playtimeneeded= $key['playTimeNeeded'];
		}
		else {
			$playtimeneeded = "0";
		}

		if ($playtimeneeded > 0) {
			// create each rank array
			$rank_array = array();
			$rank_array['name'] = $rank;
			$rank_array['default'] = $default;
			$rank_array['nopromote'] = $nopromote;
			$rank_array['promoteto'] = $promoteto;
			$rank_array['playtimeneeded'] = $playtimeneeded;

			array_push($ranks_array, $rank_array);
		}

	}


	// Sort the Ranks Alphabeticalls
	function sortranks($a, $b) {
		return strcmp($a['name'], $b['name']);
	}
	usort($ranks_array, "sortranks");


?>

			<h2 class="sub-header"><?php echo $SERVERCONF->name ?> Promotions</h2>
			 <div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Rank</th>
							<th>Next Rank</th>
							<th>Time Required</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							foreach ($ranks_array as $rank) {
								echo "<tr>";
								if($rank['default'] == 1) {
									echo "<td>".$rank['name']." (default)</td>";
								}
								else {
									echo "<td>".$rank['name']."</td>";
								}
								echo "<td>".$rank['promoteto']."</td>";
								if($rank['playtimeneeded'] > 0) {
									echo "<td>".$rank['playtimeneeded']."hrs</td>";
								}
								else {
									echo "<td></td>";
								}
								echo "</tr>";
							}
						?>
					</tbody>
				</table>
			</div>

<?php 
include("footer.inc");
//var_dump($users['users']);
?>

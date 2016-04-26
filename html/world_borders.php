<?php

	$server_json = file_get_contents('config/server.json');
	$SERVERCONF = json_decode($server_json);

	$worldborders = yaml_parse_file('data/plugins/worldborders/config.yml');
	$worldborders_worlds_array = $worldborders['worlds'];

	// build a new array with a flat assocative array for out put and ordering
	$worlds_array = array();

	foreach ($worldborders_worlds_array as $world=>$key) {

		// create each world array
		$world_array = array();
		$worldname = str_ireplace('_', ' ', $world);
		$worldname = ucwords($worldname);
		$world_array['name'] = $worldname;
		$world_array['radiusX'] = $key['radiusX'];
		$world_array['radiusZ'] = $key['radiusZ'];
		array_push($worlds_array, $world_array);

	}


	// Sort the Ranks Alphabeticalls
	function sortworlds($a, $b) {
		return strcmp($a['name'], $b['name']);
	}
	usort($worlds_array, "sortworlds");

	include("header.inc");

?>

			<h2 class="sub-header"><?php echo $SERVERCONF->name ?> Worlds</h2>
			 <div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Name</th>
							<th>radiusX</th>
							<th>radiusZ</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							foreach ($worlds_array as $world) {
								echo "<tr>";
								echo "<td>".$world['name']."</td>";
								echo "<td>".$world['radiusX']."</td>";
								echo "<td>".$world['radiusZ']."</td>";
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

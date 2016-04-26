<?php
	include("header.inc");

	$server_json = file_get_contents('config/server.json');
	$SERVERCONF = json_decode($server_json);

	$users_yaml = yaml_parse_file('data/plugins/groupmanager/users.yml');
	$users_array = $users_yaml['users'];

	// build a new array with a flat assocative array for out put and ordering
	$ranks_array = array();
	$user_ranks_array = array();

	foreach ($users_array as $user=>$key) {

		// cover user being lastseen or array index if not present
		$lastname = "";
		if( array_key_exists('lastname', $key) ) {
			$lastname = $key['lastname'];
		}
		else {
			$lastname = $user;
		}

		// create eash user array
		$user_array = array();
		$user_array['uuid'] = $user;
		$user_array['name'] = $lastname;
		$user_array['group'] = $key['group'];
		array_push($user_ranks_array, $user_array);

		// Create Array of Uique Ranks
		if( !array_key_exists($key['group'], $ranks_array) ) {
			$rank_array = array();
			$rank_array['name'] = $key['group'];
			$rank_array['user_count'] = 1;
			$ranks_array[$key['group']] = $rank_array;
			
		}
		else {
			$ranks_array[$key['group']]['user_count'] += 1;
		}

	}


	// Sort the Ranks Alphabeticalls
	function sortranks($a, $b) {
		return strcmp($a['name'], $b['name']);
	}
	usort($ranks_array, "sortranks");

	// Sort the users_ranks by group
	function sortuserranks($a, $b) {
		return strcmp($a['group'], $b['group']);
	}
	usort($user_ranks_array, "sortuserranks");

?>

			<h2 class="sub-header"><?php echo $SERVERCONF->name ?> Ranks</h2>
			 <div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Rank</th>
							<th>User Count</th>
						</tr>
					</thead>
					<tbody>
						<?php 
/*  							foreach ($user_ranks_array as $user) {
								echo "<tr>";
								echo "<td>".$user['name']."</td>";
								echo "<td>".$user['group']."</td>";
								echo "</tr>";
							} */
							foreach ($ranks_array as $rank => $value) {
								echo '<tr>';
								echo '<td><a href="rank_players.php?rank='.$value['name'].'">'.$value['name'].'</a></td>';
								echo '<td>'.$value['user_count'].'</td>';
								echo '</tr>';
							}
						?>
					</tbody>
				</table>
			</div>

<?php 
include("footer.inc");
//var_dump($users['users']);
?>

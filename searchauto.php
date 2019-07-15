<?php
	include_once("database.php");

	$searchName = $_GET['term'];
	$findTerm = array();
	$sql = "SELECT * FROM image WHERE name LIKE '%$searchName%' ORDER BY name DESC";
	$result = mysqli_query($con,$sql);
	while($row = mysqli_fetch_assoc($result)){
		$data['value'] = $row['name'];
		array_push($findTerm, $data);
	}
	echo json_encode($findTerm);
?>
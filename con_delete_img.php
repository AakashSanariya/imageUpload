<?php
	 extract($_POST);
	 $success = 1;
	include_once('database.php');
	/*Image Delete From Database*/
	$sql = "DELETE  FROM image where id=".$_POST['id'];
	$result = mysqli_query($con,$sql);

	/*Delete image from localserver*/
	unlink($_POST['path']);
	

	/*selecting data from database*/
	$select = "SELECT * FROM image";
	$selectResult = mysqli_query($con,$select);
	
	while($selectResult = mysqli_fetch_assoc($selectResult)){
		echo json_encode($selectResult);	
	}
	
	echo "suceess";
	exit();
?>
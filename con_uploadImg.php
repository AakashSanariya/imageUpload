<?php
extract($_POST);


if(isset($_FILES['image'])){
	$target_dir = "Image/";
	$new_name = date("m-d-Y H:i:s");
	$target_file = $target_dir . $new_name . '_' . basename($_FILES["image"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["image"]["tmp_name"]);
		if($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}
	}
// Check if file already exists
	if (file_exists($target_file)) {
		echo "Sorry, file already exists.";
		$uploadOk = 0;
	}
// Check file size
	if ($_FILES["image"]["size"] > 500000) {
		echo "Sorry, your file is too large.";
		$uploadOk = 0;
	}
// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	$uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
	echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
	if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
		// echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
	} else {
		echo "Sorry, there was an error uploading your file.";
	}
}
}


/*Insert image in Database*/
include_once('database.php');
$sql = "INSERT INTO image (id, name, imagePath) VALUES (NULL, '$name', '$target_file')";
$result = mysqli_query($con,$sql);

/*checking upload */
if($result == 1)
{
	header("location: list.php");
}
else{
	header("location: index.php");
}
?>
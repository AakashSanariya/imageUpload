<!DOCTYPE html>
<html>
<head>
	<title>Image Uploading</title>

	<!-- Bootstrap CDN Link -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<!-- //Bootstrap CDN -->

	<!-- Jquery Validator Plugin CDN Link-->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
	<!-- // Jquery Validator -->

</head>
<body>
	<div class="container">
		<div style="text-align: center"><h3>Upload File</h3></div>
		<form action="con_uploadImg.php" method="POST" enctype="multipart/form-data" id="registration-form">
			<div class="form-group">
				<div class="custom-file mb-3">
					<div class="md-form">
						<input placeholder="Enter Name" type="text" name="name" id="inputPlaceholderEx" class="form-control">

					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="custom-file mb-3">
					<input type="file" class="custom-file-input" id="customFile" name="image"
					data-validation="mime size"
					data-validation-allowing="jpg,jpeg, png"
					data-validation-max-size="500kb"
					required 
					>
					<label class="custom-file-label" for="customFile">Choose file</label>
				</div>
			</div>

			<div class="form-group">
				<input type="submit" value="Upload" class="btn btn-primary">
			</div>
		</form>
	</div>

	<script>
		/*name of the file appear on select*/
		$(".custom-file-input").on("change", function() {
			var fileName = $(this).val().split("\\").pop();
			$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
		});
	</script>

	<!-- Input Validation -->
	<script type="text/javascript">
		$.validate({
			modules: 'file'
		});
	</script>
</body>
</html>
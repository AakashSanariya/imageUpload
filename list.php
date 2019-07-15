<!DOCTYPE html>
<html>
<head>
	<title>List Of Upload Image</title>

	<!-- Bootstrap CDN Link -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

	<!-- Bootstrap CDN -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<!-- //Bootstrap CDN -->

	<!-- Search autocomplete JS -->
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
 	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 	 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<!-- // Search autocomplete JS -->

	<!-- Notify Js -->
	<script type="text/javascript" src="js/notify.min.js"></script>
	<script type="text/javascript" src="js/notify.js"></script>
	<!-- // Notify Js -->

</head>
<body>
	<div class="container">
		<div style="text-align: center"><h3>Listed Image</h3></div>
		<div class="float-right mb-3"><a href="index.php"><button class="btn btn-primary">Upload Image</button></a></div>
		<div class="input-group mb-6">
			<input type="text" class="form-control ui-widget" id="search" name="search" placeholder="Search">
			<div class="input-group-append">
				<button class="btn btn-success" type="submit" onclick="search()">Search</button> 
			</div>
			<button class="btn btn-secondary" onclick="resetform()">Reset</button>
		</div>
		<div id="table">
			
		</div>
	</div>

	<!-- Delete Image Ajax -->
	<script type="text/javascript">
		function delete_img(path, id) {
			var img_path = path;
			var imgId = id;
			var status = confirm("Are you sure you want delete this ?");
			if(status == true){
				var success = 1;
				/*Ajax*/
				$.ajax({
					url: 'con_delete_img.php',
					type: 'POST',
					data: {path:img_path, id:imgId},
					success: function(delteResponse){
						var delteResponse = delteResponse;
						if(delteResponse !== "NUll"){
							loadData();
							$.notify("Successfully Delete Image", "success");
						}
					}
				});

			}
		}

		function loadData(){
			var action = "fetch";
			$.ajax({
				url: 'ajaxdataload.php',
				type: 'POST',
				data: { action: action},
				success: function(data){
					$('#table').html(data);
				}
			});
		}

		/*For Searching Image*/

		function search(){
			var data = document.getElementById("search").value;
			var action = "search";
			$.ajax({
				url: 'search.php',
				type: 'POST',
				data: { search: data, action: action },
				success: function(data){
					$('#table').html(data);
				}
			});
		}		

		/* For auto load searching Complete*/
		$(function(){
			$("#search").autocomplete({
				source: 'searchauto.php',

			})
		});

		loadData();
		function resetform(){
			document.getElementById("search").value="";			
		}


	</script>
</body>
</html>
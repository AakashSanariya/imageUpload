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

	<!--Font awosome for Icon 	-->
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
	<!-- // Font awosome for Icon 	-->

	<!-- Notify Js -->
	<script type="text/javascript" src="js/notify.min.js"></script>
	<script type="text/javascript" src="js/notify.js"></script>
	<!-- // Notify Js -->
	<style>
		.searchBack{
			background: lightgray;
		}
	</style>

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
		<div class="form-group float-right mt-3">
			<select id="sorting" class="form-control col-md-12" onchange="loadData();">
				<option value="a-z" selected>A to Z</option>
				<option value="z-a">Z to A</option>
			</select>
		</div>
		<div id="table">
			
		</div>
		
		<!-- For pagination getting pageNumber-->
		<?php
			if (isset($_GET['pageNumber'])) {
				$pageNumber = $_GET['pageNumber'];
				echo "<input type='hidden' id='pageNumber' value='$pageNumber'>";
			}
			else{
				$pageNumber = "1";
				echo "<input type='hidden' id='pageNumber' value='$pageNumber'>";
			}
		?>
		<!-- //For pagination getting pageNumber-->
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

		/*Data Load*/
		function loadData(){
			var action = "fetch";
			var sort = document.getElementById("sorting").value;
			var pageNumber = document.getElementById("pageNumber").value;
			$.ajax({
				url: 'ajaxdataload.php',
				type: 'POST',
				data: { action: action, pageNumber: pageNumber, sorting: sort},
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

		/* For auto load searching Complete only dispaly at search input*/
		$(function(){
			$("#search").autocomplete({
				autoFocus: true,
				position : {my: "right top", at: "right bottom"},
				classes : {
					"ui-autocomplete" : "searchBack"
				},
				source: 'searchauto.php'
			})

		});

		loadData();
		function resetform(){
			document.getElementById("search").value="";			
		}


	</script>
</body>
</html>
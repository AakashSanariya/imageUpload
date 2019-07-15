<?php
if($_POST['action'] == "fetch"){
?>
	<table class="table table-dark table-striped" id="Image-preview">
		<thead>
			<tr>
				<th>Number</th>
				<th>Name</th>
				<th>Image</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>
			<?php
			include_once('database.php');
			$sql = "SELECT * FROM image";
			$result = mysqli_query($con, $sql);
			while ($row = mysqli_fetch_assoc($result)) {
				?>
				<tr>
					<td><?php echo($row['id']); ?></td>
					<td><?php echo($row['name']); ?></td>
					<td><img src="<?php echo($row['imagePath']); ?>" width="80px" height="80px"></td>
					<td><button class="btn btn-danger" id="delete_file" onclick="delete_img('<?php echo($row['imagePath']); ?>', '<?php echo($row['id']) ?>')">Delete</button></td>
				</tr>
				<?php
			}
		}
			?>
		</tbody>
	</table>

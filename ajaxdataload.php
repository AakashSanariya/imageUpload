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

			/* For Pagination Display Record per page*/
			$limitRecord = 2;

			if(isset($_POST['pageNumber'])){
				$pageNumber = $_POST['pageNumber'];
			}
			else{
				$pageNumber = "1";
			}
			$startFrom = ($pageNumber -1) * $limitRecord;


			/*page Moveing */
			$countRecord = "SELECT COUNT(*) as record FROM image";
			$resultCount = mysqli_query($con,$countRecord);
			$rowCount = mysqli_fetch_assoc($resultCount);
			$totalRecord = $rowCount['record'];
			$totalPage = ceil($totalRecord / $limitRecord);


			$sql = "SELECT * FROM image LIMIT $startFrom, $limitRecord";
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
<ul class="pagination">
	<li class="page-item"><a class="page-link" href="?pageNumber=1">First</a></li>
	<li class="page-item <?php if($pageNumber <= 1){ echo 'disabled'; } ?>">
        <a class="page-link" href="<?php if($pageNumber <= 1){ echo ''; } else { echo "?pageNumber=".($pageNumber - 1); } ?>">Prev</a>
    </li>
	<li class="page-item <?php if($pageNumber >= $totalPage){ echo 'disabled'; } ?>">
		<a class="page-link" href="<?php if($pageNumber >= $totalPage){ echo (''); } else { echo "?pageNumber=".($pageNumber + 1); } ?>">Next</a>
	</li>
	<li class="page-item"><a class="page-link" href="?pageNumber=<?php echo($totalPage); ?>">Last</a></li>
</ul>
<?php
	if(isset($message)) {
		echo '<label class="text-success">'.$message.'</label>';
	}
?>
<div class="error">
	<div class="alert alert-danger fade in"></div>
</div>
<table class="table table-bordered table-striped table_scrolling">
	<thead>
		<tr>
			<th>Category name</th>
			<th>#</th>
		</tr>
	</thead>
	<tbody>
		<?php
			// show all categories
			foreach($categories as $cat) {
				echo '<tr>';
				echo '<td>'.$cat->category.'</td>';
				echo '<td>';
				echo '<button type="button" id="delcat'.$cat->id.'" class="btn btn-xs btn-warning del_cat">Delete</button></td>';
				echo '</td></tr>';
			}
		?>
	</tbody>
</table>
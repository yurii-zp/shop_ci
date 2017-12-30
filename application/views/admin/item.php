<?php
	if(isset($message)) {
		echo '<label class="text-success">'.$message.'</label>';
	}
?>
<div class="error">
	<div class="alert alert-danger fade in"></div>
</div>
<div class="response_table">
	<table class="table table-bordered table-striped table_scrolling">
		<thead>
			<tr>
				<th>Item name</th>
				<th>Category</th>
				<th>#</th>
			</tr>
		</thead>
		<tbody>
			<?php
				// show all items
				foreach($items as $item) {
					echo '<tr data-catid="'.$item->catid.'">';
					echo '<td>'.$item->item.'</td>';
					echo '<td>'.$item->category.'</td>';
					echo '<td>';
					echo '<button type="button" id="upd'.$item->id.'" class="btn btn-xs btn-info edit_item">Update Item</button>';
					echo '<button type="button" id="del'.$item->id.'" class="btn btn-xs btn-warning del_item">Delete Item</button>';
					echo '</td>';
					echo '</tr>';
				}
			?>
		</tbody>
	</table>
</div>
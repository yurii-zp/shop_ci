<?php
	$this->load->view('templates/header');
?>
<section class="inner_content">
	<div class="container">
		<div class="archive_block">
			<h2 class="text-center">Products in archive</h2>
			<?php
				if($archive) {
			?>
				<form method="post" action="<?php echo site_url('archive/update'); ?>" class="form-inline">
					<div class="error">
						<div class="alert alert-danger fade in"></div>
					</div>
					<div class="table-responsive">
						<table class="table table-bordered table_scrolling">
							<thead>
								<tr>
									<th>Item name</th>
									<th>Category</th>
									<th>Pricein</th>
									<th>Pricesale</th>
									<th>Datesale</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
									foreach($archive as $key => $item) {
										$datetime = new DateTime($item->datesale);
										$date_format = $datetime->format("m-d-y H:i");

										echo '<tr>';
										echo '<td>'.$item->item.'</td>';
										echo '<td>'.$categories[$key]->category.'</td>';
										echo '<td>'.$item->pricein.'</td>';
										echo '<td>'.$item->pricesale.'</td>';
										echo '<td>'.$date_format.'</td>';
										echo '<td>';
										echo '<input type="hidden" class="upd_itemid" value="'.$item->itemid.'">';
										echo '<input type="number" min="1" name="upd_count" value="1" class="form-control">';
										echo '<button type="button" id="upd'.$item->id.'" class="btn btn-success upd_id">Update Item</button>';
										echo '</td>';
										echo '</tr>';
									}
								?>
							</tbody>
						</table>
					</div>
				</form>
			<?php
				}
				else {
					echo '<h3 class="text-center">There are no products in the archive</h3>';
				}
			?>
		</div>
	</div>
</section>
<?php
	$this->load->view('templates/footer');
?>
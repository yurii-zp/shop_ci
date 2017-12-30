<?php
	$this->load->view('templates/header');
?>
<section class="inner_content">
	<div class="container">
		<div class="catalog_block row">
			<h2 class="text-center">
				Our Products
				<span>Select category and price range for all products below</span>
			</h2>
			<form method="post" action="item_filter" class="form-horizontal">
				<div class="cat_wrap clearfix">
					<div class="error col-sm-12">
						<div class="alert alert-danger"></div>
					</div>
					<label class="col-sm-2 col-xs-3 col-xs-offset-1 control-label">Select category: </label>
					<div class="col-sm-8 col-xs-7">
						<select name="cat_catid" id="cat_catid" class="form-control">
							<option value="0">All</option>

							<?php
								foreach($categories as $cat) {
									echo '<option value="'.$cat->id.'">'.$cat->category.'</option>';
								}
							?>

						</select>
					</div>
				</div>
				<!-- when category or price range selected, items will be add here -->
				<div id="ajax-catalog">
					<?php include_once("items.php"); ?>
				</div>
			</form>
		</div>
	</div>
</section>
<?php
	$this->load->view('templates/footer');
?>
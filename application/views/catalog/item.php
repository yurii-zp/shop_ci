<?php
	$this->load->view('templates/header');
?>
<section class="inner_content">
	<div class="container">
		<div class="item_block clearfix">
			<div class="col-sm-6">
				<h2 class="text-center"><?php echo $item->item; ?></h2>
				<p><?php echo $item->info; ?></p>
				<h3 class="text-danger">$<?php echo $item->pricesale; ?></h3>
			</div>
			<div class="col-sm-6">

				<?php
					if($images) {
						echo '<ul class="item_slider">';
						foreach($images as $img) {
							echo '<li><img src="'.base_url($img->imagepath).'" alt="Image"></li>';
						}
						echo '</ul>';
					}
					else {
						echo '<img src="'.base_url("assets/images/layout/item_placeholder.png").'">';
					}
				?>

			</div>
		</div>
		<div class="comment_block all">
			<h3>Reviews</h3>
			<?php
				if(!empty($comments)) {
					foreach($comments as $comm) {
						$datetime = new DateTime($comm->curdate);
						$date_format = $datetime->format("F d, Y");

						echo '<div class="comment">';
						echo '<span class="rating rating_out" data-rating="'.$comm->rating.'"></span>';
						echo '<h4>'.$comm->title.'</h4>';
						echo '<div>'.$date_format.'</div>';
						echo '<h5>'.$comm->username.'</h5>';
						echo '<p>'.$comm->comment.'</p>';
						echo '</div>';
					}
				}
				else {
					echo '<h4>There are no reviews for this product</h4>';
					if(isset($user)) {
						echo '<p>Be the first to write a review<p>';
					}
				}
			?>
		</div>

		<?php if(isset($user)) { ?>
			<div class="comment_block add">
				<h3>Bought goods? Leave a review below!</h3>
				<form method="post" action="<?php echo site_url('catalog/comment_insert'); ?>" class="form-horizontal" role="form" data-toggle="validator">
					<div class="form-group">
						<div class="col-xs-8">
							<input type="hidden" id="itemid" name="itemid" value="<?php echo $item->id ?>">
							<input type="text" id="comm_title" name="comm_title" class="form-control" placeholder="Title">
						</div>
						<div class="col-xs-4">
							<label class="control-label">Rating:</label>
							<span id="rating_in" class="rating" data-rating="5"></span>
						</div>
					</div>
					<div class="form-group has-feedback">
						<div class="col-sm-12">
							<textarea name="comm" id="comm" rows="7" class="form-control" placeholder="Comment..." data-error="Please, enter your comment." required></textarea>
							<div class="help-block with-errors"></div>
						</div>
					</div>
					<button type="submit" id="add_comm" class="btn btn-primary">
						Add comment
						<span class="glyphicon glyphicon-send"></span>
					</button>
				</form>
			</div>
		<?php } ?>

	</div>
</section>
<?php
	$this->load->view('templates/footer');
?>
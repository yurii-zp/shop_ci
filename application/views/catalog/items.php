<div class="range_wrap clearfix">
	<div class="col-xs-8">
		<div id="slider-range"></div>
	</div>
	<div class="col-xs-4">
		<input type="text" name="range" id="range" class="form-control" readonly>
		<button type="button" id="price_filter" class="btn btn-info price_filter">Show</button>
	</div>
</div>
<div class="catalog clearfix">
	<?php
		foreach($items as $key => $item) {
			echo '<div class="col-sm-4 col-xs-6">';
			echo '<h4 class="text-center">'.$item->item.'</h4>';
			if($item->imagepath) {
				echo '<div class="item_img" style="background-image: url('.base_url($item->imagepath).'); "></div>';
			}
			else {
				echo '<div class="item_img" style="background-image: url('.base_url("assets/images/layout/item_placeholder.png").'); "></div>';
			}
			echo '<div class="excerpt">';
			$excerpt = substr($item->info, 0, strpos($item->info,'</p>'));
			echo $excerpt.'</p>';
			echo '</div>';
			echo '<h3 class="text-danger text-right">$'.$item->pricesale.'</h3>';
			if($item->count != 0) {
				echo '<div class="text-right">';
				echo '<a href="'.site_url('catalog/item/'.$item->id).'" target="_blank" class="btn btn-sm btn-info">View More</a>';
				echo '<button type="button" id="cart'.$item->id.'" class="btn btn-sm btn-success to_cart">Add to Cart</button>';
				echo '</div></div>';
			}
			else {
				echo '<span class="text-warning">Not in stock</span>';
				echo '<input type="hidden" value="'.$item->id.'">';
				echo '<a href="#" class="btn btn-sm btn-primary pull-right">To order</a></div>';
			}
		}
	?>
</div>
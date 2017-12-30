<form method="post" action="<?php echo site_url('buy_delete'); ?>" class="cart_form">
	<div class="table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Item name</th>
					<th>&nbsp;</th>
					<th>Info</th>
					<th>Price</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach($items as $key => $item) {
						$excerpt = substr($item->info, 0, strpos($item->info,'</p>'));

						echo '<tr>';
						echo '<td><h4 class="text-center">'.$item->item.'</h4></td>';
						if($img) {
							echo '<td><img src="'.base_url($img[$key]).'"></td>';
						}
						else {
							echo '<td><img src="'.base_url("assets/images/layout/item_placeholder.png").'"></td>';
						}
						echo '<td>'.$excerpt.'</p></td>';
						echo '<td>$'.$item->pricesale.'</td>';
						echo '<td>';
						echo '<button type="button" id="delcart'.$cart_items[$key]->id.'" data-itemid="'.$cart_items[$key]->itemid.'" 
							  class="btn btn-md btn-warning del_cart">Delete Item</button>';
						echo '<button type="button" id="buycart'.$cart_items[$key]->itemid.'" class="btn btn-md btn-success buy_cart">Buy Now</button>';
						echo '</td>';
						echo '</tr>';
					}
				?>
			</tbody>
		</table>
	</div>
	<div class="nth_padding clearfix">
		<div class="col-xs-6">
			<?php
				if(isset($user)) {
					$login = $user['login'];
				}
				else {
					$login = null;
				}

				if(!empty($login)) {
					echo '<h3 class="text-success">Current discount: '.$user['discount'].'%</h3>';
				}
				else {
					echo '<h3 class="text-success">Your order: '.$orderid.'</h3>';
				}
			?>
		</div>
		<div class="col-xs-6">
			<h2 class="text-right text-info">IN TOTAL: $<?php echo $discount; ?></h2>
		</div>
	</div>
</form>
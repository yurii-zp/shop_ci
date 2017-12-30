<?php
	$this->load->view('templates/header');
?>
<section class="inner_content">
	<div class="container">
		<div class="cart_block">
			<h2 class="text-center">
				My Cart
				<span>Look at statistics for all products in the cart</span>
			</h2>
			<?php
				$orderid = $this->session->orderid;
				// if user has already purchased products before
				if(isset($orderid)) {
					// if user have items in the cart
					if(!empty($cart)) {
					?>
						<form method="post" action="<?php echo site_url('cart/buy_delete'); ?>" class="cart_form"> <!--inc/cart_buy_delete.php-->
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
					<?php
					}
					// if user does not have items in the cart
					else {
						echo '<h3 class="text-center">You have no shopping cart. Look our products on <a href="'.site_url('catalog/index').'">Catalog</a> page.</h3>';
					}
				}
				// if user doesen't purchased products before
				else {
			?>
					<h3 class="text-center">You have no shopping cart. Look our products on <a href="<?php echo site_url('catalog/index'); ?>">Catalog</a> page.</h3>
					<div class="order_wrap text-center">
						<?php if(!isset($user)) : ?>
							<span id="setorder" class="setorder text-info">I'm non registered user</span>
						<?php endif; ?>
						<div>
							<span class="close">×</span>
							<form method="post" action="<?php echo site_url('cart/get_order'); ?>" class="order_form" role="form" data-toggle="validator">
								<div class="form-group has-feedback">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-cog"></i></span>
										<input type="text" name="ordernum" placeholder="Enter the order number" id="ordernum" class="form-control" maxlength="32" 
										data-error="Please, enter your order." autocomplete="off" required>
									</div>
									<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
									<div class="help-block with-errors text-left"></div>
								</div>
								<input type="submit" name="getorder" class="btn btn-primary" value="Send">
							</form>
						</div>
					</div>
			<?php } ?>
		</div>
	</div>
</section>
<?php
	$this->load->view('templates/footer');
?>
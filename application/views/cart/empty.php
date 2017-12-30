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
			<h3 class="text-center">You have no shopping cart. Look our products on <a href="<?php echo site_url('catalog/index'); ?>">Catalog</a> page.</h3>
			<div class="order_wrap text-center">	
				<span id="setorder" class="setorder text-info">I'm non registered user</span>
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
			<p class="text-center text-danger">Not correct order number</p>
		</div>
	</div>
</section>
<?php
	$this->load->view('templates/footer');
?>
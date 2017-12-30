<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" type="image/png" href="<?php echo base_url('assets/images/layout/favicon.png') ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/slick-theme.css') ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/slick.css') ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/jquery-ui.min.css') ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/mCustomScrollbar.min.css') ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css') ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/responsive.css') ?>">
		<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-1.12.4.min.js') ?>"></script>
		<title>Shop</title>
	</head>
	<body>
		<div id="preloader"></div>

	<!-- Start registration & authentification modal -->

		<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
			<div class="modal-dialog">
				<div class="error">
					<div class="alert alert-danger fade in"></div>
				</div>
				<div id="ajax-content" class="modal-content">
					<!-- form will be add here -->
				</div>
			</div>
		</div>

	<!-- Start item insert & update modal -->

		<div class="modal fade" id="upd_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
			<div class="modal-dialog">
				<div class="error">
					<div class="alert alert-danger fade in"></div>
				</div>
				<div class="modal-content">
					<form method="post" action="<?php echo site_url('admin/item_insert'); ?>" enctype="multipart/form-data" class="item_form" role="form" data-toggle="validator">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Update Item</h4>
						</div>
						<div class="modal-body clearfix">
							<div class="form-group has-feedback">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-plus"></i></span>
									<input type="text" name="item" id="upd_name" class="form-control" placeholder="Item name" autocomplete="off" maxlength="64" 
									data-error="Please, enter the item." required>
								</div>
								<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
								<div class="help-block with-errors"></div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-4">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-cog"></i></span>
											<input type="number" name="count" id="upd_count" class="form-control" min="1" value="1" placeholder="Amount">
										</div>
									</div>
									<div class="col-md-4">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
											<input type="number" name="pricein" id="upd_pricein" class="form-control" min="0.01" step="0.01" placeholder="Price" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
											<input type="number" name="pricesale" id="upd_pricesale" class="form-control" min="0.01" step="0.01" placeholder="Selling price" required>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group has-feedback">
								<textarea rows="7" name="item_info" placeholder="Description" id="upd_itemeditor" class="form-control" data-error="Please, enter item description."></textarea>
								<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="reset" class="btn btn-default">
								Reset
								<span class="glyphicon glyphicon-refresh"></span>
							</button>
							<div class="uploader_wrap">
								<input type="file" name="img[]" id="file" multiple accept="image/*">
								<a href="#" class="btn btn-info pseudo_uploader">Add Images</a>
							</div>
							<input type="hidden" name="item_id" id="item_id">
							<button type="submit" name="upd_item" id="upd_item" class="btn btn-success">
								<span>Update Item</span>
								<span class="glyphicon glyphicon-send"></span>
							</button>
						</div>
					</form>
				</div>
			</div>

		</div>

	<!-- End modals -->

		<div class="main_wrap">
			<header class="header clearfix">
				<div class="header_wrap">
					<a href="<?php echo site_url('home/index'); ?>" class="logo">Shop</a>
					<div class="navigation_wrap">
						<nav class="main_navigation">
							<a href="#" class="mob_close_btn"></a>
							<?php $this->load->view('templates/menu'); ?>
						</nav>
					</div>
					<a href="<?php echo site_url('cart/index'); ?>" class="cart">
						<span>
							<?php
								if(isset($this->session->orderid)) {
									echo $cart;
								}
								else {
									echo 0;
								}
							?>
						</span>
					</a>

					<?php
						// open session for current user
						if(isset($this->session->reguser) || isset($this->session->regadmin)) :
							if(isset($this->session->reguser)) {
								$login = $this->session->reguser;
							}
							else {
								$login = $this->session->regadmin;
							}
					?>
						<div class="profile">
							<div class="avatar">
								<?php
									// show user avatar
									if($user['avatar']) {
										$avatar = base64_encode($user['avatar']);
										echo '<img src="data:image/jpg; base64,'.$avatar.'" alt="avatar" />';
									}
									else {
										echo '<img src="'.base_url('assets/images/layout/avatar_placeholder.png').'">';
									}
								?>
								<div class="overlay"></div>
							</div>
							<div class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
									<?php echo $login; ?>
									<span class="caret"></span>
								</a>
								<ul class="dropdown-menu">
									<li>
										<a href="<?php echo site_url('profile/index'); ?>">Profile</a>
									</li>
									<li>
										<form method="post" action="<?php echo site_url('register/logout'); ?>">
											<input type="submit" name="logout" value="Logout">
										</form>
									</li>
								</ul>
							</div>
						</div>

					<?php else : ?>

						<div class="reg_box">
							<a href="<?php echo site_url('register/signin'); ?>" class="signin modal-ajax" data-toggle="modal" data-target="#modal">Sign In</a>
							<span>OR</span>
							<a href="<?php echo site_url('register/signup'); ?>" class="signup modal-ajax" data-toggle="modal" data-target="#modal">Sing Up</a>
						</div>

					<?php endif; ?>
					<a href="#" class="mob_btn"></a>
				</div>
			</header>
			<main>

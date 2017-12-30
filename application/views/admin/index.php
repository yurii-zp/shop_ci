<?php
	$this->load->view('templates/header');
?>
<section class="inner_content">
	<div class="container">
		<div class="admin_block">
			<h2 class="text-center">Admin Area</h2>
			<div id="tabs" class="tabs">
				<ul>
					<li>
						<a href="#tab_1">Categories</a>
					</li>
					<li>
						<a href="#tab_2">Items</a>
					</li>
					<li>
						<a href="#tab_3">Users</a>
					</li>
				</ul>

			<!-- Start category tab -->
				<div id="tab_1" class="cat_tab">
					<div class="nth_padding clearfix">
						<div class="col-sm-7">
							<form method="post" action="<?php echo site_url('admin/category'); ?>" class="cat_form" role="form" data-toggle="validator">
								<div class="error">
									<div class="alert alert-danger fade in"></div>
								</div>
								<div class="form-group has-feedback">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-pushpin"></i></span>
										<input type="text" name="category" placeholder="Category name" class="form-control" maxlength="64" data-error="Please, add a category." 
										data-nextid="<?php echo $nextid->ai; ?>" required>
									</div>
									<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
								<button type="submit" class="btn btn-success">
									Add Category
									<span class="glyphicon glyphicon-send"></span>
								</button>
							</form>
						</div>
						<div class="col-sm-5">
							<input type="search" placeholder="Search Category" data-url="<?php echo site_url('admin/category'); ?>" class="form-control search_data">
							<form method="post" action="<?php echo site_url('admin/category'); ?>" class="cat_all_form clearfix">
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
							</form>
						</div>
					</div>
				</div>
			<!-- End category tab -->

			<!-- Start item tab -->
				<div id="tab_2" class="item_tab">
					<div class="nth_padding clearfix">
						<div class="col-sm-6">
							<form method="post" action="<?php echo site_url('admin/item_insert'); ?>" enctype="multipart/form-data" class="item_form" role="form" data-toggle="validator">
								<div class="error">
									<div class="alert alert-danger fade in"></div>
								</div>
								<div class="form-group has-feedback">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-plus"></i></span>
										<input type="text" name="item" placeholder="Item name" class="form-control" maxlength="64" data-error="Please, enter the item." required>
									</div>
									<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
									<div class="help-block with-errors"></div>
								</div>
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-pushpin"></i></span>
										<select name="catid" id="catid" class="form-control">
											<option value="default">Select Categories</option>
											<?php
												// show all categories in select
												foreach($categories as $cat) {
													echo '<option value="'.$cat->id.'">'.$cat->category.'</option>';
												}
											?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-md-4">
											<input type="number" name="count" min="1" value="1" placeholder="Amount" class="form-control">
										</div>
										<div class="col-md-4">
											<input type="number" name="pricein" min="0.01" step="0.01" placeholder="Price" class="form-control" required>
										</div>
										<div class="col-md-4">
											<input type="number" name="pricesale" min="0.01" step="0.01" placeholder="Selling price" class="form-control" required>
										</div>
									</div>
								</div>
								<div class="form-group has-feedback">
									<textarea rows="7" name="item_info" placeholder="Description" id="itemeditor" class="form-control" data-error="Please, enter item description."></textarea>
									<div class="help-block with-errors"></div>
								</div>
								<button type="reset" class="btn btn-default">
									Reset
									<span class="glyphicon glyphicon-refresh"></span>
								</button>
								<div class="uploader_wrap">
									<input type="file" name="img[]" multiple accept="image/*">
									<a href="#" class="btn btn-info pseudo_uploader">Add Images</a>
								</div>
								<button type="submit" class="btn btn-success">
									Add Item
									<span class="glyphicon glyphicon-send"></span>
								</button>
							</form>
						</div>
						<div class="col-sm-6">
							<input type="search" placeholder="Search Product" data-url="<?php echo site_url('admin/item_search'); ?>" class="form-control search_data">
							<form method="post" action="<?php echo site_url('admin/item_insert'); ?>" class="item_all_form">
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
							</form>
						</div>
					</div>
				</div>
			<!-- End item tab -->

			<!-- Start user tab -->
				<div id="tab_3" class="user_tab">
					<input type="search" placeholder="Search User" data-url="<?php echo site_url('admin/user'); ?>" class="col-sm-3 form-control search_data">
					<form method="post" action="<?php echo site_url('admin/user'); ?>" class="user_all_form">
						<div class="error">
							<div class="alert alert-danger fade in"></div>
						</div>
						<div class="response_table">
							<table class="table table-bordered table-striped table_scrolling">
								<thead>
									<tr>
										<th>Username</th>
										<th>Email</th>
										<th>Role</th>
									</tr>
								</thead>
								<tbody>
									<?php
										// show all users
										foreach($users as $user) {
											switch($user->roleid) {
												case 2:
													$role = 'Administrator';
													$text = 'Change to user';
													$btn = 'info';
													break;
												default:
													$role = 'Customer';
													$text = 'Make admin';
													$btn = 'success';
													break;
											}
											echo '<tr>';
											echo '<td>'.$user->login.'</td>';
											echo '<td>'.$user->email.'</td>';
											echo '<td>'.$role;
											echo '<div class="btn_wrap">';
											echo '<button type="button" value="'.site_url('admin/user').'" id="ad'.$user->id.'" class="btn btn-xs btn-'.$btn.' user_action">'.$text.'</button>';
											echo '<button type="button" value="'.site_url('admin/user_delete').'" id="de'.$user->id.'" class="btn btn-xs btn-warning user_action">Delete</button>';
											echo '</div>';
											echo '</td>';
											echo '</tr>';
										}
									?>
								</tbody>
							</table>
						</div>
					</form>
				</div>
			<!-- End user tab -->
		</div>
	</div>
</section>
<?php
	$this->load->view('templates/footer');
?>
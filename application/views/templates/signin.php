<form method="post" action="<?php echo site_url('register/signin'); ?>" id="signin" class="form-horizontal ajax-form" role="form" data-toggle="validator">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Sign In</h4>
		</div>
		<div class="modal-body clearfix">
			<div class="form-group has-feedback">
				<label for="login_in" class="control-label col-sm-4">Login</label>
				<div class="col-sm-8">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input type="text" name="login_in" id="login_in" class="form-control" minlength="3" maxlength="64" 
						data-error="Please, required this field. Minimum 3 characters." required>
					</div>
					<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					<div class="help-block with-errors"></div>
				</div>
			</div>

			<div class="form-group has-feedback">
				<label for="pass_in" class="control-label col-sm-4">Password</label>
				<div class="col-sm-8">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-cog"></i></span>
						<input type="password" name="pass_in" id="pass_in" class="form-control" minlength="4" maxlength="64"
						data-error="Please, required this field." required>
					</div>
					<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					<div class="help-block with-errors"></div>
					<a href="<?php echo site_url('register/forgot_pass'); ?>" id="forgot_pass" class="modal-ajax" data-target="#modal">
						<em>Forgot Password?</em>
					</a>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">
				Cancel
				<span class="glyphicon glyphicon-remove"></span>
			</button>
			<input type="submit" name="signin" class="btn btn-primary" value="Sign In">
		</div>
	</form>
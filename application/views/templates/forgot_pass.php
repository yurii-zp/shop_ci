<form method="post" action="<?php echo site_url('register/forgot_pass'); ?>" id="forgot" class="form-horizontal ajax-form" role="form" data-toggle="validator">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Change Password</h4>
	</div>
	<div class="modal-body clearfix">
		<div class="form-group has-feedback">
			<label for="login_ch" class="control-label col-sm-4">Login</label>
			<div class="col-sm-8">
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
					<input type="text" name="login_ch" id="login_ch" class="form-control" minlength="3" maxlength="64" 
					data-error="Please, required this field. Minimum 3 characters." required>
				</div>
				<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
				<div class="help-block with-errors"></div>
			</div>
		</div>

		<div class="form-group has-feedback">
			<label for="pass_ch" class="control-label col-sm-4">New Password</label>
			<div class="col-sm-8">
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-cog"></i></span>
					<input type="password" name="pass_ch" id="pass_ch" class="form-control" minlength="4" maxlength="64"
					data-error="Please, required this field." required>
				</div>
				<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
				<div class="help-block">Minimum of 4 characters</div>
			</div>
		</div>

		<div class="form-group has-feedback">
			<label for="conf_pass_ch" class="control-label col-sm-4">Confirm New Password</label>
			<div class="col-sm-8">
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-cog"></i></span>
					<input type="password" name="conf_pass_ch" id="conf_pass_ch" class="form-control" data-match="#pass_ch" data-error="Please, required this field." 
					data-match-error="Passwords do not match" required>
				</div>
				<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
				<div class="help-block with-errors"></div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">
			Cancel
			<span class="glyphicon glyphicon-remove"></span>
		</button>
		<input type="submit" name="change_pass" class="btn btn-primary" value="Change Password">
	</div>
</form>
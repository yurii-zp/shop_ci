<?php
	if(isset($message)) {
		echo '<label class="text-success">'.$message.'</label>';
	}
?>
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
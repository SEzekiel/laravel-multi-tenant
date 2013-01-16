@layout('layouts.root')

{{-- Password changing form --}}

@section('content')
	<div class="page-header">
		<h1>Change Password</h1>
	</div>

	@render('parts.alert')

	{{ Form::horizontal_open()}}

		<?php 
		echo Form::control_group(
			Form::label('old_password', 'Old Password'),
			Form::password('old_password', array('placeholder' => 'Your old password')),
			$errors->has('old_password') ? 'error' : '',
		 	$errors->has('old_password') ? Form::inline_help($errors->first('old_password')) : ''
			);

		echo Form::control_group(
			Form::label('new_password', 'New Password'),
			Form::password('new_password', array('placeholder' => 'Your new password')),
			$errors->has('new_password') ? 'error' : '',
		 	$errors->has('new_password') ? Form::inline_help($errors->first('new_password')) : ''
			);

		echo Form::control_group(
			Form::label('password_confirmation', 'Confirm'),
			Form::password('password_confirmation', array('placeholder' => 'Confirm your new password')),
			$errors->has('password_confirmation') ? 'error' : '',
		 	$errors->has('password_confirmation') ? Form::inline_help($errors->first('password_confirmation')) : ''
			);
		
		echo Form::control_group(
			Form::label('',''),
			Button::primary_submit('Change Password').' '.
			Button::normal_reset('Reset')
			);
		?>
		
	{{ Form::close()}}
@endsection

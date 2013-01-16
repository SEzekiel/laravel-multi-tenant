@layout('layouts.root')

{{-- User profile editing form --}}

@section('content')

	<div class="page-header">
		<h1>Edit Profile</h1>
	</div>

	@render('parts.alert')

	{{ Form::horizontal_open(URL::current()) }}
		<?php 
		echo Form::control_group(
			Form::label('username', 'Username'),
			Form::text('username', $user->username, array('disabled' => 'disabled', 'class' => 'disabled')),
			'',
			Form::block_help(URL::base($user->username))
			);

		echo Form::control_group(
			Form::label('email', 'E-mail'),
			Form::text('email', $user->email, array('disabled' => 'disabled', 'class' => 'disabled'))
			);

		echo Form::control_group(
			Form::label('password', 'Password'),
			Button::link('dashboard/password', 'Change')
			);

		echo Form::control_group(
			Form::label('first_name', 'First Name'),
			Form::text('first_name', $user->first_name),
			$errors->has('first_name') ? 'error' : '',
			Form::block_help($errors->first('first_name'))
			);

		echo Form::control_group(
			Form::label('last_name', 'Last Name'),
			Form::text('last_name', $user->last_name),
			$errors->has('last_name') ? 'error' : '',
			Form::block_help($errors->first('last_name'))
			);

		echo Form::control_group(
			Form::label('save', ''),
			Button::primary_submit('Save').' '.
			Button::normal_reset('Reset')
			);
		?>

	{{ Form::close() }}
@endsection
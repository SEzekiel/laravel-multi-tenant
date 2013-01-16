@layout('layouts.root')

{{-- User registration form --}}

@section('content')
	<div class="page-header">
		<h1>Register</h1>
	</div>

	@render('parts.alert')
	
	{{ Form::horizontal_open('register')}}
		<?php
		 echo Form::control_group( 
		 		Form::label('first_name', 'First Name'), 
		 		Form::text('first_name', Input::old('first_name')),
		 		$errors->has('first_name') ? 'error' : '',
		 		$errors->has('first_name') ? Form::inline_help($errors->first('first_name')) : ''

	 		);
		 
		 echo Form::control_group( 
				 Form::label('last_name', 'Last Name'),
				 Form::text('last_name', Input::old('last_name')),
				 $errors->has('last_name') ? 'error' : '',
				 $errors->has('last_name') ? Form::inline_help($errors->first('last_name')) : ''

	 		);
		 
		 echo Form::control_group( 
				 Form::label('username', 'Username'),
				 Form::prepend_append(
				 	Form::text_small('username', Input::old('username')), 
				 	'http://', 
				 	'.'.URL::strip_http(URL::base_root())
				 	),
				 $errors->has('username') ? 'error' : '',
				 $errors->has('username') ? Form::inline_help($errors->first('username')) : ''
	 		);

		 echo Form::control_group( 
				 Form::label('email', 'E-mail'),
				 Form::text('email', Input::old('email')),
				 $errors->has('email') ? 'error' : '',
				 $errors->has('email') ? Form::inline_help($errors->first('email')) : ''

	 		);

		 echo Form::control_group( 
				 Form::label('password', 'Password'),
				 Form::password('password'),
				 $errors->has('password') ? 'error' : '',
				 $errors->has('password') ? Form::inline_help($errors->first('password')) : ''

	 		);

		 echo Form::control_group( 
				 Form::label('password_confirmation', 'Confirm Password'),
				 Form::password('password_confirmation'),
				 $errors->has('password') ? 'error' : '',
				 $errors->has('password') ? Form::inline_help($errors->first('password')) : ''

	 		);

		?>

		<hr>

		{{ Form::submit('Register', array('class' => 'btn btn-large btn-primary'))}}
	

	{{ Form::close()}}
@endsection

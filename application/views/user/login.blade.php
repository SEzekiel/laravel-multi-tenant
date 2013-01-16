@layout('layouts.root')

{{-- Login Form --}}

@section('content')
	<div class="page-header">
		<h1>Login</h1>
	</div>

	@render('parts.alert')

	{{ Form::vertical_open(URL::current())}}

		<?php 
		echo Form::control_group(
			Form::label('email', 'E-mail'),
			Form::text('email', Input::old('email'), array('placeholder' => 'someone@domain.com')),
			$errors->has('email') ? 'error' : '',
		 	$errors->has('email') ? Form::inline_help($errors->first('email')) : ''
			);

		echo Form::control_group(
			Form::label('password', 'Password'),
			Form::password('password', array('placeholder' => 'Password')),
			$errors->has('password') ? 'error' : '',
		 	$errors->has('password') ? Form::inline_help($errors->first('password')) : ''
			);
		
		echo Form::block_help(
			HTML::link('forget', 'Forget password?')
			.' or '.
			HTML::link('register', 'Register a new account')
			);
		?>
		{{ Button::primary_submit('Login') }}
		
	{{ Form::close()}}
@endsection

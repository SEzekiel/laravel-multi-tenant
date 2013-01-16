<?php 

/**
* Controller class handling the User entity
*/
class User_Controller extends Base_Controller
{
	/**
	 * Show the login form
	 * 
	 * @return View
	 */
	public function get_login()
	{
		return View::make('user.login');
	}

	/**
	 * Process the login form
	 * 
	 * @return Response
	 */
	public function post_login()
	{	
		// Validate the credential first,
		// redirect back with error message if it's not valid
		$validation = User::login_validate(Input::all());
		if ($validation->fails())
		{
			return Redirect::back()
				->with('error', 'Please correct e-mail and password and try again.')
				->with_errors($validation)
				->with_input('except', 'password')
				;
		}

		// Attempt login using the credential,
		// redirect back with error message if it's not valid
		if ( ! User::login(Input::all()) )
		{
			return Redirect::back()
				->with('error', 'E-mail or password didn\'t match');
		}

		// Redirect to user URL
		return Redirect::to_tenant(Auth::user()->username);
	}

	/**
	 * Destroy current user session
	 * and redirect back to login page
	 * 
	 * @return Response
	 */
	public function get_logout()
	{
		Auth::logout();

		return Redirect::to_root('login')
			->with('success', 'You have been logged out successfully')
			;
	}

	/**
	 * Show the registration form
	 * 
	 * @return View
	 */
	public function get_register()
	{
		Auth::logout();
		
		return View::make('user.register');
	}

	/**
	 * Process the registration data
	 * 
	 * @return Response
	 */
	public function post_register()
	{
		// Validate the user data,
		// redirect back with error message if it's not valid
		$validation = User::register_validate(Input::all());
		if($validation->fails())
		{
			return Redirect::back()
				->with('error', 'Correct the form and click submit.')
				->with_errors($validation)
				->with_input('except', array('password', 'password_confirmation'))
				;
		}

		// Throw some error if registration is failed for unknown reason
		if (! User::register(Input::all()) )
			return Fulan::error('There is an error occured while registering your account, 
				please contact site administrator');
		

		return Redirect::to('login')
			->with('success', 
				'Registration complete. You can access your user URL at '.
				HTML::link(URL::to_tenant(Input::get('username'))) );
	}

	/**
	 * Show user profile editing form
	 * 
	 * @return View
	 */
	public function get_edit()
	{
		return View::make('user.edit')->with('user', Auth::user());
	}

	/**
	 * Process the user profile editing data
	 * 
	 * @return Response
	 */
	public function post_edit()
	{
		// Don't process username and email field, since they can't be changed
		$input = Input::except(array('username', 'email'));
		
		// Validate the profile
		$validation = User::profile_validate($input);
		if($validation->fails())
		{
			return Redirect::back()
				->with('error', 'Correct the form and click save.')
				->with_errors($validation)
				->with_input()
				;
		}

		// Update the user data
		$user = Auth::user();
		foreach ($input as $key => $value)
			$user->$key = $value;
		$user->save();

		return Redirect::back()
			->with('success', 'Profile successfully edited')
			;
	}

	/**
	 * Show the password changing form
	 * 
	 * @return View
	 */
	public function get_password()
	{
		return View::make('user.password');
	}

	/**
	 * Process the password changing data
	 * 
	 * @return Response
	 */
	public function post_password()
	{
		$input      = Input::all();

		// Validate the password matching
		$validation = User::password_validate($input);
		if($validation->fails())
		{
			return Redirect::back()
				->with('error', 'Correct the form and click save.')
				->with_errors($validation)
				->with_input()
				;
		}

		// Change the password
		User::change_password($input['new_password']);

		return Redirect::to('dashboard/profile')
			->with('success', 'Password successfully changed')
			;
	}

	// TODO: merge validations into one function
}
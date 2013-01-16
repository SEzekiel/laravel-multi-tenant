<?php 

class User extends Eloquent {

	public static $registration_rules = array(
		'first_name' => 'required|max:100',
		'last_name'  => 'required|max:100',
		'username'   => 'required|max:20|alpha_num|unique:users',
		'email'      => 'required|email|unique:users',
		'password'   => 'required|min:4|confirmed',
		);

	public static $login_rules = array(
		'email'    => 'required|email',
		'password' => 'required',
		);

	public static $profile_rules = array(
		'first_name' => 'required|max:100',
		'last_name'  => 'required|max:100',
		);

	public static $password_rules = array(
		'old_password'          => 'required|valid',
		'new_password'          => 'required|min:4|different:old_password',
		'password_confirmation' => 'required|same:new_password',
		);

	/**
	 * Validate registration data
	 * 
	 * @param  array $user
	 * @return Validator
	 */
	public static function register_validate($user)
	{
		return Validator::make($user, static::$registration_rules);
	}

	/**
	 * Register the user
	 * 
	 * @param  array $user
	 * @return User
	 */
	public static function register($user)
	{
		unset($user['password_confirmation']);
		$user['password'] = Hash::make($user['password']);

		// Create user public directory
		if (! \Tenancy\Manager::make($user['username']) )
			return false;

		// TODO: Put script for generating user subdomain here
		// --- placeholder ---

		return static::create($user);
	}

	/**
	 * Validate login data
	 * 
	 * @param  array     $user
	 * @return Validator
	 */
	public static function login_validate($user)
	{
		return Validator::make($user, static::$login_rules);
	}

	/**
	 * Attemt login with user's credentials
	 * 
	 * @param  array $user
	 * @return User
	 */
	public static function login($user)
	{
		$credentials = array(
			'username' => $user['email'],
			'password' => $user['password'],
			);

		return Auth::attempt($credentials);
	}

	/**
	 * Validate profile data
	 * 
	 * @param  array $user
	 * @return Validator
	 */
	public static function profile_validate($user)
	{
		return Validator::make($user, static::$profile_rules);
	}

	/**
	 * Validate new password data
	 * 
	 * @static array     $user
	 * @return Validator
	 */
	public static function password_validate($user)
	{
		return Validator::make($user, static::$password_rules);
	}

	/**
	 * Change the password of currently logged in user
	 * 
	 * @static string $password
	 * @return User
	 */
	public static function change_password($password)
	{
		$user = Auth::user();
		$user->password = Hash::make($password);

		return $user->save();
	}

	/**
	 * Concatenate firstname and lastname
	 * 
	 * @return string
	 */
	public function full_name()
	{
		return $this->first_name.' '.$this->last_name;
	}

	/**
	 * Get the data of currently viewed user
	 * 
	 * @return User
	 */
	public static function viewed()
	{
		if(TENANT_NAME === null)
			return false;

		return User::where('username', '=', TENANT_NAME)->first();
	}

}
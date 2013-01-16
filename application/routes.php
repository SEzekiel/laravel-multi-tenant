<?php

Route::get('/', function()
{
	if(TENANT_NAME === null)
		return View::make('home');
	else
		return View::make('user.home')->with('viewed', User::viewed());
});

Route::group(array('before' => 'tenant'), function()
{
	Route::group(array('before' => 'auth'), function()
	{
		Route::any('dashboard/profile', 'user@edit');
		Route::any('dashboard/password', 'user@password');
	});
});

Route::group(array('before' => 'root'), function()
{
	// http://sitename.tld/login
	Route::any('login', 'user@login');

	// http://sitename.tld/logout
	Route::get('logout', 'user@logout');

	// http://sitename.tld/register
	Route::any('register', 'user@register');
});

/*
|--------------------------------------------------------------------------
| Application 404 & 500 Error Handlers
|--------------------------------------------------------------------------
*/

Event::listen('404', function()
{
	return Response::error('404');
});

Event::listen('500', function()
{
	return Response::error('500');
});

/*
|--------------------------------------------------------------------------
| Route Filters
|--------------------------------------------------------------------------
*/

Route::filter('before', function()
{
	// Do stuff before every request to your application...
});

Route::filter('after', function($response)
{
	// Do stuff after every request to your application...
});

Route::filter('csrf', function()
{
	if (Request::forged()) return Response::error('500');
});

Route::filter('auth', function()
{
	if (Auth::guest()) 
		return Redirect::to_root('login')->with('warning', 'You must be logged in to continue.');
});

Route::filter('root', function()
{
	// Redirect routes other than root
	if (TENANT_NAME !== null) return Redirect::to_root(URI::current());
});

Route::filter('tenant', function()
{
	// Redirect routes other than root
	if (TENANT_NAME === null) return Redirect::to_root('/');
});
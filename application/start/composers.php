<?php 

View::composer('parts.user', function($view)
{
	$view->with('user', Auth::user());
});

View::composer('layouts.root', function($view)
{
	Asset::container('bootstrap')->add_common('bootstrap.css', 'lib/bootstrap/css/bootstrap.min.css');
	Asset::container('bootstrap')->add_common('bootstrap-responsive.css', 'lib/bootstrap/css/bootstrap-responsive.min.css', 'common.css');
	Asset::container('bootstrap')->add_common('bootstrap.js',  'lib/bootstrap/js/bootstrap.min.js', 'jquery.js');
	Asset::container('bootstrap')->add_common('jquery.js',  'lib/jquery/jquery-1.7.1.min.js');
});
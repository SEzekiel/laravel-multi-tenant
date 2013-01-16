<?php 
namespace Tenancy;

class Redirect extends \Laravel\Redirect {

	public static function to_tenant($tenant, $url = '/', $status = 302, $https = null)
	{
		$url = \Tenancy\URL::to_tenant($tenant, $url, $https);

		return \Laravel\Redirect::to($url, $status, $https);
	}

	public static function to_root($url ='/', $status = 302, $https = null)
	{
		return static::to_tenant(null, $url, $status, $https);
	}
}
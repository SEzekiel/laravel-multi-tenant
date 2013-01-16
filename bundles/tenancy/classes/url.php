<?php 
namespace Tenancy;

class URL extends \Laravel\URL {

	public static function tenancify($tenant, $url)
	{
		$tenant = ($tenant === null) ? '' : $tenant.'.';

		if (TENANT_NAME !== null)
		{
			$url = str_replace('http://'.TENANT_NAME.'.', 'http://'.$tenant, $url);
			$url = str_replace('https://'.TENANT_NAME.'.', 'https://'.$tenant, $url);
		}
		else
		{
			$url = str_replace('http://', 'http://'.$tenant, $url);
			$url = str_replace('https://', 'https://'.$tenant, $url);
		}

		return $url;
	}

	public static function to_tenant($tenant, $url = '/', $https = null)
	{
		$url = \Laravel\URL::to($url, $https);

		return static::tenancify($tenant, $url);
	}

	public static function to_tenant_asset($tenant, $url = '/', $https = null)
	{
		$url = \Laravel\URL::to_asset($url, $https);

		return static::tenancify($tenant, $url);
	}

	public static function to_root($url = '/', $https = null)
	{
		return static::to_tenant(null, $url, $https);
	}

	public static function to_common_asset($url = '/', $https = null)
	{
		return static::to_tenant_asset(null, $url, $https);
	}

	public static function base($tenant = false)
	{
		$base = \Laravel\URL::base();

		if($tenant !== false)
			$base = static::tenancify($tenant, $base);

		return $base;
	}

	public static function base_root()
	{
		return static::base(null);
	}

	public static function strip_http($url)
	{
		$url = str_replace('http://', '', $url);
		$url = str_replace('https://', '', $url);

		return $url;
	}
}
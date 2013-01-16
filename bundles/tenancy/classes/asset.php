<?php 
namespace Tenancy;

class Asset extends \Laravel\Asset {

	public static function container($container = 'default')
	{
		if ( ! isset(static::$containers[$container]))
		{
			static::$containers[$container] = new \Tenancy\Asset_Container($container);
		}

		return static::$containers[$container];
	}
	
}

class Asset_Container extends \Laravel\Asset_Container {

	public function add_common($name, $source, $dependencies = array(), $attributes = array())
	{
		$source = \Tenancy\URL::tenancify(null, \Laravel\URL::to_asset($source));

		return $this->add($name, $source, $dependencies, $attributes);
	}
}
<?php 
namespace Tenancy;

class Eloquent extends \Laravel\Database\Eloquent\Model {

	public function connect($connection_name)
	{
		static::$connection = $connection_name;

		return $this;
	}
}
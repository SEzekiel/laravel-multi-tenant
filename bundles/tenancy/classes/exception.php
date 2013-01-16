<?php 
namespace Tenancy;

class Exception
{
	public function __construct($message)
	{
		echo $message;
		exit;
	}
}
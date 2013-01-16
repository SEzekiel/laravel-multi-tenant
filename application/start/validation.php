<?php 

Validator::register('valid', function($attribute, $value, $parameter)
{
	return Hash::check($value, Auth::user()->password);
});
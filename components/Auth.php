<?php
class Auth
{
	public static function authorization()
	{
		$user = new User;
		return $user;
	}
	public static function authen($user, $pwd)
	{
		/*if(hash_equals($user['password'],crypt($pwd,$user['salt'])))*/return true;
		return false;
	}
}
?>
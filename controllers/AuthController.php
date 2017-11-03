<?php
class AuthController
{
	public function __construct()
	{
	}
	public function actionRegister()
	{
		if($_SERVER["REQUEST_METHOD"] == "POST")
		{
			$data = file_get_contents('php://input');
			$data = json_decode($data,true);
			//return print_r(json_encode(array('err'=>count(User::getByEmail($data['email'])))));
			$err = '';
			//$data = json_decode($data,true);
			//echo $data['name'];
			$data['name'] = isset($data['name'])?$data['name']:null;
			$data['email'] = isset($data['email'])?$data['email']:null;
			if(!$data['email']){return print_r(json_encode(array('err'=>'Email error!')));}
			if(count(User::getByEmail($data['email'])) > 0){return print_r(json_encode(array('err'=>'Email exist!')));}
			$data['password'] = isset($data['password'])?$data['password']:null;
			if(!$data['password']){return print_r(json_encode(array('err'=>'Password error!')));}
			$data['avatar'] = isset($data['avatar'])?$data['avatar']:'anonym';
			$data['create'] = isset($data['create'])?$data['create']:time();
			$data['update'] = isset($data['update'])?$data['update']:$data['create'];
			$data['rating'] = isset($data['rating'])?$data['rating']:0;
			if(User::setUser($data)) return print_r(json_encode(array('err'=>null)));
	}else return print_r(json_encode(array('err'=>'User not created!')));
	}
	public function actionLogin()
	{
		if($_SERVER["REQUEST_METHOD"] == "POST")
		{
			$data = file_get_contents('php://input');
			$err = "";
			$data = json_decode($data,true);
			//echo $data['name'];
			//$data['name'] = isset($data['name'])?htmlentities($data['name']):null;
			$data['email'] = isset($data['email'])?htmlentities($data['email']):null;
			if(!$data['email'] || strlen($data['email']) > 149)return App::reqAJ(array('err'=>'Email error!'));
			//return print_r(json_encode(User::getByEmail($data['email'])));
			$user = User::getByEmail($data['email']);
			if(!count($user))return App::reqAJ(array('err'=>'Email not found!'));
			else $user = $user[0];
			$data['password'] = isset($data['password'])?htmlentities($data['password']):null;
			if(!$data['password'] || strlen($data['password']) > 149)return App::reqAJ(array('err'=>'Password error! '.$data['password']));
			// check pwd equals!
			if(!Auth::authen($user,$data['password']))
			{
				return App::reqAJ(array('err'=>'Wrong password!'));
			}else{
				if(Auth::makeAuthSession($user))return App::reqAJ(array('err'=>null,'user'=>'User loged in.'));
				else return App::reqAJ(array('err'=>'Start session error! User not loged in.'));	
			}
		}else return App::reqAJ(array('err'=>'User not loged in!'));
	}
	public function actionLogout()
	{
		if(Auth::logout()) App::loged('User logout.');	
		else App::loged('Logout error!');
		App::redirect('/'.LANG);
	}
}	
?>
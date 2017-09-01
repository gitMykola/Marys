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
			if(User::set($data)) return print_r(json_encode(array('err'=>null)));
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
			$data['name'] = isset($data['name'])?htmlentities($data['name']):null;
			$data['email'] = isset($data['email'])?htmlentities($data['email']):null;
			if(!$data['email'] || strlen($data['email']) > 149){return print_r(json_encode(array('err'=>'Email error!')));}
			//return print_r(json_encode(User::getByEmail($data['email'])));
			$user = User::getByEmail($data['email']);
			if(!count($user)){return print_r(json_encode(array('err'=>'Email not found!')));}
			$data['password'] = isset($data['password'])?htmlentities($data['password']):null;
			if(!$data['password'] || strlen($data['password']) > 149){return print_r(json_encode(array('err'=>'Password error! '.$data['password'])));}
			// check pwd equals!
			if(!Auth::authen($user,$data['password'])){return print_r(json_encode(array('err'=>'Wrong password!')));}
			else{
				return print_r(json_encode(array('err'=>null,'u_id'=>$user['id'],'u_email'=>$user['email'])));
			}
		}else return print_r(json_encode(array('err'=>'User not loged in!')));
	}
	public function actionDel()
	{
		$err="";
		if($_SERVER["REQUEST_METHOD"] == "POST")
		{
			//if(!$this->model->del)
				$this->data["id"] = isset($_POST["id"])?$_POST["id"]:"";
			//var_dump((int)$this->data["id"]);
			if((int) $this->data["id"] > 0 && $this->model->del((int)$this->data['id']))
				App::loged('Address '.$this->data["id"].' deleted.');
			else App::loged('Error with address delete. '.$this->data["id"]);	
		}else die;
	}
}	
?>
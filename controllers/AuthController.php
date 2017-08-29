<?php
class AuthController
{
	public function __construct()
	{
	}
	public function actionLogin()
	{	
	}
	public function actionRegister($page = null)
	{
		$data = file_get_contents('php://input');
		if($_SERVER["REQUEST_METHOD"] == "POST")
		{
			$send_data = json_decode($data,true);
			//echo $data['name'];
			$data['name'] = isset($send_data['name'])?$send_data['name']:'';
			$data['email'] = isset($send_data['email'])?$send_data['email']:'';
			$data['password'] = isset($send_data['password'])?$send_data['password']:'';
			$data['avatar'] = isset($send_data['avatar'])?$send_data['avatar']:'';
			$data['create'] = isset($send_data['create'])?$send_data['create']:time();
			$data['update'] = isset($send_data['update'])?$send_data['update']:$data['create'];
			$data['rating'] = isset($send_data['rating'])?$send_data['rating']:0;
			echo User::set($data);
		}else die;
	}
	public function actionSet()
	{
		$err = "";
		if($_SERVER["REQUEST_METHOD"] == "POST")
		{
			//var_export($_POST);
			$this->data["country"] = isset($_POST["country"])?$_POST["country"]:"";
			$this->data["city"] = isset($_POST["city"])?$_POST["city"]:"";
			$this->data["region"] = isset($_POST["region"])?$_POST["region"]:"";
			$this->data["street"] = isset($_POST["street"])?$_POST["street"]:"";
			$this->data["appartment"] = isset($_POST["appartment"])?$_POST["appartment"]:"";
			
		}else $err .= " Invalid address!";
		if($err !== "") App::loged($err);
		else if(!$this->model->set($this->data)) App::loged('database error with address set function.');
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
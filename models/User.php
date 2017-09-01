<?php
class User extends Model{
	public $auth;
	public $admin;
	public $template;
	public $mainTemplate;
	public function __construct()
	{
		$this->template = ROOT.'/templates/users.php';
		$this->mainTemplate = ROOT.'/templates/marys.php';
		$this->auth = false;
		$this->admin = false;
	}
	public function get($page = null,$limit = null,$sort = null)
	{
		
	}
	public function getById($id)
	{
		//validate $email
		try{
		$db = Db::getConnection();
		$sql = "select `id`,`name_".LANG."`,`email`,`password`, `salt`,`avatar`,`create`,`update`,`rating` from `users` where id=:id";
		$result = $db->prepare($sql);
		$result->bindParam(':id',$id,PDO::PARAM_INT);
		$result->setFetchMode(PDO::FETCH_ASSOC);
		if(!$result->execute()) return false;
		$data = $result->fetch(PDO::FETCH_ASSOC);
		return $data;
		}
		catch(PDOException $Exception){App::loged($Exception);}
	}
	public function getByEmail($email)
	{
		//validate $email
		try{
		$db = Db::getConnection();
		$sql = "select `id`,`name_".LANG."`,`email`,`password`, `salt`,`avatar`,`create`,`update`,`rating` from `users` where email=:email";
		$result = $db->prepare($sql);
		$result->bindParam(':email',$email,PDO::PARAM_STR);
		$result->setFetchMode(PDO::FETCH_ASSOC);
		if(!$result->execute()) return false;
		$data = $result->fetch(PDO::FETCH_ASSOC);
		return $data;
		}
		catch(PDOException $Exception){App::loged($Exception);}
	}
	public function set($data)
	{
		if(!User::validate($data))return false;
		try{
		$db = Db::getConnection();
		$sql = "insert into `users` (`name_".LANG."`,`email`,`password`, `salt`,`avatar`,`create`,`update`,`rating`)"
		." values(:name, :email, :password, :salt, :avatar, :create, :update, :rating)";
		$result = $db->prepare($sql);
		$result->bindParam(':name',$data['name'],PDO::PARAM_STR);
		$result->bindParam(':email',$data['email'],PDO::PARAM_STR);
		$hash = User::getHash($data['password']);
		$result->bindParam(':password',$hash['hash'],PDO::PARAM_STR);
		$result->bindParam(':salt',$hash['salt'],PDO::PARAM_STR);
		$result->bindParam(':avatar',$data['avatar'],PDO::PARAM_STR);
		$result->bindParam(':create',$data['create'],PDO::PARAM_STR);
		$result->bindParam(':update',$data['update'],PDO::PARAM_STR);
		$result->bindParam(':rating',$data['rating'],PDO::PARAM_INT);
		$result->setFetchMode(PDO::FETCH_ASSOC);
		if(!$result->execute()) return false;
		return true;
		}
		catch(PDOException $Exception){App::loged($Exception);return $Exception;}	
		
	}
	public function update($data)
	{
		
	}
	public function del($id)
	{
		
	}
	private function validate($data)
	{
		return true;
	}
	public static function getHash($pwd)
	{
		$rndstr ='';
		$chset = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';	
		while(strlen($rndstr) < 16)
		{
			$rndstr .= $chset[rand(0,strlen($chset) - 1)];
		}
		return array('hash'=>crypt($pwd,$rndstr),'salt'=>$rndstr);
	}
}
?>
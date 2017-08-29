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
	public function getByEmail($email)
	{
		//validate $email
		try{
		$db = Db::getConnection();
		$sql = "select `id`,`name_".LANG."`,`email`,`password`, `avatar`, `create`, `update`, `rating` from `users` where email=:email";
		$result = $db->prepare($sql);
		$result->bindParam(':email',$email,PDO::PARAM_STR);
		$result->setFetchMode(PDO::FETCH_ASSOC);
		if(!$result->execute()) return false;
		return $result->fetch();
		}
		catch(PDOException $Exception){App::loged($Exception);}
	}
	public function set($data)
	{
		if(!User::validate($data))return false;
		try{
		$db = Db::getConnection();
		$sql = "insert into `users` (`name_".LANG."`,`email`,`password`,`avatar`,`create`,`update`,`rating)"
		." values(:name, :email, :password, :avatar, :create, :update, :rating)";
		$result = $db->prepare($sql);
		$name = $data['name'];
		$email = $data['email'];
		$password = $data['password'];
		$avatar = $data['avatar'];
		$create = $data['create'];
		$update = $data['update'];
		$rating = $data['rating'];
		$result->bindParam(':name',$name,PDO::PARAM_STR);
		$result->bindParam(':email',$email,PDO::PARAM_STR);
		$result->bindParam(':password',$password,PDO::PARAM_STR);
		$result->bindParam(':avatar',$avatar,PDO::PARAM_STR);
		$result->bindParam(':create',$create,PDO::PARAM_STR);
		$result->bindParam(':update',$update,PDO::PARAM_STR);
		$result->bindParam(':rating',$rating,PDO::PARAM_INT);
		$result->setFetchMode(PDO::FETCH_ASSOC);
		//return $result->execute();
		if(!$result->execute()) return false;
		return $result->fetchAll();
		}
		catch(PDOException $Exception){App::loged($Exception);echo $Exception;}	
		
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
}
?>
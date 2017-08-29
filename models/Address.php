<?php
class Address extends Model{
	public $template;
	public $mainTemplate;
	public function __construct()
	{
		$this->template = ROOT.'/templates/address.php';
		$this->mainTemplate = ROOT.'/templates/marys.php';
	}
	public function get($page = null,$limit = null,$sort = null)
	{
		try{
		$db = Db::getConnection();
		$sql = "select `id`,`country`,`city`,`region`, `street`, `appartment` from `address` where 1";
		$result = $db->prepare($sql);
		$result->setFetchMode(PDO::FETCH_ASSOC);
		if(!$result->execute()) return false;
		return $result->fetchAll();
		}
		catch(PDOException $Exception){App::loged($Exception);}
	}
	public function set($data)
	{
		if(!$this->validate($data))return false;
		try{
		$db = Db::getConnection();
		$sql = "insert into `address` (`country`,`city`,`region`,`street`,`appartment`)"
		." values(:country, :city, :region, :street, :appartment)";
		$result = $db->prepare($sql);
		$result->bindParam(':country',$data['country'],PDO::PARAM_STR);
		$result->bindParam(':city',$data['city'],PDO::PARAM_STR);
		$result->bindParam(':region',$data['region'],PDO::PARAM_STR);
		$result->bindParam(':appartment',$data['appartment'],PDO::PARAM_STR);
		$result->bindParam(':street',$data['street'],PDO::PARAM_STR);
		$result->setFetchMode(PDO::FETCH_ASSOC);
		if(!$result->execute()) return false;
		return $result->fetch();
		}
		catch(PDOException $Exception){App::loged($Exception);}
	}
	public function update($data	)
	{
		
	}
	public function del($id)
	{
		try{
		$db = Db::getConnection();
		$sql = "delete from `address` where id=:id";
		$result = $db->prepare($sql);
		$result->bindParam(':id',$id,PDO::PARAM_INT);
		if(!$result->execute()) return false;
		return $result->fetch();
		}
		catch(PDOException $Exception){App::loged($Exception);}
	}
	private function validate($data)
	{
		return true;
	}
}
?>
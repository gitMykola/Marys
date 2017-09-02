<?php
class Auth
{
	public static function authorization()
	{
		$user = array(
			'auth'=>false,
			'admin'=>false,
			'id'=>null,
		);
		if(App::is_session() && $_SESSION && $_SESSION['hash'])
		{
			$paramsPath = ROOT.'/config/config.php';
			$params = include($paramsPath);
			$params = $params['app'];
			$ses = explode(":",$_SESSION['hash']);
			$userSes = Auth::getByUserId($ses[1]);
			if(count($userSes) && (time() - $userSes[0]['login_at'] < $params['session_auth_live']))
			{
				$user['auth'] = true;
				$tuser = User::getById($userSes[0]['user_id']);
				$user['name'] = $tuser['name_'.LANG];
			}
		}
		return $user;
	}
	public static function authen($user, $pwd)
	{
		/*if(hash_equals($user['password'],crypt($pwd,$user['salt'])))*/return true;
		return false;
	}
	public static function makeAuthSession($user)
	{
		//return true;
		if(App::is_session())
			{
				$paramsPath = ROOT.'/config/config.php';
				$params = include($paramsPath);
				$params = $params['app'];
				$userSes = Auth::getByUserId($user['id']);
				if(!count($userSes) || (time() - $userSes[0]['login_at'] > $params['session_auth_live']))
				{
					$sesHash = User::getHash($user['id'].$user['email']);
					$_SESSION['hash'] = $sesHash['hash'].':'.$user['id'];
					try{
						$db = Db::getConnection();
						$sql = "insert into `authorizations` (`hash`,`salt`,`user_id`,`user_ip`,`login_at`)"
						." values(:hash, :salt, :user_id, :user_ip, :login_at)";
						$result = $db->prepare($sql);
						$result->bindParam(':hash',$sesHash['hash'],PDO::PARAM_STR);
						$result->bindParam(':salt',$sesHash['salt'],PDO::PARAM_STR);
						$result->bindParam(':user_id',$user['id'],PDO::PARAM_INT);
						$ip = isset($_SERVER['REMOTE_ADDR'])?$_SERVER['REMOTE_ADDR']:'unknown';
						$result->bindParam(':user_ip',$ip,PDO::PARAM_STR);
						$result->bindParam(':login_at',time(),PDO::PARAM_INT);
						$result->setFetchMode(PDO::FETCH_ASSOC);
						if(!$result->execute()) return false;
						return true;
						}
					catch(PDOException $Exception){App::loged($Exception);return false;}
				}else{
					$_SESSION['hash'] = $userSes[0]['hash'].':'.$userSes[0]['user_id'];
					return true;
				}	
			}
		return false;		
	}
	public static function getByUserId($id, $num = 0)
	{
		try{
		$db = Db::getConnection();
		$sql = "select `hash`,`salt`,`user_id`,`user_ip`,`login_at` from `authorizations` where user_id=:id order by `login_at` desc";
		$sql .= ($num !== 0)?" limit ".$num:"";
		$result = $db->prepare($sql);
		$result->bindParam(':id',$id,PDO::PARAM_INT);
		$result->setFetchMode(PDO::FETCH_ASSOC);
		if(!$result->execute()) return false;
		$data = $result->fetchAll(PDO::FETCH_ASSOC);
		return $data;
		}
		catch(PDOException $Exception){App::loged($Exception);return false;}
	}
	public static function logout()
	{
		if(App::is_session() && $_SESSION['hash']) $_SESSION['hash'] = null;
		return true;
		
	}
}
?>
<?php
class Settings
{
    protected $dbh;
    protected $cookiname = "ASPAUTH";
    function __construct()
    {
        $dsn = 'mysql:dbname=loginsys;host=127.0.0.1'; //use in MySql
        $user = 'userforDB'; //use in MySql
        $password = 'passwordfordb'; //use in MySql
        try
        {
            $this->dbh = new PDO('sqlite:../db/webDevCams.db'); // new PDO($dsn, $user, $password);
        } catch (PDOException $e)
        {
            echo 'Connection failed: ' . $e->getMessage(); //TODO: In production disable
        }
    }
}
/*
class Error
{
	static function ShowPdoError($db)
	{
		$arr = array();
        $arr = $db->errorInfo();
		echo "<br>";
		print_r($arr);	
		echo "<br>";		
	}
	static function ShowPdoExeption($e)
	{		
		echo "<br>";
		echo $e->getMessage();	
		echo "<br>";		
	}
} */

class MainUsr extends Settings
{
    protected $Username;
    protected $Password;
    protected $Group;
   
    function SetUsername($username)
    {
        return $this->Username = trim($username);
    }
	
	 function SetGroup($group)
    {
        return $this->Group = (int)($group*1);
    }
   
    function GetUsername()
    {
        return $this->Username;
    }
    
    function SetPassword($password)
    {
        return $this->Password = trim($password);
    }

    function Validate()
    {
        $errors =  array();
        
        if((strlen($this->Username)) < 3 )
        {
            $errors[] = "Username must be at list 3 characters";
        }

        if((strlen($this->Password)) < 5 )
        {
            $errors[] = "Password must be at list 5 characters";
        }
        
        if ( !preg_match("/^[a-zA-Z0-9]{3,30}$/", $this->Password) )
        {
            $errors[] = "You entered an invalid password";
        }
		if(!isset($this->Group) or $this->VaidateGroup() == FALSE)
		{
			$errors[] = "Group not found";
		}
        return $errors;
    }
	
	///return user info by enabled user name  or false
	function GetUserByName()
	{		
		$stmt = $this->dbh->prepare("SELECT user_id, user_login, user_password, user_hash, user_ip, user_group, user_logindt FROM dc_users where user_enable = 1 and user_login=:username");
		$stmt->bindParam(':username', $this->Username);		
		try {
		$stmt->execute();
			} catch(PDOException $e)  
			{   
				//echo $e->getMessage(); 
				return false;  
			}
		return $stmt->fetchAll();		
	}
	
	///проверяет доступность группы по- id группы и то что она не блокирована; return true if group exist and enable
	function VaidateGroup()
	{		
		if(!isset($this->Group) && $this->Group <0) return false; 
		$stmt = $this->dbh->prepare("SELECT count(*) as Exist FROM dc_groups where group_enable=1 and group_id=:idgroup ");
		$stmt->bindParam(':idgroup', $this->Group);		
		try {
		$stmt->execute();
			} catch(PDOException $e)  
			{   
				//echo $e->getMessage(); 
				return false;  
			}
		$grpres = $stmt->fetch();
		if(is_array($grpres) && $grpres['Exist'] == 1)
		{
			return true;			
		} else return false;
	}
}

class Login extends MainUsr
{    
    function CheckLogin()
    {
		$user_rows = $this->GetUserByName();        
        if(count($user_rows) > 0 )
        {
            $user_data = $user_rows[0];
            $password_hash = md5($this->Password."~".$user_data['user_hash']);
            if ($password_hash == $user_data['user_password'])
			{
                $secret_key = uniqid();
                $new_password_hash = md5($this->Password."~".$secret_key);
                $curr_date = time();
                $user_update = $this->UpdateUserData($this->Username, $new_password_hash, $secret_key, $curr_date);
                if ($user_update){
                    setcookie($this->cookiname, $this->Username.":".md5($secret_key.":".$_SERVER['REMOTE_ADDR'].":".$curr_date),time()+60*60*24);
                    //header ("Location: ".$_SERVER['PHP_SELF']);
					header ("Location: "."index.php");					
                    exit();
                } else 
				{
                    return "Failed to update user information";
                }
            } else 
			{
                return "You entered an invalid login or password";
            }
        }
        else
        {
            return "User not found";
        }
    }

    function UpdateUserData($usr, $pass, $hash, $ldt)
    {
        $stmt = $this->dbh->prepare("update dc_users set user_password = :password , user_hash = :hash, user_ip= :ip, user_logindt= :ldt where user_login= :user");        
        $stmt->bindParam(':user', $usr);
        $stmt->bindParam(':password', $pass);
        $stmt->bindParam(':hash', $hash);
		$stmt->bindParam(':ip', $_SERVER['REMOTE_ADDR']);
        $stmt->bindParam(':ldt', $ldt);
        return $stmt->execute();		
    }
	/*
	function ShowRes()
	{
		$st = $this->dbh->query("SELECT * FROM dc_users where user_login='User1'");
		//$results = $st->fetchAll();
		$results = $st->fetch();
		echo "<pre>";
		print_r($results);
		echo "</pre>";		
	}*/
}

class Autorization extends MainUsr
{
	function Grant()
	{
		if (isset($_COOKIE[$this->cookiname]))
		{
			$data_array = explode(":",$_COOKIE[$this->cookiname]);
			if (preg_match("/^[a-zA-Z0-9]{3,30}$/", $data_array[0])) 
			{				
				$this->SetUsername($data_array[0]);				
				$user_rows = $this->GetUserByName();				
				if (count($user_rows) == 1) {
					$cookies_hash = $data_array[1]; 
					$user_data = $user_rows[0];					
					$evaluate_hash = md5($user_data['user_hash'].":".$_SERVER['REMOTE_ADDR'].":".$user_data['user_logindt']);
					if ($cookies_hash == $evaluate_hash) 
					{
						return TRUE;
					} 
				} 
			} 
		}	
		return false;
	}
	
	function GetCookiName()
	{
		return $this->cookiname;
	}
	
	function Logout()
	{
		setcookie($this->cookiname, '', time()-60*60*24); 
		header ("Location: ".$_SERVER['PHP_SELF']);
		exit();		
	}	
}

class Registration extends MainUsr
{
	function InsertUser()
    {		
        $error = $this->Validate();
		$userInfo = $this->GetUserByName();
		if(count($userInfo) == 1 ) { $error = "That login name is not available."; }
        if(count($error) > 0 )
        {
                return $error;    
        }
        else
        {			
			$secret_key = uniqid();
			$password_hash = md5($this->Password."~".$secret_key); //мутим хеш соленый
			$stmt = $this->dbh->prepare("INSERT INTO dc_users ( user_login, user_password, user_hash, user_group ) VALUES (:username, :password, :hash, :group)");			
			$stmt->bindParam(':username', $this->Username);
			$stmt->bindParam(':password', $password_hash); //хеш соленый
			$stmt->bindParam(':hash', $secret_key); //солька
			$stmt->bindParam(':group', $this->Group);			
			$stmt->execute();			
			$arr = array();
			$arr = $stmt->errorInfo();
			if( !empty($arr['2']) )
			{
				return($arr['2']);
			}
			return false;        
        }        
    }
	
	function DeleteUser()
	{		
		$user_rows = $this->GetUserByName();   
		//var_dump($user_rows);		
        if(count($user_rows) == 1 )
        {
			$stmt = $this->dbh->prepare("delete from dc_users where user_login= :user");        
			$stmt->bindParam(':user', $this->Username);
			return $stmt->execute();			
		}
		return false;
	}	
	
	function DesableUser()
	{		
		$user_rows = $this->GetUserByName();   
		//var_dump($user_rows);		
        if(count($user_rows) == 1 )
        {
			$stmt = $this->dbh->prepare("update dc_users  set  user_enable = 0 where user_login = :user");        
			$stmt->bindParam(':user', $this->Username);
			return $stmt->execute();			
		}
		return false;
	}	
	
	function ChangeUserGroup()
	{		
		$user_rows = $this->GetUserByName();   			
        if(count($user_rows) != 1 ) { return "User is not found."; }
        
		$stmt = $this->dbh->prepare("update dc_users set user_group=:group where user_login= :user");        
		$stmt->bindParam(':user', $this->Username);
		$stmt->bindParam(':group', $this->Group);
		$stmt->execute();
		$arr = array();
		$arr = $stmt->errorInfo();
		if( !empty($arr['2']) )
			{
				return($arr['2']);
			}
		return false;	
	}	
	
}

class InfoUsr extends Settings
{
	function GetUserInfo()
	{
		$sql = 'SELECT user_id, user_login, user_ip, user_group, group_name, user_logindt FROM dc_users as us  inner join dc_groups as dc on us.[user_group] = dc.[group_id] where user_enable = 1 order by user_login';
		$stmt = $this->dbh->prepare($sql);
		if($stmt == FALSE) return false; 
		//$stmt->bindParam(':username', $this->Username);
		try {
		    $stmt->execute();
			} 
			catch(PDOException $e){ //echo $e->getMessage(); 
			return false;  
			}
		return $stmt->fetchAll();			
	}	
	function GetGroupInfo()	//выводит группы
	{
		$stmt = $this->dbh->prepare("Select [group_id] as uin,[group_name] as name,[group_admin] as admin,[group_backplay] as playback,[group_enable] as enable From MAIN.[DC_GROUPS] order by name");
		if($stmt == FALSE) return false; 
		//$stmt->bindParam(':username', $this->Username);
		try {
		    $stmt->execute();
			} 
			catch(PDOException $e)  
			{   
				echo $e->getMessage(); 
				return false;  
			}
		return $stmt->fetchAll();			
	}	
}

class MainGrp extends Settings
{
	protected $GroupName;
    protected $Admin;
	protected $Playback;
	protected $Enable;
    protected $Group;
   
    function SetGroupName($groupname)
    {
        return $this->GroupName = trim($groupname);
    }
	function GetGroupName()
    {
        return $this->GroupName;
    }	
	
	function SetGroup($group) //id
    {
        return $this->Group = (int)($group*1);
    }
	
    function SetGroupAdmin($admin)
    {		 
        return $this->Admin = ($admin) === 'on' ? 1 : 0;
		
    }
    function SetGroupPlayback($pback)
    {
        return $this->Playback = ($pback) === 'on' ? 1 : 0;
    }
	function SetGroupEnable($enable)
    {
        return $this->Enable = ($enable) === 'on' ? 1 : 0;
    }
    
	function Validate()
    {
        $errors =  array();
        
        if((strlen($this->GroupName)) < 3 )
        {
            $errors[] = "Group name must be at list 3 characters. ";
        }
		
		if( $this->VaidateGroupName() ) 
		{ $error = "That group name is not available. "; }
	}	
    
	///проверяет доступность группы Name группы; return true if group exist and enable
	function VaidateGroupName() //TODO:: нужна ли тутт проверка на enable?
	{		
		if(!isset($this->GroupName)) return false; 
		//var_dump($this->GroupName);
		$stmt = $this->dbh->prepare("SELECT count(*) as Exist FROM dc_groups where group_name=:groupName ");
		$stmt->bindParam(':groupName', $this->GroupName);		
		try {
		$stmt->execute();
			} catch(PDOException $e)  
			{   
				//echo $e->getMessage(); 
				return false;  
			}
		$grpres = $stmt->fetch();
		if(is_array($grpres) && $grpres['Exist'] == 1)
		{
			return true;			
		} else return false;
	}
	
	///проверяет доступность группы по- id группы; return true if group exist and enable
	function VaidateGroup() //TODO:: нужна ли тутт проверка на enable?
	{		
		if(!isset($this->Group) && $this->Group <0) return false; 
		$stmt = $this->dbh->prepare("SELECT count(*) as Exist FROM dc_groups where group_id=:idgroup ");
		$stmt->bindParam(':idgroup', $this->Group);		
		try {
		$stmt->execute();
			} catch(PDOException $e)  
			{   
				//echo $e->getMessage(); 
				return false;  
			}
		$grpres = $stmt->fetch();
		if(is_array($grpres) && $grpres['Exist'] == 1)
		{
			return true;			
		} else return false;
	}
	
	///Возвращает набор прав для группы name, admin, playback, enable
	function GetGroupRight() 
	{		
		if(!isset($this->Group) && $this->Group <0) return false; 
		$stmt = $this->dbh->prepare("SELECT group_name as name, group_admin as admin, group_backplay as playback, group_enable as enable FROM dc_groups where group_id=:idgroup ");
		$stmt->bindParam(':idgroup', $this->Group);		
		try {
		$stmt->execute();
			} catch(PDOException $e)  
			{   
				//echo $e->getMessage(); 
				return false;  
			}
		return $stmt->fetchAll();		
	}
	
	function InsertGroup()
	{		
		$error = $this->Validate();
		$exist = $this->VaidateGroupName();		;
		if( $exist ) { $error = "That group name is not available. "; }
        if(count($error) > 0 )
        {
                return $error;    
        }		    
			$stmt = $this->dbh->prepare("INSERT INTO dc_groups ( group_name, group_admin, group_backplay, group_enable ) VALUES (:groupname, :adm, :pback, :enable)");			
			$stmt->bindParam(':groupname', $this->GroupName);			
			$stmt->bindParam(':adm', $this->Admin); 
			$stmt->bindParam(':pback', $this->Playback); 			
			$stmt->bindParam(':enable', $this->Enable);			
			$stmt->execute();			
			$arr = array();
			$arr = $stmt->errorInfo();
			if( !empty($arr['2']) )
			{
				return($arr['2']);
			}
			return false; 		
	}
	function UpdateGroup()
	{
		
		
	}
	
	function DeleteGroup()
	{			
        if( $this->VaidateGroupName() == true )
        {
			$stmt = $this->dbh->prepare("delete from dc_groups where group_name= :groupname");        
			$stmt->bindParam(':groupname', $this->GroupName);
			return $stmt->execute();			
		}
		return false;
	}
	
	function ChangeGroupRight()
	{
		if($this->VaidateGroupName() ) { $error = "Group not found. "; }
		$stmt = $this->dbh->prepare("update dc_groups  set  group_admin = :adm, group_backplay = :pback, group_enable = :enable  where group_name = :groupname");        
		$stmt->bindParam(':groupname', $this->GroupName);
		$stmt->bindParam(':adm', $this->Admin); 
		$stmt->bindParam(':pback', $this->Playback); 			
		$stmt->bindParam(':enable', $this->Enable);	
		$stmt->execute();
		$arr = array();
		$arr = $stmt->errorInfo();
		if( !empty($arr['2']) )
			{
				return($arr['2']); //TODO:: в продакшине не выводить везде
			}
		return false;	
	}
}
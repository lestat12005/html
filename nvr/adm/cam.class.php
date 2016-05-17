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

class IpCam extends Settings
{
	protected $CamName;
    protected $Url;
    protected $Ip;
	protected $Uin;
	protected $User;
	protected $Password;
	protected $Group;
    protected $Enable;
	
	function SetCamName($camname)
    {
        return $this->CamName = trim($camname);
    }
	
}

class IpCamInfo extends Settings
{
	function GetIpCamInfo()
	{
		$sql = 'Select [ipcam_id] as id,[ipcam_name] as name,[ipcam_ip] as ip,[ipcam_port] as port,[ipcam_uin] as uin,[ipcam_url] asurl,' 
			  .'[ipcam_enable] as enable,[ipcam_chind] as chanel,[ipcam_type] as type,[ipcam_dep] as depid,[dep_name] as depname,[dep_num] as depnum,[dep_enable] as depenable ' 
			  .'From [DC_IPCAM] join DC_DEP on  ipcam_dep = dep_id order by dep_name, ipcam_name';
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
	function GetIpCamShortInfo()
	{
		$sql = 'Select [ipcam_id] as id,[ipcam_name] as name,[ipcam_enable] as enable,[ipcam_dep] as depid,[dep_name] as depname,[dep_num] as depnum,[dep_enable] as depenable ' 
			  .'From [DC_IPCAM] join DC_DEP on  ipcam_dep = dep_id order by dep_name, ipcam_name';
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
	
	function GetDepInfo()
	{
		$sql = 'Select [dep_id]  as depid,[dep_name] as depname,[dep_num] as depnum,[dep_enable] as depenable From MAIN.[DC_DEP]';
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
}
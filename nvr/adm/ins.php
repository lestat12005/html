<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
$Password = "12345";
echo md5($Password.":".'555555555');

$db = new PDO('sqlite:db/webDevCams.db');

$st = $db->query("SELECT * FROM dc_users");
//$st = $db->prepare("SELECT * FROM dc_users where user_login='User1'");
$st->execute();
$results = $st->fetchAll();
//$results = $st->fetch();
echo "<pre>";
print_r($results);
echo "</pre>";
echo "<br>ggggg<br>";
/*
if ($db->exec(
		//"INSERT INTO users (username, password, email, regdate) VALUES ('user1', '45', '89', '778')"
		""
	) > 0)
{           echo 'Inserted';       }  
else
{ echo "not";}

		$arr = array();
        $arr = $db->errorInfo();
		echo "22<br>";
		print_r($arr);

*/

/*
$usr = "User42";
$pass = "22222222222222222";
$hash = "555555555";
$ldt = "55122016";

		$stmt = $db->prepare("update dc_users set user_password = :password , user_hash = :hash, user_logindt= :ldt where user_login= :user");
        //$stmt = $this->dbh->prepare("UPDATE users SET password = :password  WHERE username = :username AND password = :oldpass");
        $stmt->bindParam(':user', $usr);
        $stmt->bindParam(':password', $pass);
        $stmt->bindParam(':hash', $hash);
        $stmt->bindParam(':ldt', $ldt);
        $res = $stmt->execute();
		
		echo "----->".$res."<-----";
		
		$arr = array();
        $arr = $db->errorInfo();
		echo "22<br>";
		print_r($arr);
		
		*/
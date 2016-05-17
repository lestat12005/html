<?php
error_reporting(E_ALL); 
ini_set("display_errors", 1); 
include_once($_SERVER['DOCUMENT_ROOT'].'/nvr/adm/sys.class.php');

$autorize = new Autorization();

if(@$_POST['exit']) {	$autorize->Logout();	}


if(isset($_COOKIE[$autorize->GetCookiName()]))
{
	$access = $autorize->Grant();
	var_dump($access);	
}else
{
	echo "coockie dont set";
	
}

if (!isset($access) or $access = false) 
{
		include ($_SERVER['DOCUMENT_ROOT'].'/nvr/adm/login.php');
		exit();
}	?>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<input type='submit' name='exit' value='Выйти'/>
</form>
Здесь закрытый контент...

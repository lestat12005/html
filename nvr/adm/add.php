<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
var_dump($_POST);
echo "-----<br>";
require_once 'sys.class.php';
$reg = new Registration;
$reg2 = new Registration;
	$reg2->SetUsername('User6');
	$reg2->SetPassword("12345");
	$reg2->SetGroup("3");
	$rvalGr = $reg2->VaidateGroup();
	echo "-----<br>";
var_dump($rvalGr);
echo "-----<br>";
	echo "<pre>";
		print_r($rvalGr);
	echo "</pre>";
	
echo "<br>";
if( isset($_POST['add']) && isset($_POST['login']) && isset($_POST['pass']) )
{
	$reg->SetUsername($_POST['login']);
	$reg->SetPassword($_POST['pass']);
	$reg->SetGroup("1");
	$rvalGr = $reg->VaidateGroup();
	echo "<br>valgr =";
	var_dump($rvalGr);
	$error = $reg->InsertUser(); // see notes at the class
	//var_dump($error);
	echo "<br>";
	if($error)
	{
	var_dump($error);
	}
}

if( isset($_POST['del']) && isset($_POST['login']) )
{
	$reg->SetUsername($_POST['login']);	
	$error = $reg->DeleteUser(); // see notes at the class
	
	echo "<br>";
	if($error)
	{
		echo "User deleted";
	} else
	{
	var_dump($error);
	}
}

?>


<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" name="add">
    <span>Login:</span>
    <input name="login" type="text" size="45"/><br/>
    <span>Password:</span>
    <input name="pass" type="password" size="45"/>
    <input class="submit" name="add" type="submit" value="Add user"/>
</form>

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" name="del">
    <span>Login:</span>
    <input name="login" type="text" size="45"/><br/>
    <input class="submit" name="del" type="submit" value="Delete"/>
</form>
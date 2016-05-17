<?
error_reporting(E_ALL); 
ini_set("display_errors", 1); 

include_once($_SERVER['DOCUMENT_ROOT'].'/nvr/adm/sys.class.php');
if (isset($_POST['name']) and isset($_POST['password']) and $_POST['password'] !== '' and $_POST['name'] !== '') 
{
	$login = new Login();
	$login->SetUsername($_POST['name']);
	$login->SetPassword($_POST['password']);
	$res= $login->CheckLogin();
} 
if( isset($_POST['name']) or isset($_POST['password']) ) $res = "You entered an invalid login or password";

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Авторизация.</title>
<link rel="stylesheet" href="stlog.css"/>
</head>

<body>
<div class="logo">
	<div class="login">
	<br><br>
    <h2>Авторизация:</h2>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" name="register">
    <span>Логин:</span>
    <input name="name" type="text" size="45"/><br/>
    <span>Пароль:</span>
    <input name="password" type="password" size="45"/>
    <input class="submit" type="submit" value="Войти"/>
    </form>
    </div>
    <?php
    if (@$res) {
	?>
    <div class="error">
    <span><?php echo $res;?></span>
    </div>   
    <?php } ?>
</div>
</body>
</html>
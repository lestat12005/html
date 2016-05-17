<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/nvr/adm/sys.class.php');
$autorize = new Autorization();
if(@$_POST['exit']) {	$autorize->Logout();	}
if(isset($_COOKIE[$autorize->GetCookiName()]))
{
	$access = $autorize->Grant();	
}
if (!isset($access) or $access = false) 
{
		include ($_SERVER['DOCUMENT_ROOT'].'/nvr/adm/login.php');
		exit();
}
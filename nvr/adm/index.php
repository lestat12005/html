<?php
include_once('debug.php');
//show_r($_POST);
define("cp", 'index.php');
$title = "Administrator";

include_once($_SERVER['DOCUMENT_ROOT'].'/nvr/adm/sys.class.php');
//require_once('parseDate.class.php');
 
//echo "<br>---";
//$Userinfo = new InfoUsr();
//echo "<br>---";
//$res_usr_array = $Userinfo->GetUserInfo();
//$res_grp_array = $Userinfo->GetGroupInfo();
//echo "<br>---";
//var_dump($res_grp_array);
//echo "<pre>";
//		print_r($res_usr_array);
//echo "</pre>";
//$status = "trst";

//------------------------Add user----------------------------------------
if( isset($_POST['add_user_desc']) && isset($_POST['new_name']) && isset($_POST['new_pwd']) && isset($_POST['new_groupSelector'])  )
{
	
	$reg = new Registration;
	$reg->SetUsername($_POST['new_name']);
	$reg->SetPassword($_POST['new_pwd']);
	$reg->SetGroup($_POST['new_groupSelector']); 
	$error = $reg->InsertUser(); // see notes at the class
	//var_dump($error);
	//echo "<br>";
	if($error)
	{
		$status = $error;
	} else 
	{
		$status = "User added"; 
	}
}

//-----------------------Update user----------------------------------------
if( isset($_POST['save_user_desc']) && isset($_POST['edit_name']) && isset($_POST['edit_groupSelector']) )
{
	$reg = new Registration;
	$reg->SetUsername($_POST['edit_name']);
	//$reg->SetPassword();
	$reg->SetGroup($_POST['edit_groupSelector']);
	$error = $reg->ChangeUserGroup(); // see notes at the class
	//var_dump($error);
	//echo "<br>";
	if($error)
	{
		$status = "Select user first";
	} else { $status = "User Edited"; }
}
//-------------------------Del user---------------------------------------
if( isset($_POST['form2_delete']) && isset($_POST['form2_name']) )
{	
	$reg = new Registration;	
	$reg->SetUsername($_POST['form2_name']);
	$UserData = $reg->GetUserByName();	
	if(isset($UserData[0]) && $UserData[0]['user_id'] == (int)$_POST['form2_delete'] )
	{		
		$error = $reg->DesableUser(); // see notes at the class			
		if($error)
		{
			$status = "User deleted";
		} else
		{
			$status = "User not deleted";			
		}
	} else { $status = "User not found"; }
}
//-----------------------------------------------------------------------
$Userinfo = new InfoUsr();

$res_usr_array = $Userinfo->GetUserInfo();
$res_grp_array = $Userinfo->GetGroupInfo();
/*
show_r( $Userinfo->GetGroupInfo() );
$MainUsr1 = new MainUsr();

$MainUsr1->SetGroup(1);
show_r( $MainUsr1->GetGroupRight() ); 
*/
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<?php include_once("admin_head.php");?>
</head>
<body>
<table class="rootTable">
  <tr><td class="header" colspan="3"><?php include_once('admin_header.php');?></td>
  </tr>
  <tr>
	  <td class="menu" ><?php include_once('admin_menu.php');?></td>
	  <td class="body"> 
			<?php require_once('disp_error.php');?>
			<?php include_once('admin_adm.php');?>
	  </td>
	  <td class="right_margin" ></td>
  </tr> 
  <div id="ds-info" class="ds-info"><div class="ds-infoh">Warning</div><div id="ds-infot" class="ds-infot"></div></div>
  <tr><td id="footer" class="footer" colspan="3"><span id="status"></span></td></tr>
</table>
</body>
</html>
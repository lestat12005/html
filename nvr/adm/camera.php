<?php
include_once('debug.php');
show_r($_POST);
define("cp", 'camera.php');
$title = "Cameras";

include_once($_SERVER['DOCUMENT_ROOT'].'/nvr/adm/cam.class.php');
//------------------- New ipcam ---------------------------------------
if( isset($_POST['add_user_desc']) && isset($_POST['new_name']) && isset($_POST['new_pwd']) && isset($_POST['new_groupSelector'])  )
{	

$ipcamera = new IpCam();
$ipcamera->CamName;
$ipcamera->Url;
$ipcamera->User;
$ipcamera->Password;
$ipcamera->Group;
}
/*
    [new_name] => кенке
    [new_url] => 
    [new_login] => 
    [new_ipcamSelector] => 1
    [new_pwd] => 
    [add_user_desc] => Добавить
*/
//-----------------------------------------------------------------------
$Userinfo = new IpCamInfo();

$res_cam_array = $Userinfo->GetIpCamShortInfo();
$res_cam_full_array = $Userinfo->GetIpCamInfo();
//show_r($res_cam_full_array);

$res_ipcam_array = $Userinfo->GetDepInfo();
//show_r($res_dep_array);

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
			<?php include_once('admin_cam.php');?>
	  </td>
	  <td class="right_margin" ></td>
  </tr> 
  <div id="ds-info" class="ds-info"><div class="ds-infoh">Warning</div><div id="ds-infot" class="ds-infot"></div></div>
  <tr><td id="footer" class="footer" colspan="3"><span id="status"></span></td></tr>
</table>
</body>
</html>
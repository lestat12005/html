<?php		
include_once('debug.php');
//show_r($_POST);
define("cp", 'groups.php');
$title = "Groups";
include_once($_SERVER['DOCUMENT_ROOT'].'/nvr/adm/sys.class.php');

//------------------------Add group----------------------------------------
if( isset($_POST['new_name']) && isset($_POST['add_grp_desc'])  )
{	
	$reg = new MainGrp;
	$reg->SetGroupName($_POST['new_name']);
	$reg->SetGroupAdmin(isset($_POST['new_adm']) ? $_POST['new_adm']: 'off' );	
	$reg->SetGroupPlayback(isset($_POST['new_pbck']) ? $_POST['new_pbck']: 'off' ); 
	$reg->SetGroupEnable(isset($_POST['new_enbl']) ? $_POST['new_enbl']: 'off' ); 
	$error = $reg->InsertGroup(); // see notes at the class	
	if($error) { $status = "Couldn't add group : ".$error; } else {	$status = "Group added"; }
} //else	
//-----------------------Update group right---------------------------------
if( isset($_POST['save_grp_desc']) && isset($_POST['edit_name']) )
{
	$edtg = new MainGrp;
	$edtg->SetGroupName($_POST['edit_name']);
	$edtg->SetGroupAdmin(isset($_POST['edit_adm']) ? $_POST['edit_adm']: 'off');
	$edtg->SetGroupPlayback(isset($_POST['edit_pbck']) ? $_POST['edit_pbck']: 'off'); 
	$edtg->SetGroupEnable(isset($_POST['edit_enbl']) ? $_POST['edit_enbl']: 'off');	
	$error = $edtg->ChangeGroupRight(); // see notes at the class
	if($error) { $status = "Select group first"; } else { $status = "Group Edited"; }
}
//-------------------------Del group---------------------------------------
if( isset($_POST['form2_delete']) && isset($_POST['form2_name']) )
{	
	$delg = new MainGrp;	
	$delg->SetGroupName($_POST['form2_name']);
	$delg->VaidateGroupName();	
	if( $delg->VaidateGroupName() ) 
	{		
		$error = $delg->DeleteGroup(); // see notes at the class			
		if($error)
		{ $status = "Group deleted"; } else	{ $status = "Group not deleted"; }
	} else { $status = "Group not found"; }
}
//-------------------------------------------------------------------------
$Userinfo = new InfoUsr();
$res_usr_array = $Userinfo->GetUserInfo();
$res_grp_array = $Userinfo->GetGroupInfo();

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
			<?php include_once('admin_grp.php');?>
	  </td>
	  <td class="right_margin" ></td>
  </tr> 
  <div id="ds-info" class="ds-info"><div class="ds-infoh">Warning</div><div id="ds-infot" class="ds-infot"></div></div>
  <tr><td id="footer" class="footer" colspan="3"><span id="status"></span></td></tr>
</table>
</body>
</html>
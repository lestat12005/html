<?php
//simple DB, lol
$login_user="user1";
$password_user="234567";
$login_user1="user2";
$password_user1="345678";
$login_user2="user3";
$password_user2="456789";


if(!isset($_POST['login']) || !isset($_POST['password'])  ) { header( 'Location: index.html' ) ; }

$login=$_POST['login'];
$password=$_POST['password'];
if(($login_user == $login) and ($password_user == $password)or($login_user1 == $login) and ($password_user1 == $password)or($login_user2 == $login) and ($password_user2 == $password)){
    
    SetCookie("User","Login");
	SetCookie("Ui", base64_encode($login)  );
	SetCookie("Dtlogin", sha1( MD5($login).SHA1("rfh34itiufhiu45jgfi54jngi") )   );
	SetCookie("Pass", md5( sha1("Login").date("m.d.y") ) );
	
	/*<?php if( !defined("fbr_3") ) die("Error 404.");?> */
    header( 'Location: index.php' ) ;
}
else
{
    //echo "Wrong Pass!";
    header( 'Location: index.html' ) ;
}
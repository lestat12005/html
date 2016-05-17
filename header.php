<?php  define('LOADED', true); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head><?php

    if (isset ($_GET['go'])){
        SetCookie("User",""); SetCookie("Pass",""); SetCookie("Dtlogin",""); SetCookie("Ui","");
        header( 'Location: index.html' ) ;
    }

	if( !isset($_COOKIE['User'])   ||  !isset($_COOKIE['Dtlogin']) || !isset($_COOKIE['Ui']) ){ header( 'Location: index.html' ); }
    if( !($_COOKIE['User']=='Login') || !($_COOKIE['Dtlogin'] == sha1(MD5(base64_decode($_COOKIE['Ui'])).SHA1("rfh34itiufhiu45jgfi54jngi"))) ) 	{ header( 'Location: index.html' ); }
	
    $pagePrefix= "";

    $page= $_SERVER['REQUEST_URI'];

    switch ($page) {
        case $pagePrefix.'/index.php':
            $title = 'Наглядный пример демонсрации видеопотока в двух разных режимах: верхний ряд с разрешение"1600х1200" нижний "704x576" ';
            break;
        case $pagePrefix.'/index.php':
            $title = 'Maine Page';
            break;
        case $pagePrefix.'/z1maine.php':
            $title = 'Z1. Maine';
            break;
        case $pagePrefix.'/z1sub.php':
            $title = 'Z1. Sub';
            break;
        case $pagePrefix.'/z2maine.php':
            $title = 'Z2. Maine';
            break;
        case $pagePrefix.'/z2sub.php':
            $title = 'Z2. Sub';
            break;
        case $pagePrefix.'/z3maine.php':
            $title = 'Z3. Maine';
            break;
        case $pagePrefix.'/z3sub.php':
            $title = 'Z3. Sub';
            break;
        case $pagePrefix.'/departmentbank.php':
            $title = 'Пример схемы подключения объекта к ядру сети';
            break;
		case $pagePrefix.'/equipment.php':
            $title = 'Комплект оборудования на объект';
			 break;
		case $pagePrefix.'/Core.php':
            $title = 'Ядро ситемы видеонаблюдения';
			 break;
		case $pagePrefix.'/HDD_Size.php':
            $title = 'Расчеты дискового массива все варианты';
			 break;
		case $pagePrefix.'/L_HDD_Size.php':
            $title = 'Расчеты дискового массива Версия "Эконом" ядра системы';
			 break;	 	 
		case $pagePrefix.'/Zabbix.php':
            $title = 'Карта мониторинга оборудования';
			 break;
			 		case $pagePrefix.'/Prezentaciya.php':
            $title = 'Возможности ситемы';
			 break;	
    }
    ?>
    <title><?php echo $title ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
<style>
.mtbl
{
	width:1210px;
	
	border-spacing:0;
	border: 0px solid green; /* Рамка вокруг таблицы */
    margin: auto; /* Выравниваем таблицу по центру окна  */	
}
.tr_h
{
	background: transparent url("img/head_bg.png") repeat-x scroll 0% 0%;
	height:120px;
	padding:0 10px;
}
.tr_h2 {  height:14px; }
.tr_h3 { background: transparent url("img/bg2.gif") repeat-x scroll 0% 0%; height:31px; padding-left:10px; }
.tr_hsb { background-color:white; width:188px;  padding-left:10px; }
.tr_hcont { background-color:white; width:1000px;   }
.tr_hf { background-color:white; height:14px;   }
</style>
<link rel="stylesheet" href="style/st1.css" type="text/css" />
</head>
<body>
<table class="mtbl">
<tr>
     <td class="tr_h" colspan="2">
	 <!--div class="logo"><a href="index.php"><img src="img/logo.png"/></a></div-->
            <a href="index.php?go=1" style="float: right;margin-top: 65px;padding: 10px 20px;background: #EC9A40;border: solid 1px #FFFFFF;border-radius: 15px;font-weight: bold;text-decoration: none;color: #fff;">Exit</a>
     </td>
<tr>     <td class="tr_h2" colspan="2"></td></tr>
<tr>
     <td  class="tr_h3" colspan="2"><b><?php echo $title ?></b></td>
</tr>
<tr>
	<td class="tr_hsb" valign="top">   
            
            <?php include 'sidebar.php'; ?>
	</td>
	<td class="tr_hcont">
<div id="ch_list" class="channel-list"><?php
$menu_array = array("department"=>"Отделения", "camera"=>"Камеры", "groups"=>"Группы", "index"=>"Пользователи");
//$_SERVER['DOCUMENT_ROOT']
foreach($menu_array as $k=>$v)
{
	echo '<div class="ch"><a href="'.$k.'.php?cat='.$k.'"><div class="ch-name">'.$v.'</div></a></div>';	
}
?></div>
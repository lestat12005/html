<?php if(isset($status) && $status != ""){ 
if(is_array($status))
{
	echo '<p style="width: 1000px; margin: 8px; padding:8px; border:1px solid red">';
	foreach($status as $cstatus )
	{
		echo  $cstatus."<br>";		
	} echo "</p>";
} else
echo '<p style="width: 1000px; margin: 8px; padding:8px; border:1px solid red">'.$status."</p>"; }?>
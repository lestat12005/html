<script>
function handlerConfForm(curObj)
    {
		var cid = curObj.id.split('_');
		if(!cid[1] )	{ return false; } 		
		var cuid = parseInt(cid[1]);		
		if ( isNaN(cuid) || !confirm("Вы подтверждаете удаление?")) { return false; }
		var cName = document.getElementById('cu_'+cuid).innerText.trim();
		
		var fm = document.getElementById('form2');
        var inpElem = document.createElement('input');
        inpElem.setAttribute("name", 'form2_delete');
        inpElem.setAttribute("type", 'hidden');
		var inpElem2 = document.createElement('input');
        inpElem2.setAttribute("name", 'form2_name');
        inpElem2.setAttribute("type", 'hidden');
		inpElem2.setAttribute("value", cName);
        inpElem.setAttribute("value", cuid);
        fm.appendChild(inpElem);
		fm.appendChild(inpElem2);
        fm.submit();		
	}

	function handlerEditForm(curObj)
    {
		var cid = curObj.id.split('_');
		if(!cid[1] )	{ return false; } 		
		var cuid = parseInt(cid[1]);		
		if ( isNaN(cuid) ) { return false; }
		var cName = document.getElementById('cu_'+cuid).innerText.trim();
		document.getElementById('edit_name').value = cName;		
		//editName
	}
</script>
<form method="POST" action="<?=cp?>">
<table class="hTable">
	<tr>
		<td width="120">Новыя камера</td>
        <td width="150"><input id="new_name" name="new_name" type="text" placeholder="Название" maxlength="15" size="15"></td>
		<td >&nbsp;</td>	
		<td width="100">Link</td>
        <td width="400"><input id="new_url" name="new_url" type="text" placeholder="Link" maxlength="15" size="15"></td>
		<td width="150"></td>			
	</tr>
	<tr>
		<td>Логин</td>	
		<td><input id="new_login" name="new_login" type="text" placeholder="Логин" maxlength="15" size="15"></td>
		<td>&nbsp;</td>	
		<td>Отдел</td>
		<td>
		<select id="new_ipcamSelector" name ="new_ipcamSelector" >
		<?php
		$fst = true;
		if(!is_array($res_ipcam_array))
		{
			echo '<option selected disabled="" value="-1">Department not found</option>';
		}
		else
		{
			foreach($res_ipcam_array as $cgrp)
			{
				$depFullName = $cgrp['depname']." N".$cgrp['depnum'];
				if($fst)
				{
					echo '<option selected value="'.$cgrp['depid'].'">'.$depFullName.'</option>'; $fst = false;
				}
				else
				{
					echo '<option value="'.$cgrp['depid'].'">'.$depFullName.'</option>';
				}
			}
		}		
		?>			
		</select>
		</td>
		<td></td>	
	</tr>
	<tr>
		<td >Пароль</td>	
		<td ><input id="new_pwd"  name="new_pwd"  type="password" placeholder="Пароль" maxlength="15" size="15"></td>
		<td >&nbsp;</td>	
		<td ></td>
		<td ></td>
		<td align="right"><input id="add_user_desc" name="add_user_desc" type="submit" value="Добавить" /></td>
	</tr>  
</table></form>

<form method="POST" action="<?=cp?>">
<table class="hTable">
    <tr>
		<td width="150">Редактировать</td>
        <td width="170"><input readonly id="edit_name" name="edit_name" type="text" placeholder="Выберите логин" maxlength="15" size="15" value=""></td>
        <td width="120"></td>
		<td >&nbsp;</td>
        <td width="120">Группа доступа</td>
        <td width="180">
		<select id="edit_groupSelector" name ="edit_groupSelector">
		<?php
		$fst = true;
		if(!is_array($res_grp_array))
		{
			echo '<option selected disabled="" value="-1">Group not found</option>';
		}
		else
		{
			foreach($res_grp_array as $cgrp)
			{
				if($fst)
				{
					echo '<option selected value="'.$cgrp['uin'].'">'.$cgrp['name'].'</option>'; $fst = false;
				}
				else
				{
					echo '<option value="'.$cgrp['uin'].'">'.$cgrp['name'].'</option>';
				}
			}
		}		
		?>			
		</select>
		</td>
        <td width="150" align="right"><input id="save_ipcam_desc" name="save_ipcam_desc" type="submit" value="Сохранить" /></td>
    </tr>	
</table></form>

<form method="POST" action="<?=cp?>" id="form2" name="form2">
<table   class="fixed_headers_adm">
    <thead>
    <tr><th>Камера</th><th>Отдел</th><th>Номер</th><th>Состояние</th><th>Редактировать</th><th>Удалить</th></tr>
    </thead>
    <tbody>
    <?php
	if(isset($res_cam_array) && is_array($res_cam_array))
    foreach($res_cam_array as $cam)
    {
        $cc = $cam[0];
		//if(isset($cusr['user_logindt'])){ $bdate = date('d.m.Y H:i', $cusr['user_logindt']); } else{ $bdate = "-"; }
		if($cam['enable'] !=1 || $cam['depenable'] != 1){ $isBlocked = "Blocked"; } else { $isBlocked = "Available"; }		
        ?>
    <tr>
        <td id="cu_<?=$cc?>"><?php echo $cam['name']; ?></td>
        <td><?php echo $cam['depname']; ?></td>
        <td><?php echo $cam['depnum']; ?></td>
        <td><?php echo $isBlocked; ?></td>        
        <td><a id="editFill_<?=$cn?>"  href="<?=cp?>" onclick="handlerEditForm(this); return false;">Править</a></td>
        <td><a id="editDelete_<?=$cn?>"  href="<?=cp?>" onclick="handlerConfForm(this); return false;">Удалить</a></td>
    </tr>

<?php    } //document.getElementById('form2').submit();
    ?>
    </tbody>
</table>
</form>
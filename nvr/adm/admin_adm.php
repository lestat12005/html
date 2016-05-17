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
		<td width="150">Новый пользователь</td>
        <td width="170"><input id="new_name" name="new_name" type="text" placeholder="Новый логин" maxlength="15" size="15"></td>
        <td width="150"><input id="new_pwd"  name="new_pwd"  type="password" placeholder="Пароль" maxlength="15" size="15"></td>
		<td >&nbsp;</td>
        <td width="120">Группа доступа</td>
        <td width="180">
		<select id="new_groupSelector" name ="new_groupSelector" >
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
        <td width="150" align="right"><input id="add_user_desc" name="add_user_desc" type="submit" value="Добавить" /></td>
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
        <td width="150" align="right"><input id="save_user_desc" name="save_user_desc" type="submit" value="Сохранить" /></td>
    </tr>	
</table></form>

<form method="POST" action="<?=cp?>" id="form2" name="form2">
<table   class="fixed_headers_adm">
    <thead>
    <tr><th>Логин</th><th>Группа</th><th>Время</th><th>IP</th><th>Редактировать</th><th>Удалить</th></tr>
    </thead>
    <tbody>
    <?php
	if(isset($res_usr_array) && is_array($res_usr_array))
    foreach($res_usr_array as $cusr)
    {
        $cn = $cusr[0];
		if(isset($cusr['user_logindt'])){ $bdate = date('d.m.Y H:i', $cusr['user_logindt']); } else{ $bdate = "-"; }

        ?>
    <tr>
        <td id="cu_<?=$cn?>"><?php echo $cusr['user_login']; ?></td>
        <td><?php echo $cusr['group_name']; ?></td>
        <td><?php echo $bdate; ?></td>
        <td><?php echo $cusr['user_ip']; ?></td>        
        <td><a id="editFill_<?=$cn?>"  href="<?=cp?>" onclick="handlerEditForm(this); return false;">Править</a></td>
        <td><a id="editDelete_<?=$cn?>"  href="<?=cp?>" onclick="handlerConfForm(this); return false;">Удалить</a></td>
    </tr>

<?php    } //document.getElementById('form2').submit();
    ?>
    </tbody>
</table>
</form>
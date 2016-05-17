<script>
function handlerConfForm(curObj)
    {   //delete
		var cid = curObj.id.split('_');
		if(!cid[1] )	{ return false; } 		
		var cuid = parseInt(cid[1]);		
		if ( isNaN(cuid) || !confirm("Вы подтверждаете удаление?")) { return false; }
		var cName = document.getElementById('cg_'+cuid).innerText.trim();
		
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
			
		if( document.getElementById('cg_'+cuid)  !== null) document.getElementById('edit_name').value = document.getElementById('cg_'+cuid).innerText.trim();			
		if( document.getElementById('cga_'+cuid) !== null) document.getElementById('edit_adm' ).checked = document.getElementById('cga_'+cuid).checked;	
		if( document.getElementById('cgp_'+cuid) !== null) document.getElementById('edit_pbck').checked = document.getElementById('cgp_'+cuid).checked;
		if( document.getElementById('cge_'+cuid) !== null) document.getElementById('edit_enbl').checked = document.getElementById('cge_'+cuid).checked;
		//editGroup
	}
</script>
<form method="POST" action="<?=cp?>">
<table class="hTable">
    <tr>
		<td width="150">Новая группа</td>
        <td width="170"><input id="new_name" name="new_name" type="text" placeholder="Новая группа" maxlength="15" size="15"></td>
        <td width="150"><input id="new_adm" name="new_adm"  type="checkbox"> <label for="new_adm">Admins</label></td>
		<td width="150"><input id="new_pbck" name="new_pbck"  type="checkbox"> <label for="new_pbck">Playback</label></td>
        <td width="120"><input id="new_enbl" name="new_enbl" checked="" type="checkbox"> <label for="new_enbl">Enable</label>
        <td ></td>
        <td width="150" align="right"><input id="add_grp_desc" name="add_grp_desc" type="submit" value="Добавить" /></td>
    </tr>	
</table></form>

<form method="POST" action="<?=cp?>">
<table class="hTable">
    <tr>
		<td width="150">Редактировать</td>
        <td width="170"><input id="edit_name" name="edit_name" readonly type="text" placeholder="Группа" maxlength="15" size="15"></td>
        <td width="150"><input id="edit_adm"  name="edit_adm"    type="checkbox"> <label for="edit_adm">Admins</label></td>
		<td width="150"><input id="edit_pbck" name="edit_pbck"   type="checkbox"> <label for="edit_pbck">Playback</label></td>
        <td width="120"><input id="edit_enbl" name="edit_enbl"   type="checkbox"> <label for="edit_enbl">Enable</label></td>
        <td ></td>
        <td width="150" align="right"><input id="save_grp_desc" name="save_grp_desc" type="submit" value="Сохранить" /></td>
    </tr>	
</table></form>

<form method="POST" action="<?=cp?>" id="form2" name="form2">
<table   class="fixed_headers_adm">
    <thead>
    <tr><th>Группа</th><th>Admins</th><th>Playback</th><th>Enable</th><th>Редактировать</th><th>Удалить</th></tr>
    </thead>
    <tbody>
    <?php
	if(isset($res_grp_array) && is_array($res_grp_array))
    foreach($res_grp_array as $cgrp)
    {
        $cg = $cgrp[0];
		//if(isset($cgrp['user_logindt'])){ $bdate = date('d.m.Y H:i', $cgrp['user_logindt']); } else{ $bdate = "-"; }
//[group_id] as uin,[group_name] as name,[group_admin] as admin,[group_backplay] as playback,[group_enable] as enable From MAIN.[DC_GROUPS] 
		if( $cgrp['admin'] == 1 )	{$cga_checked = 'checked=""';} else {$cga_checked = '';}
		if( $cgrp['playback'] == 1 ){$cgp_checked = 'checked=""';} else {$cgp_checked = '';}
		if( $cgrp['enable'] == 1 )	{$cge_checked = 'checked=""';} else {$cge_checked = '';}
		
        ?>
    <tr>
        <td id="cg_<?=$cg?>"><?php echo $cgrp['name']; ?></td>
        <td><input disabled="" id="cga_<?=$cg?>" name="cga_<?=$cg?>" <?=$cga_checked?> type="checkbox"></td>
        <td><input disabled="" id="cgp_<?=$cg?>" name="cgp_<?=$cg?>" <?=$cgp_checked?> type="checkbox"></td>
        <td><input disabled="" id="cge_<?=$cg?>" name="cge_<?=$cg?>" <?=$cge_checked?> type="checkbox"></td>        
        <td><a id="editFill_<?=$cg?>"  href="<?=cp?>" onclick="handlerEditForm(this); return false;">Править</a></td>
        <td><a id="editDelete_<?=$cg?>"  href="<?=cp?>" onclick="handlerConfForm(this); return false;">Удалить</a></td>
    </tr>

<?php    } //document.getElementById('form2').submit();
    ?>
    </tbody>
</table>
</form>
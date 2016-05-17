<form method="POST" action="<?=cp?>">
<table class="hTable">
    <tr>
        <td width="150"><input id="new_name" name="new_name" type="text" placeholder="Новый логин" maxlength="15" size="15"></td>
        <td width="230"><input id="new_pwd" name="new_pwd" type="password" placeholder="Пароль" maxlength="15" size="15"></td>
        <td width="200"><input id="new_pers" name="new_pers" type="checkbox" checked> <label for="new_pers">Персоны и картотека</label></td>
        <td width="150"><input id="new_rep" name="new_rep" type="checkbox" checked> <label for="new_rep">Отчеты</label></td>
        <td width="150"><input id="new_ident" name="new_ident" type="checkbox" checked> <label for="new_ident">Администратор</label></td>
        <td width="120" align="right"><input id="save_user_desc" name="save_user_desc" type="submit" value="Добавить" /></td>
    </tr>
</table></form>

<form method="POST" action="<?=cp?>" id="form2">
<table   class="fixed_headers_adm">
    <thead>
    <tr><th>Логин</th> <th>Пароль</th> <th>Персоны</th> <th>Отчеты</th> <th>Администратор</th> <th>Удалить</th> <th>Действие</th>
    </tr>
    </thead>
    <tbody>
    <?php

    foreach($res_usr_array as $cusr)
    {
        $cn = $cusr[0];


        ?>
    <tr onclick="chUser(this)" id="<?=$cn?>">
        <td><?=cw2u8($cusr[1])?><input disabled type="hidden" id="usr_<?=$cn?>"  name="usr_<?=$cn?>" value="<?=cw2u8($cusr[1])?>"></td>
        <td><input disabled   id="pwd_<?=$cn?>" name="pwd_<?=$cn?>" type="hidden" placeholder="Пароль" maxlength="15" size="15"></td>
        <td><input disabled id="cpc_<?=$cn?>" name="cpc_<?=$cn?>" type="checkbox" <?=ch_right($cusr[3])?> ></td>
        <td><input disabled id="crp_<?=$cn?>" name="crp_<?=$cn?>" type="checkbox" <?=ch_right($cusr[4])?> ></td>
        <td><input disabled id="cid_<?=$cn?>" name="cid_<?=$cn?>" type="checkbox" <?=ch_right($cusr[5])?> onchange="handlerChAdmin(this);" ></td>
        <td><input disabled id="cdl_<?=$cn?>" name="cdl_<?=$cn?>" type="checkbox" ></td>
        <td><a id="acf_<?=$cn?>" hidden href="<?=cp?>" onclick="handlerConfForm(this); return false;">Применить</a></td>
    </tr>

<?php    } //document.getElementById('form2').submit();
    ?>
    </tbody>
</table>
</form>
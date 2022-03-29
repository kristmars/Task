<?php if($dataParams['auth']<>'register') :
?>
<form  action="/?action=login" method="POST">
    <table class="login"><tr>
    <td colspan="3"><label name="userName">Dane do logowania</label></td></tr>
    <tr>
    <td><input  type="text" name="IuserName" maxlength="25" placeholder="Podaj login"></td>
    <td><input  type="password" name="Ipassword" maxlength="25" placeholder="Podaj haslo"></td>
    <td><input class="button" type="submit" name="Zaloguj" value="Zaloguj"/></td>
    </tr>
    <tr><td colspan="2 "></td>
        <td><a href="/?action=register">Zarejestruj</a></td></tr>
    </table>
</form>
<?php endif; ?>
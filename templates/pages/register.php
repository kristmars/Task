<form clas="form" action="/?action=register" method="POST">
    <label>Podaj Imie</label>
    <input class="inputTxt" name="fname" type="text" required/>
    <label>Podaj nazwisko</label>
    <input  class="inputTxt" name="sname" type="text" required/>
    <label>Podaj login</label>
    <input  class="inputTxt" name="login" type="text" required/>
    <label>Podaj haslo</label>
    <input  class="inputTxt" name="password" type="password" required/>
    <label>Podaj email</label>
    <input  class="inputTxt" name="email" type="text" required/>
    <input class="button" type="submit" name="Zapisz" value="Zapisz"/>
    <a href="/?action=noregister"><input class="button" type="button" name="Anuluj" value="Anuluj"/></a>
</form>
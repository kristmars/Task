<form class="form" action="/?action=editedCategory&id=<?php echo htmlentities($dataParams['id'])?>" method="POST">
    <label name="LName">Nazwa kategorii</label>
    <input class="tresc" type="text" name="Name" value="<?php echo htmlentities($dataParams['name'])?>">
    <input class="button" type="submit" name="Zapisz" value="Zapisz"/>
</form>

<form clas="form" action="/?action=creTask" method="POST">
    <label>Tytul zadania</label>
    <input name="tytul" type="text">
    <label>Opis zadania</label>
    <input  name="description" type="textarea">
    <label>Kategoria</label>
    <select name="category">
    <?php foreach ($dataParams['category'] ?? [] as $category):?>
        <option><?php echo htmlentities($category['name'])?></option>
    <?php endforeach;?>    
    </select>
    <input class="button" type="submit" name="Zapisz"/>
</form>

<table>
    <th>Tytul</th>
    <th>Opis</th>
    <th>Kategoria</th>
    <th>Data utworzenia</th>
</table>
<table>
    <?php foreach ($dataParams['task'] ?? [] as $task):?>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <?php endforeach;?>
</table>
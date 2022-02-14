<form clas="form" action="/?action=creTask&app=Task" method="POST">
    <label>Tytul zadania</label>
    <input class="inputTxt" name="tytul" type="text">
    <label>Opis zadania</label>
    <input  class="inputTxt" name="description" type="textarea">
    <label>Kategoria</label>
    <select class="inputTxt" name="category">
    <?php foreach ($dataParams['category'] ?? [] as $category):?>
        <option><?php echo htmlentities($category['name']) ?></option>
    <?php endforeach;?>    
    </select>
    <input class="button" type="submit" name="Zapisz" value="Zapisz"/>
</form>

<table>
    <tr>
    <th>Tytul</th>
    <th>Opis</th>
    <th>Kategoria</th>
    <th>Data utworzenia</th>
    <th>Operacje</th>
    </tr>
<!--</table>
<table>-->
    <?php foreach ($dataParams['task'] ?? [] as $task):
    ?>
    <tr>
        <td><?php echo htmlentities($task['name'])?></td>
        <td><?php echo htmlentities($task['description'])?></td>
        <td><?php echo htmlentities($task['categoryName']) ?></td>
        <td><?php echo htmlentities($task['creates'])?></td>
        <td>
        <ul>
            <li  class="operacje"><a href="/?action=editTask&app=Task&id=<?php echo htmlentities($task['id'])?>">Edycja
            </a></li>
            <li  class="operacje"><a href="/?action=delTask&app=Task&id=<?php echo htmlentities($task['id'])?>">Usun
            </a></li>
        </ul>
        </td>
    </tr>
    <?php endforeach;?>
</table>
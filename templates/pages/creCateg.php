<form class="form" action="/?action=creCateg" method="POST">
    <label name="LName">Nazwa kategorii</label>
    <input class="tresc" type="text" name="Name"/>
    <input class="button" type="submit" name="Zapisz" value="Zapisz"/>
</form>
<table class="tbl-header">
    <th>Nazwa kategori</th>
    <th>Operacje</th>
</table>
<table class="tbl-content">
    <?php foreach ($dataParams['category'] ?? [] as $category):?>
    <tr>
        <td><?php echo htmlentities($category['name'])?></td>
        <td class="operacje">
            <a href="/?action=editCateg&id=<?php echo htmlentities($category['id'])?>">
                <input name="Edycja" type="button"/>Edycja</input>
            </a>
            <a href="/?action=delCateg&id=<?php echo htmlentities($category['id'])?>">
                <input name="Usun" type="button"/>Usun</input>
            </a>
        </td>
    </tr>
    <?php endforeach;?>
</table>
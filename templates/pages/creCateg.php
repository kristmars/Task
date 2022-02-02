<form class="form" action="/?action=creCateg" method="POST">
    <label name="LName">Nazwa kategorii</label>
    <input class="inputTxt" type="text" name="Name"/>
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
        <td>
            <ul>
            <li  class="operacje"><a href="/?action=editCateg&id=<?php echo htmlentities($category['id'])?>">Edycja
            </a></li>
            <li  class="operacje"><a href="/?action=delCateg&id=<?php echo htmlentities($category['id'])?>">Usun
            </a></li>
            </ul>
        </td>
    </tr>
    <?php endforeach;?>
</table>
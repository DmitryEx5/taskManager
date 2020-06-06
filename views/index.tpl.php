<table class="table">
    <thead>
    <tr>
        <? foreach ($model->fields as $dbName => $title) { ?>
            <th scope="col"><?= $title ?></th>
        <? } ?>
    </tr>
    </thead>
    <tbody>
        <? foreach ($pageData['itemsOnPage'] as $item) { ?>
            <tr>
                <th scope="row"><?= $item['id']?></th>
                <td><?= $item['username'] ?></td>
                <td><?= $item['email'] ?></td>
                <td><?= $item['task'] ?></td>
                <td><?= $item['status'] ?></td>
            </tr>
        <? } ?>
    </tbody>
</table>

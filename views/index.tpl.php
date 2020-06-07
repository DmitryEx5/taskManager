<table class="table">
    <thead>
    <tr>
        <? foreach ($model->fields as $dbName => $title) { ?>
            <th scope="col"><?= $title ?></th>
        <? } ?>
        <? if ($pageData['userRole'] == 'admin') { ?>
            <th></th>
        <? } ?>
    </tr>
    </thead>
    <tbody>
    <? foreach ($pageData['itemsOnPage'] as $item) { ?>
        <? if ($pageData['userRole'] == 'admin') { ?>
            <form method="post" action="updateTask?page=<?= $_GET['page'] ?>">
                <input type="hidden" name="task_id" value="<?= $item['id'] ?>">
                <tr>
                    <th scope="row"><?= $item['id'] ?></th>
                    <td><?= $item['username'] ?></td>
                    <td><?= $item['email'] ?></td>
                    <td><textarea style="width: 100%" name="task"><?= $item['task'] ?></textarea></td>
                    <td style="width: 5%">
                        <div class="dropdown">
                            <button class="btn btn-danger dropdown-toggle" type="button"
                                    id="dropdownMenuButton-<?= $item['id'] ?>" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                <?= $item['status'] ?>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <? foreach (TaskStatus::$statuses as $key => $title) {
                                    if ($title == $item['status']) {
                                        continue;
                                    }
                                    ?>
                                    <a class="dropdown-item"
                                       href="updateTask?page=<?= $_GET['page'] ?>&task_id=<?= $item['id'] ?>&status=<?= $key ?>&statusOnly=1"><?= $title ?></a>
                                <? } ?>
                            </div>
                        </div>
                    </td>
                    <td style="width: 5%">
                        <button class="btn btn-primary" type="submit">Сохранить</button>
                    </td>
                </tr>
            </form>
        <? } else { ?>
            <tr>
                <th scope="row"><?= $item['id'] ?></th>
                <td><?= $item['username'] ?></td>
                <td><?= $item['email'] ?></td>
                <td><?= $item['task'] ?></td>
                <td><?= $item['status'] ?></td>
            </tr>
        <? } ?>
    <? } ?>
    </tbody>
</table>

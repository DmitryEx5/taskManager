<?php
/** @var Model $model */
/** @var array $pageData */
?>
<table class="table">
    <thead>
    <tr>
        <th>#</th>
        <th><a href="sortBy?page=<?= $_GET['page'] ?>&type=username">Пользователь</a></th>
        <th><a href="sortBy?page=<?= $_GET['page'] ?>&type=email">Почта</a></th>
        <th>Задача</th>
        <th><a href="sortBy?page=<?= $_GET['page'] ?>&type=status">Статус</a></th>
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
                    <td><?= htmlspecialchars($item['username']); ?></td>
                    <td><?= htmlspecialchars($item['email']); ?></td>
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
                <td><?= htmlspecialchars($item['username']); ?></td>
                <td><?= htmlspecialchars($item['email']); ?></td>
                <td><?= htmlspecialchars($item['task']); ?></td>
                <td><?= $item['status'] ?></td>
            </tr>
        <? } ?>
    <? } ?>
    </tbody>
</table>

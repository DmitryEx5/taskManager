<?php
/** @var Model $model */
/** @var array $pageData */
?>
<table class="table">
    <thead>
    <tr>
        <th>#</th>
        <?php if (isset($_GET['userSortType']) && $_GET['userSortType'] == 'asc') {
                $userSortType = 'desc';
            } else {
                $userSortType = 'asc';
            }
            if (isset($_GET['emailSortType']) && $_GET['emailSortType'] == 'asc') {
                $emailSortType = 'desc';
            } else {
                $emailSortType = 'asc';
            }
            if (isset($_GET['statusSortType']) && $_GET['statusSortType'] == 'asc') {
                $statusSortType = 'desc';
            } else {
                $statusSortType = 'asc';
            }
        ?>
        <th>
            <a href="index?page=<?= $pageNum ?>&sortBy=username&userSortType=<?= $userSortType ?>">Имя пользователя</a>
        </th>
        <th>
            <a href="index?page=<?= $pageNum ?>&sortBy=email&emailSortType=<?= $emailSortType ?>">Email</a></th>
        <th>Текст задачи</th>
        <th>
            <a href="index?page=<?= $pageNum ?>&sortBy=status&statusSortType=<?= $statusSortType ?>">Статус</a>
        </th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <? foreach ($pageData['itemsOnPage'] as $item) { ?>
        <? if ($pageData['userRole'] == 'admin') { ?>
            <form method="post" action="updateTask?page=<?= $pageNum ?>">
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
                                       href="updateTask?page=<?= $pageNum ?>&task_id=<?= $item['id'] ?>&status=<?= $key ?>&statusOnly=1"><?= $title ?></a>
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
                <td>
                    <?= $item['status'] ?>
                </td>
                <? if ($item['was_edited']) { ?>
                    <td>
                        <i data-toggle="tooltip" data-placement="top" title="Отредактировано администратором" class="fa fa-exclamation-circle" aria-hidden="true"></i>
                    </td>
                <? } ?>
            </tr>
        <? } ?>
    <? } ?>
    </tbody>
</table>

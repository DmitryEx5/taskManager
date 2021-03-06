<?php
/** @var array $pageData */
$pageNum = empty($_GET['page']) ? 1 : $_GET['page'];
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title><?= $pageData['title'] ?></title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link href="<?= ROOT ?>/bower_components/bootstrap/dist/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="<?= ROOT ?>/bower_components/bootstrap/dist/css/bootstrap-grid.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="<?= ROOT ?>/bower_components/jquery/dist/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="<?= ROOT ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</head>
<body>
<div class="wrap">
    <? if (!empty($pageData['errors']['userNotExists'])) { ?>
        <div class="alert alert-danger" id="errorHolder">
            <strong>Ошибка!</strong> Указанный вами пользователь не существует.
        </div>
    <? } ?>
    <? if (!empty($pageData['errors']['enterDataCorrectly'])) { ?>
        <div class="alert alert-danger" id="errorHolder">
            <strong>Ошибка!</strong> Все поля являются обязательными.
        </div>
    <? } ?>
    <? if (!empty($pageData['errors']['authorise'])) { ?>
        <div class="alert alert-danger" id="errorHolder">
            <strong>Ошибка!</strong> Пожалуйста, авторизуйтесь.
        </div>
    <? } ?>
    <? if (!empty($pageData['success']['taskAdded'])) { ?>
        <div class="alert alert-success" id="errorHolder">
            <strong>Отлично!</strong> Задача добавлена.
        </div>
    <? } ?>
    <? if (!empty($pageData['success']['taskUpdated'])) { ?>
        <div class="alert alert-success" id="errorHolder">
            <strong>Отлично!</strong> Запись успешно отредактирована.
        </div>
    <? } ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="navbar-collapse" id="navbarSupportedContent">
            <button class="btn btn-success float-left" data-toggle="modal" data-target="#createTask">Добавить задачу</button>
            <? if (empty($_SESSION['user_id'])) { ?>
                <button class="btn btn-danger float-left" style="margin-left: 10px;" data-toggle="modal" data-target="#logIn"> Вход</button>
            <? } else { ?>
                <form action="logOut?page=<?= $pageNum ?>" method="post">
                    <button class="btn btn-danger float-left" style="margin-left: 10px;" type="submit" data-target="#logOut"> Выход
                        (<?= $pageData['userName'] ?>)
                    </button>
                </form>
            <? } ?>
        </div>
    </nav>
    <div class="container">
        <? include $pageData['body'] ?>
        <div class="row">
            <div class="col-md-12 text-center">
                <?= $pageData['pagination'] ?>
            </div>
        </div>
    </div>
</div>
<footer class="card-footer text-center">
    &copy; Мальяков Дмитрий, <cite>Алматы <?= date('Y') ?></cite>
</footer>

<!-- Modal Forms -->
<div class="modal fade" id="createTask" tabindex="-1" role="dialog" aria-labelledby="createTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Добавить задачу</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="newTaskForm" method="post" name="newTaskForm" action="createTask?page=<?= $pageNum ?>">
                    <div class="form-group">
                        <label for="usernameTask" class="col-form-label">Пользователь:</label>
                        <input type="text" class="form-control" id="usernameTask" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="task" class="col-form-label">Описание задачи:</label>
                        <textarea class="form-control" id="task" name="task" required></textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-success">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="logIn" tabindex="-1" role="dialog" aria-labelledby="logInModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Добавить задачу</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="logInForm" method="post" name="logInForm" action="logIn?page=<?= $pageNum ?>">
                    <div class="form-group">
                        <label for="usernameLogIn" class="col-form-label">Пользователь:</label>
                        <input type="text" class="form-control" id="usernameLogIn" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="pwd" class="col-form-label">Пароль:</label>
                        <input type="password" class="form-control" id="pwd" name="pwd" required>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-success">Войти</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('#errorHolder').delay(3000).slideUp(500);
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
</body>
</html>


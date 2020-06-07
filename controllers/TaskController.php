<?php

/**
 * Class TaskController
 */
class TaskController extends Controller
{
    private $itemsPerPage = 3;

    /**
     * TaskController constructor.
     */
    public function __construct()
    {
        $this->view = new View('views/layouts/main.tpl.php');
        $this->model = new TaskModel();
        /** @var UserModel userModel */
        $this->userModel = new UserModel();
        if (!empty($_SESSION['user_id'])) {
            $this->user = $this->userModel->getById($_SESSION['user_id']);
        }
    }

    public function indexAction()
    {
        if (!empty($_SESSION['user_id'])) {
            $user = $this->userModel->getById($_SESSION['user_id']);
            $this->pageData['userName'] = $user->username;
            $this->pageData['userRole'] = $user->role;
        } elseif (isset($_GET['login']) && $_GET['login'] == FALSE) {
            $this->pageData['errors']['userNotExists'] = 1;
        }

        if (empty($this->pageData['userRole'])) {
            $this->pageData['userRole'] = 'guest';
        }

        if (isset($_GET['authorise'])) {
            $this->pageData['errors']['authorise'] = 1;
        }

        $tpl = 'views/index.tpl.php';
        $this->pageData['title'] = "Задачник";

        $allProducts = count($this->model->getAll());

        $totalPages = ceil($allProducts / $this->itemsPerPage);
        $this->makeProductPager($allProducts, $totalPages);
        $pager = new Pager();
        $pagination = $pager->drawPager($allProducts, $this->itemsPerPage);
        $this->pageData['pagination'] = $pagination;
        $this->view->render($tpl, $this->pageData, $this->model);
    }

    public function logInAction()
    {
        if (!empty($_POST['username']) && $_POST['pwd']) {
            $userName = $_POST['username'];
            $password = $_POST['pwd'];
            $user = $this->userModel->getByParams($userName, $password);
            if (empty($user)) {
                $_SESSION['user_id'] = NULL;
                $login = 0;
            } else {
                $_SESSION['user_id'] = $user->id;
                $login = 1;
            }
        }

        $this->redirect('task', 'index', 'page=' . $_GET['page'] . '&login=' . $login);
    }

    public function logOutAction()
    {
        $_SESSION['user_id'] = NULL;
        $this->redirect('task', 'index', 'page=' . $_GET['page']);
    }

    public function createTaskAction()
    {
        if (!$this->userModel->isSessionUserAdmin()) {
            $this->redirect('task', 'index', 'page=' . $_GET['page'] . '&authorise=1');
        }

        if (empty($_POST['username']) || empty($_POST['email']) || empty($_POST['task'])) {
            $this->pageData['errors']['enterDataCorrectly'] = 1;
        } else {
            $this->model->createTask($_POST['username'], $_POST['email'], $_POST['task']);
        }

        $this->redirect('task', 'index', 'page=' . $_GET['page']);
    }

    public function updateTaskAction()
    {
        if (!$this->userModel->isSessionUserAdmin()) {
            $this->redirect('task', 'index', 'page=' . $_GET['page'] . '&authorise=1');
        }

        if (isset($_GET['statusOnly'])) {
            $this->model->updateTask($_GET['task_id'], NULL, $_GET['status'], TRUE);
        } else {
            $this->model->updateTask($_POST['task_id'], $_POST['task'], NULL);
        }
        $this->redirect('task', 'index', 'page=' . $_GET['page']);
    }

    public function deleteTaskAction()
    {

    }

    /**
     * @param $allProducts
     * @param $totalPages
     */
    public function makeProductPager($allProducts, $totalPages)
    {
        if (!isset($_GET['page']) || intval($_GET['page']) == 0 || intval($_GET['page']) == 1 || intval($_GET['page']) < 0) {
            $pageNumber = 1;
            $leftLimit = 0;
            $rightLimit = $this->itemsPerPage;
        } elseif (intval($_GET['page']) > $totalPages || intval($_GET['page']) == $totalPages) {
            $pageNumber = $totalPages;
            $leftLimit = $this->itemsPerPage * ($pageNumber - 1);
            $rightLimit = $allProducts;
        } else {
            $pageNumber = intval($_GET['page']);
            $leftLimit = $this->itemsPerPage * ($pageNumber - 1);
            $rightLimit = $this->itemsPerPage;
        }

        $this->pageData['itemsOnPage'] = $this->model->getLimitTasks($leftLimit, $rightLimit);
    }
}

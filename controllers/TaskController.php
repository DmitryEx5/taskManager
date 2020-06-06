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
                $this->pageData['errors']['userNotExists'] = 1;
            } else {
                $_SESSION['user_id'] = $user->id;
            }
        }
        $this->indexAction();
    }

    public function logOutAction()
    {
        $_SESSION['user_id'] = NULL;
        $this->indexAction();
    }

    public function createTaskAction()
    {

    }

    public function updateTaskAction()
    {

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

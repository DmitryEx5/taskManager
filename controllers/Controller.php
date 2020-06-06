<?php

require_once MODEL_PATH . 'UserModel.php';

/**
 * Class Controller
 */
class Controller
{

    public $model;
    public $view;
    /** @var UserModel */
    public $userModel;
    protected $pageData = ['errors' => []];

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->view = new View();
    }

    /**
     * @param string $msg
     */
    public function errorAction($msg = '')
    {
        if (!empty($msg)) {
            echo $msg . PHP_EOL;
        } else {
            echo 'Bad News.' . PHP_EOL;
        }
        exit;
    }

}
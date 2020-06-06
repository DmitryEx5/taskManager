<?php

/**
 * Class View
 */
class View
{

    /**
     * @var string
     */
    private $layout = '';

    /**
     * View constructor.
     * @param string $layout
     */
    public function __construct($layout = '')
    {
        if (!empty($layout)) {
            $this->layout = $layout;
        }
    }

    /**
     * @param $tpl
     * @param array $pageData
     * @param Model $model
     */
    public function render($tpl, $pageData, $model)
    {
        $pageData['body'] = $tpl;
        if (!empty($this->layout)) {
            include_once $this->layout;
        }
    }

}

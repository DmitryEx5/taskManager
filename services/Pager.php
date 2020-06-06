<?php

/**
 * Class Pager
 */
class Pager
{

    /**
     * @param $totalItems
     * @param $perPage
     * @return string|null
     */
    public function drawPager($totalItems, $perPage)
    {
        $pages = ceil($totalItems / $perPage);

        if (!isset($_GET['page']) || intval($_GET['page']) == 0) {
            $page = 1;
        } else if (intval($_GET['page']) > $totalItems) {
            $page = $pages;
        } else {
            $page = intval($_GET['page']);
        }

        if ($pages > 1) {
            $pager = "<a href='/taskManager/task/index?page=1' aria-label='Previous'><span aria-hidden='true'>«</span> Начало</a> &nbsp;";
            for ($i = 2; $i <= $pages - 1; $i++) {
                $pager .= "<a href='/taskManager/task/index?page=" . $i . "'>" . $i . "</a> &nbsp;";
            }
            $pager .= "<a href='/taskManager/task/index?page=" . $pages . "' aria-label='Next'>Конец <span aria-hidden='true'>»</span></a>";

            return $pager;
        }

        return NULL;
    }

}
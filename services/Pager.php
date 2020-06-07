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

        $addToLink = "";
        foreach ($_GET as $key => $value) {
            if ($key == 'page') continue;
            $addToLink .= "&{$key}={$value}";
        }


        if ($pages > 1) {
            $pageLink = '/task/index?page=1' . $addToLink;
            $pager = "<a href='{$pageLink}' aria-label='Previous'><span aria-hidden='true'>«</span> Начало</a> &nbsp;";
            for ($i = 2; $i <= $pages - 1; $i++) {
                $pageLink = "/task/index?page=" . $i . $addToLink;
                $pager .= "<a href='$pageLink'>" . $i . "</a> &nbsp;";
            }
            $pageLink = "/task/index?page=" . $pages . $addToLink;
            $pager .= "<a href='$pageLink' aria-label='Next'>Конец <span aria-hidden='true'>»</span></a>";

            return $pager;
        }

        return NULL;
    }

}
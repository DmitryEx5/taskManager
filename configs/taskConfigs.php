<?php

class TaskStatus
{

    /** @var string[] */
    public static $statuses = [
        1 => 'Назначена',
        2 => 'В работе',
        3 => 'Выполнена',
        4 => 'Отменена',
    ];

    /**
     * @param $statusId
     * @return string
     */
    static function getStatusName($statusId)
    {
        return self::$statuses[$statusId];
    }
}

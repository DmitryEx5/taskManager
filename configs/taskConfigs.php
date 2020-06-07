<?php

class TaskStatus
{

    /** @var string[] */
    public static $statuses = [
        1 => 'Назначена',
        2 => 'Выполнена',
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

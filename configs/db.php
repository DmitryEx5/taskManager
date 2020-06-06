<?php

/**
 * Class DB
 */
class DB
{

    /**
     * @return false|mysqli
     */
    public static function connect()
    {
        $conn = IS_DEV
            ? mysqli_connect("127.0.0.1", "root", "", "task_manager")
            : mysqli_connect("127.0.0.1", "root", "my_password", "my_db");

        if (!$conn) {
            echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
            echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
            echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }

        return $conn;
    }

}

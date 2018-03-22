<?php

namespace app\services;

use mysqli;

class Db {
    private static $conn = null;

    /**
     * @return mysqli
     */
    public static function getConn() {
        if (is_null(self::$conn)) {
            self::$conn = mysqli_connect('localhost', 'aleksey', '1234', 'words');
        }

        return self::$conn;
    }

    private function __construct()
    {
    }

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    private function __wakeup()
    {
        // TODO: Implement __wakeup() method.
    }
}
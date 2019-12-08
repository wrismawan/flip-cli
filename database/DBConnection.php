<?php

namespace Database;

use PDO;
use PDOException;

class DBConnection
{
    public static function make($config)
    {
        try {
            return new PDO(
                $config['db_connection'].';dbname='.$config['db_name'],
                $config['db_username'],
                $config['db_password']
            );
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage() . "\n";
        }
    }
}
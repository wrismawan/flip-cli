<?php

namespace FlipCLI\Database;

use PDO;
use PDOException;

class Connection
{
    protected $config;

    function __construct($config)
    {
        $this->config = $config;
    }

    public function make()
    {
        try {
            return new PDO(
                $this->config['db_connection'].';dbname='.$this->config['db_name'],
                $this->config['db_username'],
                $this->config['db_password']
            );
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage() . "\n";
        }
    }
}
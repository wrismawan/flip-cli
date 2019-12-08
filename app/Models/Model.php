<?php

namespace App\Models;

use Database\DBConnection;
use FlipCLI\App;
use PDO;

class Model
{
    protected $table;

    protected $connection;

    function __construct()
    {
        $this->connection = DBConnection::make(
            App::config('database')
        );
    }

    public function save($params)
    {
        $sql = sprintf(
            'insert into %s (%s) values (%s)',
            $this->table,
            implode(', ', array_keys($params)),
            ':' . implode(', :', array_keys($params))
        );

        try {
            $statement = $this->connection->prepare($sql);
            $statement->execute($params);
        } catch (\Exception $e) {
            echo "ERROR: " . $e->getMessage() . "\n";
        }
    }
}
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

    public function updateById($id, $params)
    {
        # convert key=>value php array format to "key=:key" format
        $paramUpdateFormat = implode(', ', array_map(
            function ($value, $key) { return sprintf("%s=:%s", $key, $key); },
            $params,
            array_keys($params)
        ));

        $sql = sprintf(
            'update %s set %s where id = %s',
            $this->table,
            $paramUpdateFormat,
            $id
        );

        echo "\nUPDATE SQL: " . $sql . "\n";

        try {
            $statement = $this->connection->prepare($sql);
            $statement->execute($params);
        } catch (\Exception $e) {
            echo "ERROR: " . $e->getMessage() . "\n";
        }
    }
}
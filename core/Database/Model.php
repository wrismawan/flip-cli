<?php

namespace FlipCLI\Database;

use FlipCLI\App;

class Model
{
    protected $table;

    protected $connection;

    function __construct()
    {
        $this->connection = App::dbConnection();
    }

    public function save($params)
    {
        # make sql format: insert into table_name (columns) values (:columns)
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

        # make sql format: update table_name set column_name=:column_name where id={id}
        $sql = sprintf(
            'update %s set %s where id = %s',
            $this->table,
            $paramUpdateFormat,
            $id
        );

        try {
            $statement = $this->connection->prepare($sql);
            $statement->execute($params);
        } catch (\Exception $e) {
            echo "ERROR: " . $e->getMessage() . "\n";
        }
    }
}
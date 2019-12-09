<?php

namespace FlipCLI;

use FlipCLI\Command\CommandController;
use FlipCLI\Command\CommandRegistry;
use FlipCLI\Database\Connection;

class App
{
    protected $printer;

    protected $commandRegistry;

    protected static $config;

    protected static $database;

    protected static $httpNetwork;

    public function __construct()
    {
        $this->printer = new Printer();
        $this->commandRegistry = new CommandRegistry();
    }

    public function setConfig($value)
    {
        static::$config = $value;
    }

    public static function config($key)
    {
        return static::$config[$key];
    }

    public function setDBConnection(Connection $connection)
    {
        static::$database = $connection->make();
    }

    public static function dbConnection()
    {
        return static::$database;
    }

    public function setHttpNetwork($value)
    {
        static::$httpNetwork = $value;
    }

    public static function httpNetwork()
    {
        return static::$httpNetwork;
    }

    public function getPrinter()
    {
        return $this->printer;
    }

    public function registerController($name, CommandController $controller)
    {
        $this->commandRegistry->registerController($name, $controller);
    }

    public function registerCommand($name, $callable)
    {
        $this->commandRegistry->registerCommand($name, $callable);
    }

    public function runCommand(array $argv = [], $defaultCommand = "help")
    {
        $commandName = $defaultCommand;

        if (isset($argv[1])) {
            $commandName = $argv[1];
        }

        try {
            call_user_func($this->commandRegistry->getCallable($commandName), $argv);
        } catch (\Exception $e) {
            $this->printer->display("ERROR: " . $e->getMessage());
            exit;
        }
    }
}
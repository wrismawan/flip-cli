<?php

namespace FlipCLI;

use FlipCLI\Command\CommandController;
use FlipCLI\Command\CommandRegistry;
use FlipCLI\Database\Connection;
use FlipCLI\Network\HttpClient;

class App
{
    protected $printer;

    protected $commandRegistry;

    protected static $config;

    protected static $database;

    protected static $httpClient;

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

    public function setHttpClient(HttpClient $client)
    {
        static::$httpClient = $client;
    }

    public static function httpClient()
    {
        return static::$httpClient;
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
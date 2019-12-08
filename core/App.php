<?php

namespace FlipCLI;

use App\Controllers\Controller;

class App
{
    protected $printer;

    protected $commandRegistry;

    public function __construct()
    {
        $this->printer = new Printer();
        $this->commandRegistry = new CommandRegistry();
    }

    public function getPrinter()
    {
        return $this->printer;
    }

    public function registerController($name, Controller $controller)
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
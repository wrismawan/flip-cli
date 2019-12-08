<?php

namespace FlipCLI;

use App\Controllers\Controller;

class CommandRegistry
{
    protected $registry = [];

    protected $controllers = [];

    public function registerController($commandName, Controller $controller)
    {
        $this->controllers[$commandName] = $controller;
    }

    public function registerCommand($name, $callable)
    {
        $this->registry[$name] = $callable;
    }

    public function getController($command)
    {
        if (! isset($this->controllers[$command])) {
            return null;
        }

        return $this->controllers[$command];
    }

    public function getCommand($command)
    {
        if (! isset($this->registry[$command])) {
            return null;
        }

        return $this->registry[$command];
    }

    public function getCallable($commandName)
    {
        $controller = $this->getController($commandName);

        if ($controller instanceof  Controller) {
            return [ $controller, 'run'];
        }

        $command = $this->getCommand($commandName);
        if ($command === null) {
            throw new \Exception("Command {$commandName} not found.");
        }

        return $command;
    }
}
<?php

namespace FlipCLI\Command;

use FlipCLI\App;

abstract class CommandController
{
    protected $app;

    protected $params;

    abstract public function run();

    public function __construct(App $app, $argv)
    {
        $this->app = $app;
        $this->argv = $argv;
        $this->params = $this->parseParams($argv);
    }

    public function getApp()
    {
        return $this->app;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function display($message)
    {
        $this->app->getPrinter()->display($message);
    }

    public function parseParams($argv)
    {
        $params = array();
        for ($i = 1; $i < count($argv); $i++) {
            if (preg_match('/^--([^=]+)=(.*)/', $argv[$i], $match)) {
                $params[$match[1]] = $match[2];
            }
        }
        return $params;
    }
}
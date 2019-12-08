<?php

namespace App\Controllers;

use FlipCLI\App;

abstract class Controller
{
    protected $app;

    abstract public function run($argv);

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    public function getApp()
    {
        return $this->app;
    }

    public function display($message)
    {
        $this->app->getPrinter()->display($message);
    }
}
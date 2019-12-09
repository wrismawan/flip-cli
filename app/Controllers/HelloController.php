<?php

namespace App\Controllers;

use FlipCLI\Command\CommandController;

class HelloController extends CommandController
{
    public function run()
    {
        $params = $this->getParams();

        $name = isset($params["name"]) ? $params["name"] : "Muhammad";
        $this->display("Hello {$name}, Welcome to Flip CLI!");
    }
}
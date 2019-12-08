<?php

namespace App\Controllers;

class HelloController extends Controller
{
    public function run()
    {
        $params = $this->getParams();

        $name = isset($params["name"]) ? $params["name"] : "Muhammad";
        $this->display("Hello {$name}, Welcome to Flip CLI!");
    }
}
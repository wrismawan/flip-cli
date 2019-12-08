<?php

namespace App\Controllers;

class HelloController extends Controller
{
    public function run($argv)
    {
        $name = isset($argv[2]) ? $argv[2] : "World";
        $this->display("Hello {$name}, Welcome to Flip CLI!");
    }
}
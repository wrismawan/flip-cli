<?php

namespace FlipCLI;

class App
{
    protected $printer;

    public function __construct()
    {
        $this->printer = new Printer();
    }

    public function runCommand(array $argv)
    {
        $name = "Muhammad";

        if (isset($argv[1])) {
            $name = $argv[1];
        }

        $this->printer->display("Welcome to Flip CLI, {$name}!");
    }
}
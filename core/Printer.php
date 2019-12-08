<?php

namespace FlipCLI;

class Printer
{
    public function output($message)
    {
        echo $message;
    }
    public function blankline()
    {
        $this->output("\n");
    }

    public function display($message)
    {
        $this->output($message);
        $this->blankline();
        $this->blankline();

    }
}
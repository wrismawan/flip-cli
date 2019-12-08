<?php

namespace App\Controllers;

class HelpController extends Controller
{
    public function run($argv)
    {
        $message =
            "Usage: php flip [COMMAND]
            \nCommand list:
            \n1. hello [YOURNAME]\tWelcome Message for testing purpose";

        $this->display($message);
    }

}
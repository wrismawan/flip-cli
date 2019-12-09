<?php

namespace App\Controllers;

use FlipCLI\Command\CommandController;

class HelpController extends CommandController
{
    public function run()
    {
        $message =
            "Usage: php flip [COMMAND]
            \nCommand list:
            \n1. hello [YOURNAME]\tWelcome Message for testing purpose";

        $this->display($message);
    }

}
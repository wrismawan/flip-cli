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
            \n1. hello [YOURNAME]
            > Welcome Message for testing purpose
            > eg: php flip hello --name='wahyu rismawan'
            
            \n2. disbursement show [PARAMETERS]
            > Get disbursement data from API by Id, then update the data if any change.
            > Parameters:
            \t--id\t : Dirsbursement Id
            > Eg: php flip disbursement show --id=123
            
            \n3. disbursement all
            > Get all disbursement data from database
            > Eg: php flip disbursement all
            
            \n4. disbursement send [PARAMETERS]
            > Send request disbursement data.
            > Parameters:
            \t--bank_code\t\t : Bank Code
            \t--account_number\t : Account Number
            \t--amount\t\t : Amount to transfer
            \t--remark\t\t : Remark disbursement
            Eg: php flip disbursement send --bank_code=021 --account_number=111-222-333 --amount=99999 --remark=\"sample remark\"";

        $this->display($message);
    }

}
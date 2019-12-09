<?php

namespace Database;

use FlipCLI\App;
use FlipCLI\Command\CommandController;

class Migration extends CommandController
{
    public function run()
    {
        $sql = "CREATE TABLE `disbursements` ( 
                    `id` VARCHAR(100) NOT NULL, 
                    `amount` INT(10) NULL , 
                    `status` VARCHAR(10) NULL , 
                    `bank_code` VARCHAR(10) NULL , 
                    `account_number` VARCHAR(100) NULL , 
                    `beneficiary_name` VARCHAR(255) NULL , 
                    `remark` VARCHAR(255) NULL , 
                    `receipt` TEXT NULL , 
                    `fee` INT(20) NULL , 
                    `time_served` VARCHAR(100) NULL , 
                    `timestamp` VARCHAR(100) NULL , 
                    PRIMARY KEY (`id`)
                ) ENGINE = InnoDB;";

        $connection = App::dbConnection();
        $connection->exec($sql);

        $this->display("> disbursement table has been created.");
    }
}
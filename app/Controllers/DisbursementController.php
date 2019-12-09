<?php

namespace App\Controllers;

use FlipCLI\App;
use FlipCLI\Command\CommandController;
use App\Models\Disbursement;

class DisbursementController extends CommandController
{
    const SHOW_DISBURSEMENT = "show";
    const SHOW_ALL_DISBURSEMENT = "all";
    const SEND_DISBURSEMENT = "send";

    protected $disbursementModel;

    public function run()
    {
        $mode = $this->argv[2];
        $params = $this->params;
        $this->disbursementModel = new Disbursement();

        switch ($mode) {
            case self::SEND_DISBURSEMENT:
                $this->send($params);
                break;
            case self::SHOW_DISBURSEMENT:
                $this->show($params);
                break;
            case self::SHOW_ALL_DISBURSEMENT:
                $this->showAll($params);
                break;
        }
    }

    private function send($params)
    {
        $this->display(">> Request send disbursement on process. Please wait....");

        $requestPayload = [
            "bank_code" => $params["bank_code"],
            "account_number" => $params["account_number"],
            "amount" => $params["amount"],
            "remark" => $params["remark"]
        ];

        $client = App::httpClient();
        $response = $client->sendRequest('POST', '/disburse', $requestPayload);
        $this->disbursementModel->make($response);
        $this->disbursementModel->save();

        $this->display("\n>> Yuhuu... Data has been saved into database. \\(^_^)/ \n");
    }

    private function show($params)
    {
        $disburseId = $params["id"];
        $this->display("\nShowing Disbursement ID = {$disburseId} on process. Please wait....\n");

        $client = App::httpClient();
        $response = $client->sendRequest("GET", "/disburse/{$disburseId}");

        $disburseDataToUpdate = [
            "status" => $response->status,
            "receipt" => $response->receipt,
            "time_served" => $response->time_served
        ];

        $this->disbursementModel->updateById($disburseId, $disburseDataToUpdate);
        $this->display("\n>> Yuhuu... Data has been updated. \\(^_^)/ \n");
    }

    private function showAll($params)
    {
        echo "show all\n";
    }


}
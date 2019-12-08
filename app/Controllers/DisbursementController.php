<?php

namespace App\Controllers;

use App\Models\Disbursement;
use FlipCLI\App;

class DisbursementController extends Controller
{
    const SHOW_DISBURSEMENT = "show";
    const SHOW_ALL_DISBURSEMENT = "all";
    const SEND_DISBURSEMENT = "send";

    protected $disbursementModel;

    public function run()
    {
        $mode = $this->argv[2];
        $params = $this->params;

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

        $this->display("disbursement");
    }

    private function send($params)
    {
        $baseURL = App::config('api')['base_url'];
        $secretKey = App::config('api')['secret_key'];
        $url = $baseURL . "/disburse";

        $requestPayload = json_encode([
            "bank_code" => $params["bank_code"],
            "account_number" => $params["account_number"],
            "amount" => $params["amount"],
            "remark" => $params["remark"]
        ]);

        echo "Request disbursement on process. Please wait....\n\n";
        echo ">>URL: " . $url . "\n";
        echo ">>Payload: " . $requestPayload . "\n";

        $client = curl_init($url);
        curl_setopt($client, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($client, CURLOPT_USERPWD, $secretKey);
        curl_setopt($client, CURLOPT_POSTFIELDS, $requestPayload);
        curl_setopt($client, CURLOPT_POST, 1);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

        $response = json_decode(curl_exec($client));

        $responseData = [
            "id" => $response->id,
            "amount" => $response->amount,
            "status" => $response->status,
            "account_number" => $response->account_number,
            "bank_code" => $response->bank_code,
            "beneficiary_name" => $response->beneficiary_name,
            "receipt" => $response->receipt,
            "remark" => $response->remark,
            "fee" => $response->fee,
            "timestamp" => $response->timestamp,
            "time_served" => $response->time_served
        ];

        var_dump(json_encode($responseData));

        $disbursementModel = new Disbursement();
        $disbursementModel->save($responseData);

        echo "\n>> SUCCESS Response: ";
        var_dump(json_encode($response));

    }

    private function show($params)
    {
        $baseURL = App::config('api')['base_url'];
        $secretKey = App::config('api')['secret_key'];
        $disburseId = $params["id"];
        $url = $baseURL . "/disburse/" . $disburseId;

        echo "Showing Disbursement {$disburseId} on process. Please wait....\n";
        echo ">> URL: " . $url . "\n";

        $client = curl_init($url);
        curl_setopt($client, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($client, CURLOPT_USERPWD, $secretKey);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = json_decode(curl_exec($client));

        $params = [
            "status" => $response->status,
            "receipt" => $response->receipt,
            "time_served" => $response->time_served
        ];

        $disbursementModel = new Disbursement();
        $disbursementModel->updateById($disburseId, $params);

        echo "\n>> SUCCESS RESPONSE: " . json_encode($response);
    }

    private function showAll($params)
    {
        echo "show all\n";
    }


}
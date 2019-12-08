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
        echo "Request disbursement on process. Please wait....\n";
        var_dump(json_encode($params));

        $baseURL = App::config('api')['base_url'];
        $secretKey = App::config('api')['secret_key'];

        $url = $baseURL . "/disburse";

        $client = curl_init($url);

        $requestPayload = json_encode([
            "bank_code" => $params["bank_code"],
            "account_number" => $params["account_number"],
            "amount" => $params["amount"],
            "remark" => $params["remark"]
        ]);

        curl_setopt($client, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($client, CURLOPT_USERPWD, $secretKey);
        curl_setopt($client, CURLOPT_POSTFIELDS, $requestPayload);
        curl_setopt($client, CURLOPT_POST, 1);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

        /*
         * "{"id":6793792503,
         * "amount":99999,"status":"PENDING",
         * "timestamp":"2019-12-08 20:35:54",
         * "bank_code":"021","account_number":"111-222-333",
         * "beneficiary_name":"PT FLIP","remark":"cobain dulu",
         * "receipt":null,"time_served":"0000-00-00 00:00:00",
         * "fee":4000}"
         */

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

        $disbursementModel = new Disbursement();
        $disbursementModel->save($responseData);
        var_dump(json_encode($response));

    }

    private function show($params)
    {
        echo "show\n";
        var_dump(App::config('database'));
        var_dump($params);
    }

    private function showAll($params)
    {
        echo "show all\n";
        var_dump($params);
    }


}
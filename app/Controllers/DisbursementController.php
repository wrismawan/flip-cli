<?php

namespace App\Controllers;

class DisbursementController extends Controller
{
    const SHOW_DISBURSEMENT = "show";
    const SHOW_ALL_DISBURSEMENT = "all";
    const SEND_DISBURSEMENT = "send";

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
        var_dump($params);

        $url = "https://nextar.flip.id/disburse";
        $secretKey = "HyzioY7LP6ZoO7nTYKbG8O4ISkyWnX1JvAEVAhtWKZumooCzqp41";

        $client = curl_init($url);

        $payload = json_encode([
            "bank_code" => $params["bank_code"],
            "account_number" => $params["account_number"],
            "amount" => $params["amount"],
            "remark" => $params["remark"]
        ]);

        curl_setopt($client, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($client, CURLOPT_USERPWD, $secretKey);
        curl_setopt($client, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($client, CURLOPT_POST, 1);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        var_dump($response);
    }

    private function show($params)
    {
        echo "show\n";
        var_dump($params);
    }

    private function showAll($params)
    {
        echo "show all\n";
        var_dump($params);
    }


}
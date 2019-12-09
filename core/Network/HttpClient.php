<?php

namespace FlipCLI\Network;

class HttpClient
{
    protected $config;

    protected $result;

    protected $baseUrl;

    const POST_METHOD = 'POST';
    const GET_METHOD = 'GET';

    function __construct($config)
    {
        $this->config = $config;
        $this->baseUrl = $config['base_url'];
    }

    public function sendRequest($method, $endPoint, $payload = null)
    {
        $url = $this->baseUrl . $endPoint;
        echo ">> REQUEST [{$method}]: {$url}\n";
        echo ">> REQUEST PAYLOAD: ". json_encode($payload) . "\n";
        echo ">> Please wait....\n";

        try {
            $client = curl_init($url);

            if ($method == self::POST_METHOD) {
                curl_setopt($client, CURLOPT_POSTFIELDS, json_encode($payload));
                curl_setopt($client, CURLOPT_POST, 1);
            }

            curl_setopt($client, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            curl_setopt($client, CURLOPT_USERPWD, $this->config['secret_key']);
            curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

            $this->result = curl_exec($client);

            echo "\n>> REQUEST SUCCESS. YEAY!!";
            echo "\n>> Response Data: " . $this->result . "\n";

            return json_decode($this->result);
        } catch (\Exception $e) {
            echo "ERROR: " . $e->getMessage() . "\n";
            exit;
        }

    }
}
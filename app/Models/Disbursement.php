<?php

namespace App\Models;

use FlipCLI\Database\Model;

class Disbursement extends Model
{
    protected $table = "disbursements";

    protected $data;

    public function make($data)
    {
        $this->data = [
            "id" => $data->id,
            "amount" => $data->amount,
            "status" => $data->status,
            "account_number" => $data->account_number,
            "bank_code" => $data->bank_code,
            "beneficiary_name" => $data->beneficiary_name,
            "receipt" => $data->receipt,
            "remark" => $data->remark,
            "fee" => $data->fee,
            "timestamp" => $data->timestamp,
            "time_served" => $data->time_served
        ];
    }

    public function save()
    {
        parent::save($this->data);
    }

    public function display($data)
    {
        echo "\nId\t\t\t: {$data["id"]}";
        echo "\nAmount\t\t\t: {$data["amount"]}";
        echo "\nStatus\t\t\t: {$data["status"]}";
        echo "\nBank Code\t\t: {$data["bank_code"]}";
        echo "\nAccount Number\t\t: {$data["account_number"]}";
        echo "\nBeneficiary Name\t: {$data["beneficiary_name"]}";
        echo "\nRemark\t\t\t: {$data["remark"]}";
        echo "\nReceipt\t\t\t: {$data["receipt"]}";
        echo "\nFee\t\t\t: {$data["fee"]}";
    }
}
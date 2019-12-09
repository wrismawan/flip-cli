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
}
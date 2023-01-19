<?php

namespace src\formatters;
use src\core\Helpers\Formatter;
use src\core\Constants\General;

class ApplicationFormatter extends Formatter
{
    public function getApplication($data)
    {
        $fields = [
            'id' => 'id',
            'user_id' => 'user_id',
            'first_name' => 'first_name',
            'last_name' => 'last_name',
            'gender' => 'gender',
            'title' => 'title',
            'dob' => 'dob',
            'status' => 'status',
            'date_added' => 'date_added',
        ];

        $result = $this->format($data, $fields);

        $result['status_id'] = $result['status']; 
        $result['status'] = General::APPLICATION_STATUS_MAP[$result['status']] ?? 'N/A';
        $result['gender'] = General::GENDER_MAP[$result['gender']] ?? 'N/A';

        return $result;
    }
}
<?php

namespace src\formatters;
use src\core\Helpers\Formatter;

class ServiceFormatter extends Formatter
{
    public function getApplicationService($data)
    {
        $fields = [
            'id' => 'id',
            'count' => 'count',
            'name' => 'name',
            'country' => 'country',
            'application_title' => 'application_title',
            'description' => 'description',
            'application_id' => 'application_id',
            'service_id' => 'service_id',
            'date_ordered' => 'date_ordered',
        ];

        return $this->format($data, $fields);
    }
}
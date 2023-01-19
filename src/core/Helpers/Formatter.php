<?php

namespace src\core\Helpers;

//formatter class where it is being extended by other formatter classes.
//used for formatting data between entities and DB result, etc.
class Formatter
{
    private $method = null;
    protected function format($data, $fields)
    {
        if (empty($this->method))
        {
            throw new \Exception("No Formatter method chosen");
        }

        switch($this->method)
        {
            case 'arrayToArray':
            {
                return $this->mapArrayToArray($data, $fields);
            }break;
            case 'objectToArray':
            {
                return $this->mapObjectToArray($data, $fields);
            }break;
            default: throw new \Exception("No Formatter method chosen");

        }
    }

    public function mapArrayToArray($data, $fields)
    {
        $result = [];
        foreach($fields ?? [] as $key => $value)
        {
            if (isset($data[$key]))
            {
                $result[$value] = $data[$key];
            }
        }
        return $result;
    }

    public function mapObjectToArray($data, $fields)
    {
        $data = (array) $data;
        $result = [];
        foreach($fields ?? [] as $key => $value)
        {
            if (isset($data[$key]))
            {
                $result[$value] = $data[$key];
            }
        }
        return $result;
    }

    public function arrayToArray()
    {
        $this->method = 'arrayToArray';
        return $this;
    }

    public function objectToArray()
    {
        $this->method = 'objectToArray';
        return $this;
    }


}
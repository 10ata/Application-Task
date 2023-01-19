<?php

namespace src\Models;

use src\core\MVC\AbstractModel;

class Service extends AbstractModel
{
    public $id;
    public $country_id;
    public $user_id;
    public $name;
    public $description;
    public $available;
    public $date_added;
    public $date_updated;

    public function getSource()
    {
        return 'ent_service';
    }

    public function getAll($throw = false)
    {
        
        $params = [
            'order' => 'date_added DESC'
        ];

        $result = $this->find($params);

        if ($throw && empty($result)) {
            throw new \Exception("getAllDescending error!");
        }

        return $result;
    }
}
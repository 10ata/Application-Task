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

    public function getById($id, $throw = false)
    {
        $params = [
            'conditions' => 'name = :country: AND ',
            'bind' => ['country' => 'Bulgaria'],
            'limit' => 1,
            'order' => 'name DESC'
        ];

        return $country;

    }

    public function getByCountryName($name, $throw = false)
    {
        $params = [
            'conditions' => 'name = :country:',
            'bind' => ['country' => $name],
            'limit' => 1,
            'order' => 'name DESC'
        ];

        $country = $this->findFirst($params);

        if ($throw && empty($country)) {
            throw new \Exception("Country `$name` is not found!");
        }

        return $country;
    }
}
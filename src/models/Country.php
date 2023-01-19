<?php

namespace src\Models;

use src\core\MVC\AbstractModel;

class Country extends AbstractModel
{
    public $id;
    public $iso2;
    public $name;

    public function getSource()
    {
        return 'par_country';
    }

    public function getByIso2($iso2, $throw = false)
    {
        $params = [
            'conditions' => 'iso2 = :iso2:',
            'bind' => ['iso2' => $iso2],
            'limit' => 1,
            'order' => 'name DESC'
        ];

        $country = $this->findFirst($params);

        if ($throw && empty($country)) {
            throw new \Exception("Country `$name` is not found!");
        }

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
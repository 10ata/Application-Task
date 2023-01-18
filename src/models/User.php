<?php

namespace src\Models;

use src\core\MVC\AbstractModel;

class User extends AbstractModel
{
    public $id;
    public $email;
    public $password;
    public $first_name;
    public $last_name;
    public $date_added;

    public function getSource()
    {
        return 'ent_user';
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
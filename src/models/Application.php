<?php

namespace src\Models;

use src\core\MVC\AbstractModel;

class Application extends AbstractModel
{
    public $id;
    public $user_id;
    public $first_name;
    public $last_name;
    public $dob;
    public $gender;
    public $title;
    public $status;
    public $date_added;

    public function getSource()
    {
        return 'ent_application';
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
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

    public function getAllDescending($throw = false)
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
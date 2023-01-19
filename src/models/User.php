<?php

namespace src\Models;

use src\core\MVC\AbstractModel;
use src\core\Helpers\General;

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

    public function getByEmailAndPassword($email, $password, $throw = false)
    {
        $generalHelper = new General();
        $password_encrypted = $generalHelper->encryptData($password);
        $params = [
            'conditions' => 'email = :email: AND password = :password:',
            'bind' => ['email' => $email, 'password' => $password_encrypted],
            'limit' => 1
        ];

        $user = $this->findFirst($params);

        if ($throw && empty($user)) {
            throw new \Exception("User with email: `$email` is not found!");
        }

        return $user;
    }
}
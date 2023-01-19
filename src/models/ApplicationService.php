<?php

namespace src\Models;

use src\core\MVC\AbstractModel;

class ApplicationService extends AbstractModel
{
    public $id;
    public $application_id;
    public $service_id;
    public $date_ordered;

    public function getSource()
    {
        return 'ent_application_service';
    }


    public function getResultFromLastSevenDays($throw = false)
    {
        $current_date = date("Y-m-d H:i:s");
        $one_week_ago = new \DateTime($current_date);
        $one_week_ago->modify('-7 days');
        $one_week_ago_formatted = $one_week_ago->format("Y-m-d H:i:s");
        
        $query = "SELECT COUNT(*) as count, S.name, C.name AS country, S.description ";
        $query .="FROM ent_application_service AS SA ";
        $query .="JOIN ent_service AS S ";
        $query .="ON S.id = SA.service_id ";
        $query .="JOIN ent_application AS A ";
        $query .="ON A.id = SA.application_id ";
        $query .="JOIN par_country AS C ";
        $query .="ON C.id = S.country_id ";
        $query .="WHERE SA.date_ordered > '" . $one_week_ago_formatted . "' ";
        $query .="GROUP BY S.id ";
        $query .="ORDER BY COUNT desc ";
        $query .="LIMIT 3;";
        $result = $this->dbManager->query($query);

        if ($throw && empty($result)) {
            throw new \Exception("getResultFromLastSevenDays failed!");
        }

        return $result;
    }

    public function getByApplicationId($id, $throw = false)
    {
        $query = "SELECT S.id as id, S.name, C.name AS country, A.title AS application_title, SA.date_ordered ";
        $query .="FROM ent_application_service AS SA ";
        $query .="JOIN ent_service AS S ";
        $query .="ON S.id = SA.service_id ";
        $query .="JOIN ent_application AS A ";
        $query .="ON A.id = SA.application_id ";
        $query .="JOIN par_country AS C ";
        $query .="ON C.id = S.country_id ";
        $query .="WHERE A.id = '" . $id . "' ";
        $query .="ORDER BY SA.date_ordered desc;";
        $result = $this->dbManager->query($query);

        if ($throw && empty($result)) {
            throw new \Exception("getByApplicationId failed!");
        }

        return $result;
    }

    public function getByApplicationIdAndServiceId($id, $service_id, $throw = false)
    {
        $params = [
            'conditions' => 'application_id = :application_id: AND service_id = :service_id:',
            'bind' => ['application_id' => $id, 'service_id' => $service_id],
            'limit' => 1,
            'order' => 'date_ordered DESC'
        ];

        $result = $this->findFirst($params);

        if ($throw && empty($result)) {
            throw new \Exception("getByApplicationId failed!");
        }

        return $result;
    }
}
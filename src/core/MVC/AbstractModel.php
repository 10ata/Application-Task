<?php

namespace src\core\MVC;
use src\core\Helpers\DBManager;

abstract class AbstractModel
{
    protected $dbManager;

    private $fields;
    public function __construct()
    {
        $this->dbManager = DBManager::getInstance();
        $this->fields = get_object_vars($this);
        unset($this->fields['dbManager']);
        unset($this->fields['fields']);
    }

  
    protected abstract function getSource();

    protected function find($parameters = null)
    {

        return $this->dbManager->query($this->mapParametersToSelectQuery($parameters));
    }

    protected function findFirst($parameters = null)
    {
        $result = $this->dbManager->query($this->mapParametersToSelectQuery($parameters))[0] ?? null;

        if (!empty($result)) {
            foreach($result as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->{$key} = $value;
                }
            }
            return $this;
        }

        return null;
    }

    public function save($data = null)
    {
        return $this->dbManager->execute($this->mapFieldsToQuery());
    }

    public function delete()
    {

    }

    public function getById($id, $throw = false)
    {
        $params = [
            'conditions' => 'id = :id:',
            'bind' => ['id' => $id],
            'limit' => 1
        ];

        $entity = $this->findFirst($params);

        if ($throw && empty($entity)) {
            throw new \Exception("Entity `" . get_class($this) . "` with ID `$id` is not found from the DB!");
        }
        return $entity;
    }

    private function mapFieldsToQuery()
    {
        if (isset($this->fields['id']))
        {

          // UPDATE $this->table SET $this->fields;
            $query = "UPDATE `" . $this->getSource() . "` SET ";
            foreach($this->fields ?? [] as $field => $value) {
                if ($field == 'id') {
                    continue;
                }
                $value = is_numeric($this->$field) ? $this->$field : "'" . $this->$field . "'";
                $query .= "`$field`= $value, ";
            }

            $query = substr($query, 0, -2);
            $query .= ' WHERE id = ' . $this->fields['id'] . ';';
        }
        else
        {
          // INSERT INTO $this->table $this->fields;
          $query = "INSERT INTO `" . $this->getSource() . "` (";
            foreach($this->fields ?? [] as $field => $value) {
                if ($field == 'id') {
                    continue;
                }
                $query .= "$field, ";
            }

            $query = substr($query, 0, -2);
            $query .= ') VALUES (';

            foreach($this->fields ?? [] as $field => $value) {
                if ($field == 'id') {
                    continue;
                }
                $value = is_numeric($this->$field) ? $this->$field : "'" . $this->$field . "'";
                $query .= "$value, ";
            }

            $query = substr($query, 0, -2);
            $query .= ');';
        }
        
        return $query;
    }

    //to be moved in abstract class of this abstract class
    private function mapParametersToSelectQuery($parameters = null)
    {

        /*SELECT column_name(s)
        FROM table_name
        WHERE condition
        LIMIT number;

        SELECT column1, column2, ...
        FROM table_name
        ORDER BY column1, column2, ... ASC|DESC;

        $params = [
            'conditions' => 'name = :country: AND ',
            'bind' => ['country' => 'Bulgaria'],
            'limit' => 1,
            'order' => 'name DESC'
        ];*/

        $instruction = 'SELECT * FROM ';
        //from proeprty
        $where = $parameters['conditions'] ?? null;

        /*if (empty($where)) {
            throw new \Exception("Caugh MySQL Exception while preparing statement: Conditions parameters are empty!");
        }*/

        if (!empty($where)) {
            preg_match_all('/(:.*?:)/', $parameters['conditions'], $matches);
            if (count($matches) > 0) {
                 foreach($matches[0] ?? [] as $match)
                {
                    $val = "'" . $parameters['bind'][trim($match, ':')] . "'";
                    $where = str_replace($match, $val, $where);
                }
    
                
                if (str_contains($where, ':')) {
                    throw new \Exception("Caugh MySQL Exception while preparing statement: Not all bind parameters were given!");
                }
            }
        }
        

        if (!empty($where)) {
            $query = $instruction . '`'. $this->getSource() . '` WHERE ' . $where;
        } else {
            $query = $instruction . '`'. $this->getSource() . '`';
        }
       

        if (isset($parameters['order'])) {
            $query.= ' ORDER BY ' . $parameters['order'];
        }

        if (isset($parameters['limit'])) {
            $query.= ' LIMIT ' . $parameters['limit'];
        }

        $query.= ';';
        return $query;
    }

}

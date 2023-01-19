<?php

namespace src\core\Helpers;

use src\core\Helpers\ConfigLoader;

class DBManager
{
    /**
     * @var array $instances
     */
    private static $instances = [];

    protected $conn = null;
    protected $query = null;

    protected function __construct() {
    }

    protected function __clone() { }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton." . $GLOBALS['newline']);
    }

    public static function getInstance(): DBManager
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }

    private function connect()
    {
        $configLoader = ConfigLoader::getInstance();
        $config = $configLoader->load('config');

        if (!isset($config['mysql'])) {
            throw new \Exception("Missing mysql configuration!");
        }
        extract($config['mysql']);
        // Create connection
        $this->conn = new \mysqli($host . ':' . $port, $username, $password, $db_name);

        // Check connection
        if ($this->conn->connect_error) {
            throw new \Exception("Connection failed: " . $this->conn->connect_error);
        }
    }

    private function close()
    {
        $this->conn->close();
    }

    public function preparedStatement($stmt)
    {

    }

    //for select
    public function query($query = null): array
    {
        if (!empty($query)) {
            $this->query = $query;
        }

        if (empty($this->query)) {
            throw new \Exception("Query is empty!");
        }

        try {
            $this->connect();

            $result = $this->conn->query($this->query);
            $formatted_result = [];
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    $formatted_result[] = $row;
                }
            } 

            $this->close();

            return $formatted_result;
        } catch (\Exception $e) {
            echo 'Caught MySQL query exception: ', $e->getMessage(), str_replace("#", "<br>#", $e->getTraceAsString());
        }
    }

    //For insert, update
    public function execute($query = null): mixed
    {
        if (!empty($query)) {
            $this->query = $query;
        }

        if (empty($this->query)) {
            throw new \Exception("Query is empty!");
        }

        try {
            $this->connect();

            $result = $this->conn->query($this->query);
            
            $this->close();

            return $result;
        } catch (\Exception $e) {
            echo 'Caught MySQL execute exception: ', $e->getMessage(), str_replace("#", "<br>#", $e->getTraceAsString());
        }
    }

    public function setQuery($query)
    {
        $this->query = $query;
    }

}
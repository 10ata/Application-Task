<?php

namespace src\core\Helpers;

//Singleton class ConfigLoader to load configs from a folder (depending on the environment)
class ConfigLoader
{
    /**
     * @var array $instances
     */
    private static $instances = [];

    public $configs = [];

    protected function __construct() {
    }

    protected function __clone() { }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    public static function getInstance(): ConfigLoader
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }

    public function load($config)
    {
        if (!isset($this->configs[$config]))
        {
            $this->configs[$config] = include CONFIGS_DIR . ENVIRONMENT . '\\' . $config . '.php';
        }
        
        return $this->configs[$config];
    }
}
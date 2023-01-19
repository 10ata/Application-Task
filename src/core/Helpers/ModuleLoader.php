<?php

namespace src\core\Helpers;
use src\core\Constants\General;

//Singleton class ModelLoader to load entity modules
class ModuleLoader
{
    /**
     * @var array $instances
     */
    private static $instances = [];

    public $modules = [];

    protected function __construct() {
    }

    protected function __clone() { }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    public static function getInstance(): ModuleLoader
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }

    public function load($module)
    {
        $class = General::MODULES_DIR . $module;
        if (!isset($this->modules[$module]))
        {
            
            $this->modules[$module] = new $class();
        }
        
        return $this->modules[$module];
    }
}
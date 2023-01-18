<?php

namespace src\core\Helpers;
use src\core\Constants\General;

//Singleton class FormatterLoader to load formatter classes
class FormatterLoader
{
    /**
     * @var array $instances
     */
    private static $instances = [];

    public $models = [];

    protected function __construct() {
    }

    protected function __clone() { }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    public static function getInstance(): FormatterLoader
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }

    public function load($model)
    {
        $class = General::FORMATTERS_DIR . $model;
        if (!isset($this->models[$model]))
        {
            
            $this->models[$model] = new $class();
        }
        
        return $this->models[$model];
    }
}
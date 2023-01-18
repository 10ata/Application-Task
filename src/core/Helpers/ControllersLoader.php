<?php

namespace src\core\Helpers;

//Singleton class ControllersLoader to load all controllers
class ControllersLoader
{
    /**
     * @var array $instances
     */
    private static $instances = [];

    private $controllers = [];
    public $controller_names = [];

    protected function __construct() {
        $this->loadControllers();
    }

    protected function __clone() { }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    public static function getInstance(): ControllersLoader
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }

    private function loadControllers()
    {
        $filenames = array_filter(scandir(CONTROLLERS_DIR), function ($item) {
            return !is_dir(CONTROLLERS_DIR . $item);
        });

        $filenames = array_map(function ($value){
            return strtolower(pathinfo($value, PATHINFO_FILENAME));;
        }, $filenames);

        $this->controller_names = array_values($filenames);
    }
    
    public function getControllerNames()
    {
        return $this->controller_names;
    }

    public function load($class)
    {
        if (!isset($this->classes[$class]))
        {
            $this->classes[$class] = new $class();
            
        }
        
        return $this->classes[$class];
    }
}
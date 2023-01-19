<?php

namespace src\core\MVC;

use src\core\Helpers\ConfigLoader;
use src\core\Helpers\ModelLoader;
use src\core\Helpers\FormatterLoader;
abstract class AbstractController
{
    protected $modelLoader;
    protected $configLoader;
    protected $formatter;

    public function __construct()
    {
        $this->modelLoader = ModelLoader::getInstance();
        $this->configLoader = ConfigLoader::getInstance();
        $this->formatter = FormatterLoader::getInstance();
    }

    //Simple function to render a template with variables
    public function render($template, $param = NULL){

        if (!empty($_SESSION['previous_location']) && count($_SESSION['previous_location']) > 1)
        {
            unset($_SESSION['previous_location'][0]);
            $_SESSION['previous_location'] = array_values($_SESSION['previous_location']);
        }
        if (!str_contains($_SERVER["REQUEST_URI"],'/login')) {
            $_SESSION['previous_location'][] = $_SERVER["REQUEST_URI"];
        }
        
        ob_start();
        if($param)
            extract($param, EXTR_SKIP);
        require_once('../src/views/' . $template . '.php');
    }
}
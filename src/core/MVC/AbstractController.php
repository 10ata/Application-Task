<?php

namespace src\core\MVC;

use src\core\Helpers\ConfigLoader;
use src\core\Helpers\ModelLoader;
use src\core\Helpers\ModuleLoader;
use src\core\Helpers\FormatterLoader;
abstract class AbstractController
{
    protected $modelLoader;
    protected $moduleLoader;
    protected $configLoader;
    protected $formatter;

    public function __construct()
    {
        $this->modelLoader = ModelLoader::getInstance();
        $this->configLoader = ConfigLoader::getInstance();
        $this->formatter = FormatterLoader::getInstance();
        $this->moduleLoader = ModuleLoader::getInstance();
    }

    protected function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    protected function getRequestedData()
    {
        return $_POST;
    }

    //Simple function to render a template with variables
    protected function render($template, $param = NULL){

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

    protected function redirect($path = '/', $message = null, $is_error_message = false)
    {
        if (!empty($message)) {
            $_SESSION[$is_error_message ? 'errorMessage' : 'infoMessage'] = $message;
        }
        
        header("Location: http://" . $_SERVER['SERVER_NAME'] . $path);
        exit();
    }
}
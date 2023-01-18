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
        
        ob_start();
        if($param)
            extract($param, EXTR_SKIP);
        require_once('../src/views/' . $template . '.php');
    }
}